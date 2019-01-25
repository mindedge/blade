[![Build Status](https://travis-ci.org/mindedge/blade.svg?branch=master)](https://travis-ci.org/mindedge/blade)
[![Coverage Status](https://coveralls.io/repos/mindedge/blade/badge.svg?branch=master&service=github)](https://coveralls.io/github/mindedge/blade?branch=master)


# Mindedge Blade

Composer package to implement standalone blade via direct implemenation with the illuminate\view laravel component. This package provides also IoC container service, so that we may include other components, dependecny injection, tests and lots of other fun stuff should we choose to do so down the road.

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

And run 

```
composer install
```
## Usage:

Within the root directory of of your app, create four directories. 
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
    realpath(__DIR__.'/../')
);

return $app;

```

For now, we'll need to manually bring in the /vendor folder.

Ideally, boostrap/app.php would go in a global include, so it only needs to be included once.

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

This tells blade where to look for files with .blade extensions, and where to put the compiled blade files. This can be altered at any time to make implemenation with a legacy code base easier. As noted, 'paths' is an array and can contain referances to many file locations.

The cache directory is where Blade automatically puts the "compiled" source code, so blade compliation only needs to occur when file changes are made.

# Usage

Assuming all above steps were followed correctly, and bootstrap/app.php is now globally included. All views can be converted to .blade extensions, and get the full benefit of [The Blade Docs.](https://laravel.com/docs/5.7/blade)

As a simple example, lets say the user is visiting index.php, you could write:

```
//Ideally this line would not be needed if its globally included
require_once('bootstrap/app.php');

//Look for a file called 'welcome.blade.php' inside <rootDir>/views/welcome.blade.php
echo $app['view']->make('welcome', ['name' => 'mike']);

```

The second argument to the make() method is the data that should be given to the view. It will be automatically be made available to any child views as well. 

# Roadmap

Since we agree'd this turned out to be the best way to implment blade, this gives us tons of options in the future. Not only can we add almost any laravel component, but also most symphony, cake and PHPLeauge packages will work as well.