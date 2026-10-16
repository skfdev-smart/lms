# ==========================================
# Production Dockerfile for SMART-LMS
# Target: VPS Ubuntu 24.04 with Coolify PaaS
# Domain: https://smart-lms.spindo.my.id
# ==========================================

FROM php:8.4-fpm-alpine AS base

# Install System Dependencies & Database Libraries
RUN apk add --no-cache \
    sqlite \
    sqlite-dev \
    postgresql-dev \
    postgresql-client \
    mysql-client \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    icu-dev \
    curl \
    git

# Configure and Install PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_pgsql \
        pgsql \
        pdo_sqlite \
        pdo_mysql \
        bcmath \
        gd \
        intl \
        zip \
        opcache

# Configure PHP upload limits & memory (50MB for video/course materials)
RUN { \
        echo 'upload_max_filesize = 50M'; \
        echo 'post_max_size = 55M'; \
        echo 'memory_limit = 512M'; \
        echo 'max_execution_time = 300'; \
        echo 'max_input_time = 300'; \
        echo 'default_socket_timeout = 300'; \
    } > /usr/local/etc/php/conf.d/uploads.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files (including pre-compiled public/build assets)
COPY . .

# Install PHP dependencies without dev packages
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set up entrypoint script permissions
RUN chmod +x /var/www/html/docker-entrypoint.sh \
    && sed -i -e 's/\r$//' /var/www/html/docker-entrypoint.sh

# Configure file permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

ENV PHP_CLI_SERVER_WORKERS=4
ENV PORT=80

EXPOSE 80

ENTRYPOINT ["/var/www/html/docker-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
