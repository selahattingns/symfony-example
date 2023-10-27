FROM php:7.3.33-fpm-alpine3.14

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer
# VEYA ayrı bir RUN olarak çalışması gerekmektedir.
RUN curl -s https://getcomposer.org/installer | php

RUN apk update \
    && apk add --no-cache \
    bash \
    libzip-dev \
    zip \
    unzip \
    icu-dev \
    postgresql-libs \
    postgresql-dev \
    && docker-php-ext-configure \
    intl \
    && docker-php-ext-install \
    intl \
    opcache \
    mysqli \
    pdo \
    pdo_mysql \
    && docker-php-ext-enable \
    pdo_mysql