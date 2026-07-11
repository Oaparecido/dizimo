FROM composer:2 AS vendor
WORKDIR /app

COPY composer.json composer.lock ./
COPY artisan .
COPY bootstrap/app.php bootstrap/providers.php bootstrap/
RUN composer install --no-dev --no-interaction --ignore-platform-reqs --no-scripts

FROM php:8.4-cli-alpine AS final
WORKDIR /app

RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    zip \
    bcmath \
    opcache

COPY --from=vendor --chown=www-data:www-data /app/vendor /app/vendor

COPY --chown=www-data:www-data . .

RUN chmod -R 775 storage bootstrap/cache

COPY start.sh /start.sh
RUN chmod +x /start.sh

ENV PHP_CLI_SERVER_WORKERS=4

EXPOSE 10000

CMD ["/start.sh"]
