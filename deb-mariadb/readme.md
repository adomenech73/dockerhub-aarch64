docker build -t adomenech73/mariadb .
docker run -d -p 3306:3306 -e MYSQL_ROOT_PASSWORD="changeme" adomenech73/mariadb
