#!/usr/bin/env bash
set -euo pipefail

# Minimal deploy script — run on the production host as the deploy user.
# Usage: ./deploy.sh /path/to/app
APP_DIR=${1:-/var/www/aeps}
cd "$APP_DIR"

echo "Installing composer dependencies (no dev)..."
composer install --no-dev --prefer-dist --optimize-autoloader

echo "Running migrations..."
php artisan migrate --force

echo "Caching config, routes and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Linking storage..."
php artisan storage:link || true

echo "Restarting queue workers (supervisor/systemd should pick this up)..."
# supervisorctl restart aeps-workers:* || true

echo "Done."
