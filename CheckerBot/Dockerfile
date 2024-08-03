FROM php:8.0-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y libzip-dev \
    && docker-php-ext-install zip

CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
