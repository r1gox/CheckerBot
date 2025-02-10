# Usar una imagen base de PHP
FROM php:8.0-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable pgsql pdo_pgsql \
    && rm -rf /var/lib/apt/lists/* \
    && apt autoremove --yes

# Crear el directorio de trabajo
WORKDIR /app

# Copiar el código de la aplicación
COPY . .

# Exponer el puerto 10000
EXPOSE 10000

# Comando para iniciar la aplicación
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
