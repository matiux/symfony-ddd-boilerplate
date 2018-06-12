Boilerplate Symfony con struttura cartelle DDD
========================

Symfony 3.4 con struttuca cartelle per modellare in DDD

## Preparazione ambiente sviluppo
L'applicazione funziona all'interno di un conainer docker. Preparare l'ambiente in questo modo:

#### Clone del progetto
```
git clone git@github.com:matiux/SymfonyDDDBoilerplate.git && cd SymfonyDDDBoilerplate
```

#### Variabili d'ambiente
```
cp env.dist .env
```
#### Build e run dei containers
```
./dc up -d
```
#### Smontare i containers e i volumi
```
./dc down -v
```
Per ulteriori informazioni controllare il readme in `./docker/redme.md`
## Sviluppo

#### Entrare nel container PHP per lo sviluppo
```
./dc exec --user utente php bash
composer install
```
Il container php è configurato per far comunicare Xdebug con PhpStorm

## Accessi

* `localhost:8080` risponde nginx
* `localhost:8081` phpmyadmin
* All'interno del container PHP, il database è raggiungibile con l'host `servicedb` alla porta `3306`
* All'esterno del container, il database è raggiungibile con l'host `127.0.0.1` alla porta `3307`

## Comandi e Aliases all'interno del container PHP

* `test` è un alias a `vendor/bin/phpunit`
* `sf` è un alias a `bin/console` per usare la console di Symfony
* `sfcc` è un alias a `rm -Rf var/cache/*` per svuotare la cache
* `memflush` è un alias a `echo \"flush_all\" | nc servicememcached 11211 -q 1"` per svuotare memcached

## Test
All'interno del container PHP
```
test
test --group integration
test --group unit
```

## Fix permessi Symfony:

Da dentro al container php:

```
./fix-permissions
```
