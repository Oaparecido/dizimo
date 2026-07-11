#!/bin/sh

set -e

db_ready() {
    php -r "try {
        new PDO('pgsql:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');
        exit(0);
    } catch (\PDOException \$e) {
        exit(1);
    }" 2>/dev/null
}

echo "Waiting for database..."
until db_ready; do
    sleep 1
done
echo "Database ready."

if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
    php artisan key:generate --force --no-interaction 2>/dev/null \
        || export APP_KEY=$(php -r "echo 'base64:' . base64_encode(random_bytes(32));")
fi

php artisan storage:link --force 2>/dev/null || true

php artisan package:discover --quiet 2>/dev/null || true

php artisan migrate --force

if [ "${DB_SEED}" = "true" ]; then
    php artisan db:seed --force
fi

exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
