#!/bin/bash

set -e

cd builder && docker build -t cadvisor-builder . \
&& docker run --name cadvisor-builder-box -ti -v $(pwd):/go/out cadvisor-builder \
&& sudo chown $USER:$USER $(pwd)/cadvisor


docker rm -f cadvisor-builder-box
mv $(pwd)/cadvisor ../
#docker rmi -f cadvisor-builder
