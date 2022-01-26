FROM ambientum/php:8.1-nginx
USER root
ENV XDEBUG_ENABLED=true

RUN apk add --update nodejs nodejs-npm
# RUN apk add --update mysql-client

COPY ./xdebug.ini /etc/php7/conf.d/xdebug.ini
COPY ./laravel.conf /etc/nginx/sites/laravel.conf