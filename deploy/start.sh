#!/bin/sh
set -eu

# Free-tier demo hosting: API tokens are hashed in the database, so a key that
# changes on restart is harmless. Set APP_KEY in the host to keep one stable key.
if [ -z "${APP_KEY:-}" ]; then
    APP_KEY="$(php artisan key:generate --show | tail -n 1)"
    export APP_KEY
fi

php artisan config:cache
php artisan route:cache
php artisan migrate --force --no-interaction
# The seeder returns at once when users already exist, so this is safe on every boot.
php artisan db:seed --force --no-interaction

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
