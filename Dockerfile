# ─────────────────────────────────────────────────────────────
# Stage 1 — PHP vendor dependencies (no dev)
# ─────────────────────────────────────────────────────────────
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# ─────────────────────────────────────────────────────────────
# Stage 2 — JS/CSS build (webpack encore)
# ─────────────────────────────────────────────────────────────
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json webpack.config.js ./
RUN npm ci --silent
COPY assets/ ./assets/
RUN npm run build

# ─────────────────────────────────────────────────────────────
# Stage 3 — PHP-FPM production image  (target: app)
# ─────────────────────────────────────────────────────────────
FROM php:8.4-fpm AS app

RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev libonig-dev libxml2-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl \
    && apt-get purge -y --auto-remove \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfony

COPY . .
COPY --from=vendor /app/vendor ./vendor/
COPY --from=assets /app/public/build ./public/build/

# Régénère le classmap avec les fichiers src/ disponibles, puis nettoie composer
RUN composer dump-autoload --optimize --no-dev \
    && rm /usr/bin/composer \
    && mkdir -p var/cache var/log \
    && chown -R www-data:www-data var/

EXPOSE 9000
CMD ["php-fpm"]

# ─────────────────────────────────────────────────────────────
# Stage 4 — nginx production image  (target: nginx)
# ─────────────────────────────────────────────────────────────
FROM nginx:alpine AS nginx

COPY docker/nginx.conf /etc/nginx/conf.d/default.conf
# Fichiers statiques depuis le projet + assets compilés depuis le stage assets
COPY public/ /var/www/symfony/public/
COPY --from=assets /app/public/build /var/www/symfony/public/build

EXPOSE 80
