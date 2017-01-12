#!/bin/bash

set -e

cd cadvisor
go get github.com/tools/godep
go get -d github.com/google/cadvisor
godep go build --ldflags '-extldflags "-static"' github.com/google/cadvisor

cp cadvisor $GOPATH/out
