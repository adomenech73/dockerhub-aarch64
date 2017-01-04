#!/usr/bin/env bash

if [ -n "${SOCKET}" ]; then
  export SOCKET__DEFAULT__="${SOCKET}"
fi

for var in ${!SOCKET_*}; do
  value="${!var}"
  echo "input(type=\"imuxsock\" Socket=\"${value}\")" >> /etc/rsyslog.d/extra-sockets.conf
done

exec "${@}"
