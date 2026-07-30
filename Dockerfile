FROM composer:latest AS composer
FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    nginx git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache
RUN sed -i 's/clear_env = yes/clear_env = no/' /usr/local/etc/php-fpm.d/www.conf
COPY deploy/nginx.conf /etc/nginx/sites-enabled/default
COPY startup.sh /startup.sh
RUN chmod +x /startup.sh
EXPOSE 8080
CMD ["/startup.sh"]