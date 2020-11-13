Requirements:
```
php,
mysql
```
Commands after pull:
```
comoser update
php artisan passport:install   
php artisan migrate:refresh --seed
```
then
```
php artisan queue:work
php artisan serve
```
Documentation

 [api documentation is here](https://github.com/Dariush59/laravel-fundation/wiki)
