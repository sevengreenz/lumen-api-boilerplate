FROM php:7.2-fpm-alpine
RUN docker-php-ext-install pdo_mysql mysqli mbstring

RUN apk update && \
    docker-php-ext-install bcmath && \
    apk --no-cache add mariadb-client && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

ADD . /var/www
WORKDIR /var/www
RUN composer install && \
    /bin/ash -c 'chmod -R 777 storage'

