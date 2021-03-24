#!/bin/bash
printf 'refreshing db\n'
php artisan migrate:refresh

printf '\nseeding db with trash data\n\n'
php artisan db:seed

printf '\nDONE! please check your db\n\n'


