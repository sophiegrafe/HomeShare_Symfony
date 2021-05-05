# HomeShare_Symfony

This site is a project that I work on to learn and practice the basics of Symfony 5.

I will build a site allowing properties's owners to share their house or appartment, for holidays, weekend, or else.

In order to focus on the technical part of the project, I will follow the specifications sheet provided in an other course. 

## Environement de développement

### Pré-requis

* PHP 7.4
* Composer
* Symfony CLI
* npm
  
Vous pouvez vérifier les prérequis avec la commande suivante (de la CLI Symfony)

```bash
symfony check:requirements
```
### Lancer l'environement de développement

```bash

composer install
symfony console doctrine:database:create
symfony console make:migration
symfony console doctrine:migration:migrate
symfony console doctrine:fixtures:load
symfony server:start

```
 
## Lancer les tests

```bash
php bin/phpunit --testdox
```