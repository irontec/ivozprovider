#!/bin/bash

set -e

CACHE_CLEAR=1
VERBOSE_LEVEL="-v"

while getopts ":hvs" OPTCHAR; do
    case "${OPTCHAR}" in
        s)
            CACHE_CLEAR=0
            ;;
        h)
            echo -e "Usage: $0 [-v] [-h] [-s] [Provider|Ast|Kam|Cgr]"
            echo
            echo -e "\t-v\tShow version information"
            echo -e "\t-h\tShow this help"
            echo -e "\t-s\tSkip cache clear after generation"
            echo
            exit
            ;;
        v)
            VERBOSE_LEVEL="${VERBOSE_LEVEL}v"
            ;;
    esac
done

shift $(expr $OPTIND - 1 )

pushd /opt/irontec/ivozprovider/scheme
    while test $# -gt 0; do
        bin/console provider:clear:interfaces ${VERBOSE_LEVEL} Ivoz/$1
        bin/console provider:generate:entities:abstract ${VERBOSE_LEVEL} Ivoz/$1
        bin/console provider:generate:traits ${VERBOSE_LEVEL} Ivoz/$1
        bin/console provider:generate:entities ${VERBOSE_LEVEL} Ivoz/$1 --path ../library/
        bin/console provider:generate:interfaces ${VERBOSE_LEVEL} Ivoz/$1
        bin/console provider:generate:dtos:abstract ${VERBOSE_LEVEL} Ivoz/$1
        bin/console provider:generate:dtos ${VERBOSE_LEVEL} Ivoz/$1
        shift
    done
popd


if [ ${CACHE_CLEAR} -eq 1 ]; then
    pushd /opt/irontec/ivozprovider/web/rest/
        php bin/console cache:clear -e dev
        php bin/console cache:clear -e prod
        php bin/console api:swagger:export -e prod > web/swagger.json
    popd
fi