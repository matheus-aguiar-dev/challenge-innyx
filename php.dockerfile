FROM php:8.2-fpm
RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y git zip unzip

# Configure o diretório de trabalho
WORKDIR /var/www/html

COPY ./innyx-backend .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && cd /var/www/html \
    && php artisan key:generate \
    && php artisan config:cache


EXPOSE 9000

CMD ["php-fpm"]
