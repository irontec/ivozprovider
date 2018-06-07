# See https://github.com/docker-library/php/blob/4677ca134fe48d20c820a19becb99198824d78e3/7.0/fpm/Dockerfile
FROM debian:stretch

MAINTAINER Mikel Madariaga <mikel@irontec.com>

RUN apt-get update && apt-get -y install gnupg wget

RUN echo deb http://packages.irontec.com/debian bleeding main extra >> \
    /etc/apt/sources.list

RUN wget http://packages.irontec.com/public.key -q -O - | apt-key add -

RUN apt-get update && apt-get install -y \
    dpkg-dev \
    debhelper \
    dh-systemd \
    nodejs \
    ruby-compass \
    python \
    python-sphinx-rtd-theme \
    gettext \
    python-sphinx \
    sphinx-common \
    sphinx-intl \
    libjs-sphinxdoc \
    libjs-jquery \
    python-alabaster \
    composer \
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
    php-zip \
    openjdk-8-jre \
    xvfb \
    chromium \
    chromium-driver

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Selenium server
RUN mkdir /opt/selenium/ && mkdir -p /opt/selenium/ && \
	curl -SS http://selenium-release.storage.googleapis.com/3.5/selenium-server-standalone-3.5.3.jar \
		-o /opt/selenium/selenium-server-standalone-3.5.3.jar

# Create jenkins user (configurable)
ARG UNAME=jenkins
ARG UID=108
ARG GID=117
RUN groupadd -g $GID $UNAME
RUN useradd -m -u $UID -g $GID -s /bin/bash $UNAME
RUN chown jenkins.jenkins /opt/

# Base project
USER $UNAME
RUN mkdir -p /opt/irontec
RUN git clone -b bleeding --depth 1 https://github.com/irontec/ivozprovider /opt/irontec/ivozprovider

# Get dependencies
RUN /opt/irontec/ivozprovider/library/bin/composer-install --prefer-dist --no-progress

# Store the main project vendor
RUN cp -r /opt/irontec/ivozprovider/library/vendor/    /opt/library-vendor

# Install Node version manager in jenkins $HOME
RUN curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.11/install.sh | bash

WORKDIR /opt/irontec/ivozprovider/
ENTRYPOINT [ "/opt/irontec/ivozprovider/tests/docker/bin/prepare-and-run" ]
