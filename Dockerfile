FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y procps net-tools libpq-dev curl nginx git unzip zip libzip-dev && \
    apt-get clean

RUN docker-php-ext-install pdo pdo_pgsql pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY nginx.conf /etc/nginx/nginx.conf
RUN nginx -t

RUN chown -R www-data:www-data /var/www

COPY . /var/www
WORKDIR /var/www
RUN composer install
WORKDIR /var/www/public



EXPOSE 80 9000

CMD service nginx start && php-fpm -D && tail -f /var/log/nginx/error.log

