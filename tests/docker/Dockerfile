FROM debian:stretch

MAINTAINER Mikel Madariaga <mikel@irontec.com>

RUN echo deb http://packages.irontec.com/debian bleeding main extra >> /etc/apt/sources.list

RUN apt-get update
RUN apt-get install --assume-yes --force-yes \
        gettext \
        composer \
        make \
        git \
        unzip \
        curl \
        sqlite3 \
        sphinx-intl \
        nodejs \
        php7.0 \
        php7.0-cli \
        php7.0-mysql \
        php7.0-xml \
        php7.0-gd \
        php7.0-mbstring \
        php7.0-sqlite3 \
        php7.0-igbinary \
        php7.0-curl \
        php7.0-fpm \
        php-yaml \
        php-gearman \
        php-mailparse \
        php-imagick \
        php-xdebug \
        php-zip
RUN apt-get clean

# Create jenkins user (configurable)
ARG UNAME=jenkins
ARG UID=108
ARG GID=117
RUN groupadd -g $GID $UNAME
RUN useradd -m -u $UID -g $GID -s /bin/bash $UNAME
RUN chown jenkins.jenkins /opt/

# Install node tools for testing
RUN npm install -g swagger-cli

# Base project
USER $UNAME
RUN mkdir -p /opt/irontec
RUN git clone -b bleeding --depth 1 https://github.com/irontec/ivozprovider /opt/irontec/ivozprovider

# Get dependencies
RUN /opt/irontec/ivozprovider/library/bin/composer-install --prefer-dist --no-progress

# Store the main project vendor
RUN cp -r /opt/irontec/ivozprovider/library/vendor/    /opt/library-vendor

# We dont require project files anymore
RUN rm -fr /opt/irontec/ivozprovider/

WORKDIR /opt/irontec/ivozprovider/
