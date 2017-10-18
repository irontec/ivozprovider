#!/bin/bash

for target in "$@"
do
    php ./bin/console provider:clear:interfaces Ivoz/$target &&
    php ./bin/console provider:generate:entities:abstract Ivoz/$target && \
    php ./bin/console provider:generate:traits Ivoz/$target && \
    php ./bin/console provider:generate:entities Ivoz/$target && \
    php ./bin/console provider:generate:interfaces Ivoz/$target && \
    php ./bin/console provider:generate:dtos Ivoz/$target

    pushd /opt/irontec/ivozprovider
        php web/rest/bin/console cache:clear -e dev
        php web/rest/bin/console cache:clear -e prod
    popd
done