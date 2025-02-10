# Usa la imagen de PHP CLI 8.0
FROM php:8.0-cli

# Establece el directorio de trabajo
WORKDIR /app

# Copia el contenido del proyecto en el contenedor
COPY . .

# Instala dependencias del sistema, incluidas las necesarias para PostgreSQL y ZIP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install zip pdo_pgsql

# Instala Composer (si es necesario)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ejecuta Composer para instalar dependencias si existe un archivo composer.json
RUN if [ -f composer.json ]; then composer install; fi

# Expone el puerto que usará el servidor embebido de PHP
EXPOSE 10000

# Comando para ejecutar el servidor embebido de PHP
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
