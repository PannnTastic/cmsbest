#!/bin/bash
# BEST Adminside (CMS) Deployment Script for cPanel
# Usage: bash deploy.sh

set -e

echo "========================================"
echo "  BEST Adminside - Deploy Script"
echo "========================================"

# Detect PHP path (cPanel compatible)
PHP=$(which php 2>/dev/null || command -v php 2>/dev/null || echo "/usr/local/bin/php")

echo "[1/7] Pulling latest code from GitHub..."
git pull origin main || git pull origin master

echo "[2/7] Installing composer dependencies (no-dev)..."
$PHP /usr/local/bin/composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "[3/7] Generating app key if not exists..."
if ! grep -q "APP_KEY=base64" .env 2>/dev/null; then
    $PHP artisan key:generate --force
fi

echo "[4/7] Running database migrations..."
$PHP artisan migrate --force

echo "[5/7] Creating storage symlink..."
$PHP artisan storage:link || true

echo "[6/7] Caching config, routes, and views..."
$PHP artisan config:cache
$PHP artisan route:cache
$PHP artisan view:cache

echo "[7/7] Optimizing..."
$PHP artisan optimize
$PHP artisan filament:upgrade || true

echo "========================================"
echo "  Deployment completed successfully!"
echo "========================================"
