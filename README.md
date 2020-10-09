## Requirements

Run php artisan passport:install
Run php artisan event:generate
Run php artisan storage:link
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
Run php artisan migrate --seed
