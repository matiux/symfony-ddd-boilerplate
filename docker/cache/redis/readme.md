#Entrare nel container

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
