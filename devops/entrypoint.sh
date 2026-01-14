#!/bin/bash
set -e

# Install dependencies if needed
if [ ! -d "/var/www/vendor" ]; then
    echo "Installing Composer dependencies..."
    composer install --working-dir=/var/www
fi

if [ ! -d "/var/www/node_modules" ] || [ ! -f "/var/www/.npm-installed-arm64" ]; then
    echo "Installing Node dependencies..."
    cd /var/www
    # Remove lock file to allow fresh npm install with optional dependencies
    rm -f package-lock.json
    rm -rf node_modules
    npm install
    # Create marker file to indicate npm install was done for this architecture
    # touch .npm-installed-arm64
fi

# Run the command passed as arguments
exec "$@"

