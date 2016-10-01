#
# Build: docker build -t mongodb .
# Run: docker run -d -p 27017:27017 --name mongodb_box mongodb
#
FROM aarch64/ubuntu:xenial
#RUN  echo 'Acquire::http { Proxy "http://104.155.93.110:3142"; };' >> /etc/apt/apt.conf.d/01proxy
MAINTAINER Albert Domenech (adomenech@gmail.com)
ENV \
	DEBIAN_FRONTEND=noninteractive \ 
	TERM=xterm-color
# ...put your own build instructions here...
RUN \
	#apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 7F0CEB10 && \
	#echo "deb http://repo.mongodb.org/apt/debian wheezy/mongodb-org/3.0 main" | tee /etc/apt/sources.list.d \
	#| tee /etc/apt/sources.list.d/mongodb-org-3.0.list && \
	apt-get update && \
	apt-get install -y mongodb && \
	apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
	mkdir /data && mkdir /data/db && \
	chown mongodb:mongodb /data/db

USER mongodb

EXPOSE 27017


ENTRYPOINT ["/usr/bin/mongod"]
