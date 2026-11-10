#!/bin/bash

cd $(dirname $(realpath $0))/..

# List Go files whose format differs from gofmt (without rewriting them)
UNFORMATTED=$(gofmt -l .)

if [ -n "$UNFORMATTED" ]; then
    echo "Some files have incorrect format (run gofmt -w on them):"
    echo "$UNFORMATTED"
    exit 1
fi

exit 0
