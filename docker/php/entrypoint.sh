#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

# Ensure writable dirs for Laravel (dev-friendly)
mkdir -p \
  storage \
  storage/framework/cache \
  storage/framework/sessions \
  storage/framework/views \
  storage/logs \
  bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Install PHP deps if needed (when using bind mounts)
if [ ! -f vendor/autoload.php ]; then
  composer install --no-interaction --prefer-dist
fi

# If APP_KEY is empty, generate one (won't overwrite existing)
if [ -f .env ] && ! grep -qE '^APP_KEY=.+$' .env; then
  php artisan key:generate --force || true
fi

exec "$@"
