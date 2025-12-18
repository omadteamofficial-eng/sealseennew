FROM php:8.2-apache

# Kerakli kutubxonalarni o'rnatish (SQLite va Zip)
RUN apt-get update && apt-get install -y libsqlite3-dev unzip git \
    && docker-php-ext-install pdo pdo_sqlite

# Render PORT sozlamasi
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Fayllarni nusxalash
COPY . /var/www/html/

# Ruxsatlarni berish (DB yozilishi uchun muhim)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE ${PORT}
