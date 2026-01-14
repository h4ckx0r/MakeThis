# docker/development/workspace/Dockerfile
# Use the official PHP CLI image as the base
FROM php:8.4-cli

# Set environment variables
ARG NODE_VERSION=22.12.0

# Install system dependencies and build libraries
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev \
    libssl-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libicu-dev \
    libzip-dev \
    procps \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install pdo pdo_pgsql pgsql opcache intl zip bcmath soap pcntl

# Install NVM (Node Version Manager)
RUN export NVM_DIR="/root/.nvm" && \
    curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash && \
    [ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh" && \
    nvm install ${NODE_VERSION} && \
    nvm alias default ${NODE_VERSION}

# Create a symlink for node and npm to be available globally
RUN export NVM_DIR="/root/.nvm" && \
    . "$NVM_DIR/nvm.sh" && \
    ln -s $NVM_DIR/versions/node/$(node -v)/bin/node /usr/local/bin/node && \
    ln -s $NVM_DIR/versions/node/$(node -v)/bin/npm /usr/local/bin/npm && \
    ln -s $NVM_DIR/versions/node/$(node -v)/bin/npx /usr/local/bin/npx

# Set the working directory
WORKDIR /var/www

# Copy entrypoint script
COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set the entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Default command - can be overridden
CMD ["composer", "run", "dev"]
