#!/bin/sh

set -e

if [ -n "$RENDER_EXTERNAL_URL" ]; then
    export APP_URL="$RENDER_EXTERNAL_URL"
fi

if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
    php artisan key:generate --force
fi

php artisan storage:link --force 2>/dev/null || true

php artisan migrate --force

if [ "$APP_ENV" = "production" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
fi

exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
