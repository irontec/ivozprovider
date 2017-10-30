#!/bin/bash

for target in "$@"
do
    php ./bin/console provider:clear:interfaces -v Ivoz/$target &&
    php ./bin/console provider:generate:entities:abstract -v Ivoz/$target && \
    php ./bin/console provider:generate:traits -v Ivoz/$target && \
    php ./bin/console provider:generate:entities -v Ivoz/$target && \
    php ./bin/console provider:generate:interfaces -v Ivoz/$target && \
    php ./bin/console provider:generate:dtos -v Ivoz/$target
done

pushd /opt/irontec/ivozprovider
    php web/rest/bin/console cache:clear -e dev
    php web/rest/bin/console cache:clear -e prod
popd