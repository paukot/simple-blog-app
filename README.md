### Clone Repository & set up .env for docker and laravel (.env + web/.env)
copy .env.example to .env

In the main directory run docker
```shell
    docker compose up -d
```

Ensure php container has is using `php` name for docker commands
```shell
    docker compose ps
```

Install dependencies (In case of having different php container name change `docker compose exec <container_name>`)
```shell
  docker compose exec php composer install
  docker compose exec php php artisan key:generate
  
  # Optionaly add --seed flag or run artisan db:seed
  docker compose exec php php artisan migrate
  
  docker compose exec php npm i
  docker compose exec php npm run build
```

Everything is set up! Access the app at http://localhost:8080