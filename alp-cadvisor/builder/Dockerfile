#FROM 192.168.1.102/library/aarch64-alpine:edge
FROM aarch64/alpine:edge
MAINTAINER Albert Domenech <adomenech@gmail.com>

RUN apk add --no-cache ca-certificates

ENV GOPATH /go
ENV PATH $GOPATH/bin:/usr/local/go/bin:$PATH
ENV PATH $PATH:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin

RUN apk update && apk add linux-headers curl bash gcc musl-dev openssl go git

RUN mkdir -p "$GOPATH/src" "$GOPATH/bin" "$GOPATH/out"

WORKDIR $GOPATH
VOLUME $GOPATH/out


COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
#CMD ["/bin/sh"]

