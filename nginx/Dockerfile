FROM aarch64/ubuntu:xenial
#RUN  echo 'Acquire::http { Proxy "http://aptcacherng:3142"; };' >> /etc/apt/apt.conf.d/01proxy

# Set environment. 
ENV \ 
	#NPS_VERSION=1.9.32.10 \
	#NGINX_VERSION=1.8.0 \
	DEBIAN_FRONTEND=noninteractive \ 
	TERM=xterm-color

# Install dependency packages. 
RUN apt-get update && \
	apt-get install nginx && \
	apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD /nginx.conf /usr/local/nginx/conf/nginx.conf
ADD /blog.albert.es.crt /etc/nginx/blog.albert.es.crt
ADD /blog.albert.es.key /etc/nginx/blog.albert.es.key

RUN chmod 400 /etc/nginx/blog.albert.es.key && \
	chmod 644 /etc/nginx/blog.albert.es.crt

#VOLUME ["/usr/local/nginx/conf","/usr/local/nginx/logs", "/usr/local/nginx/html"]

EXPOSE 80 443

#CMD ["/bin/bash"]
ENTRYPOINT ["nginx", "-g", "daemon off;"]
