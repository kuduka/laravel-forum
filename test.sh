#!/bin/bash

redis-cli flushall
cp .env.testing .env
php artisan config:cache
phpunit
cp .env.backup .env
php artisan config:clear
php artisan config:cache
php artisan cache:clear
php artisan view:clear 
