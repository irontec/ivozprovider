#!/bin/bash

for target in "$@"
do
    php ./bin/console provider:generate:entities:abstract Ivoz/$target && \
    php ./bin/console provider:generate:traits Ivoz/$target && \
    php ./bin/console provider:generate:entities Ivoz/$target && \
    php ./bin/console provider:generate:interfaces Ivoz/$target && \
    php ./bin/console provider:generate:dtos Ivoz/$target
done