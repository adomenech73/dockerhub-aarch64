# cadvisor

This is a 34Mb aarch64 alpine image where is loaded a previously compiled binary for google cadvisor as explained here: [cadvisor build](https://github.com/google/cadvisor/blob/master/docs/development/build.md)

Because the Alpine C library is based in uClibc / musl it can get problems linking the library with dynamic compilation as happens to be with cAdvisor.

The diference between this and the oficial [cadvisor image](https://hub.docker.com/r/google/cadvisor/) is that in this case we don't rely on @sgerrand glibc compatibility layer package, as we don't have offial aarch64 releases, instead we relay on a staticaly compile the binary, that we can produce like:

```
export GOPATH=~/src/go
export PATH="$PATH:$GOPATH/bin"

git clone --depth 1 https://github.com/google/cadvisor.git

go get github.com/tools/godep
go get -d github.com/google/cadvisor
# build statically for scratch image
godep go build --ldflags '-extldflags "-static"' github.com/google/cadvisor
```

To simplificate this compilation I created a new Dockerfile in builder dir and a build.sh script that must be called on a aarch64 system, in my case on a Pine64 board.

```
./build.sh
```

## build image

´´´
docker build -t cadvisor-aarch64 .
´´´
## run image

´´´
docker run \
  --volume=/:/rootfs:ro \
  --volume=/var/run:/var/run:rw \
  --volume=/sys:/sys:ro \
  --volume=/var/lib/docker/:/var/lib/docker:ro \
  --publish=8080:8080 \
  --detach=true \
  --name=cadvisor \
  adomenech73/cadvisor-aarch64
´´´