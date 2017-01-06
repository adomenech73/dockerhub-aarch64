#!/bin/bash

set -e

cd builder && docker build -t builder . \
&& docker run --name builder-box -ti -v $(pwd):/go/out builder \
&& sudo chown $USER:$USER $(pwd)/cadvisor


docker rm -f builder-box
mv $(pwd)/cadvisor ../
#docker rmi -f builder
