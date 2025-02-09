# Usar una imagen base de PHP
FROM php:8.0-cli AS builder

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    unzip \
    && docker-php-ext-install zip pdo pdo_pgsql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar el código de la aplicación
WORKDIR /app
COPY . .

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Crear una imagen final más ligera
FROM php:8.0-cli

# Copiar solo los archivos necesarios desde la etapa de construcción
COPY --from=builder /app /app

# Establecer el directorio de trabajo
WORKDIR /app

# Exponer el puerto 10000
EXPOSE 10000

# Comando para iniciar la aplicación
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
