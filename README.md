# AskNicely Engineer Test

## Requirements

- NodeJs >= `18.x`
- Npm >= `8.x`

## Run the backend

- Rename `~/.env.example` to `.env`
- Run `docker-compose up -d`
- Run compose install `docker exec -it app sh`
- Once inside the container, run `composer install`
- Run unit test, run `composer test`
- Exit the app container, type `exit`

## Seed DATABASE schema

- It is important that the docker containers are running. Run `docker ps` to check
- If database is running, run the database migration with `docker exec -it database sh`
- Once inside the database container, run `psql -h localhost -d homestead -U postgres -f employees.sql`
- Exit the DB container, type `exit`

## Run the frontend

- Go to `~/frontend`
- Install libraries, run `npm install`
- Run `npm run dev`
- Go to [http://127.0.0.1:5173/](http://127.0.0.1:5173/)

## Notes
- Used [Simple PHP Router](https://github.com/skipperbent/simple-php-router) for handling routing
- Used [Rakit Validation](https://github.com/rakit/validation) for validation of post data