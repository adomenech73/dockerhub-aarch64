#FROM 192.168.1.102/library/aarch64-alpine:edge
FROM aarch64/alpine:edge
MAINTAINER Albert Domenech <adomenech@gmail.com>

RUN apk add --no-cache ca-certificates

ENV PATH $PATH:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin


RUN apk update && apk add bash gcc musl-dev openssl git make zip \
	&& git clone https://github.com/Yelp/dumb-init \
	&& mkdir out

VOLUME /out


COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
#CMD ["/bin/bash"]
