#
# aarch64 Redis Dockerfile
# https://github.com/adomenech73/dockerhub-aarch64/redis
#

# Pull base image.
FROM aarch64/debian:jessie

ENV \
  DEBIAN_FRONTEND=noninteractive \ 
  TERM=xterm-color
# Install Redis.
#RUN \
#  apt-get update && apt-get install -y curl && \
#  apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
ADD http://download.redis.io/redis-stable.tar.gz /tmp/redis-stable.tar.gz
RUN \
  cd /tmp && \
  curl -O http://download.redis.io/redis-stable.tar.gz && \
  tar xvzf redis-stable.tar.gz && \  
  cd redis-stable && \
  make && \
  make install && \
  cp -f src/redis-sentinel /usr/local/bin && \
  mkdir -p /etc/redis && \
  cp -f *.conf /etc/redis && \
  rm -rf /tmp/redis-stable* && \
  sed -i 's/^\(bind .*\)$/# \1/' /etc/redis/redis.conf && \
  sed -i 's/^\(daemonize .*\)$/# \1/' /etc/redis/redis.conf && \
  sed -i 's/^\(dir .*\)$/# \1\ndir \/data/' /etc/redis/redis.conf && \
  sed -i 's/^\(logfile .*\)$/# \1/' /etc/redis/redis.conf

# Define mountable directories.
VOLUME ["/data"]

# Define working directory.
WORKDIR /data

# Define default command.
CMD ["redis-server", "/etc/redis/redis.conf"]

# Expose ports.
EXPOSE 6379