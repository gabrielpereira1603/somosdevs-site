FROM php:8.2-fpm

# Instala dependências
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    nodejs \
    npm

# Extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copia projeto
COPY . .

# Instala dependências Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissões
RUN chmod -R 775 storage bootstrap/cache

# Build frontend (se usar Vite)
RUN npm install && npm run build

EXPOSE 9000

CMD ["php-fpm"]
