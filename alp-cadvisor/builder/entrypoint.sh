#!/bin/bash

set -e

git clone --depth 1 https://github.com/google/cadvisor.git
cd cadvisor
go get github.com/tools/godep
go get -d github.com/google/cadvisor
godep go build --ldflags '-extldflags "-static"' github.com/google/cadvisor

cp cadvisor $GOPATH/out
