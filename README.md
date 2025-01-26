# WordPress Demo

## Launch environment

Execute the docker-compose.yml file AFTER completing the setup: 
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
or open the WPCLI terminal in Docker Desktop

## Setup
1. Create a new branch to keep this "starter" clean.
2. Review and update the docker-compose file. Make sure to change the database volume for each different site.
3. Create environment file and update variables.
    ```shell
   cp .env.example .env
    ```
4. Execute the docker-compose.yml the .env file:
   ```shell
   docker compose up -d
   ```
5. Setup WordPress @ <http://localhost/>

## Demo
1. Explore MailHog:
   * Activate MailHog plugin.
   * Create a new user to catch emails.
   * View emails @ <http://localhost:8025/>
2. Explore WP CLI
   ```
   wp --help
   wp plugin --help
   wp plugin list
   wp plugin delete hello akismet
   wp plugin install health-check query-monitor loco-translate --activate
   ```

## Lab
Add the following to today's demo
1. Update PHP to version 8.2. Confirm this worked by visiting the "Site Health" info tab.
2. Update PHP config to allow 50MB uploads, increase PHP memory limit to 256MB, and increase max execution time to 5 minutes. Start [here](https://www.geeksforgeeks.org/php-php-ini-file-configuration/) and do some googling. Confirm this worked by visiting the "Site Health" info tab and uploading an image larger than 2MB.
3. Using the following [article](https://www.codeinwp.com/blog/wp-cli/) 
   and [WP CLI docs](https://developer.wordpress.org/cli/commands/), 
   perform the following using the __WP CLI__.

   1. Create a backup of the WP database
   2. Update WP and plugins
   3. Set the [permalink structure](https://developer.wordpress.org/cli/commands/rewrite/structure/) to /%postname%/
   4. Empty all the site content
   5. Create 10 dummy posts with Lorem Ipsum text.
   6. Install and activate the "astra" theme using [wp theme install](https://developer.wordpress.org/cli/commands/theme/install/)
   7. Create a child theme
   8. Activate your child theme
   9. Change your admin password
   10. Create another backup of the WP database with a different name.

Show your instructor when you are finished.
