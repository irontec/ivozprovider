FROM phpstan/phpstan:latest

RUN apk --update --progress --no-cache add \
    php7-dev build-base php7-pcntl git

RUN apk --update --progress --no-cache --repository 'http://dl-cdn.alpinelinux.org/alpine/edge/main' add \
    bash libcrypto1.1 libssl1.1

RUN apk --update --progress --no-cache --repository 'http://dl-cdn.alpinelinux.org/alpine/edge/testing' add \
    gearman-libs gearman-dev php7-gearman

RUN apk --update --progress --no-cache --repository 'http://dl-cdn.alpinelinux.org/alpine/edge/community' add \
    php7-pecl-mailparse

RUN composer global require phpstan/phpstan-phpunit
RUN composer global require phpstan/phpstan-doctrine
RUN composer global require phpstan/phpstan-beberlei-assert
RUN composer global require phpstan/phpstan-symfony

RUN mkdir -p /opt/irontec
RUN git clone -b bleeding --depth 1 https://github.com/irontec/ivozprovider /opt/irontec/ivozprovider

# Get dependencies
RUN /opt/irontec/ivozprovider/library/bin/composer-install --prefer-dist --no-progress

# Store the main project vendor
RUN cp -r /opt/irontec/ivozprovider/library/vendor/    /opt/library-vendor

# We dont require project files anymore
RUN rm -fr /opt/irontec/ivozprovider/

WORKDIR /opt/irontec/ivozprovider/
