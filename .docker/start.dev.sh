#!/bin/bash
set -e

cd /var/www/html

echo "==> Fixing git safe directory..."
git config --global --add safe.directory /var/www/html 2>/dev/null || true

echo "==> Ensuring storage structure..."
mkdir -p storage/app/private \
         storage/framework/cache/data \
         storage/framework/sessions \
         storage/framework/testing \
         storage/framework/views \
         storage/logs
chmod -R 777 storage bootstrap/cache 2>/dev/null || true

echo "==> Installing PHP dependencies..."
composer install --no-interaction

echo "==> Generating app key (if missing)..."
grep -q "^APP_KEY=.\+" .env || php artisan key:generate --no-interaction

echo "==> Running migrations..."
php artisan migrate --no-interaction 2>/dev/null || true

echo "==> Seeding initial data (idempotent)..."
php artisan db:seed --class=SuperAdminSeeder --no-interaction 2>/dev/null || true

echo "==> Linking storage..."
php artisan storage:link --force 2>/dev/null || true
mkdir -p storage/app/public/videos

echo "==> Starting queue worker..."
(while true; do
    php artisan queue:work --tries=3 --timeout=60 --sleep=3 --max-time=3600
    echo "[$(date)] Queue worker stopped, restarting in 5s..."
    sleep 5
done >> /var/log/queue-worker.log 2>&1) &

echo "==> Starting Apache..."
exec apache2-foreground
