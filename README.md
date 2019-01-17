# Lumen API Boilerplate

Lumen REST API boilerplate using clean architecture.

## Getting Started

### Prerequisites

* install [Docker for MAC](https://store.docker.com/editions/community/docker-ce-desktop-mac)
* install [docker-sync](https://github.com/EugenMayer/docker-sync/wiki)

    ```
    $ gem install docker-sync
    $ brew install fswatch
    $ brew install unison
    ```

### Usage

Run a docker container sync with host.
`≈ docker-sync && docker-compose -f docker-compose.yml -f docker-compose-dev.yml`

```
docker-sync-stack start
```

Get an interactive prompt.

```
docker-compose exec app /bin/sh
```

Install dependency packages.

```
composer install
```

Create DB table.

```
php artisan migrate
```

Create .env file.

```
cp .env.sample .env
cp .env.testing.sample .env.testing
```

Send Request to `curl http://localhost/health-checks`.

```
curl http://localhost/health-checks
healthy
```

You can also Test.

```
composer test
```

### Remove

Stop running conteriners and remove docker images.

```
docker-compose down --rmi all
```

Remove volume saves DB data.

```
docker volume rm [volume name]
```
