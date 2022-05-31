# See https://github.com/docker-library/php/blob/4677ca134fe48d20c820a19becb99198824d78e3/7.0/fpm/Dockerfile
FROM debian:bullseye

MAINTAINER Irontec IvozProvider Team <ivozprovider@irontec.com>

RUN apt-get update && apt-get install -y \
    gnupg \
    wget \
    reprepro \
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
RUN echo "$UNAME ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

# Keyring information
RUN apt-key --keyring /usr/share/keyrings/debian-archive-keyring.gpg del ED6D65271AACF0FF15D123036FB2A1C265FFB764
RUN apt-key --keyring /usr/share/keyrings/debian-archive-keyring.gpg del 6FB2A1C265FFB764

# Update debian keyring
RUN wget -q http://ftp.us.debian.org/debian/pool/main/d/debian-keyring/debian-keyring_2021.07.26_all.deb
RUN wget -q http://ftp.us.debian.org/debian/pool/main/d/debian-archive-keyring/debian-archive-keyring_2021.1.1_all.deb
RUN dpkg -i debian-*keyring*.deb

# Base project
USER $UNAME

WORKDIR /opt/irontec/ivozprovider/extra/simple-cdd/
