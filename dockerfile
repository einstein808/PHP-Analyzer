FROM php:7.4-apache

# Diretório de trabalho
WORKDIR /var/www/html

# Instala dependências do sistema e extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql mbstring zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala Composer (v2.7.7 conforme você usou)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.7.7

# Ativa o mod_rewrite do Apache
RUN a2enmod rewrite

# Configura ServerName para evitar warning do Apache
RUN echo "ServerName localhost" >> /etc/apache2/conf-available/servername.conf \
    && a2enconf servername

# Copia o arquivo de configuração do Apache para usar DocumentRoot em /public
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copia o código da aplicação
COPY . /var/www/html/

# Ajusta permissões para www-data
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Instala dependências PHP via Composer como www-data para evitar problemas de permissões
RUN composer clear-cache \
    && su -s /bin/sh www-data -c "composer install --no-dev --optimize-autoloader --no-interaction" || { echo "Composer install failed"; exit 1; }

# Cria o arquivo .env e gera a chave da aplicação se não existir
RUN if [ ! -f /var/www/html/.env ]; then \
        cp /var/www/html/.env.example /var/www/html/.env || \
        echo -e "APP_NAME='PHP Analyzer'\nAPP_ENV=production\nAPP_KEY=\nAPP_DEBUG=true\nAPP_URL=http://localhost:8080\nDB_CONNECTION=mysql\nDB_HOST=db\nDB_PORT=3306\nDB_DATABASE=php_analyzer\nDB_USERNAME=analyzer_user\nDB_PASSWORD=analyzer_password" > /var/www/html/.env; \
        su -s /bin/sh www-data -c "php artisan key:generate --force"; \
    fi

# Expõe porta 80
EXPOSE 80


COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
