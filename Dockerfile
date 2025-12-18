# PHP 8.2 va Apache o'rnatilgan rasmiy image
FROM php:8.2-apache

# Tizim paketlarini yangilash va kerakli kutubxonalarni o'rnatish
# SQLite va CURL ishlashi uchun zarur paketlar
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    libcurl4-openssl-dev \
    unzip \
    && docker-php-ext-install pdo pdo_sqlite curl

# Apachening mod_rewrite modulini yoqish (URLlar bilan ishlash uchun)
RUN a2enmod rewrite

# Ishchi papkani belgilash
WORKDIR /var/www/html

# Loyiha fayllarini konteyner ichiga nusxalash
COPY . /var/www/html

# Ruxsatlarni to'g'irlash
# SQLite fayl yaratishi va yozishi uchun www-data foydalanuvchisiga huquq beramiz
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# 80-portni ochish
EXPOSE 80
