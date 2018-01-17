#!/bin/bash

pushd /opt/irontec/ivozprovider/scheme
    for target in "$@"
    do
        php ./bin/console provider:clear:interfaces -v Ivoz/$target &&
        php ./bin/console provider:generate:entities:abstract -v Ivoz/$target && \
        php ./bin/console provider:generate:traits -v Ivoz/$target && \
        php ./bin/console provider:generate:entities -v Ivoz/$target --path ../library/ && \
        php ./bin/console provider:generate:interfaces -v Ivoz/$target && \
        php ./bin/console provider:generate:dtos:abstract -v Ivoz/$target
        php ./bin/console provider:generate:dtos -v Ivoz/$target
    done
popd

pushd /opt/irontec/ivozprovider
    php web/rest/bin/console cache:clear -e dev
    php web/rest/bin/console cache:clear -e prod
popd