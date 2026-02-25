#!/bin/sh
set -e

# Garantizar que los directorios de runtime existen
# (necesario si /app/storage está montado como volumen externo vacío)
mkdir -p storage/framework/views \
         storage/framework/cache/data \
         storage/framework/sessions \
         storage/logs

echo "[entrypoint.prod] Cacheando configuración..."
php artisan config:cache

echo "[entrypoint.prod] Cacheando rutas..."
php artisan route:cache

echo "[entrypoint.prod] Cacheando vistas..."
php artisan view:cache

echo "[entrypoint.prod] Ejecutando migraciones..."
php artisan migrate --force

echo "[entrypoint.prod] Verificando storage:link..."
if [ ! -L "/app/public/storage" ]; then
    echo "[entrypoint.prod] Creando symlink de storage..."
    php artisan storage:link
fi

echo "[entrypoint.prod] Iniciando FrankenPHP..."
exec frankenphp run --config /etc/frankenphp/Caddyfile
