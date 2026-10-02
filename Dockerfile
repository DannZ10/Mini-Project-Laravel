FROM php:8.3-cli

# Install system dependencies & PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better Docker caching
COPY composer.json composer.lock ./

# Install dependencies (production only)
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copy rest of the project
COPY . .

# Run post-install scripts
RUN composer dump-autoload --optimize

# Set permissions for Laravel storage & cache
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY deploy/start.sh /usr/local/bin/dibiedu-start
RUN chmod +x /usr/local/bin/dibiedu-start

# php artisan serve is single-threaded unless told otherwise.
ENV PHP_CLI_SERVER_WORKERS=4

# Render provides PORT dynamically; start.sh falls back to 8080.
EXPOSE 8080

# Boot: key fallback, cache config/routes, migrate, seed an empty database, serve.
CMD ["/usr/local/bin/dibiedu-start"]
