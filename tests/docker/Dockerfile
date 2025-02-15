FROM debian:bookworm

LABEL MAINTAINER="Mikel Madariaga <mmadariaga@irontec.com>"
LABEL MAINTAINER="Ivan Alonso <kaian@irontec.com>"

RUN echo 'deb [trusted=yes] http://packages.irontec.com/debian tempest main extra' >> /etc/apt/sources.list

# Generic environment configuration
ENV DEBIAN_FRONTEND=noninteractive
ENV CYPRESS_INSTALL_BINARY="https://packages.irontec.com/misc/cypress-10.11.0-linux-amd64.zip"
ENV CYPRESS_CACHE_FOLDER="/opt/cache/cypress/"

# Install packages and clean up
RUN apt update \
    && apt install --no-install-recommends --assume-yes \
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
    && npm install -g swagger-cli \
    && pip install --break-system-packages reformat-gherkin \
    && sed -i 's/variables_order = "GPCS"/variables_order = "EGPCS"/g' /etc/php/8.2/cli/php.ini \
    && apt clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && localepurge

WORKDIR /opt/irontec/ivozprovider/
