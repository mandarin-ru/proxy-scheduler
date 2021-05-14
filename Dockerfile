FROM composer as builder
WORKDIR /app/
COPY composer.* ./
RUN composer install

FROM php:8-apache
EXPOSE 80
RUN mkdir /var/www/html/data
RUN chown www-data.www-data /var/www/html/data
VOLUME /var/www/html/data
COPY --from=builder /app/vendor /var/www/html/vendor
COPY ./templates /var/www/html/templates
COPY ./*.php /var/www/html/
