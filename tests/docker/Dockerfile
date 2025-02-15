FROM debian:bookworm

LABEL MAINTAINER="Mikel Madariaga <mmadariaga@irontec.com>"
LABEL MAINTAINER="Ivan Alonso <kaian@irontec.com>"

RUN echo 'deb [trusted=yes] http://packages.irontec.com/debian tempest main extra' >> /etc/apt/sources.list

# Generic environment configuraiton
ENV DEBIAN_FRONTEND=noninteractive
ENV CYPRESS_INSTALL_BINARY="https://packages.irontec.com/misc/cypress-10.11.0-linux-amd64.zip"
ENV CYPRESS_CACHE_FOLDER="/opt/cache/cypress/"

# Packages from standard repository
RUN apt update \
    && apt install --assume-yes --force-yes \
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
        libssl1.1 \
        localepurge \
    && apt clean \
    && rm -rf /var/lib/apt/lists/* \
    && localepurge

# Install node tools for testing
RUN npm install -g swagger-cli

# Install gherking fromatter
RUN pip install --break-system-packages reformat-gherkin

# Allow access to environment variables. Needed for testing DB
RUN sed -i 's/variables_order = "GPCS"/variables_order = "EGPCS"/g' /etc/php/8.2/cli/php.ini

# Install phpunit 6.5.14
RUN mkdir -p /opt/phpunit/ \
    && wget https://github.com/sebastianbergmann/phpunit/archive/6.5.14.zip -O /opt/phpunit/phpunit.zip \
    && unzip /opt/phpunit/phpunit.zip -d /opt/phpunit/

# Get dependencies
RUN mkdir -p /opt/irontec/ivozprovider/library/
WORKDIR /opt/irontec/ivozprovider/library
COPY library/composer-packages composer-packages
COPY library/composer.json library/composer.lock ./
RUN composer install --prefer-dist --no-progress

# Get yarn dependencies and store them in the image
RUN mkdir -p /opt/irontec/ivozprovider/web/portal/
WORKDIR /opt/irontec/ivozprovider/web/portal/
COPY --chown=$UNAME web/portal/package.json web/portal/yarn.lock ./
RUN yarn install

WORKDIR /opt/irontec/ivozprovider/
