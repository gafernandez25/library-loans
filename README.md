# Set up the environment

## Containers

1) After cloning the repository you can change container names and ports if you desire in docker-compose.yml file
   located in directory root.

``` sh
    webserver:
    container_name: library-loans-nginx
    restart: on-failure
    image: 'nginx:alpine'
    ports:
      - "8000:80"
```

> Take in consideration that command examples in this file are based in the parameter values from the original docker
> compose file. If some of them are modified adjust the commands.

There is no need to change anything else in Dockerfile and other docker config files.

2) Once configured docker compose you can create the images and containers.

``` sh
docker-compose up -d
```

## Source code

1) Once containers are created enter to php-fpm container as root user. It's recommended to execute every cli commands
   from
   inside the container.

``` sh
docker exec -ti library-loans-php-fpm bash
```

2) Once inside the container you must execute the following commands to set up everything related to the code itself (
   dependencies, permissiones, etc.).

``` sh
make clone-post-actions
```

> If you didn't create databases (real and test) before you will be asked if you want them to be created, select yes.

> If console askes you if you are sure to execute some command in production select yes as response.
> > These are actions that will be executed after cloning the repository when there's no user data saved in any place.

At this point you can already see Swagger documentation (link below).

3) Decrypt environment variables file with the following command.

``` sh
make decrypt-env KEY={{decription-key}}
```

### decription-key:

> **base64:0vidi+3Qum0fpkHpC5F9fpbrz/CJMXf4ftnf9Z7dDWg=**

## Database

Once env file is created after decryption migrations can be executed:

``` sh
make database-migrate KEY={{envfile-encryption-key}}
```

### envfile-encryption-key

> 51TMszQEvpAlVxbe

### Disclaimers:

> > The DECRYPTION KEYS should be sent and store SECURELY.
>
> As this is a DEMO repository I take the liberty to expose it here.
> 
> In fact this is not even the best way, it's barely a good way. Ideally this should be consumed from secrets, e.g. AWS Secrets

> Environment variables are set up intentionally for a development environment, i.e.
> > APP_ENV=local
>
> > APP_DEBUG=true

Everything set up, enjoy it!! :smiley:

# API Documentation

> http://localhost:8000/api/documentation
>

# Run tests

You can execute all tests with the following command:

``` sh
make tests-run
```
