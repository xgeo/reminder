## Postgrain - BackEnd Api Test

- Laravel 8.x
- Swagger - OA\Api 3.0

#### Requirements

- PHP 7.4.x
- MySQL
- Redis

#### Installing

- `git clone repo`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `chmod -R 0777 storage bootstrap`
- `php artisan migrate`
- `php artisan passport:install`
- `php artisan db:seed`

#### Running

- Queue: `php artisan queue:listen redis --queue reminders`
- Console Command: `php artisan check:reminders`

#### Cron

- `* * * * * cd /postgrain && php artisan schedule:run >> /dev/null 2>&1`

#### Scheduler locally

- `php artisan schedule:work`

#### Docker
- `docker-compose up --build`
