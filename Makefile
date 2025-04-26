install:
	cp ./backend/.env.example ./backend/.env
	docker run --rm -u "$(id -u):$(id -g)" -v "$(shell pwd)/backend:/var/www/html" -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs
	@make up
	@make backend-setup
	@make frontend-setup
up:
	docker compose up -d
down:
	docker compose down
test:
	./backend/vendor/bin/sail php artisan test
migrate:
	./backend/vendor/bin/sail php artisan migrate
fresh:
	./backend/vendor/bin/sail php artisan migrate:fresh --seed
seed:
	./backend/vendor/bin/sail php artisan db:seed
tinker:
	./backend/vendor/bin/sail php artisan tinker
pint:
	./backend/vendor/bin/pint -v
stan:
	cd backend && ./vendor/bin/phpstan analyse --memory-limit=2G
lint:
	docker compose exec frontend npm run lint
lintfix:
	docker compose exec frontend npm run lint:fix
format:
	docker compose exec frontend npm run format
cache:
	./backend/vendor/bin/sail php artisan config:cache
	./backend/vendor/bin/sail php artisan route:cache
	./backend/vendor/bin/sail php artisan view:cache
	./backend/vendor/bin/sail php artisan event:cache
	./backend/vendor/bin/sail php artisan optimize:clear
route-list:
	./backend/vendor/bin/sail php artisan route:list
backend-setup:
	cp ./backend/.env.example ./backend/.env
	./backend/vendor/bin/sail php artisan key:generate
	./backend/vendor/bin/sail php artisan migrate:fresh --seed
frontend-setup:
	cp ./frontend/.env.local.example ./frontend/.env.local
	cd ./frontend
	npm install
app:
	docker compose exec laravel.test bash