# TinyHome_Symfony

This website is a project I've worked on to learn and practice the basics of Symfony 5.

It's supposed to allow owners and makers of unusual home space to share with us their choices and ways they live with them daily.

In order to focus on the technical part of the project, I followed the specifications sheet provided in an other course. 

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
