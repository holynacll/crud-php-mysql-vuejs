to start app:

 1 - docker-compose up -d

 2 - docker-compose exec -T db mysql -u MYSQL_USER -pMYSQL_PASSWORD MY_DATABASE < app/Database/schema.sql