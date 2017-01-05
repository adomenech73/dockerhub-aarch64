#FROM 192.168.1.102/library/aarch64-alpine:edge
aarch64/alpine:edge
MAINTAINER Albert Domenech <adomenech@gmail.com>

RUN apk --no-cache add ca-certificates device-mapper && \
    apk --no-cache add zfs --repository http://dl-3.alpinelinux.org/alpine/edge/main/ && \
    echo 'hosts: files mdns4_minimal [NOTFOUND=return] dns mdns4' >> /etc/nsswitch.conf && \
    rm -rf /var/cache/apk/*

# Grab cadvisor from the staging directory.
ADD cadvisor /usr/bin/cadvisor

EXPOSE 8080
ENTRYPOINT ["/usr/bin/cadvisor", "-logtostderr"]
