### Running Using Docker

### On Local

```sh
docker-compose up -d db
docker-compose build
```

### On Server

```sh
docker compose up -d
docker-compose exec -T app php artisan key:generate
docker-compose exec -T app npm install
docker-compose exec -T app npm build
docker-compose exec -T app composer install
docker-compose exec -T app php artisan migrate
```
