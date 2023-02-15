FROM php:8.1-fpm-alpine
WORKDIR /var/www/

FROM nginx
COPY static-html-directory /usr/share/nginx/htm

RUN apt-get update \
    &&  apt-get install git

RUN curl -sS https://getcomposer.org/installer | php -- \
    &&  mv composer.phar /usr/local/bin/composer

RUN curl -sS https://get.symfony.com/cli/installer | bash \
    &&  mv /root/.symfony/bin/symfony /usr/local/bin

WORKDIR /var/www/html/