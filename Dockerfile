# Dockerfile para Laravel + PostgreSQL en Render
FROM php:8.2-apache

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Habilita mod_rewrite
RUN a2enmod rewrite

# Copia el proyecto
COPY . /var/www/html/

# Configura Apache para servir desde public/
WORKDIR /var/www/html
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Permisos correctos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache