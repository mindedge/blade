# Atutor Container

Composer package to implement standalone blade via direct implemenation with illuminate\support. This package provides IoC container service, so that we may include other components down the road if desired. 

The package is now hosted on packagist, which means adding the repository array is not longer nessisary. 

https://packagist.org/packages/mindedge/atutor-container

## Installation

You can use the below require statement from the command line in the root directory (assuming a composer.json already exists):

```
composer require mindedge/atutor-container
```

Alternativly, simply add to existing dependency to "require" object in composer.json,

```
"require": {
    "mindedge/atutor-container": "^2.0.0"
}
```

And run 

```
composer install
```
## Usage:

Within the root directory of atutor, create four directories. bootrap, config, and cache and views. (we can change this). New directories (relative to atutor codebase) are inside of the lines below.

```
|-admin
|...
|------------
|-config
|-boostrap
|-cache
|-views
|-----------
|-includes
|-images
|-...
```

In boostrap directory, create a single named app.php, file with the below conents.

```
require_once __DIR__.'/../vendor/autoload.php';

use  Mindedge\AtutorContainer\Application;

$app = new Application(
    realpath(__DIR__.'/../')
);

return $app;

```

For now, we'll need to manually bring in the /vendor folder.

### This the boostrap/app.php file should now be included somewhere where it will be globally loaded. Vitals or somewhere in includes.

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

This tells blade where to look for files with .blade extensions, and where to put the compiled blade files. This can be altered at any time to make implemenation with atutor easier.

# Usage

Assuming all above steps were followed correctly, and bootstrap/app.php is now globally included. All views can be converted to .blade extensions.

In the entry request entry point, a sample could look as follows:

```
//Ideally this line would not be needed if its globally included
require_once('bootstrap/app.php');

//Look for a file called 'welcome.blade.php' inside <rootDir>/views/welcome.blade.php
echo $app['view']->make('welcome', ['name' => 'mike']);

```

# Roadmap

Since we are implementing the "real" container, any other laravel component can be easily added down the road (router, eloquent, request.. etc), As well as any other laravel specific package.
