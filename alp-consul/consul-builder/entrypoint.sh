#!/bin/bash

set -e


cd $GOPATH/src/github.com/hashicorp/consul \
&& XC_ARCH=arm64 XC_OS=linux make

cp bin/consul $GOPATH/out
