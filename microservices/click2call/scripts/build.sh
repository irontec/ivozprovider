#!/bin/bash

cd $(dirname $(realpath $0))/..

go mod download && go mod verify
go build -v -o originate irontec.com/click2call/cmd/originate
