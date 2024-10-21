# Запуск проекта:

1. Запускаем миникуб "с нуля":
```bash
minikube stop
minikube delete --all
minikube start
```
2. Создаем пространство имен для работы приложения
```bash
kubectl create namespace u
```
3. Устанавливаем nginx через helm
```bash
helm repo add ingress-nginx https://kubernetes.github.io/ingress-nginx/
helm repo update
helm uninstall nginx -n u
helm install nginx ingress-nginx/ingress-nginx --namespace u -f nginx-ingress.yaml
```
4. Применяем манифесты сервиса и деплоймента и ждем READY-состояния
```bash
kubectl apply -f service.yaml -n u
kubectl apply -f deployment.yaml -n u
kubectl get pods -n u --show-kind=true -w
```
5. Применяем манифест ingress-а
```bash
kubectl apply -f ingress.yaml -n u
```
6. Запускаем туннель
```bash
minikube tunnel
```
## Готово! Вы восхитительны!

Можно запускать http://arch.homework и наслаждаться ответом приложения.

Также нужно убедиться, что в /etc/hosts прописан DNS
```
127.0.0.1 arch.homework
```
для мака и винды, а на линуксе вместо локалхоста нужно прописать ip, полученный командой
```
minkube ip
```

### Всё должно заработать, но вот пара команд на случай дебага:
```bash
kubectl get events -n u
kubectl get all -n u
kubectl get pods -n u
kubectl get svc -n u
kubectl get ingress -n u
kubectl describe pods/nginx-ingress-nginx-controller-256c9 -n u
kubectl logs svc/nginx-ingress-nginx-controller-admission -n u
kubectl delete pod -l app.kubernetes.io/instance=nginx -n u

kubectl create rolebinding endpointslice-controller-access \
--clusterrole=system:controller:endpointslice-controller \
--serviceaccount=kube-system:endpointslice-controller \
--namespace=u
```