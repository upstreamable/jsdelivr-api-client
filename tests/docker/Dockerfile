FROM php:7.2

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && \
  apt-get install --no-install-recommends --no-install-suggests --yes --quiet git zip unzip procps && \
  docker-php-ext-install sockets && \
  curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
