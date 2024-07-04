FROM debian:bookworm

MAINTAINER Mikel Madariaga <mmadariaga@irontec.com>
MAINTAINER Ivan Alonso <kaian@irontec.com>

RUN echo 'deb [trusted=yes] http://packages.irontec.com/debian tempest main extra' >> /etc/apt/sources.list

# Packages from standard repository
RUN apt-get update && apt-get install --assume-yes --force-yes \
        gettext \
        composer \
        make \
        git \
        golang \
        unzip \
        curl \
        wget \
        percona-toolkit \
        sqlite3 \
        sphinx-intl \
        nodejs \
        npm \
        mysql-client \
        python3-pip \
        php \
        php-cli \
        php-mysql \
        php-xml \
        php-gd \
        php-mbstring \
        php-sqlite3 \
        php-redis \
        php-igbinary \
        php-curl \
        php-yaml \
        php-mailparse \
        php-imagick \
        php-xdebug \
        php-zip \
        yarn \
        jq \
        xvfb \
        libnss3 \
        libatk3.0-cil \
        libatk-bridge2.0-0 \
        libcups2 \
        libgtk3.0-cil \
        libgbm1 \
        libasound2 \
        libxrender1 \
        libssl1.1

RUN apt-get clean

# Custom cypress download URL
ENV CYPRESS_INSTALL_BINARY=https://packages.irontec.com/misc/cypress-10.11.0-linux-amd64.zip

# Create jenkins user (configurable)
ARG UNAME=jenkins
ARG UID=108
ARG GID=117
RUN groupadd -g $GID $UNAME
RUN useradd -m -u $UID -g $GID -s /bin/bash $UNAME
RUN chown jenkins:jenkins /opt/

# Install node tools for testing
RUN npm install -g swagger-cli

# Install gherking fromatter
RUN pip install --break-system-packages reformat-gherkin

# Base project
USER $UNAME
RUN mkdir -p /opt/irontec
RUN git clone -b bleeding --depth 1 https://github.com/irontec/ivozprovider /opt/irontec/ivozprovider

# Install phpunit 6.5.14
RUN mkdir -p /opt/phpunit/
RUN wget https://github.com/sebastianbergmann/phpunit/archive/6.5.14.zip -O /opt/phpunit/phpunit.zip
RUN unzip /opt/phpunit/phpunit.zip -d /opt/phpunit/

# Get dependencies
RUN /opt/irontec/ivozprovider/library/bin/composer-install --prefer-dist --no-progress

# Store the main project vendor
RUN cp -r /opt/irontec/ivozprovider/library/vendor/    /opt/library-vendor

# Get yarn dependencies and store them in the image
RUN yarn --cwd /opt/irontec/ivozprovider/web/portal --cache-folder /opt/web-node_modules install

# We dont require project files anymore
RUN rm -fr /opt/irontec/ivozprovider/

WORKDIR /opt/irontec/ivozprovider/
