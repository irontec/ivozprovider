FROM debian:bookworm

################################################################################
# Install package dependencies
################################################################################
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update && \
    apt-get install --assume-yes --force-yes \
        sudo \
        gettext \
        composer \
        make \
        git \
        unzip \
        curl \
        percona-toolkit \
        sqlite3 \
        php8.2 \
        php8.2-cli \
        php8.2-mysql \
        php8.2-xml \
        php8.2-gd \
        php8.2-mbstring \
        php8.2-sqlite3 \
        php8.2-redis \
        php8.2-igbinary \
        php8.2-curl \
        php8.2-yaml \
        php8.2-fpm \
        php8.2-mailparse \
        php8.2-imagick \
        php8.2-xdebug \
        php8.2-zip \
        php8.2-ldap \
        php8.2-intl \
        iputils-ping \
        python3\
        pip\
        vim \
        iproute2 \
        apache2 \
        acl \
    && apt-get clean

################################################################################
# Apache server configuration
################################################################################
ADD docker/backend/060-ivozprovider-api.conf \
    /etc/apache2/sites-available/060-ivozprovider-api.conf

# Disable not required apache modules
RUN /usr/sbin/a2dismod -q mpm_prefork
RUN /usr/sbin/a2dismod -q mpm_worker

# Enable required apache modules
RUN /usr/sbin/a2enmod -q mpm_event
RUN /usr/sbin/a2enmod -q http2
RUN /usr/sbin/a2enmod -q headers
RUN /usr/sbin/a2enmod -q rewrite
RUN /usr/sbin/a2enmod -q ssl
RUN /usr/sbin/a2enmod -q proxy
RUN /usr/sbin/a2enmod -q proxy_http
RUN /usr/sbin/a2enmod -q proxy_wstunnel
RUN /usr/sbin/a2enmod -q proxy_fcgi setenvif

# Enable required apache configuration
RUN /usr/sbin/a2enconf -q php8.2-fpm
RUN /usr/sbin/a2dissite -q 000-default
RUN /usr/sbin/a2ensite -q 060-ivozprovider-api.conf

################################################################################
# php8.2-fpm server configuration
################################################################################
ENV PHP_IDE_CONFIG="serverName=ivozprovider-backend"
RUN rm -f /etc/php/8.2/fpm/conf.d/20-xdebug.ini
ADD docker/backend/xdebug.ini /etc/php/8.2/fpm/conf.d/20-xdebug.ini

################################################################################
# Internal docker user configuration
################################################################################
## Create user to run commands with same id than host
ARG UID
ARG GID
RUN groupadd -g $GID docker
RUN useradd -m -u $UID -g $GID docker
RUN echo "docker:docker" | chpasswd
RUN adduser docker sudo
RUN echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

################################################################################
# Startup script
################################################################################
RUN mkdir -p /var/run/php
ADD docker/backend/start.sh /var/run
RUN chmod +x /var/run/start.sh

USER docker
WORKDIR /opt/irontec/ivozprovider/
CMD [ "/bin/bash", "/var/run/start.sh"]