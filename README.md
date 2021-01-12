## Reminder - API
#### Requirements

- PHP 7.4.x
- Laravel 8.x
- MySQL 5.x
- Redis 5.x
- Swagger - OA\Api 3.0

#### Installing - With Docker

- `docker-compose up --build`
- `docker-compose run --rm composer install`
- `docker-compose run --rm sh cp .env.example .env`
- `docker-compose run --rm artisan key:generate`
- `docker-compose run --rm sh chmod -R 0777 storage bootstrap`
- `docker-compose run --rm artisan migrate`
- `docker-compose run --rm artisan passport:install`
- `docker-compose run --rm artisan db:seed`

#### Installing - Without docker

- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `chmod -R 0777 storage bootstrap`
- `php artisan migrate`
- `php artisan passport:install`
- `php artisan db:seed`

#### Running - Without Docker

- Queue: `php artisan queue:listen redis --queue reminders`
- Console Command: `php artisan check:reminders`
- Server: `php artisan serve`

#### Cron

- `* * * * * cd /postgrain && php artisan schedule:run >> /dev/null 2>&1`

#### Scheduler locally

- `php artisan schedule:work`
