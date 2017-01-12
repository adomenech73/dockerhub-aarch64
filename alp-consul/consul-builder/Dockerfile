#FROM 192.168.1.102/library/aarch64-alpine:edge
FROM aarch64/alpine:edge
MAINTAINER Albert Domenech <adomenech@gmail.com>

RUN apk add --no-cache ca-certificates

ENV GOPATH /go
ENV PATH $GOPATH/bin:/usr/local/go/bin:$PATH
ENV PATH $PATH:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin

WORKDIR $GOPATH

RUN apk update && apk add linux-headers \
						  bash gcc musl-dev openssl \
						  go git make zip \
	&& mkdir -p $GOPATH/src/github.com/hashicorp \
	&& cd $GOPATH/src/github.com/hashicorp \
	&& git clone https://github.com/hashicorp/consul

VOLUME $GOPATH/out


COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
#CMD ["/bin/bash"]
