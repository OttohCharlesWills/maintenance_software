FROM php:8.2-cli

WORKDIR /app

# system deps
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libpq-dev \
    gnupg

# install node 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# install php extensions
RUN docker-php-ext-install zip pdo pdo_mysql pdo_pgsql

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

# php deps
RUN composer install --no-dev --optimize-autoloader

# vite build
RUN npm install
RUN npm run build

EXPOSE 10000

CMD php artisan config:clear && php -S 0.0.0.0:10000 -t public