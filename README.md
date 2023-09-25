# AskNicely Engineer Test

## Requirements

- NodeJs >= `18.x`
- Npm >= `8.x`

## Run the backend

- Rename `~/.env.example` to `.env`
- Run `docker-compose up -d`
- Go inside the container `docker exec -it app bash`
- Once inside the container, run `composer install`
- Exit the app container, type `exit`

## Seed DATABASE schema

- It is important that the docker containers are running. Run `docker ps` to check
- If database is running, run the database migration with `docker exec -it database bash`
- Once inside the database container, run `psql -h localhost -d homestead -U postgres -f employees.sql`
- Exit the DB container, type `exit`

## Run the frontend

- Go to `~/frontend`
- Install libraries, run `npm install`
- Run `npm run dev`
- Go to [http://127.0.0.1:5173/](http://127.0.0.1:5173/)

## Run unit test
- Go inside the container `docker exec -it app bash`
- Run unit test with `composer test`

## Suggestion
- With unlimited time, the database connection can be abstracted more into its own configurations
- Add ability to create migration files like the famous PHP frameworks
- Process the data inside a controller instead of directly in the route file inside anonymous function

## Notes
- Used [Simple PHP Router](https://github.com/skipperbent/simple-php-router) for handling routing
- Used [Rakit Validation](https://github.com/rakit/validation) for validation of post data