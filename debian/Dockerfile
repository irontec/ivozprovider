FROM debian:bullseye

MAINTAINER Mikel Madariaga <mikel@irontec.com>
MAINTAINER Ivan Alonso <kaian@irontec.com>

RUN apt-get update && apt-get -y install gnupg wget

RUN echo deb http://packages.irontec.com/debian halliday main extra >> \
    /etc/apt/sources.list

RUN wget http://packages.irontec.com/public.key -q -O - | apt-key add -

RUN apt-get update && apt-get install -y \
    composer \
    curl \
    dpkg-dev \
    debhelper \
    gettext \
    git \
    libjs-sphinxdoc \
    libjs-jquery \
    make \
    nodejs \
    openssh-client \
    php8.0 \
    php8.0-cli \
    php8.0-common \
    php8.0-mbstring \
    php8.0-xml \
    php8.0-zip \
    php8.0-mailparse \
    php8.0-readline \
    php8.0-gearman \
    python \
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

