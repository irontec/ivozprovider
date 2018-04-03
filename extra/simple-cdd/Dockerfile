# See https://github.com/docker-library/php/blob/4677ca134fe48d20c820a19becb99198824d78e3/7.0/fpm/Dockerfile
FROM debian:stretch

MAINTAINER Irontec IvozProvider Team <ivozprovider@irontec.com>

RUN apt-get update && apt-get install -y \
    gnupg \
    wget \
    sudo \
    simple-cdd

# Iso target architecture
ARG ARCH=amd64

# Create jenkins user (configurable)
ARG UNAME=jenkins
ARG UID=108
ARG GID=117
RUN groupadd -g $GID $UNAME
RUN useradd -m -u $UID -g $GID -s /bin/bash $UNAME

# Add jenkins to sudoers file
RUN echo 'jenkins ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Base project
USER $UNAME

WORKDIR /opt/irontec/ivozprovider/extra/simple-cdd/

