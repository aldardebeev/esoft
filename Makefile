.PHONY: start
start:
	cd .deploy/local && docker compose build && docker compose up -d && docker compose exec app php artisan migrate && docker compose exec app php artisan passport:install && docker compose exec app php artisan db:seed

.PHONY: create_admin
create_admin:
	cd .deploy/local && docker compose exec app php artisan create_admin $(email)

