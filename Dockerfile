FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && \
  apt-get install -y libsqlite3-dev && \
  docker-php-ext-install pdo_sqlite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html/

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD ["php-fpm"]

