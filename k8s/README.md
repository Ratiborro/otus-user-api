```bash
minikube stop
minikube delete --all
minikube start

# Либо включаем аддон ingress
minikube addons enable ingress
# Либо устанавливаем ingress через helm (но не одновременно!!!)
helm repo add ingress-nginx https://kubernetes.github.io/ingress-nginx/
helm repo update
helm install nginx ingress-nginx/ingress-nginx -f nginx-ingress.yaml

# Устанавливаем Postgres
helm repo add bitnami https://charts.bitnami.com/bitnami
helm repo update
helm install postgres bitnami/postgresql -f values.yaml

minikube status
```

```bash
 # Запускаем деплоймент
kubectl apply -f deployment.yaml
 # Убеждаемся в успешном запуске
kubectl get pods -w
 # Запускаем сервис для деплоймента
kubectl apply -f service.yaml
 # Убеждаемся в успешном запуске сервиса
kubectl get svc php-app
 # Смотрим IP подов
kubectl get pods -o wide
 # Убеждаемся в том, что сервис связался с подами (в Endpoints должны быть прописаны IP и порты подов)
kubectl describe svc php-app
# Запускаем ingress
kubectl apply -f ingress.yaml
# Убеждаемся, что ингресс создан
kubectl get ingress
# Получаем IP-адрес ingress (сервис с именем nginx-ingress-nginx-controller)
kubectl get svc
# Получаем секреты БД
kubectl apply -f secret.yaml
# Запускаем другие конфиги БД
kubectl apply -f configmap.yaml
# Проверяем переменные окружения БД
kubectl exec -it <php-app-pod-name> -- env | grep DB_
# Запускаем миграции БД
kubectl apply -f migrations.yaml
# Проверяем статус джобы с миграциями
kubectl get jobs
# Смотрим логи джобы
kubectl logs job/db-migrations
# Если джоба зафейлилась, удаляем ей и запускаем заново через apply
kubectl delete job db-migrations




# Запускаем хранилище (persistent volume)
kubectl apply -f pv.yaml
# Запускаем pvc (persistent volume claim)
kubectl apply -f pvc.yaml
# Добавляем pv и pvc в deployment
kubectl apply -f deployment.yaml
# Убедимся, что pvc привязался к pv (статус bound)
kubectl get pvc
# Запускаем синхронизацию контейнера с локальной машиной
minikube mount ../:/mnt/data/php-volume



# Запускаем тоннель
minikube tunnel
```

Результат в браузере по адресу http://arch.homework/

Быстрый рестарт
```bash
minikube stop
minikube delete --all
minikube start
minikube addons enable ingress
kubectl apply -f deployment.yaml
kubectl get pods -o wide -w
kubectl apply -f service.yaml
kubectl get pods -o wide
kubectl describe svc php-app
kubectl apply -f ingress.yaml
# + minikube tunnel

kubectl rollout restart deployment php-app
kubectl delete pod -l app=php-app
```