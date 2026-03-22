#!/bin/sh

echo "==> Iniciando container Laravel..."

# Gera nginx.conf com a PORT correta (Render define $PORT dinamicamente)
export PORT=${PORT:-10000}
echo "==> Porta: $PORT"
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf

# Corrige permissoes do storage em runtime
echo "==> Corrigindo permissoes do storage..."
chown -R www-data:www-data /var/www/html/storage && chmod -R 775 /var/www/html/storage

# Cria symlink do storage publico
echo "==> Criando storage:link..."
php artisan storage:link || echo "[AVISO] storage:link falhou (pode ja existir)"

# Otimizacoes Laravel (dependem de APP_KEY estar configurado no Render)
echo "==> Otimizando Laravel..."
php artisan package:discover --ansi
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ATENÇÃO: remover a linha abaixo após o próximo deploy bem-sucedido
DB_FRESH=false

# Roda migrations (funciona com qualquer driver: mysql, pgsql, sqlite)
if [ "$DB_FRESH" = "true" ]; then
    echo "==> DB_FRESH=true: dropando todas as tabelas e rodando migrate:fresh..."
    php artisan migrate:fresh --force
    echo "==> Rodando seeders EMI..."
    php artisan db:seed --force
else
    echo "==> Rodando migrations (DB_CONNECTION=${DB_CONNECTION})..."
    php artisan migrate --force
    echo "==> Limpando usuarios de teste..."
    php artisan db:seed --class=CleanTestUsersSeeder --force
    echo "==> Atualizando logo EMI..."
    php artisan db:seed --class=UpdateLogoSeeder --force
    echo "==> Sincronizando pacotes EMI (upsert)..."
    php artisan db:seed --class=PackageSeeder --force
fi

echo "==> Iniciando nginx + php-fpm..."
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
