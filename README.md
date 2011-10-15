Facebook Service Provider for Silex
============================

[Silex][1] Service Provider for loading the Facebook SDK into your apps.

## Installation

First you need to place *FacebookServiceProvider* somewhere in your project. You could download and unpack a [tarball][2] or, if you are using Git, you could add it as a submodule.

    $ git submodule add git@github.com:tobiassjosten/FacebookServiceProvider.git vendor/TobiassjostenSilexProvider/Facebook

This repository contains a submodule of its own (the actual Facebook SDK) and so you will need to initiate that.

    $ git submodule update --init --recursive

Then configure your Silex app to use it. To use the autoloader you need to tell it where to look for the Facebook namespace.

    $app['autoloader']->registerNamespaces(array(
        'TobiassjostenSilexProvider\Facebook' => __DIR__.'/../vendor',
    ));

    $app->register(new TobiassjostenSilexProvider\Facebook\FacebookServiceProvider(), array(
        'facebook.app_id' => '1234567890',
        'facebook.secret' => '7de6da38beb841a75f0ac5becb215f18',
    ));

Now you can use it in your application!

    $app->get('/about', function() use ($app) {
        $tobias = $app['facebook']->api('/721814015');

        return "Brought to you by {$tobias['name']}!";
    });

## Tests

In order to run the tests you need to fetch [`silex.phar`][3] first.

    $ wget http://silex.sensiolabs.org/get/silex.phar

Then run the [PHPUnit][4] test suite.

    $ phpunit

[1]: http://silex-project.org/
[2]: https://github.com/tobiassjosten/FacebookServiceProvider/tarball/master
[3]: http://silex.sensiolabs.org/get/silex.phar
[4]: http://www.phpunit.de/manual/current/en/index.html
