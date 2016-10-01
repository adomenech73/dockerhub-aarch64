FROM aarch64/debian:jessie
MAINTAINER Albert Domenech (adomenech@gmail.com)
ENV \
	DEBIAN_FRONTEND=noninteractive \ 
	TERM=xterm-color \
	NVM_DIR=/usr/local/nvm \
	NVM_VERSION=0.32.0 \
	NODE_VERSION=4.5.0

# Replace shell with bash so we can source files
RUN apt-get update && \
	apt-get install -y -q --no-install-recommends \
		curl supervisor ca-certificates && \
	apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
	mkdir -p /var/log/supervisor

RUN	rm /bin/sh && ln -s /bin/bash /bin/sh

RUN	curl -o- https://raw.githubusercontent.com/creationix/nvm/v$NVM_VERSION/install.sh | bash && \
	source $NVM_DIR/nvm.sh && \
	nvm install $NODE_VERSION && \
	nvm alias default $NODE_VERSION
#RUN	nvm use defaul

ENV NODE_PATH=$NVM_DIR/versions/node/v$NODE_VERSION/lib/node_modules \
	PATH=$NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH


# copy supervisor conf
ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf
ADD package.json /srv/package.json

# Copy App
ADD app/ /srv

#USER daemon
EXPOSE 3000

# start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf", "-n"]

#  python python-meld3 python-pkg-resources python-pip
