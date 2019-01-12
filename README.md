# WIC


This is WIC backend project based on [symfony framework last version](http://symfony.com/).

## How to setup the project

### Step 1 - Clone the project

```
git clone https://github.com/harmn108/wic-backend.git
```

### Step 2 - installation of dependencies via composer

Make sure [composer](https://getcomposer.org/) is installed otherways install it accoring to official [documentation](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx). Install project dependencies

```
cd wic-backend #project root
composer install
```
**Note:** If development and production environments have the same configuration (like php version) on production server *composer install* command should be called instead of *composer update*

### Database schema and migrations
In root folder the file **.env** should be configured by updating parameter for database connection.
```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/wic
```

create database via symfony's console with name: **wic**
```
bin/console doctrine:database:create
```

create database tables (schema and default 10 countries in 'country' table) via symfony's console
```
bin/console doctrine:migrations:migrate
```

### Configuring web server 

on development machine it is possible to run a php build-in server which must not be used on produciton server
```
bin/console server:start 127.0.0.1:8081
```

configuration of production server (Apache / Nginx) can be found in official documentation at [Configuring a Web Server](http://symfony.com/doc/current/setup/web_server_configuration.html).

### Testing web server

You can test all API's list here:
```
http://127.0.0.1:8081/api/doc
```