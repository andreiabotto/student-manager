## Student manager

This project is a basic web application designed to demonstrate the implementation of CRUD (Create, Read, Update, Delete) operations for a "Student" table. The application is built using PHP, HTML, CSS, and JavaScript, providing a simple and intuitive interface for managing student data.

### Technologies Used
 - Backend: PHP (Laravel)
 - Database: MySQL (or any SQL-based database)

## Installation

1. Initiate de environment 

```dockerfile
docker-compose up -d --build
```

2. Install de packages 

```dockerfile
docker-compose exec app composer install
```

```dockerfile
docker-compose exec app npm install && npm run prod
```

3. Generate key

```dockerfile
docker-compose exec app php artisan key:generate
```

4. Create database

```dockerfile
docker-compose exec app php artisan migrate
```
```dockerfile
docker-compose exec app php artisan db:seed  
```

5. Generate the documentation swagger 

```dockerfile
docker-compose exec app php artisan l5-swagger:generate
```

6. Access the page

```http
GET http://localhost:8000
```
