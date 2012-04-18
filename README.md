Facebook Service Provider for Silex
============================

[Silex][1] Service Provider for loading the [Facebook SDK][2] into your apps.

## Installation

FacebookServiceProvider uses [Composer][3], which makes installing it *dead simple*.

1 -- Download Composer as per [the instructions][4].

2 -- Add FacebookServiceProvider to the requirements of your composer.json.

    "require": {
        "php": "> 5.3.2",
        "tobiassjosten/facebook-service-provider": "dev-master"
    }

(See a full example of [FacebookServiceProvider's composer.json][5].)

3 -- Run `./composer.phar install`

And that's it! You now have FacebookServiceProvider installed into your vendor directory. Inside which an autoloader file has also been created for you.

## Usage

Next you need to tell the autoloader where to look for the `Tobiassjosten\Silex\Provider\Facebook` namespace.

    $app['autoloader']->registerNamespaces(array(
        'Tobiassjosten\Silex\Provider' => __DIR__.'/vendor/tobiassjosten/facebook-service-provider/lib',
    ));

    $app->register(new Tobiassjosten\Silex\Provider\FacebookServiceProvider(), array(
        'facebook.app_id'     => '1234567890',
        'facebook.secret'     => '7de6da38beb841a75f0ac5becb215f18',
    ));

Now Silex knows all it needs and you can use the Facebook SDK in your application.

    $app->get('/about', function() use ($app) {
        $tobias = $app['facebook']->api('/721814015');

        return "Brought to you by {$tobias['name']}!";
    });

## Tests

Again because of Composer, running tests are *dead simple*.

    $ ./composer.phar install && phpunit

[1]: http://silex-project.org/
[2]: https://github.com/facebook/facebook-php-sdk
[3]: http://getcomposer.org/
[4]: http://getcomposer.org/download/
[5]: https://github.com/tobiassjosten/FacebookServiceProvider/blob/master/composer.json
