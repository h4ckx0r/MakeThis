#!/bin/sh
set -e

echo "[entrypoint.prod] Cacheando configuración..."
php artisan config:cache

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
