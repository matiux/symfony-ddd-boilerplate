Boilerplate Symfony con struttura cartelle DDD
========================

Symfony 5 con struttura cartelle per modellare in DDD

## Preparazione ambiente sviluppo
L'applicazione funziona all'interno di un container docker. Preparare l'ambiente in questo modo:

#### Clone del progetto
```
git clone git@github.com:matiux/symfony-ddd-boilerplate.git && cd symfony-ddd-boilerplate
cp docker/docker-compose.override.dist.yml docker/docker-compose.override.yml
./dc up -d
```

## Sviluppo

#### Entrare nel container PHP per lo sviluppo
```
./dc enter
composer install
```
Il container php è configurato per far comunicare Xdebug con PhpStorm


## Comandi e Aliases all'interno del container PHP

* `test` è un alias a `./vendor/bin/simple-phpunit`
* `sf` è un alias a `bin/console` per usare la console di Symfony
* `sfcc` è un alias a `rm -Rf var/cache/*` per svuotare la cache
* `memflush` è un alias a `echo \"flush_all\" | nc servicememcached 11211 -q 1"` per svuotare memcached
