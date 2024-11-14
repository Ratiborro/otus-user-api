# Запуск проекта:

- Запускаем миникуб "с нуля":
```bash
minikube stop
minikube delete --all
minikube start
```
- Создаем пространство имен для работы приложения
```bash
kubectl create namespace u
```
- Устанавливаем nginx через helm
```bash
helm repo add ingress-nginx https://kubernetes.github.io/ingress-nginx/
helm repo update
helm install nginx ingress-nginx/ingress-nginx --namespace u -f nginx-ingress.yaml
kubectl get daemonset -n u
kubectl get pods -n u --show-kind=true -w
```
- ingress-nginx-controller стартует около 120 секунд. Ждем
- Применяем манифест деплоймента и ждем READY-состояния
```bash
kubectl apply -f nginx-configmap.yaml -n u
kubectl apply -f deployment.yaml -n u
kubectl get pods -n u --show-kind=true -w
```
- Применяем манифест сервиса
```bash
kubectl apply -f service.yaml -n u
kubectl get service -n u
```
- Применяем манифест ingress-а
```bash
kubectl apply -f ingress.yaml -n u
kubectl get ingress user-api-ingress -n u
```
- Запускаем туннель
```bash
minikube tunnel
```
## Готово! Вы восхитительны!

Можно запускать http://arch.homework и наслаждаться ответом приложения.

Также нужно убедиться, что в /etc/hosts прописан DNS (для мака и винды)
```
127.0.0.1 arch.homework
```
а на линуксе вместо локалхоста нужно прописать ip, полученный командой
```
minkube ip
```



## Дебаг
Проверяем, что ингресс работает без ошибок:
```bash
kubectl describe ingress healthcheck-ingress -n u
```
Проверяем, что сервис работает без ошибок:
```bash
kubectl describe service healthcheck-service -n u
```
Проверяем, что поды деплоймента работают без ошибок: 
```bash
kubectl get pods -n u --show-kind=true
kubectl describe pod/healthcheck-deployment-584d6b4589-kgcl2 -n u
```
Заходим в любой под и проверяем стартовую директорию, после чего стараемся достучаться до сервиса изнутри кластера по IP:
```bash
kubectl get pods -n u --show-kind=true
kubectl exec -ti pod/healthcheck-deployment-584d6b4589-kgcl2 -n u -- bash
curl -s http://10.106.210.110/
curl -s http://arch.homework/
```


### Другие команды для дебага

### Всё должно заработать, но вот несколько команд на случай дебага:
```bash
kubectl exec -it pod/healthcheck-deployment-584d6b4589-575ng -n u -- bash
kubectl delete namespace u
kubectl get namespace u
helm uninstall nginx -n u
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