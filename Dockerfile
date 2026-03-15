# Dockerfile final para Laravel en Render
FROM php:8.2-apache

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    libpq-dev \
    curl \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

# Habilita mod_rewrite
RUN a2enmod rewrite

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia el proyecto completo al contenedor
COPY . /var/www/html/

# Establece directorio de trabajo
WORKDIR /var/www/html

# Instala dependencias de Laravel
RUN composer install --optimize-autoloader --no-dev

# 📌 Aquí va tu línea para reemplazar la configuración de Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Permisos correctos para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache