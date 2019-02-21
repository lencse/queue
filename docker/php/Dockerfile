FROM php:7.2-fpm

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN chmod +x composer.phar
RUN mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install bcmath
RUN docker-php-ext-install sockets
