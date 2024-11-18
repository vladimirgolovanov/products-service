FROM php:8.3-fpm

RUN apt update && \
    apt install -y git zip unzip libzip-dev libpq-dev

RUN docker-php-ext-install zip pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /application

ADD . /application

RUN chown -R www-data:www-data /application && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R ug+rwx storage bootstrap/cache

USER www-data

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

CMD ["php-fpm"]
