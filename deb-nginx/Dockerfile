FROM aarch64/debian:jessie

ENV \
  DEBIAN_FRONTEND=noninteractive \ 
  TERM=xterm-color

RUN apt-get update && \
	apt-get install -y --no-install-recommends nginx && \
	apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
	rm -v /etc/nginx/nginx.conf

ADD nginx.conf /etc/nginx/	

RUN echo "daemon off;" >> /etc/nginx/nginx.conf

EXPOSE 80

CMD service nginx start