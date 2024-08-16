FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Copy app files from the app directory.
COPY . /var/www/

# Copy .env.example to .env and set permissions
RUN cp /var/www/.env.example /var/www/.env

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Set permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 777 /var/www/storage/logs

# Use the default production configuration for PHP runtime arguments
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate key
RUN php artisan key:generate

EXPOSE 9000

CMD ["php-fpm"]
