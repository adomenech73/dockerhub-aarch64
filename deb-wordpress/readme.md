docker build -t adomenech73/wordpress .
# with linked container
docker run --name some-wordpress --link some-mysql:mysql -p 8080:80 -d wordpress
# with external legacy database
docker run --name some-wordpress -e WORDPRESS_DB_HOST=10.1.2.3:3306 \
    -e WORDPRESS_DB_USER=... -e WORDPRESS_DB_PASSWORD=... -d wordpress