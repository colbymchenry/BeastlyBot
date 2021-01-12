FROM pensiero/apache-php-mysql:php7.4

USER root

COPY . /var/www/html/beastlybot

WORKDIR /var/www/html/beastlybot

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
        libapache2-mod-php7.4 \
        php-gd \
        php-mbstring \
        php-xml \
        php-mysql \
        php-bcmath \
        php-json \
        php-zip

COPY .docker/apache/beastly.conf /etc/apache2/sites-available/beastlybot.conf
COPY .docker/apache/beastlybot-ssl.conf /etc/apache2/sites-available/beastlybot-ssl.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

RUN rm /etc/apache2/sites-available/000-default.conf

RUN service apache2 start

CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000
