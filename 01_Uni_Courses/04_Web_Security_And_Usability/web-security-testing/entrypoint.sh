#!/bin/bash

# Generate the application key
php artisan key:generate --ansi

# Cache laravel config
php artisan config:clear
php artisan config:cache

# set the port
export PORT=80

# Update the ports.conf file
echo "Listen ${PORT}" > /etc/apache2/ports.conf

# Start Apache
exec "$@"
