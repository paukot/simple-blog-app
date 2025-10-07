#!/bin/sh
set -e

# Move to working directory
cd /var/www/html

mkdir -p storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

if [ ! -f .env ]; then
    cp .env.example .env
    echo ".env file created from .env.example"
fi

if ! command -v composer >/dev/null 2>&1; then
    echo "Installing Composer..."
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
fi

echo "Installing Composer dependencies..."
composer install --no-interaction --optimize-autoloader
echo "Composer dependencies installed successfully!"


php artisan key:generate || echo "Key already exists"

php artisan migrate

npm i
npm run build