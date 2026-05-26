# =============================================================================
# Stage 1 – Frontend build (only in prod target)
# =============================================================================
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# =============================================================================
# Stage 2 – PHP base (shared by dev + prod)
# =============================================================================
FROM php:8.4-apache AS base

RUN apt-get update && apt-get install -y         git curl unzip         libzip-dev libicu-dev libonig-dev         libpng-dev libjpeg62-turbo-dev libfreetype6-dev         libxml2-dev     && docker-php-ext-configure gd --with-freetype --with-jpeg     && docker-php-ext-install pdo_mysql bcmath gd pcntl intl zip     && a2enmod rewrite headers     && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

EXPOSE 80

# =============================================================================
# Stage 3 – Development
# (cod montat via volume, fara COPY)
# =============================================================================
FROM base AS dev

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -     && apt-get install -y nodejs     && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY .docker/start.dev.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]

# =============================================================================
# Stage 4 – Production
# =============================================================================
FROM base AS prod

COPY . /var/www/html
COPY --from=frontend /app/public/build /var/www/html/public/build

# --no-scripts: skip post-autoload-dump (package:discover needs APP_KEY at runtime)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

RUN chown -R www-data:www-data /var/www/html     && chmod -R 775 storage bootstrap/cache

COPY .docker/start.prod.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
