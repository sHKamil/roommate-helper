FROM php:8.1-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install mysqli

RUN docker-php-ext-enable mysqli

RUN docker-php-ext-enable pdo
