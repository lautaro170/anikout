FROM php:8.3-apache
RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli
RUN apt-get update && apt-get install -y libicu-dev \
    && docker-php-ext-install intl \
    && docker-php-ext-enable intl
