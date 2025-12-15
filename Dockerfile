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
    # Ya no intentamos instalar docker.io con apt
    && rm -rf /var/lib/apt/lists/* \
    
    # -------------------------------------------------------
    # INSTALACIÓN MANUAL DE DOCKER CLIENT Y COMPOSE
    # -------------------------------------------------------
    
    # 1. Instalar Docker Compose
    && curl -L "https://github.com/docker/compose/releases/download/v2.24.5/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose \
    && chmod +x /usr/local/bin/docker-compose \
    
    # 2. Instalar Docker Client (El que te falta)
    && curl -fsSLO https://download.docker.com/linux/static/stable/x86_64/docker-26.1.3.tgz \
    && tar xzvf docker-26.1.3.tgz --strip 1 -C /usr/local/bin docker/docker \
    && rm docker-26.1.3.tgz \
    && chmod +x /usr/local/bin/docker

# 3. Instalar las extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets opcache

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets opcache zip

# 4. Instalar Composer (la herramienta para gestionar dependencias de PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Configurar el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# 6. Copiar el código fuente de tu aplicación al contenedor
COPY . .

# 7. CREA EL GRUPO 'docker' si no existe y agrega al usuario www-data
RUN groupadd -r docker || true && usermod -aG docker www-data

# 8. Establecer permisos correctos para Laravel (storage y bootstrap/cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Exponer el puerto FPM
EXPOSE 9000