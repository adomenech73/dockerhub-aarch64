To build the image using:

$ docker build -t eg_apt_cacher_ng .

Then run it, mapping the exposed port to one on the host

$ docker run -d -p 3142:3142 --name test_apt_cacher_ng eg_apt_cacher_ng

To see the logfiles that are tailed in the default command, you can use:

$ docker logs -f test_apt_cacher_ng

To get your Debian-based containers to use the proxy, you can do one of three things

    Add an apt Proxy setting echo 'Acquire::http { Proxy "http://dockerhost:3142"; };' >> /etc/apt/conf.d/01proxy
    Set an environment variable: http_proxy=http://dockerhost:3142/
    Change your sources.list entries to start with http://dockerhost:3142/

Option 1 injects the settings safely into your apt configuration in a local version of a common base:

FROM ubuntu
RUN  echo 'Acquire::http { Proxy "http://dockerhost:3142"; };' >> /etc/apt/apt.conf.d/01proxy
RUN apt-get update && apt-get install -y vim git

# docker build -t my_ubuntu .

Option 2 is good for testing, but will break other HTTP clients which obey http_proxy, such as curl, wget and others:

$ docker run --rm -t -i -e http_proxy=http://dockerhost:3142/ debian bash

Option 3 is the least portable, but there will be times when you might need to do it and you can do it from your Dockerfile too.

Apt-cacher-ng has some tools that allow you to manage the repository, and they can be used by leveraging the VOLUME instruction, and the image we built to run the service:

$ docker run --rm -t -i --volumes-from test_apt_cacher_ng eg_apt_cacher_ng bash

$$ /usr/lib/apt-cacher-ng/distkill.pl
Scanning /var/cache/apt-cacher-ng, please wait...
Found distributions:
bla, taggedcount: 0
     1. precise-security (36 index files)
     2. wheezy (25 index files)
     3. precise-updates (36 index files)
     4. precise (36 index files)
     5. wheezy-updates (18 index files)

Found architectures:
     6. amd64 (36 index files)
     7. i386 (24 index files)

WARNING: The removal action may wipe out whole directories containing
         index files. Select d to see detailed list.

(Number nn: tag distribution or architecture nn; 0: exit; d: show details; r: remove tagged; q: quit): q

Finally, clean up after your test by stopping and removing the container, and then removing the image.

$ docker stop test_apt_cacher_ng
$ docker rm test_apt_cacher_ng
$ docker rmi eg_apt_cacher_ng

On this page:

    Dockerizing an apt-cacher-ng service

