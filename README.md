Facebook extension for Silex
============================

[Silex][1] extension for loading the Facebook SDK into your apps.

## Installation

First you need to place *Facebook extension* somewhere in your project. You could download and unpack a [tarball][2] or, if you are using Git, you could add it as a submodule.

    $ git submodule add git@github.com:tobiassjosten/facebook-extension.git vendor/facebook

This extension contains a submodule of its own (the actual Facebook SDK) and so you will need to initiate that.

    $ git submodule update --init --recursive

Then configure your Silex app to use it. To use the autoloader you need to tell it where to look for the Facebook namespace.

    $app['autoloader']->registerNamespaces(array(
        'Facebook' => __DIR__.'/../vendor/facebook/src',
    ));

    $app->register(new Facebook\FacebookExtension(), array(
        'facebook.app_id' => '1234567890',
        'facebook.secret' => '7de6da38beb841a75f0ac5becb215f18',
    ));

Now you can use it in your application!

    $app->get('/about', function() use ($app) {
        $tobias = $app['facebook']->api('/721814015');

        return "Brought to you by {$tobias['name']}!";
    });

[1]: http://silex-project.org/
[2]: https://github.com/tobiassjosten/facebook-extension/tarball/master
