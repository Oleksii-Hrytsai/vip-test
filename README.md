git clone git@github.com:Oleksii-Hrytsai/vip-test.git

cd vip-test

cp .env .env.test

docker-compose up -d --build

docker-compose exec php-fpm bash

1. bin/console doctrine:database:create

2. bin/console doctrine:migrations:migrate

3. bin/console doctrine:fixtures:load

<h4>http://localhost:8080/</h4>

