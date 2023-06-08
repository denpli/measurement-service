build:
	docker-compose build
up:
	docker-compose up -d
down:
	docker-compose down
bash-app:
	docker exec -it measurement-service-app-1 /bin/sh
bash-db:
	docker exec -it measurement-service-postgres-1 /bin/sh
init:
	docker exec measurement-service-app-1 composer install
	docker exec measurement-service-app-1 php migration.php