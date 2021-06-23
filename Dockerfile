FROM php:8.0-fpm
RUN apk add --no-cache openssl bash mysql-client nodejs npm alpine-sdk autoconf vim
RUN docker-php-ext-install pdo pdo_mysql

RUN ln -s /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

WORKDIR /var/www

RUN rm -rf /var/www/html
RUN ln -s public html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

ENTRYPOINT ["php-fpm"]
