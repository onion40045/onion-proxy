FROM php:8.2-apache
COPY ./proxy.php /var/www/html/
EXPOSE 80
