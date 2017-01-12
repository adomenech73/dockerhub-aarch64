#FROM 192.168.1.102/library/aarch64-alpine:edge
FROM aarch64/alpine:edge
MAINTAINER Albert Domenech <adomenech@gmail.com>

RUN apk add --no-cache ca-certificates

ENV GOPATH /go
ENV PATH $GOPATH/bin:/usr/local/go/bin:$PATH
ENV PATH $PATH:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin

WORKDIR $GOPATH

RUN apk update && apk add linux-headers curl bash gcc musl-dev openssl \
							go bison ruby ruby-dev ruby-rdoc ruby-irb libffi-dev \
							asciidoc rpm git make \
	&& mkdir -p "$GOPATH/src" "$GOPATH/bin" "$GOPATH/out" \
	&& gem install fpm \
	&& go get github.com/sparrc/gdm \
	&& go get github.com/influxdata/influxdb \
	&& cd $GOPATH/src/github.com/influxdata/influxdb \
	&& gdm restore

VOLUME $GOPATH/out


COPY entrypoint.sh /entrypoint.sh
#ENTRYPOINT ["/entrypoint.sh"]
CMD ["/bin/bash"]

