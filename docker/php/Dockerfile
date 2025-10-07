FROM serversideup/php:8.4-fpm-alpine

USER root
WORKDIR /var/www/html

RUN apk add --no-cache bash shadow curl nodejs npm
RUN usermod -u 1000 www-data

COPY . .

COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

USER www-data
EXPOSE 9000
CMD ["php-fpm"]