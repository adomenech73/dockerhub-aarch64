# alp-registrator

gliderlabs/registrator aarch64 docker container based on local compilation binary

## Compile

The binary is statically linked and created on a Ubuntu aarch64 development node and copied directly to Alpine docker image

```Bash
sudo apt-get install mercurial

mkdir $GOPATH/src/github.com/gliderlabs
cd $GOPATH/src/github.com/gliderlabs
git clone https://github.com/gliderlabs/registrator
cd registrator
go get
go build \
  -ldflags "-X main.Version=v7" \
  -ldflags '-extldflags "-static"' \
  -o $GOPATH/bin/registrator

file $GOPATH/bin/registrator
  
cd $GOPATH/bin

sha256sum registrator > registrator.sha256sum
md5sum registrator > registrator.md5sum

```

## Launch

- As container

```Bash
docker run -d \
    --name=registrator \
    --net=host \
    --volume=/var/run/docker.sock:/tmp/docker.sock \
    adomenech73/aarch64-registrator:latest \
      consul://$(docker-image ip pine64-1):8501

docker run -d \
    --name=registrator \
    --net=host \
    --volume=/var/run/docker.sock:/tmp/docker.sock \
    192.168.1.102/apps/aarch64-registrator:latest \
      consul://$(docker-image ip pine64-1):8501      
```

- As service

```Bash
docker $(docker-machine config pine64-1) service create \
    --name registrator \
    --network consul-net \
    --mode global \
    --mount type=bind,src=/var/run/docker.sock,dst=/var/run/docker.sock \
    192.168.1.102/apps/aarch64-registrator:latest consul://192.168.1.145:8501
```