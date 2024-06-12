FROM debian:bookworm

MAINTAINER Mikel Madariaga <mikel@irontec.com>
MAINTAINER Ivan Alonso <kaian@irontec.com>

# Image environment configuration
ENV DEBIAN_FRONTEND=noninteractive

# User data for workspace permissions
ARG UNAME=user
ARG UID=1000
ARG GID=1000

RUN apt-get update \
  && apt-get install --no-install-recommends -y gnupg wget fakeroot dpkg-dev build-essential debconf pbuilder aptitude \
  && apt-get clean

# Custom sources list
RUN echo deb http://packages.irontec.com/debian tempest main extra >> /etc/apt/sources.list \
  && wget http://packages.irontec.com/public.key -q -O /etc/apt/trusted.gpg.d/irontec-debian-repository.asc

# Install build dependencies
COPY . debian
RUN apt-get update \
  && /usr/lib/pbuilder/pbuilder-satisfydepends-experimental \
  && apt-get clean

# Create user (configurable)
RUN groupadd -g $GID $UNAME \
  && useradd -m -u $UID -g $GID -s /bin/bash $UNAME \
  && mkdir -p /build/source \
  && chown -R $UID:$GID /build/

WORKDIR /build/source
