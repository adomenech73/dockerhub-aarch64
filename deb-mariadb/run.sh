#!/bin/bash
set -e

if [ "$(id -u)" != "0" ]; then
   echo "This script must be run as root" 1>&2
   exit 1
fi

NAME=mariadb

if docker inspect -f "{{ .Name }}" $NAME | grep -q '/'$NAME''; then
	echo "Restarting $NAME"
	docker restart $NAME
else
	echo "Starting $NAME"
	docker run \
		--env-file=__private_vars.env \
		--volumes-from=data-mariadb \
		--volume=/etc/timezone:/etc/timezone:ro \
		--publish=0.0.0.0:3306:3306 \
		--name mariadb \
		--restart=always \
		--detach=true \
		bremme/mariadb $@
fi