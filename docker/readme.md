#Ambiente LEMP per applicazioni PHP standard

#### Pull e push
* Creare il repo su docker hub
* Taggare durante il build: `docker build -t matiux/nginx:latest .`
* Taggare dopo il build: `docker tag df892c128f74  matiux/php7.1-fpm-nginx:latest`
* Pullare l'immagine sul repo: `docker pull matiux/nginx:latest`
* Push: `docker push matiux/php7-fpm-nginx:7.1`

#### Link utili:
*https://docs.docker.com/compose/compose-file/#service-configuration-reference
*https://docs.docker.com/engine/reference/builder/#using-arg-variables

#### Comandi utili
* Collegary a mysql: `mycli -uroot -ppwd -h localhost -P3307`
* Purge all: `docker rm $(docker ps -a -q) && docker rmi $(docker images -q)`
* Spin down any running containers: `./dc down`
* Rebuild the image to suck in latest `start-container` file: `./dc build`
* Turn on containers, let it use the default "local" environment - xdebug is enabled!:
   ```
   ./dc up -d
   ./dc exec app php --info | grep remote_enable
   ```
* Check that xdebug is not present/enabled when APP_ENV is set to "production":
   ```
   APP_ENV=production ./develop up -d
   ./dc exec app php --info | grep remote_enable
   ```

#### Redis

Dato che l'immagine è alpine, non c'è bash. Usare quindi:
```
docker exec -it redis sh
```

Come usarlo nel codice:

```
$client = RedisAdapter::createConnection(
   'redis://redis_db:6379'
);
```


#TODO
* Controllarer l'orario del container php
* Testare memcached con php