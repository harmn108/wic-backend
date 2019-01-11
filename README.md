# Historian Prize


This is Erclet backend project based on [symfony 4 framework](http://symfony.com/).

## How to setup the project

### Step 1 - Clone the project

```
git clone https://github.com/PUBLIQNetwork/historian-prize-be.git
```

### Step 2 - installation of dependencies via composer

Make sure [composer](https://getcomposer.org/) is installed otherways install it accoring to official [documentation](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx). Install project dependencies

```
cd historian-prize-be #project root
composer install
```
**Note:** If development and production environments have the same configuration (like php version) on production server *composer install* command should be called instead of *composer update*

### .env configuration parameters
If you don't have .env file, you have to create one, and  if you want to check the default parameters of .env, you can find it in .env.dist. Then you can copy the needed configuration parameters from .env.dist to .env.

### Database schema and data fixtur
In root folder the file **.env** should be configured by updating parameter for database connection.
```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```

create database via symfon's console
```
bin/console doctrine:database:create
```

create database tables (schema) via symfony's console
```
bin/console doctrine:schema:update --force
```

load default data
```
bin/console doctrine:fixtures:load --append
```

### Install  wkhtmltopdf extension
### In Ubuntu 12.04, open the terminal and type:

```
sudo add-apt-repository ppa:pov/wkhtmltopdf
sudo apt-get update
sudo apt-get install wkhtmltopdf 
```

### In Ubuntu 14.04, open the terminal and type:
```
sudo add-apt-repository ppa:ecometrica/servers
sudo apt-get update
sudo apt-get install wkhtmltopdf
```

### Configuring web server 

on development machine it is possible to run a php build-in server which must not be used on proeuciton server
```
bin/console server:run
```

configuraiton of production server (Apache / Nginx) can be found in official documentation at [Configuring a Web Server](http://symfony.com/doc/current/setup/web_server_configuration.html).
