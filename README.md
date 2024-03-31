# THOT Website — v2 / 2018-2022+

![website home page](_resources_/website.png)

Based on Symfony 5 + Webpack

Requirements:

- PHP 8
- MySQL or MariaDB
- Node with NPM (to build the frontend assets)

## Installation

#### To install PHP

For ubuntu find below, you need the php-cli & php-mysql add-ins

    sudo apt install php libapache2-mod-php
    sudo apt install php-cli
    sudo apt install php-mysql

#### To install dependencies

[Composer](https://getcomposer.org/) is the PHP package manager. Install it first and then run

    composer install

#### To build production assets

We use Node and NPM to install frontend dependencies. You can install both from [here](https://nodejs.org/en/download/) and then run

    npm install
    npm run build

### How to create a local database

Once you have a MySQL instance running, you can connect to it with `sudo mysql` and:

```sql
CREATE USER 'thot'@'localhost' IDENTIFIED BY 'thot';
CREATE DATABASE thot;
GRANT ALL PRIVILEGES ON thot.* TO 'thot'@'localhost';
```

This will create a user `thot` with password `thot` and a database named `thot`.

You can then change the MySQL connection line with theses credentials in the `.env.local` file that you must create at the root of the folder, for instance:

    DATABASE_URL=mysql://thot:thot@127.0.0.1:3306/thot

After you have done that, you can create the schema running into a terminal:

    bin/console doctrine:schema:update --force

And then run the fixtures; for instance, you can connect on your local mysql instance and run the fixtures (in fixtures.sql) with:

    sudo mysql -D thot < fixtures/fixtures.sql



## Local development

### To run a dev server

Just run

    php -S localhost:8000 -t public

You can then go to http://localhost:8000 to interact with the frontend

#### Admin

The admin is at http://localhost:8000/admin/ and the login/password is: `admin`/ `changeMe` (if you haven't changed it in your `.env.local` file)

## Deployment

To deploy on the remote server (thot-fle.fr), we use [Deployer](https://deployer.org/).

Create a `deploy/servers.yml`file with the necessary content.

Example:

```yml
production:
    hostname: XX.YY.ZZ.WW
    user: debian
    forward_agent: ~
    stage: production
    deploy_path: "/var/www/thot-fle.fr"
    branch: master
```

And then run

    ./vendor/bin/dep deploy

It should yield the following log if everything runs smoothly:

```
❯ ./vendor/bin/dep deploy
✈︎ Deploying master on thot-fle.fr
✔ Executing task deploy:prepare
✔ Executing task deploy:lock
✔ Executing task deploy:release
✔ Executing task deploy:update_code
✔ Executing task deploy:build_assets
✔ Executing task deploy:shared
✔ Executing task deploy:vendors
✔ Executing task deploy:writable
✔ Executing task deploy:cache:clear
✔ Executing task deploy:cache:warmup
✔ Executing task deploy:symlink
✔ Executing task folder:rights
✔ Executing task php-fpm:restart
✔ Executing task deploy:unlock
✔ Executing task cleanup
Successfully deployed!
```

## Translations

To extract translations from templates :

    bin/console translation:update --output-format xlf --xliff-version=2.0 fr --force
    bin/console translation:update --output-format xlf --xliff-version=2.0 en --force
    bin/console translation:update --output-format xlf --xliff-version=2.0 fa --force
    bin/console translation:update --output-format xlf --xliff-version=2.0 ps --force
    bin/console translation:update --output-format xlf --xliff-version=2.0 ar --force

