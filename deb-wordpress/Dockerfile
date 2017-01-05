# FROM 192.168.1.102/library/aarch64-debian:jessie
FROM aarch64/debian:jessie
MAINTAINER Albert Domenech <adomenech@gmail.com>

#RUN  echo 'Acquire::http { Proxy "http://aptcacherng:3142"; };' >> /etc/apt/apt.conf.d/01proxy
ENV \
	DEBIAN_FRONTEND=noninteractive \ 
	TERM=xterm-color

RUN apt-get update && \
	apt-get -y upgrade && \
	apt-get -y install mysql-client apache2 \
						libapache2-mod-php5 pwgen python-setuptools python-pip \
						php5-mysql php5-ldap && \
	apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN pip install --index-url=http://pypi.python.org/simple/ supervisor
ADD ./scripts/start.sh /start.sh
ADD ./scripts/foreground.sh /etc/apache2/foreground.sh
ADD ./configs/supervisord.conf /etc/supervisord.conf
ADD ./configs/000-default.conf /etc/apache2/sites-available/000-default.conf

ADD /blog.albert.es.crt /etc/apache2/blog.albert.es.crt
ADD /blog.albert.es.key /etc/apache2/blog.albert.es.key

RUN rm -rf /var/www/
RUN a2enmod ssl

ADD https://wordpress.org/latest.tar.gz /wordpress.tar.gz
RUN tar xvzf /wordpress.tar.gz && \
	mv /wordpress /var/www/ && \
	chmod 755 /start.sh && \
	chmod 755 /etc/apache2/foreground.sh && \
	chown -R www-data:www-data /var/www/ && \
	mkdir /var/log/supervisor/ && \
	rm wordpress.tar.gz

#ADD ./configs/wp-config.php /var/www/wp-config.php
#RUN 

EXPOSE 80 443
CMD ["/bin/bash", "/start.sh"]