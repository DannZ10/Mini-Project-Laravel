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
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose port (Render provides PORT env var dynamically)
EXPOSE 8080

# Start Laravel using artisan serve, reading PORT from env (default 8080)
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
