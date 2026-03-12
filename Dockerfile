FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Copy composer.lock and composer.json
COPY composer.json composer.lock ./

# Install PHP dependencies with --no-dev and ignore platform reqs
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Copy package.json and install Node dependencies
COPY package*.json ./
RUN npm install

# Build assets
RUN npm run build

# Copy nginx and supervisor config
COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Generate app key
RUN php artisan key:generate --no-interaction

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
