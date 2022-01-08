Boilerplate Symfony con struttura cartelle DDD
========================

Symfony 6 con struttura cartelle per modellare in DDD

## Preparazione ambiente sviluppo
L'applicazione funziona all'interno di un container docker. Preparare l'ambiente in questo modo:

#### Clone del progetto
```
git clone --branch sf6 git@github.com:matiux/symfony-ddd-boilerplate.git && cd symfony-ddd-boilerplate
cp docker/docker-compose.override.dist.yml docker/docker-compose.override.yml
rm -rf .git/hooks && ln -s ../scripts/git-hooks .git/hooks
```

Continuare il setup
```shell
./dc up -d
./dc enter
project setup-test
project setup-dev
```
