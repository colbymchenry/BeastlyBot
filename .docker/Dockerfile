FROM php:7.4.1-apache

USER root

WORKDIR /var/www/html/

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-source delete

COPY .docker/apache/beastly.conf /etc/apache2/sites-available/beastly.conf
COPY .docker/apache/beastlybot-le-ssl.conf /etc/apache2/sites-available/beastlybot-le-ssl.conf
COPY .docker/apache/beastlybot-ssl.conf /etc/apache2/sites-available/beastlybot-ssl.conf

COPY .docker/apache/discord.conf /etc/apache2/sites-available/discord.conf
COPY .docker/apache/discord-le-ssl.conf /etc/apache2/sites-available/discord-le-ssl.conf

COPY .docker/apache/store-le-ssl.conf /etc/apache2/sites-available/store-le-ssl.conf
COPY .docker/apache/store.conf /etc/apache2/sites-available/store.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite
