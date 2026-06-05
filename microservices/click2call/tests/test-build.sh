#!/bin/bash

set -xe

cd $(dirname $(realpath $0))/..

# Download required dependencies
go mod download && go mod verify

# Build server
go build -v -o originate irontec.com/click2call/cmd/originate

# Vet and unit tests
go vet ./...
go test ./...
