FROM php:8.4-alpine AS dev

ARG HOST_UID=501


# Packages installation
RUN apk --no-cache update && apk --no-cache add curl bash unzip libzip-dev icu-dev gmp-dev zip git autoconf g++ make libaio libnsl libc6-compat procps linux-headers

# Enable Docker PHP extensions
RUN docker-php-ext-install zip pcntl gmp
RUN docker-php-ext-configure intl && docker-php-ext-install intl

# Install Xdebug
RUN pecl install xdebug-3.2.1 \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install Apcu
RUN pecl install apcu && docker-php-ext-enable apcu
RUN echo "apc.enable_cli=1" >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini

# Set PHP configuration
COPY ./php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./php.ini /usr/local/etc/php/conf.d/custom.ini


# Make www-data match the host user ID on Unix filesystems to avoid permission problems
RUN apk --no-cache add shadow \
  && groupmod --gid ${HOST_UID} www-data \
  && usermod --uid ${HOST_UID} --gid ${HOST_UID} www-data \
  && apk del shadow

USER www-data
WORKDIR /usr/src/myapp

COPY --chown=www-data --from=composer:2.7.7 /usr/bin/composer /home/www-data/.local/bin/composer
ENV PATH="/home/www-data/.local/bin:${PATH}"

RUN curl -sS https://get.symfony.com/cli/installer | bash
COPY ./symfony.ini /etc/php/8.2/cli/conf.d/
ENV PATH="/home/www-data/.symfony5/bin:${PATH}"
