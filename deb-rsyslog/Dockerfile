#
# Build: docker build -t rsyslog .
# Run: docker run -d -p 514:514/udp --name rsyslog_box rsyslog
#

# FROM 192.168.1.102/library/aarch64-debian:jessie
FROM aarch64/debian:jessie
MAINTAINER Albert Domenech <adomenech@gmail.com>
ENV \
	DEBIAN_FRONTEND=noninteractive \ 
	TERM=xterm-color
#RUN echo "deb http://us.archive.ubuntu.com/ubuntu/ precise main universe" >> /etc/apt/source.list
RUN apt-get update && \
    apt-get -y install rsyslog && \
	apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
#ADD logentries.conf /etc/rsyslog.d/logentries.conf
ADD rsyslog.conf /etc/rsyslog.conf

EXPOSE 514 514/udp

CMD ["/usr/sbin/rsyslogd", "-n"]
