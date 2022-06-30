FROM php:8.1-fpm-alpine

ARG USER_ID=0
ARG GROUP_ID=0
ARG DOCKER_TIMEZONE=${DOCKER_TIMEZONE}

ENV PS1="\u@\h:\w\\$ "

RUN echo "${DOCKER_TIMEZONE}" > /etc/timezone

# 2 Set working directory
WORKDIR /usr/src/app

RUN apk update && apk add --no-cache \
    build-base shadow vim curl bash \
    zip libzip-dev \
    libpng libpng-dev \
    libmcrypt libmcrypt-dev git \
    openssh-client icu-dev libxml2-dev freetype-dev libjpeg-turbo-dev g++ make \
    postgresql-dev \
    aspell-dev \
    autoconf && docker-php-source extract

RUN pecl install xdebug redis \
    && docker-php-ext-enable xdebug redis opcache \
    && docker-php-source delete

RUN docker-php-ext-install pdo pdo_pgsql zip soap intl

RUN apk add --update --no-cache \
          libldap && \
      apk add --update --no-cache --virtual .docker-php-ldap-dependancies \
          openldap-dev && \
      docker-php-ext-configure ldap && \
      docker-php-ext-install ldap && \
      apk del .docker-php-ldap-dependancies

RUN apk --no-cache add nodejs yarn npm --repository=http://dl-cdn.alpinelinux.org/alpine/edge/community \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 6 Remove Cache
RUN rm -rf /var/cache/apk/*

WORKDIR /usr/src/app

# 7 Add UID '1000' to www-data
#RUN usermod -u ${USER_ID} www-data

# 8 Copy existing application directory permissions
COPY --chown=www-data:www-data . /usr/src/app

RUN composer install --no-scripts --prefer-dist --no-interaction --optimize-autoloader

RUN php bin/console cache:clear

RUN mkdir -p /usr/src/app/public/uploads
RUN chmod -R 777 /usr/src/app/public/uploads

RUN yarn install

RUN yarn encore prod
#RUN chown -R www-data:www-data /usr/src/app
RUN mkdir -p /usr/src/app/var/cache && chmod 777 /usr/src/app/var/cache
# 9 Change current user
USER www-data
# 10 Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

