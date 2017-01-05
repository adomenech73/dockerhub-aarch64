#FROM 192.168.1.102/library/aarch64-alpine:edge
FROM aarch64/alpine:edge
MAINTAINER Albert Domenech <adomenech@gmail.com>

ENV INFLUXDB_VERSION 1.1.0~f715692
COPY influxdb-${INFLUXDB_VERSION}_linux_amd64.tar.gz /influxdb-${INFLUXDB_VERSION}_linux_amd64.tar.gz
RUN apk add --no-cache --virtual .build-deps wget gnupg tar ca-certificates && \
    update-ca-certificates && \
    mkdir -p /usr/src && \
    tar -C /usr/src -xzf influxdb-${INFLUXDB_VERSION}_linux_amd64.tar.gz && \
    rm -f /usr/src/influxdb-*/influxdb.conf && \
    chmod +x /usr/src/influxdb-*/* && \
    cp -a /usr/src/influxdb-*/* /usr/bin/ && \
    rm -rf *.tar.gz* /usr/src /root/.gnupg && \
    apk del .build-deps
COPY influxdb.conf /etc/influxdb/influxdb.conf

EXPOSE 8083 8086

VOLUME /var/lib/influxdb

COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
#CMD ["influxd"]
