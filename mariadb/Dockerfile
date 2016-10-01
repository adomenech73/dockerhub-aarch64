#
# Build: docker build -t mariadb .
# Run: docker run -d -p 3306:3306 --name mariadb_box mariadb
#
FROM aarch64/debian:jessie
MAINTAINER Albert Domenech (adomenech@gmail.com)
#RUN  echo 'Acquire::http { Proxy "http://192.168.1.145:3142"; };' >> /etc/apt/apt.conf.d/01proxy
ENV \
	DEBIAN_FRONTEND=noninteractive \ 
	TERM=xterm-color
# install mariadb
RUN apt-get update && \
  #apt-key adv --recv-keys --keyserver keyserver.ubuntu.com 0xcbcb082a1bb943db && \
  #echo "deb http://mariadb.mirror.triple-it.nl//repo/10.0/debian wheezy main" >> /etc/apt/sources.list && \
  #echo "deb-src http://mariadb.mirror.triple-it.nl//repo/10.0/debian wheezy main" >> /etc/apt/sources.list && \
  #apt-get update && \
  apt-get install -y mariadb-server && \
  apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# adding files
COPY /my.cnf                         /etc/mysql/my.cnf
RUN chmod 644 /etc/mysql/my.cnf
COPY /bootstrap.sh                   /usr/local/bin/bootstrap.sh
COPY /create_mariadb_admin_user.sh   /usr/local/bin/create_mariadb_admin_user.sh
RUN chmod +x /usr/local/bin/*

# configuration options
ENV MYSQL_BIND_ADDRESS 0.0.0.0
ENV MYSQL_PORT 3306
# only applies when /var/lib/mysql/mysql is empty
ENV MYSQL_ADMIN_PASS password
ENV MYSQL_ADMIN_USER admin
ENV MYSQL_ADMIN_HOST %

# Add volumes
VOLUME  ["/etc/mysql", "/var/lib/mysql"]

# Expose ports
EXPOSE 3306

# Run bootstrap
CMD ["/usr/local/bin/bootstrap.sh"]