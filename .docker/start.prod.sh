#!/bin/bash
set -e

cd /var/www/html

echo "==> Creating storage directories..."
mkdir -p \
    storage/app/public \
    storage/app/private \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views \
    storage/logs
chown -R www-data:www-data storage
chmod -R 775 storage

echo "==> Linking storage..."
php artisan storage:link --force

echo "==> Discovering packages..."
php artisan package:discover --ansi

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Caching config, routes, views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Seeding system data (idempotent)..."
php artisan db:seed --class=SuperAdminSeeder --force

echo "==> Starting queue worker..."
(while true; do
    php artisan queue:work --tries=3 --timeout=60 --sleep=3 --max-time=3600
    echo "[$(date)] Queue worker stopped, restarting in 5s..."
    sleep 5
done >> /var/log/queue-worker.log 2>&1) &

echo "==> Starting Apache..."
exec apache2-foreground
