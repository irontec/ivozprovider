FROM debian:bookworm

MAINTAINER Mikel Madariaga <mikel@irontec.com>
MAINTAINER Ivan Alonso <kaian@irontec.com>

RUN apt-get update && apt-get -y install gnupg wget

RUN echo deb http://packages.irontec.com/debian tempest main extra >> \
    /etc/apt/sources.list

RUN wget http://packages.irontec.com/public.key -q -O - | apt-key add -

# Packages from standard repository
RUN apt-get update && apt-get install -y \
    composer \
    curl \
    dpkg-dev \
    debhelper \
    gettext \
    git \
    golang \
    libjs-sphinxdoc \
    libjs-jquery \
    make \
    npm \
    nodejs \
    openssh-client \
    php8.2 \
    php8.2-cli \
    php8.2-common \
    php8.2-mbstring \
    php8.2-xml \
    php8.2-zip \
    php8.2-mailparse \
    php8.2-readline \
    php8.2-gearman \
    python3 \
    python3-sphinx-rtd-theme \
    ruby-dev \
    sphinx-common \
    yarn

# Create jenkins user (configurable)
ARG UNAME=jenkins
ARG UID=108
ARG GID=117
RUN groupadd -g $GID $UNAME
RUN useradd -m -u $UID -g $GID -s /bin/bash $UNAME
RUN mkdir -p /build/source
RUN chown -R jenkins.jenkins /build/

WORKDIR /build/source

