# WordPress Demo

## Launch environment

Execute the docker-compose.yml file: 
```shell
docker compose up -d
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
1. Create environment file and update variables.
    ```shell
   cp .env.example .env
    ```
2. Setup WordPress @ <http://localhost/>
3. Explore MailHog:
   * Activate MailHog plugin.
   * Create a new user to catch emails.
   * View emails @ <http://localhost:8025/>
4. Explore WP CLI
   ```
   wp plugin delete hello akismet
   wp plugin install health-check query-monitor loco-translate
   ```

## Lab
TODO
