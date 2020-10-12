## Requirements

Run php artisan passport:install

Run php artisan event:generate

Run php artisan storage:link

Run php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"

Run php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"

Run php artisan migrate --seed
