# 1. Base: Imagen oficial de PHP para FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# 2. Instalar dependencias del sistema y Composer
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    libmagickwand-dev \
    && rm -rf /var/lib/apt/lists/*

# 3. Instalar las extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets opcache

# 4. Instalar Composer (la herramienta para gestionar dependencias de PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Configurar el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# 6. Copiar el código fuente de tu aplicación al contenedor
COPY . .

# 7. Establecer permisos correctos para Laravel (storage y bootstrap/cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Exponer el puerto FPM
EXPOSE 9000