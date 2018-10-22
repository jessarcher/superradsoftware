FROM php:7.2-fpm

RUN apt-get update && \
    apt-get install -y \
        libpq-dev \
        && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql

COPY laravel.pool.conf /usr/local/etc/php-fpm.d/
