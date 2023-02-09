# See https://github.com/docker-library/php/blob/4677ca134fe48d20c820a19becb99198824d78e3/7.0/fpm/Dockerfile
FROM debian:bullseye

MAINTAINER Mikel Madariaga <mikel@irontec.com>
MAINTAINER Ivan Alonso <kaian@irontec.com>

RUN apt-get update && apt-get -y install gnupg wget

RUN echo deb http://packages.irontec.com/debian halliday main extra >> \
    /etc/apt/sources.list

RUN wget http://packages.irontec.com/public.key -q -O - | apt-key add -

RUN apt-get update && apt-get install -y \
    dpkg-dev \
    debhelper \
    nodejs \
    npm \
    ruby-dev \
    git \
    openssh-client \
    curl \
    php8.0 \
    python \
    make \
    gettext \
    yarnpkg \
    sphinx-common \
    python3-sphinx-rtd-theme \
    libjs-sphinxdoc \
    libjs-jquery \
    composer \
    php8.0-cli \
    php8.0-mbstring \
    php8.0-xml \
    php8.0-zip \
    php8.0-mailparse \
    php8.0-gearman


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
