# Usar imagen base de PHP 7.4
FROM php:7.4.23-apache

# Copiar los archivos del proyecto a la carpeta del servidor web del contenedor
COPY . /app
# Cambiar los persmisos de /app/public
RUN chmod -R 755 /app/public

# Cambiar el Document Root de Apache
RUN sed -i 's|/var/www/html|/app/public|g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's|/var/www/html|/app/public|g' /etc/apache2/sites-available/default-ssl.conf

RUN echo "<Directory /app/public>\n    Require all granted\n</Directory>" >> /etc/apache2/apache2.conf

RUN apt-get update && \
    apt-get install -y git wget zip unzip

RUN wget https://getcomposer.org/installer -O composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

RUN apt-get update && apt-get install -y libxml2-dev zlib1g-dev libonig-dev libpng-dev

# Instalar las extensiones necesarias para PHP
RUN docker-php-ext-install pdo pdo_mysql dom mbstring gd bcmath

WORKDIR /app

RUN composer install
