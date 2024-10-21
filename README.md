Устанавливаем зависимости проекта
```bash
composer install
```

Билдим докер-образ php-приложения
```bash
docker build -t otus-user-api .
```

Запускаем докер на 80 порту
```bash
docker run -d -p 8000:80 otus-user-api
```

Меняем корневую директорию Apache на `DocumentRoot /var/www`
```bash
docker exec -it <container_id> bash
apt-get update
apt-get install nano
nano /etc/apache2/sites-available/000-default.conf
```

Перезапускаем Apache
```bash
service apache2 restart
```

При наличии ошибок проверяем логи Apache
```bash
cat /var/log/apache2/error.log
```