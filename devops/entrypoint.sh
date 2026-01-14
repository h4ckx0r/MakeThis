#!/bin/bash
set -e

# Install dependencies if needed
if [ ! -d "/var/www/vendor" ]; then
    echo "Installing Composer dependencies..."
    composer install --working-dir=/var/www
fi

if [ ! -d "/var/www/node_modules" ]; then
    echo "Installing Node dependencies..."
    cd /var/www
    # Remove lock file to allow fresh npm install with optional dependencies
    rm -f package-lock.json
    rm -rf node_modules
    npm install
fi

# Run the command passed as arguments
exec "$@"

