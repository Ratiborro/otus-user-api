# 1. Используем официальный образ PHP с встроенным Apache
FROM php:8.2-apache

# 2. Копируем файлы приложения в директорию, обслуживаемую Apache
COPY . /var/www/

# 3. Устанавливаем права доступа на папку для Apache
RUN chown -R www-data:www-data /var/www/

# 4. Открываем порт 80 для веб-сервера Apache
EXPOSE 80

# 5. Указываем команду, которая будет выполняться при запуске контейнера
CMD ["apache2-foreground"]

ENTRYPOINT ["top", "-b"]