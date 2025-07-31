FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --optimize-autoloader --no-dev

RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
