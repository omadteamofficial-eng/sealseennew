FROM php:8.2-apache

# Portni sozlash (Render odatda 80 yoki 10000 portni ishlatadi)
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/0000-default.conf /etc/apache2/ports.conf

COPY . /var/www/html/

WORKDIR /var/www/html/

EXPOSE ${PORT}
