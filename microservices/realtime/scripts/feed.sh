#!/bin/bash
set -e
pushd /opt/irontec/ivozprovider/microservices/realtime
    go run cmd/cli/main.go
popd
