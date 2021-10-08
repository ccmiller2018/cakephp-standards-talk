# &#127856; CakePHP Docker

## Usage

After install browse to [http://localhost:8080](http://localhost:8080) to see the CakePHP welcome page.

A [Makefile](Makefile) is provided with some optional commands for your convenience. Please review the Makefile as
these commands are not exact aliases of docker-compose commands.

| Make Command              | Description       |
| -----------               | -----------       |
| `make`                    | Shows all make target commands |
| `make init`               | Runs docker build, docker-compose up, and copies over env files |
| `make init.nocache`       | Same as make.init but builds with --no-cache |
| `make start`              | Starts services `docker-compose -f .docker/docker-compose.yml start` |
| `make stop`               | Stops services `docker-compose -f .docker/docker-compose.yml stop` |
| `make up`                 | Create and start containers `docker-compose -f .docker/docker-compose.yml up -d` |
| `make down`               | Take down and remove all containers `docker-compose -f .docker/docker-compose.yml down` |
| `make restart`            | Restarts services `docker-compose -f .docker/docker-compose.yml restart` |
| `make php.sh`             | PHP terminal `docker exec -it --user cakephp <PHP_CONTAINER> sh` |
| `make php.restart`        | Restarts the PHP container |
| `make db.sh`              | DB terminal `docker exec -it <DB_CONTAINER> sh` |
| `make db.mysql`           | MySQL terminal `mysql -u root -h 0.0.0.0 -p --port 3307` |
| `make web.sh`             | Web terminal `docker exec -it <WEB_CONTAINER> sh` |
| `make xdebug.on`          | Restarts PHP container with xdebug.mode set to debug,coverage |
| `make xdebug.off`         | Restarts PHP container with xdebug.mode set to off |
| `make composer.install`   | `docker exec <PHP_CONTAINER> composer install --no-interaction` |
| `make composer.test`      | `docker exec <PHP_CONTAINER> composer test` |
| `make composer.check`     | `docker exec <PHP_CONTAINER> composer check` |

### PHP

See [.docker/README.md](.docker/README.md) for details.

Shell:

```console
make php.sh
```

Helper commands:

```console
make composer.install
make composer.test
make composer.check
```

### MySQL

See [.docker/README.md](.docker/README.md) for details.

Shell:

```console
make db.sh
```

MySQL shell (requires mysql client on your localhost):

```console
make db.mysql
```

### NGINX

See [.docker/README.md](.docker/README.md) for details.

Shell:

```console
make web.sh
```

### Xdebug

Xdebug is disabled by default. To toggle:

```console
make xdebug.on
make xdebug.off
```

### PHPStorm + Xdebug

Xdebug 3's default port is `9003`.

Go to `File > Settings > Languages & Frameworks > PHP > Servers`

- Name: `localhost`
- Host: `localhost`
- Port: `8080`
- Debugger: `Xdebug`
- Use path mappings: `Enable`

Map your projects app directory to the absolute path on the docker container `/srv/app`
