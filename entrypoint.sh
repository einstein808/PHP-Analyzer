#!/bin/bash
set -e

# Copia .env se não existir
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Gera a chave da aplicação (força substituição se necessário)
php artisan key:generate --force

# Opcional: instala dependências (ou pode fazer isso só no build)
# composer install --no-dev --optimize-autoloader --no-interaction

# Ajusta permissões para o www-data
chown -R www-data:www-data /var/www/html
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Inicia Apache no foreground
apache2-foreground
