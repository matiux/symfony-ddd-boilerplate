#Ambiente LEMP per applicazioni PHP standard

##Cambio ENV da DEV a PROD (Simulazione)

#### Purge all

docker rm $(docker ps -a -q) && docker rmi $(docker images -q)

#### Spin down any running containers
```
./dc down
```

#### Rebuild the image to suck in latest `start-container` file
```
./dc build
```

#### Turn on containers, let it use the default "local" environment - xdebug is enabled!
```
./dc up -d
./dc exec app php --info | grep remote_enable
```

#### Spin containers down
```
./dc down
```

#### Check that xdebug is not present/enabled when APP_ENV is set to "production"
```
APP_ENV=production ./develop up -d
./dc exec app php --info | grep remote_enable
```

#TODO
* Controllarer l'orario del container php
* Testare memcached con php