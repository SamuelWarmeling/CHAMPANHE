FROM php:8.1-fpm-alpine

# Dependencias do sistema
RUN apk add --no-cache \
    nginx \
    supervisor \
    nodejs \
    npm \
    mysql-client \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    gettext \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia composer primeiro para aproveitar cache de layers
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copia o restante da aplicacao
COPY . .

# Build dos assets frontend (Vite)
RUN npm ci && npm run build && rm -rf node_modules

# Garante que toda a estrutura de diretorios do Laravel existe
# (git nao rastreia pastas vazias — sem isso Laravel crasha)
RUN mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Permissoes para Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Configs Docker
COPY docker/nginx.conf.template /etc/nginx/nginx.conf.template
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/start.sh /start.sh

# Corrige CRLF (Windows -> Linux) e garante permissao de execucao
RUN sed -i 's/\r$//' /start.sh && chmod +x /start.sh

EXPOSE 10000

CMD ["/start.sh"]
