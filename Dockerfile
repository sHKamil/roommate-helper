FROM php:8.1-fpm AS runtime

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install mysqli

RUN docker-php-ext-enable mysqli

RUN docker-php-ext-enable pdo

FROM runtime AS dev

RUN pecl install -o -f xdebug \
    && docker-php-ext-enable xdebug

COPY ./php.ini /usr/local/etc/php/
