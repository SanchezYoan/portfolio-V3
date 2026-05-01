FROM php:8.4-fpm

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfony

# Dépendances PHP
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --prefer-dist

# Dépendances JS
COPY package.json package-lock.json ./
RUN npm ci

# Copie du projet
COPY . .

RUN composer dump-autoload --optimize

# Permissions
RUN chown -R www-data:www-data /var/www/symfony/var

EXPOSE 9000
CMD ["php-fpm"]