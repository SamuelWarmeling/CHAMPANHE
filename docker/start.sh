#!/bin/sh

echo "==> Iniciando container Laravel..."

# Gera nginx.conf com a PORT correta (Render define $PORT dinamicamente)
export PORT=${PORT:-10000}
echo "==> Porta: $PORT"
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf

# Cria symlink do storage publico
echo "==> Criando storage:link..."
php artisan storage:link || echo "[AVISO] storage:link falhou (pode ja existir)"

# Otimizacoes Laravel (dependem de APP_KEY estar configurado no Render)
echo "==> Otimizando Laravel..."
php artisan package:discover --ansi
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Roda migrations — nao derruba o container se falhar
# (banco pode nao estar pronto ainda ou env vars ausentes)
echo "==> Rodando migrations..."
php artisan migrate --force || echo "[AVISO] migrate falhou — verifique DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD no Render"

echo "==> Iniciando nginx + php-fpm..."
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
