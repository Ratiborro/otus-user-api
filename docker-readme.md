## Docker
```bash
docker build -t ratiborro/otus-user-api .
docker run -d -p 8080:80 --name otus-user-api ratiborro/otus-user-api:latest
docker stop otus-user-api
docker rm otus-user-api
docker push ratiborro/otus-user-api:latest
```