#
# aarch64 Redis Dockerfile
# https://github.com/adomenech73/dockerhub-aarch64/redis
#

# FROM 192.168.1.102/library/aarch64-debian:jessie
FROM aarch64/debian:jessie
MAINTAINER Albert Domenech <adomenech@gmail.com>

ENV \
  DEBIAN_FRONTEND=noninteractive \ 
  TERM=xterm-color
# Install Redis.
ADD http://download.redis.io/redis-stable.tar.gz /tmp/redis-stable.tar.gz
RUN \
  apt-get update && \
  apt-get install -y  --no-install-recommends wget build-essential && \
  apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
  cd /tmp && \
  wget http://download.redis.io/redis-stable.tar.gz && \
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
  sed -i 's/^\(logfile .*\)$/# \1/' /etc/redis/redis.conf && \
  rm -rf /tmp/*

# Define mountable directories.
VOLUME ["/data"]

# Define working directory.
WORKDIR /data

# Define default command.
CMD ["redis-server", "/etc/redis/redis.conf"]

# Expose ports.
EXPOSE 6379