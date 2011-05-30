<?php

namespace Facebook;

use Silex\Application;
use Silex\ExtensionInterface;

class FacebookExtension implements ExtensionInterface
{
    public function register(Application $app)
    {
        /* @TODO: Use proper autoloading when/if Facebook fixes compliance.
        $app['autoloader']->registerPrefix(
            'Facebook',
            __DIR__.'/../../vendor/facebook/src'
        );
        */

        $app['facebook'] = $app->share(function () use ($app) {
            // @TODO: Use proper autoloading when/if Facebook fixes compliance.
            require_once __DIR__.'/../../vendor/facebook/src/facebook.php';

            return new \Facebook(array(
                'appId'  => $app['facebook.app_id'],
                'secret' => $app['facebook.secret'],
            ));
        });
    }
}
