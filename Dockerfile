FROM composer as builder
WORKDIR /app/
COPY composer.* ./
RUN composer install

FROM php:8-apache
EXPOSE 80
COPY ./*.php /var/www/html/
COPY ./templates /var/www/html/
COPY --from=builder /app/vendor /var/www/html/vendor
