#!/bin/bash

# Check if there are any tables in the database
migration_status=$(php artisan migrate:status --database=mysql | grep "not found")

if [ -n "$migration_status" ]; then
    echo "Migrations not found. Running migrations and seeding database."
    php artisan migrate:fresh --seed --database=mysql
else
    echo "Migrations have already been run."
fi
npm i @esbuild/linux-x64

# Start the APACHE server
exec apache2-foreground
