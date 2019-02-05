[![Latest Version](https://img.shields.io/github/release/mindedge/blade.svg?style=flat-square)](https://github.com/mindedge/blade/releases)
[![Build Status](https://travis-ci.org/mindedge/blade.svg?branch=master)](https://travis-ci.org/mindedge/blade)
[![Coverage Status](https://coveralls.io/repos/github/mindedge/blade/badge.svg?branch=master)](https://coveralls.io/github/mindedge/blade?branch=master)

# Mindedge Blade

Composer package that provides Laravels IOC Container, which any laravel service can be bound to. This package currently provides the following services out of the box:

1. Illuminate\view - [Github Link](https://github.com/illuminate/view), [Illuminate Api Documentation](https://laravel.com/api/5.7/Illuminate/View.html)

   This is the service thats provides the blade engine.  

2. Illuminate\config - [Github Link](https://github.com/illuminate/config), [Illuminate Api Documentation](https://laravel.com/api/5.7/Illuminate/Config.html)

   This is the service that allows services to have dedicated, easy to understand configuration files.  

3. Illuminate\database - [Github Link](https://github.com/illuminate/database), [Illuminate Api Documentation](https://laravel.com/api/5.7/Illuminate/Database.html)

  This is the service that provides database services such as Eloquent.  

The package is now hosted on packagist, which means adding the repository array is not longer nessisary. 

https://packagist.org/packages/mindedge/blade

## Installation

You can use the below require statement from the command line in the root directory (assuming a composer.json already exists):

```
composer require mindedge/blade
```

Alternativly, simply add to existing dependency to "require" object in composer.json,

```
"require": {
    "mindedge/blade": "^1.0.0"
}
```

And then run 

```
composer install
```
## Configuration:

Within the root directory of of your app, create four directories. I have used the "ROOTDIR" to denote the application root. 
1. ROOTDIR/bootrap
2. ROOTDIR/config
3. ROOTDIR/cache
4. ROOTDIR/views

You should wind up with something like this:

```
|...
|
|-config
|-boostrap
|-cache
|-views
|
|...
```

In the newly crated boostrap directory, create a single file named app.php, with the below conents.

```
require_once __DIR__.'/../vendor/autoload.php';

use  Mindedge\Blade\Application;

$app = new Application(
    dirname(__DIR__)
);

$app->withFacades();

//$app->withEloquent();

$app->boot();

return $app;

```

This example shows the autoload script being included, but as long as vendor/autoload.php is included somewhere in the project thats globally accessable, thats a fine approach as well. 


In the newly created config directory, create a single file named view.php, and place the following starter config:

```
<?php

return [

    'paths' => [
        './views'
    ],

    'compiled' => './cache',

];

```

This config file configures the View library (Blade) and contains an array with two keys.   

1. 'paths' - Represents where the Illuminate\view service should look for files. Accepted file types for this directory are .php and .blade.php. You may add as my locations to the paths array as you like.

2. 'compiled' - Represents where the compiled/resolved views should go. If the a given file hasnt changed, View will skip the complication step and read the compiled contents of the corresponding file from this folder. Make sure this folder is writable by the application/web user. 

Add another config file, for the Database library (including eloquent). Inside the config directory create a single file named database.php, and place the following starter config:

```
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
```

All database configuration values should be defined in .env files, with a localhost default backup defined in the config file if nessisary. More information reguarding configuration can be found on the [Official Laravel Docs Site](https://laravel.com/docs/5.7/database) 


Assuming all above steps were followed correctly, you should have a directory structure that looks something simliar to this:

```
|...
|
|-config
|   |
|   view.php
|   database.php
|-boostrap
|   |
|   app.php
|-cache
|-views
|   |
|   welcome.blade.php
|
|...
```

Include boostrap/app.php in you applications entry point, somewhere thats is globally included or autoloaded, and uou are now ready to use all three services this package provides. 

For further help and documenation, see the below links:

[The Laravel Blade Docs.](https://laravel.com/docs/5.7/blade)

[The Laravel Database Docs](https://laravel.com/docs/5.7/database)


