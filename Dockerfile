# Dockerfile

FROM php:8.3.8-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql

# Set working directory
WORKDIR /var/www

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
