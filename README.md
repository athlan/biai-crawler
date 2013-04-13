biai-crawler
============

## Requirements
- PHP 5.4 or above
- PHP PDO extension (with PostgreSQL connector) `php_pdo_pgsql` `php_pgsql` extensions
- PHP CURL support `php_curl` extension
- PostgreSQL 9.1 or above

## Usage

Type help to get usage info

```
php app.php help
```

The application generates a lot of cache files, bewaring of multiple and frequent requests to the same URL's. To flush this cache just type:
```
rm -R ./data/cahce/zfcache*
```

## Installation

1 . Clone the git project

```
git clone https://github.com/athlan/biai-crawler.git
```

2 . Set database connection

```
cp config/autoload/local.php.dist config/autoload/local.php
vim config/autoload/local.php
```

3 . Install dependencies

```
php composer.phar install
```

4 . Set permissions to files

```
chmod -R 0777 ./data/cache/
```

5 . Create database schema

```
php vendor/doctrine/doctrine-module/bin/doctrine-module.php orm:schema-tool:update --verbose --force
```
or
```
cd scripts
chmod +x doctrine-db-update.sh
./doctrine-db-update.sh
cd ..
```
6 . That's all! Just use:

```
php app.php help
```
