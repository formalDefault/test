# Usar una imagen base con PHP y Composer
FROM php:8.2-cli

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el código fuente al contenedor
COPY . .

# Instalar dependencias de Composer
# RUN composer install

# Exponer el puerto 8000 para el servidor de desarrollo
EXPOSE 8000 
 

CMD ["tail", "-f", "/dev/null"]
