## Requirements

| Software | Version |
|----------|---------|
| PHP      | 8.4     |
| MySQL    | 8.0     |
| NodeJS   | 24      |

## Installation

In case of not wanting to use docker, skip to step 3 and use commands without docker compose container prefixes.

### Step 1 .env setup

copy .env.example to .env in the main directory & web directory, first one is required for docker setup and the second
one is a laravel .env file

### Step 2 run docker containers

In the main directory run docker

```shell
    docker compose up -d
```

Ensure php container has is using `php` name for docker commands

```shell
    docker compose ps
```

### Step 3 dependencies

Install dependencies (In case of having different php container name change `docker compose exec <container_name>`)

```shell
  docker compose exec php composer install
  docker compose exec php php artisan key:generate
  
  # Optionally add --seed flag or run artisan db:seed
  docker compose exec php php artisan migrate
```

Now build the frontend

```shell
  docker compose exec php npm i
  docker compose exec php npm run build
```

### Summary

To run tests simply run the

```shell
    docker compose exec php php artisan test
```

Everything is set up! Access the app at http://localhost:8080


---

## Routes

### General routes

| Method | URI | Action           | Name | Middleware |
|--------|-----|------------------|------|------------|
| GET    | /   | `HomeController` | home | web        |

### Auth Routes (AuthController)

| Method | URI           | Action               | Name                  | Middleware |
|--------|---------------|----------------------|-----------------------|------------|
| GET    | /login        | login                | login                 | guest      |
| POST   | /authenticate | authenticate         | authenticate          | guest      |
| GET    | /register     | register             | register              | guest      |
| POST   | /register     | completeRegistration | complete-registration | guest      |
| POST   | /logout       | logout               | logout                | web/auth   |

### Post Routes (PostController)

| Method | URI                | Action  | Middleware |
|--------|--------------------|---------|------------|
| GET    | /posts             | index   | web        |
| GET    | /posts/create      | create  | auth       |
| POST   | /posts             | store   | auth       |
| GET    | /posts/{post}      | show    | web        |
| GET    | /posts/{post}/edit | edit    | auth       |
| PUT    | /posts/{post}      | update  | auth       |
| DELETE | /posts/{post}      | destroy | auth       |

### Post Comments Routes (CommentController)

| Method | URI                              | Action  | Middleware |
|--------|----------------------------------|---------|------------|
| POST   | /posts/{post}/comments           | store   | auth       |
| DELETE | /posts/{post}/comments/{comment} | destroy | auth       |


