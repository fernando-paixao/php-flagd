# Flagd
It's an awesome agnostic open source tool to feature flags.

## Running
Server (of the feature flags) up:
```
$ docker compose up
```
Running the client script:
```
$ composer install
$ php index.php
```
*I didn't put the PHP service on docker-compose.yml but it's a simple PHP 8 with extensions curl, intl and json.

## Further information
Use the playground and get to know of the many applications of this tool (data types, rollout based on timestamp, multi-variant to each fraction of users...):
https://flagd.dev/playground/

This is the PHP main package of the client:
https://flagd.dev/providers/php/