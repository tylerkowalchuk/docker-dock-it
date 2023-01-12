# Author Site Demo
 
## Create .env file
```shell
cp -n .env.example .env
```
... and update variables. 

You should also create a __separate mount/volume__ to create a new database.

## Launch environment

Execute the docker-compose.yml file: 
```shell
docker compose up -d
```

## Install and activate plugins
```shell
docker exec -it docker-dock-it-wpcli-1 bash -c " 
wp plugin delete hello akismet ; 
wp plugin install health-check query-monitor loco-translate blockart-blocks everest-forms --activate ;  
wp plugin activate mailhog ;
wp theme activate zakra ;
wp theme delete twentytwenty twentytwentyone ;"
```

### WordPress
<http://localhost>

### phpMyAdmin
<http://localhost:8081>

### MailHog
<http://localhost:8025>

## WP CLI
You can run a single command:
```shell
docker exec -it docker-dock-it-wpcli-1 wp user list
```
or login via the terminal:
```shell
docker exec -it docker-dock-it-wpcli-1 bash
```

## Todo
What are we going to do in class?
Modify some content and create new backup.

## Lab
Todo
