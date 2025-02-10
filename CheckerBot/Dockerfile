FROM php:8.0-cli

# Define el directorio de trabajo
WORKDIR /app

# Instala dependencias necesarias y Composer
RUN apt-get update && apt-get install -y libzip-dev unzip \
    && docker-php-ext-install zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia el código al contenedor
COPY . .

# Ejecuta Composer para instalar dependencias si existe un archivo composer.json
RUN if [ -f composer.json ]; then composer install; fi

# Expone el puerto que usará el servidor embebido de PHP
EXPOSE 10000

# Comando para ejecutar el servidor embebido de PHP
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
