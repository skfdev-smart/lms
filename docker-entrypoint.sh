#!/bin/sh
set -e

echo "🚀 Starting SMART-LMS Production Container..."

# Ensure environment file exists
if [ ! -f /var/www/html/.env ]; then
    echo "📄 Creating .env from .env.example..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Ensure application key is generated
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application encryption key..."
    php artisan key:generate --force
fi

# Wait for Database Connection
if [ "${DB_CONNECTION}" = "pgsql" ]; then
    echo "🐘 Checking PostgreSQL database connection (${DB_HOST:-db}:${DB_PORT:-5432})..."
    max_retries=30
    count=0
    until pg_isready -h "${DB_HOST:-db}" -p "${DB_PORT:-5432}" -U "${DB_USERNAME:-lms_user}" > /dev/null 2>&1 || [ $count -ge $max_retries ]; do
        echo "⏳ Database is starting up... waiting 2s ($((count+1))/$max_retries)"
        sleep 2
        count=$((count+1))
    done
    if [ $count -ge $max_retries ]; then
        echo "⚠️ PostgreSQL did not respond in time, proceeding anyway..."
    else
        echo "✅ PostgreSQL database connected successfully!"
    fi
elif [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    echo "📁 Ensuring SQLite database file exists..."
    mkdir -p /var/www/html/database
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        touch /var/www/html/database/database.sqlite
    fi
    chown -R www-data:www-data /var/www/html/database
    chmod 664 /var/www/html/database/database.sqlite
fi

# Ensure storage directories exist
mkdir -p /var/www/html/storage/app/public/courses
mkdir -p /var/www/html/storage/app/public/certificates
mkdir -p /var/www/html/storage/app/public/avatars
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views

# Link storage
echo "🔗 Ensuring storage symlink..."
php artisan storage:link --force || true

# Set permissions for web server upload writing
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Run database seeders safely (idempotent)
echo "🌱 Running database seeders..."
php artisan db:seed --force || true

# Optimize cache for production
echo "⚡ Optimizing Laravel config, routes, and views..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ SMART-LMS Ready. Serving HTTP on port 80..."
exec "$@"
