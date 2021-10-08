#
# container
# @see https://hub.docker.com/repository/docker/cnizzardini/php-fpm-alpine
# @see https://github.com/cnizzardini/php-fpm-alpine/tree/php-7.4
FROM php:8.0.0-fpm-alpine as cakephp_php

ENV TERM=linux

RUN apk add libzip icu
RUN apk add --no-cache --virtual .build-deps curl-dev libxml2-dev icu-dev libedit-dev libzip-dev acl libzip icu
RUN docker-php-ext-install intl pdo pdo_mysql curl opcache readline xml zip

RUN apk del -f .build-deps && rm -rf /tmp/* /var/cache/apk/*

ARG ENV=prod
ARG UID=1000
ENV APP_ENV=$ENV

#
# dev/test depdencies
#
RUN if [[ "$ENV" != "prod" ]]; then \
    apk add git \
    && apk add --no-cache --virtual .php-deps file re2c autoconf make zlib zlib-dev g++ curl \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del -f .php-deps; \
fi

#
# application
#
COPY .docker/php/docker-healthcheck.sh /usr/local/bin/docker-healthcheck
RUN chmod +x /usr/local/bin/docker-healthcheck
HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD ["docker-healthcheck"]

COPY .docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

COPY .assets /srv/.assets

WORKDIR /srv/app

RUN addgroup -g 101 nginx
RUN adduser --disabled-password --gecos '' -u $UID cakephp;

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY app .

RUN if [[ "$ENV" = "prod" ]]; then \
    composer install --prefer-dist --no-interaction --no-dev; \
fi

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]
