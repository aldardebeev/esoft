FROM php:8.2-fpm
ENV CASH_PATH /var/lib/apt/lists/*
ENV DEBIAN_FRONTEND noninteractive
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libmpc-dev \
    libpq-dev\
    libonig-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    nano \
    unzip \
    git

RUN pecl install xdebug && docker-php-ext-enable xdebug

EXPOSE 9000
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install pdo gmp pdo_pgsql bcmath mbstring

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD chown -R www-data:www-data /var/www/html/ && chmod -R 777 /var/www/html/ && php-fpm
