#!/bin/bash

set -e

# Compile consul
cd consul-builder
docker build -t consul-builder . 
docker run --name consul-builder-box -ti -v $(pwd):/go/out consul-builder 
sudo chown $USER:$USER $(pwd)/consul
docker rm -f consul-builder-box
mv $(pwd)/consul ../
#docker rmi -f consul-builder


# Compile dumb-init
cd ../dumb-init-builder
docker build -t dumb-init-builder .
docker run --name dumb-init-builder-box -ti -v $(pwd):/out dumb-init-builder
sudo chown $USER:$USER $(pwd)/dumb-init
docker rm -f dumb-init-builder-box
mv $(pwd)/dumb-init ../
#docker rmi -f dumb-init-builder


# Build consul images
cd ..
#sed -i 's/^#CMD ["agent, "-dev", "-client"/CMD ["agent, "-dev", "-client"/' Dockerfile
docker build -t consul-aarch64 .
#sed -i 's/^CMD ["agent, "-dev", "-client"/#CMD ["agent, "-dev", "-client"/' Dockerfile
#sed -i 's/^#CMD ["agent, "-dev", "-server"/CMD ["agent, "-dev", "-server"/' Dockerfile
#docker build --no-cache -t consul-server-aarch64 .
#sed -i 's/^CMD ["agent, "-dev", "-server"/#CMD ["agent, "-dev", "-server"/' Dockerfile

