FROM php:8.0-fpm-alpine3.15

ARG USER_ID=1000
ARG GROUP_ID=1000
ARG DOCKER_TIMEZONE=${DOCKER_TIMEZONE}

ENV PS1="\u@\h:\w\\$ "

RUN echo "${DOCKER_TIMEZONE}" > /etc/timezone

# 2 Set working directory
WORKDIR /usr/src/app

# 3 Install Additional dependencies
RUN apk update && apk add --no-cache \
    build-base shadow vim curl bash \
    php8 \
    php8-fpm \
    php8-common \
    php8-pdo \
    php8-pdo_mysql \
    php8-mysqli \
    php8-mbstring \
    php8-xml \
    php8-openssl \
    php8-json \
    php8-phar \
    php8-zip \
    php8-gd \
    php8-dom \
    php8-session \
    php8-zlib \
    postgresql-dev \
    aspell-dev \
    autoconf

# 4 Add and Enable PHP-PDO Extenstions
RUN docker-php-ext-install pdo pdo_mysql mysqli 
RUN docker-php-ext-enable pdo_mysql opcache
RUN docker-php-ext-install pdo_pgsql 
RUN docker-php-ext-install pgsql 
RUN docker-php-ext-install pspell 
RUN docker-php-ext-enable pdo_pgsql pgsql pspell

# xdebug extensions
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
#

RUN pecl install -o -f redis apcu  \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis apcu

# 5 Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 6 Remove Cache
RUN rm -rf /var/cache/apk/*

# 7 Add UID '1000' to www-data
RUN usermod -u ${USER_ID} www-data

# 8 Copy existing application directory permissions
COPY --chown=www-data:www-data . /usr/src/app

# 9 Change current user to www
USER www-data

# 10 Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]