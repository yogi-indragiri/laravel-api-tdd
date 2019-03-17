# laravel-api-tdd
Build API with Test Driven Design with authentication passport and social media authentication

## Perintah Command line
```Command line
php artisan make:test Http/Controllers/Api/ProductControllerTest

vendor/bin/phpunit tests/Feature/Http/Controllers/Api/ProductControllerTest.php

php artisan make:model Product -mc

php artisan make:resource Product

vendor/bin/phpunit tests/Feature/Http/Controllers/Api/ProductControllerTest.php can_return_a_product --filter=can_return_a_product

php artisan make:resource ProductCollection

composer require laravel/passport
php artisan migrate
php artisan passport:install
```

## Tutorial By Devlob
[Laravel API with TDD](https://devlob.com/courses/apis-in-laravel-using-tdd)
