# Usar una imagen base de PHP
FROM php:8.0-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Crear el directorio de trabajo
WORKDIR /app

# Copiar el código de la aplicación
COPY . .

# Instalar dependencias de Composer (si es necesario)
RUN if [ -f "composer.json" ]; then composer install --no-dev --optimize-autoloader; fi

# Exponer el puerto 10000
EXPOSE 10000

# Comando para iniciar la aplicación
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
