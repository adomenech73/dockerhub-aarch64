FROM 192.168.1.102/library/aarch64-alpine:edge
# FROM aarch64/alpine:edge

COPY registrator /bin/registrator
# COPY registrator.sha256sum /bin/registrator.sha256sum
# COPY registrator.md5sum /bin/registrator.md5sum

# RUN \
#	sha256sum -c /bin/registrator.sha256sum 2>&1 | grep OK && \
#	md5sum -c /bin/registrator.md5sum 2>&1 | grep OK

ENTRYPOINT ["/bin/registrator"]
# CMD ["/bin/ash"]