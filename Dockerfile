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
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Create storage/cache dirs and set permissions AFTER copy
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

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

# Set APP_KEY from Railway environment variable (set in Railway dashboard)
ENV APP_KEY base64:i1TtSKBuTTOUVzZjsW8EDQId9N9wR1EKZIBk7tOEbnM=

# Copy .env.example as .env (Railway will override with its variables)
COPY .env.example .env
RUN cp .env.example .env

EXPOSE 80
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
