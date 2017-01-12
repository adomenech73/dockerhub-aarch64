#!/bin/bash

set -e


cd /dumb-init
make

cp dumb-init /out
