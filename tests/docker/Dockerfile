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
        php8.0-zip
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
RUN git clone -b halliday --depth 1 https://github.com/irontec/ivozprovider /opt/irontec/ivozprovider

# Install phpunit 6.5.14
RUN mkdir -p /opt/phpunit/
RUN wget https://github.com/sebastianbergmann/phpunit/archive/6.5.14.zip -O /opt/phpunit/phpunit.zip
RUN unzip /opt/phpunit/phpunit.zip -d /opt/phpunit/

# Get dependencies
RUN /opt/irontec/ivozprovider/library/bin/composer-install --prefer-dist --no-progress --ignore-platform-reqs

# Store the main project vendor
RUN cp -r /opt/irontec/ivozprovider/library/vendor/    /opt/library-vendor

# We dont require project files anymore
RUN rm -fr /opt/irontec/ivozprovider/

WORKDIR /opt/irontec/ivozprovider/
