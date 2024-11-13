FROM php:8.3-fpm

RUN apt update && \
    apt install -y git zip unzip libzip-dev libpq-dev

RUN docker-php-ext-install zip pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#WORKDIR /application

#COPY . .

#RUN composer install --no-interaction --prefer-dist --optimize-autoloader
#RUN php artisan key:generate
#RUN php artisan migrate
