ARG PHP_VERSION
ARG XDEBUG_PORT

FROM php:${PHP_VERSION}-fpm-alpine

RUN apk --update --no-cache add git postgresql-dev
RUN apk add --no-cache $PHPIZE_DEPS
RUN apk add --update linux-headers
RUN pecl install xdebug
RUN docker-php-ext-install pdo pdo_pgsql pgsql
RUN docker-php-ext-enable xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /data