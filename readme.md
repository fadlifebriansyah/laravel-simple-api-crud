A simple CRUD Rest API for interaction between web service and apps using Laravel Passport OAuth.


Notes for steps :

-clone from repository
-create .env file
-php artisan key:generate
-php artisan cache:clear 
-php artisan config:clear
-create database
-composer require laravel/passport
-php artisan migrate
-php artisan passport:install
-php artisan make:middleware CheckApiToken
-php artisan migrate
-php artisan serve


Notes for post :

"Authorization" : "Bearer {token}"

"Content-Type" : "application/json"
