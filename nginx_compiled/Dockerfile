FROM debian:jessie
#RUN  echo 'Acquire::http { Proxy "http://aptcacherng:3142"; };' >> /etc/apt/apt.conf.d/01proxy

# Set environment. 
ENV \ 
	NPS_VERSION=1.9.32.10 \
	NGINX_VERSION=1.8.0 \
	DEBIAN_FRONTEND=noninteractive \ 
	TERM=xterm-color

# Install dependency packages. 
RUN echo "deb-src http://ftp.de.debian.org/debian/ jessie main contrib non-free" >> /etc/apt/sources.list && \
	echo "deb-src http://security.debian.org/ jessie/updates main contrib non-free" >> /etc/apt/sources.list && \
	apt-get update && \
	apt-get -y install build-essential wget curl libcurl4-openssl-dev zlib1g-dev \
	libldap2-dev libossp-uuid-dev libssl-dev libpcre3 libpcre3-dev && \
	apt-get build-dep -y nginx && \
	apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
	cd ~ && \
	wget https://github.com/pagespeed/ngx_pagespeed/archive/release-${NPS_VERSION}-beta.tar.gz && \
	tar -xvf release-${NPS_VERSION}-beta.tar.gz && \
	cd ngx_pagespeed-release-${NPS_VERSION}-beta/ && \
	wget https://dl.google.com/dl/page-speed/psol/${NPS_VERSION}.tar.gz && \
	tar -xzf ${NPS_VERSION}.tar.gz && \
	cd ~ && \
	wget http://nginx.org/download/nginx-${NGINX_VERSION}.tar.gz && \
	tar -xvf nginx-${NGINX_VERSION}.tar.gz && \
	cd nginx-${NGINX_VERSION}/ && \
	./configure --with-http_ssl_module --add-module=$HOME/ngx_pagespeed-release-${NPS_VERSION}-beta && \
	make && \
	make install && \
	ln -s /usr/local/nginx/sbin/nginx /usr/local/sbin && \
	cd ~ && \
	rm -rf nginx-${NGINX_VERSION} && \
	rm -rf ngx_pagespeed-release-${NPS_VERSION}-beta

# Clean up APT when done.
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
ADD /nginx.conf /usr/local/nginx/conf/nginx.conf
ADD /blog.albert.es.crt /etc/nginx/blog.albert.es.crt
ADD /blog.albert.es.key /etc/nginx/blog.albert.es.key
RUN chmod 400 /etc/nginx/blog.albert.es.key && \
	chmod 644 /etc/nginx/blog.albert.es.crt && \
	chown root:staff /usr/local/nginx/conf/nginx.conf && \
	chmod 644 /usr/local/nginx/conf/nginx.conf && \
	ln -sf /usr/local/nginx/logs /var/log/nginx
	#ln -sf /dev/stdout /usr/local/nginx/logs/access.log && \
	#ln -sf /dev/stderr /usr/local/nginx/logs/error.log

#VOLUME ["/usr/local/nginx/conf","/usr/local/nginx/logs", "/usr/local/nginx/html"]
WORKDIR "/usr/local/nginx"

EXPOSE 80 443

#CMD ["/bin/bash"]
ENTRYPOINT ["nginx", "-g", "daemon off;"]
