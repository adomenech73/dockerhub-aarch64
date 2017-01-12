#!/bin/bash

set -e


gem install fpm


git clone --depth 1 https://github.com/influxdata/influxdb.git
cd influxdb
go get github.com/sparrc/gdm
go get github.com/influxdata/influxdb
cd $GOPATH/src/github.com/influxdata/influxdb
gdm restore
python build.py --package

cp influxdb* $GOPATH/out
