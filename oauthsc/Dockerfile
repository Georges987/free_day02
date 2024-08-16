FROM node:lts-alpine as frontend

# use /app as working directory

WORKDIR /app

# Copy existing application directory contents

COPY . /app/

# Install npm dependencies

RUN npm install

# Build frontend

RUN npm run build

# FROM php:8.3 as laravel

FROM php:8.3 as laravel

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip

# Set working directory

WORKDIR /app

# Copy existing application directory contents

COPY --from=frontend /app /app

# Install composer dependencies

RUN composer install

RUN cp .env.example .env

RUN php artisan optimize:clear

RUN php artisan key:generate

# Expose port 8000 and start application

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
