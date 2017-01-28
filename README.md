# Docker + Lumen with Nginx and MySQL

### Configuration

To change configuration values, look in the `docker-compose.yml` file and change the `php` container's environment variables. These directly correlate to the Lumen environment variables.

### Build & Run

```bash
docker-compose up --build -d
```
### Start Database Migration

First, check the Docker Container ID for the image `taskmanager_php` in your terminal with the following command:

```bash
docker ps
```
Copy the container ID and then enter to the container environment by typing:

```bash
docker exec -it `CONTAINER_ID` /bin/bash
```

If everything was successfull, you'll be redirected to an interactive console inside the php container.
Finally, to make the migration, use:

```bash
php artisan migrate
```

### Apply seeds to Database

To apply the default seeds set in the project, inside the php container (see `Start Database Migration`), type the following command:

```bash
php artisan db:seed
```

### Access to MySQL database container

If you want to access to mysql database, follow the steps in section `Start Databse Migration`, but this time
look for the container ID of the image `mysql`. After entering to the interactive console, you'll be able to
execute `mysql` tradional commands.

### Stop Everything

```bash
docker-compose down
```
