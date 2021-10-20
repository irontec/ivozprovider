FROM debian:stretch

MAINTAINER Mikel Madariaga <mikel@irontec.com>
MAINTAINER Ivan Alonso <kaian@irontec.com>

RUN apt-get update && apt-get -y install gnupg wget

RUN echo deb http://packages.irontec.com/debian artemis main extra >> \
    /etc/apt/sources.list

RUN wget http://packages.irontec.com/public.key -q -O - | apt-key add -

RUN apt-get update && apt-get install -y \
    dpkg-dev \
    debhelper \
    dh-systemd \
    nodejs \
    ruby-compass \
    git \
    openssh-client \
    curl \
    php7.0 \
    python \
    make \
    python-sphinx-rtd-theme \
    gettext \
    python-sphinx \
    sphinx-common \
    libjs-sphinxdoc \
    libjs-jquery \
    python-alabaster \
    composer \
    php7.0-mbstring \
    php7.0-xml \
    php7.0-zip \
    php-mailparse \
    php-gearman

# Create jenkins user (configurable)
ARG UNAME=jenkins
ARG UID=108
ARG GID=117
RUN groupadd -g $GID $UNAME
RUN useradd -m -u $UID -g $GID -s /bin/bash $UNAME
RUN chown jenkins.jenkins /opt/

# Base project
USER $UNAME
RUN mkdir -p /opt/irontec/ivozprovider

WORKDIR /opt/irontec/ivozprovider/

