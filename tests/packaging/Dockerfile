FROM debian:bookworm

LABEL MAINTAINER="Mikel Madariaga <mikel@irontec.com>"
LABEL MAINTAINER="Ivan Alonso <kaian@irontec.com>"

RUN echo 'deb [trusted=yes] http://packages.irontec.com/debian tempest main extra' >> /etc/apt/sources.list

ENV DEBIAN_FRONTEND=noninteractive

# Build-Depends from debian/control
RUN apt-get update && apt-get install -y \
    debhelper \
    dh-exec \
    dpkg-dev \
    composer \
    curl \
    gettext \
    git \
    libjs-jquery \
    libjs-sphinxdoc \
    make \
    openssh-client \
    php8.2 \
    php8.2-cli \
    php8.2-common \
    php8.2-mailparse \
    php8.2-mbstring \
    php8.2-opcache \
    php8.2-readline \
    php8.2-xml \
    php8.2-zip \
    python3 \
    python3-alabaster \
    python3-sphinx \
    python3-sphinx-rtd-theme \
    ruby-dev \
    sphinx-common \
    yarn \
    nodejs \
    jq \
    golang

# Avoid HTTP/2 failures on git clones (bookworm git + github return 401 on POST)
RUN git config --system http.version HTTP/1.1

# Create jenkins user (configurable)
ARG UNAME=jenkins
ARG UID=108
ARG GID=117
RUN groupadd -g $GID $UNAME
RUN useradd -m -u $UID -g $GID -s /bin/bash $UNAME
RUN chown jenkins:jenkins /opt/

# Base project
USER $UNAME
RUN mkdir -p /opt/irontec/ivozprovider

WORKDIR /opt/irontec/ivozprovider/
