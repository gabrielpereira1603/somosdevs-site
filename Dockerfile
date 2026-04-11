FROM php:8.4-cli

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Instala extensões PHP
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copia projeto
COPY . .

# Instala dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Build frontend
RUN npm install && npm run build

# Ajusta permissões
RUN mkdir -p storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Laravel precisa ouvir fora do container
EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
