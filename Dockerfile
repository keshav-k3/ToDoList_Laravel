FROM php:8.1

RUN apt-get update && apt-get install -y --no-install-recommends libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

CMD php artisan serve --host=0.0.0.0 --port=9000