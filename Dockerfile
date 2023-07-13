FROM php:8.1.0-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    unzip \
    libicu-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql intl
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
COPY ./docker/xdebug.ini "${PHP_INI_DIR}/conf.d"
RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/*

WORKDIR /var/www

COPY ./composer.* ./

RUN composer install


