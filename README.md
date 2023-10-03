docker-compose up -d

docker-compose exec -T db mysql -u MYSQL_USER -pMYSQL_PASSWORD MY_DATABASE < database/schema.sql 