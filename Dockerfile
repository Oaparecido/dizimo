FROM node:22-alpine AS build-assets
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

FROM composer:2 AS build-vendor
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

FROM php:8.4-cli-alpine AS final
WORKDIR /app

RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pdo_sqlite \
    zip \
    bcmath \
    opcache

COPY --from=build-assets --chown=www-data:www-data /app/public/build /app/public/build
COPY --from=build-vendor --chown=www-data:www-data /app/vendor /app/vendor

COPY --chown=www-data:www-data . .

RUN chmod -R 775 storage bootstrap/cache

COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]
