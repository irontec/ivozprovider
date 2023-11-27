#!/bin/bash

cd $(dirname $(realpath $0))/..

go mod download && go mod verify
go build -v -o server irontec.com/realtime/cmd/server
