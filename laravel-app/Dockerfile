# Use the official PHP image as the base image
FROM php:8.1-fpm

# Set the working directory inside the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install AMQP extension
RUN apt-get install -y librabbitmq-dev && pecl install amqp && docker-php-ext-enable amqp

# Expose port 9000 to the outside world
EXPOSE 9000 8000

# Start PHP-FPM server
CMD ["php-fpm"]
