## Запуск проекта

```bash
# Запускаем миникуб
minikube start
minikube addons enable ingress

cd k8s

# Устанавливаем Postgres
helm repo add bitnami https://charts.bitnami.com/bitnami
helm repo update
helm install postgres bitnami/postgresql -f values.yaml

# Последовательно применяем манифесты
kubectl apply -f secret.yaml
kubectl apply -f configmap.yaml
kubectl apply -f deployment.yaml
kubectl apply -f service.yaml
kubectl apply -f ingress.yaml

# Запускаем джобу для миграций БД
kubectl apply -f migrations.yaml

# Запускаем тоннель
minikube tunnel
```