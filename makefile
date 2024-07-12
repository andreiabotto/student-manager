# Define the default goal
.DEFAULT_GOAL := up

# Command to bring up Docker containers
up:
	@echo "Starting Docker containers..."
	docker-compose up -d --build

# Command to stop Docker containers
down:
	@echo "Stopping Docker containers..."
	docker-compose down

# Command to restart Docker containers
restart: down up

# Command to run migrations
migrate:
	@echo "Running migrations..."
	docker-compose exec app php artisan migrate

# Command to seed the database
seed:
	@echo "Seeding database..."
	docker-compose exec app php artisan db:seed

# Command to install Composer dependencies
composer-install:
	@echo "Installing Composer dependencies..."
	docker-compose exec app composer install

# Command to clear Laravel cache
cache-clear:
	@echo "Clearing Laravel cache..."
	docker-compose exec app php artisan cache:clear

# Command to clear and regenerate configuration cache
config-cache:
	@echo "Regenerating config cache..."
	docker-compose exec app php artisan config:cache
