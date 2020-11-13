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