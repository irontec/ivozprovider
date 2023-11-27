#!/bin/bash

cd $(dirname $(realpath $0))/..

# Format code files
go fmt ./...

# Check there is updated files
if [ -n "$(git status -s | grep .go)" ]; then
    echo "Some files have incorrect format."
    git status -s | grep .go
    exit 1
fi

exit 0
