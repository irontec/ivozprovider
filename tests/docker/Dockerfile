FROM debian:bullseye

MAINTAINER Mikel Madariaga <mikel@irontec.com>

RUN echo 'deb [trusted=yes] http://packages.irontec.com/debian halliday main extra' >> /etc/apt/sources.list

RUN apt-get update
RUN apt-get install --assume-yes --force-yes \
        gettext \
        composer \
        make \
        git \
        unzip \
        curl \
        wget \
        percona-toolkit \
        sqlite3 \
        sphinx-intl \
        nodejs \
        npm \
        php8.0 \
        php8.0-cli \
        php8.0-mysql \
        php8.0-xml \
        php8.0-gd \
        php8.0-mbstring \
        php8.0-sqlite3 \
        php8.0-redis \
        php8.0-igbinary \
        php8.0-curl \
        php8.0-yaml \
        php8.0-mailparse \
        php8.0-imagick \
        php8.0-xdebug \
        php8.0-zip \
        yarnpkg
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

RUN mkdir -p /opt/irontec/ivozprovider

WORKDIR /opt/irontec/ivozprovider/
