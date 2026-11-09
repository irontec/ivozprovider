#!/bin/bash

set -xe

cd $(dirname $(realpath $0))/..

go mod download && go mod verify

unformatted=$(gofmt -l .)
if [ -n "$unformatted" ]; then
    echo "Some files have incorrect format:"
    echo "$unformatted"
    exit 1
fi

go vet ./...
go test ./...
