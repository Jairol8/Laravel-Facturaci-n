# Dockerfile final para Laravel en Render
FROM php:8.2-apache

# Instala dependencias de sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    apt-utils \
    build-essential \
    libzip-dev \
    unzip \
    git \
    libpq-dev \
    curl \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

# Habilita mod_rewrite
RUN a2enmod rewrite

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia tu proyecto
COPY . /var/www/html/

# Establece directorio de trabajo
WORKDIR /var/www/html

# Instala dependencias de Laravel
RUN composer install --optimize-autoloader --no-dev

# Reemplaza la configuración de Apache para servir desde public/
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Permisos correctos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache