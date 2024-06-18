# Usar la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalar las extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html

# Copiar el archivo de configuración de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Establecer permisos y propietario de los archivos
RUN chown -R www-data:www-data /var/www/html
RUN find /var/www/html -type f -exec chmod 644 {} \;
RUN find /var/www/html -type d -exec chmod 755 {} \;

# Instalar Composer y las dependencias de Laravel
RUN apt-get update && apt-get install -y unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html
RUN composer install
