# TinyHome_Symfony

## Dev env

### require

* PHP 7.4
* Composer
* Symfony CLI
* npm
  

### check requirements
```bash
symfony check:requirements
```

## launch the app

```bash
composer install
symfony console doctrine:database:create
symfony console make:migration
symfony console doctrine:migration:migrate
symfony console doctrine:fixtures:load
symfony server:start
```
 
## launch the tests

```bash
php bin/phpunit --testdox
```

## check test coverage

```bash
XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-html var/log/test/test-coverage
```

## trello board

```bash
https://trello.com/b/gubdwCZp/projet-perso-symfo
```
