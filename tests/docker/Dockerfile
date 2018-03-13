# See https://github.com/docker-library/php/blob/4677ca134fe48d20c820a19becb99198824d78e3/7.0/fpm/Dockerfile
FROM debian:stretch

MAINTAINER Mikel Madariaga <mikel@irontec.com>

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    php7.0 \
    php7.0-cli \
    php7.0-mysql \
    php7.0-xml \
    php7.0-mbstring \
    php-xdebug \
    sqlite3 \
    php7.0-sqlite3 \
    php7.0-igbinary \
    php-gearman \
    php-mailparse \
    php-imagick \
    php7.0-curl \
    php-yaml \
    php7.0-gd \
    php-zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Base project
RUN mkdir -p /opt/irontec
RUN git clone -b run-tests-in-ci https://github.com/irontec/ivozprovider /opt/irontec/ivozprovider

# Get dependencies
RUN /opt/irontec/ivozprovider/library/bin/composer_install.sh --prefer-dist --no-progress

ENTRYPOINT [ "/opt/irontec/ivozprovider/tests/docker/bin/prepare-and-run" ]
