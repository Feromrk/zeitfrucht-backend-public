FROM php:7.2.18-apache

ARG HOST_GID_ARG
ENV HOST_GID=$HOST_GID_ARG
ARG HOST_UID_ARG
ENV HOST_UID=$HOST_UID_ARG

RUN apt-get update

COPY . /srv/api
COPY docker/php/vhost.conf /etc/apache2/sites-available/000-default.conf

#COPY docker/php/php.ini /usr/local/etc/php/php.ini
RUN docker-php-ext-configure pdo_mysql && docker-php-ext-install pdo_mysql

RUN usermod -u $HOST_UID www-data
RUN groupmod -g $HOST_GID www-data
RUN chown -R www-data:www-data /srv/api
RUN a2enmod rewrite 
RUN a2enmod headers