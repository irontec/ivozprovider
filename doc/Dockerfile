FROM debian:stretch

MAINTAINER Irontec IvozProvider Team <ivozprovider@irontec.com>

RUN echo deb http://archive.debian.org/debian stretch main contrib non-free > /etc/apt/sources.list
RUN echo deb http://archive.debian.org/debian stretch-backports main contrib non-free > /etc/apt/sources.list.d/backports.list

RUN apt-get update && apt-get install -y --allow-downgrades \
    gnupg \
    wget \
    sudo \
    git \
    python-pip \
    python-sphinx-rtd-theme \
    texlive-latex-base \
    texlive-latex-extra \
    texlive-latex-recommended \
    libnettle6=3.3-1+b2

# Install sphinx multiversion plugin
RUN pip install colorclass click
RUN git clone https://github.com/irontec/sphinxcontrib-versioning.git
RUN cd sphinxcontrib-versioning && python setup.py install

# Create jenkins user (configurable)
ARG UNAME=jenkins
ARG UID=108
ARG GID=117
RUN groupadd -g $GID $UNAME
RUN useradd -m -u $UID -g $GID -s /bin/bash $UNAME

# Add jenkins to sudoers file
RUN echo "$UNAME ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

# Base project
USER $UNAME

WORKDIR /opt/irontec/ivozprovider/

