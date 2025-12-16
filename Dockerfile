FROM composer as builder
WORKDIR /app/
COPY composer.* ./
RUN composer install

FROM php:8-apache
WORKDIR /var/www/html/
EXPOSE 80
RUN mkdir ./data
RUN chown www-data.www-data ./data
RUN a2enmod remoteip
RUN a2enmod rewrite
COPY --chown=root:root 000-remoteip.conf /etc/apache2/conf-available/
RUN a2enconf 000-remoteip
VOLUME ./data
COPY --from=builder /app/vendor ./vendor
COPY ./templates ./templates
COPY ./*.php ./
