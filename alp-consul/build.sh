#!/bin/bash

set -e

cd builder && docker build -t consul-builder . \
&& docker run --name consul-builder-box -ti -v $(pwd):/go/out consul-builder \
&& sudo chown $USER:$USER $(pwd)/consul


docker rm -f consul-builder-box
mv $(pwd)/consul ../
#docker rmi -f consul-builder
