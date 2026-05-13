# ─────────────────────────────────────────────────────────────
# Stage 1 — PHP vendor dependencies
# ─────────────────────────────────────────────────────────────
FROM composer:2.7 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-scripts \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --ignore-platform-req=php && \
    rm -f vendor/composer/platform_check.php || true

# ─────────────────────────────────────────────────────────────
# Stage 2 — JS/CSS build (webpack encore)
# ─────────────────────────────────────────────────────────────
FROM node:20-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json webpack.config.js ./

RUN npm ci --silent

# Sources frontend nécessaires à Encore/Vue
COPY assets/ ./assets/
COPY public/ ./public/

RUN npm run build

# ─────────────────────────────────────────────────────────────
# Stage 3 — PHP-FPM production image  (target: app)
# ─────────────────────────────────────────────────────────────
FROM php:8.4-fpm AS app

RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        zip \
        unzip \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        exif \
        pcntl \
    && apt-get purge -y --auto-remove \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfony

# Dépendances PHP installées dans le stage vendor
COPY --from=vendor /app/vendor ./vendor/

# Sources du projet Symfony (copie APRÈS vendor, en excluant vendor/ et node_modules/)
COPY --chown=www-data:www-data . .
RUN rm -rf vendor node_modules && mkdir -p vendor/composer

# Recopy vendor depuis le stage (après avoir supprimé le vendor du local)
COPY --from=vendor /app/vendor ./vendor/

# Assets compilés par Webpack Encore
COPY --from=assets /app/public/build ./public/build/

# Sauvegarde des assets pour les restaurer au démarrage (après volume mount)
RUN cp -r public/build /tmp/build_backup

# Prépare les répertoires de cache/log
RUN mkdir -p var/cache var/log \
    && chown -R www-data:www-data var/ \
    && rm /usr/bin/composer

# PHP-FPM listen on all interfaces so nginx can reach it
RUN echo "listen = 0.0.0.0:9000" > /usr/local/etc/php-fpm.d/zz-docker.conf

# Entrypoint: migrations + assets + cache au démarrage
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 9000
ENTRYPOINT ["/entrypoint.sh"]

# ─────────────────────────────────────────────────────────────
# Stage 4 — nginx production image  (target: nginx)
# ─────────────────────────────────────────────────────────────
FROM nginx:alpine AS nginx

COPY docker/nginx.conf /etc/nginx/conf.d/default.conf

# Fichiers statiques depuis le projet + assets compilés depuis le stage assets
COPY public/ /var/www/symfony/public/
COPY --from=assets /app/public/build /var/www/symfony/public/build

EXPOSE 80