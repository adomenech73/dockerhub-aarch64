# FROM 192.168.1.102/library/aarch64-ubuntu:trusty
FROM aarch64/ubuntu:14.04
MAINTAINER Albert Domenech <adomenech@gmail.com>

#RUN  echo 'Acquire::http { Proxy "http://104.155.93.110:3142"; };' >> /etc/apt/apt.conf.d/01proxy
# http://yandextank.readthedocs.org/en/latest/install.html
ENV \
	DEBIAN_FRONTEND=noninteractive \ 
	TERM=xterm-color
# ...put your own build instructions here...
RUN \
	apt-get update && \
	apt-get install -y -q --no-install-recommends software-properties-common python-software-properties && \
	add-apt-repository ppa:yandex-load/main && \
	apt-get update && \
	apt-get install -y -q yandex-load-tank-base phantom phantom-ssl && \
	apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
	mkdir /tank-workdir

ADD sysctl.conf /etc/sysctl.conf
ADD entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]

EXPOSE 8888/tcp


#USER mongodb
#EXPOSE 27017

#ENTRYPOINT ["/usr/bin/mongod"]
