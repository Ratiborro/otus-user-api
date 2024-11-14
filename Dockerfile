FROM php:8.2-fpm

# Установка необходимых пакетов и расширений
RUN apt-get update && \
    apt-get install -y libpq-dev curl && \
    docker-php-ext-install pdo pdo_pgsql

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка зависимостей приложения
WORKDIR /var/www
COPY . /var/www
RUN composer install && true

CMD ["php-fpm"]
