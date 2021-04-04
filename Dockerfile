FROM composer as builder
WORKDIR /app/
COPY composer.* ./
RUN composer install

FROM php:8-apache
WORKDIR /code
EXPOSE 80
COPY . /var/www/html/
COPY --from=builder /app/vendor /var/www/html/vendor
