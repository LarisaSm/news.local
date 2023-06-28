FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git \
    libfreetype6-dev \
    libmcrypt-dev \
    libzip-dev \
    zip \
    && docker-php-ext-configure zip --with-libzip \ 
    && docker-php-ext-install zip \ 
    && docker-php-ext-install mysqli

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html