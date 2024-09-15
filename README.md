

Билдим докер-образ php-приложения
```bash
docker build -t otus-user-api .
```

Запускаем докер на 80 порту
```bash
docker run -d -p 8080:80 otus-user-api
```

Устанавливаем зависимости проекта
```bash
composer install
```