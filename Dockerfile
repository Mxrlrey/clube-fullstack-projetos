FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql

WORKDIR /var/www/public

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/public"]
