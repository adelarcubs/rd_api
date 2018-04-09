# API

This is the API design to receive track and registration for RD test.

## Run local

Just a couple of commands. Running this commands the api application will be on localhost:8888

```
docker-compose up -d --build
docker-compose run api ./vendor/bin/doctrine orm:schema-tool:update --force
```

### Enable development mode

```
composer development-enable
```

## Testing

Executing unit tests

```
composer test
```