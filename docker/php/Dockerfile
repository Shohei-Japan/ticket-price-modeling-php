FROM php:7.2-cli-alpine

####################
## composer
####################

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN composer config -g repos.packagist composer https://packagist.jp && \
    composer global require hirak/prestissimo

####################
## app
####################

WORKDIR /app
