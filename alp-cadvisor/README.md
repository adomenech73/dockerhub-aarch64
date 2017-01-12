# cadvisor

This is a ~36Mb aarch64 alpine image where is loaded a previously compiled binary for google cadvisor as explained here: [cadvisor build](https://github.com/google/cadvisor/blob/master/docs/development/build.md)

Because the Alpine C library is based in uClibc / musl it can get problems linking the library with dynamic compilation as happens to be with cAdvisor.

The diference between this and the oficial [cadvisor image](https://hub.docker.com/r/google/cadvisor/) is that in this case we don't rely on @sgerrand glibc compatibility layer package, as we don't have offial aarch64 releases, instead we relay on a staticaly compiled binary, that we can produce locally like:

```
export GOPATH=~/src/go
export PATH="$PATH:$GOPATH/bin"

git clone --depth 1 https://github.com/google/cadvisor.git

go get github.com/tools/godep
go get -d github.com/google/cadvisor
# build statically for scratch image
godep go build --ldflags '-extldflags "-static"' github.com/google/cadvisor
```

Or to simplificate we can use ```build.sh``` script:

```
./build.sh
```

After new binary is created it's possible to generate Docker image and execute containers based on it.

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