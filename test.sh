#!/bin/bash

cp .env.testing .env
php artisan config:cache
phpunit
cp .env.backup .env
php artisan config:cache
