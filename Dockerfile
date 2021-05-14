FROM composer as builder
WORKDIR /app/
COPY composer.* ./
RUN composer install

FROM php:8-apache
WORKDIR /var/www/html/
EXPOSE 80
RUN mkdir ./data
RUN chown www-data.www-data ./data
VOLUME ./data
COPY --from=builder /app/vendor ./vendor
COPY ./templates ./templates
COPY ./*.php ./
