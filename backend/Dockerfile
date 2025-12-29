FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libssl-dev pkg-config unzip git \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html
WORKDIR /var/www/html

RUN composer install --ignore-platform-req=ext-mongodb
RUN a2enmod rewrite
EXPOSE 80
