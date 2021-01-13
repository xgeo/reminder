## Reminder - API
#### Requirements

- PHP 7.4.x
- Laravel 8.x
- MySQL 5.x
- Redis 5.x
- Swagger - OA\Api 3.0

#### Installing and Running - With Docker

1. `make build-prod && make start-prod`
2. `make initialize`
3. `http://localhost:8090/documentation` - Swagger

#### Installing - Without docker

- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan optimize`
- `chmod -R 0777 storage bootstrap`
- `php artisan migrate`
- `php artisan passport:install`
- `php artisan db:seed`

#### Running - Without Docker

- Queue: `php artisan queue:listen redis --queue reminders`
- Console Command: `php artisan check:reminders`
- Server: `php artisan serve`
- Valet: `valet link api.reminder`

#### Cron

- `* * * * * cd /reminder && php artisan schedule:run >> /dev/null 2>&1`

#### Scheduler locally

- `php artisan schedule:work`

#### Configuração para o Docker
- `git@github.com:dimadeush/docker-nginx-php-laravel.git`

#### API User Test
- email: `geovannylc@gmail.com`
- password: `teste@321`
