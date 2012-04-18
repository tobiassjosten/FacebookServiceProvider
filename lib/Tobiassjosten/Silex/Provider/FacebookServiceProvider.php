<?php

namespace Tobiassjosten\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class FacebookServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['facebook'] = $app->share(function () use ($app) {
            return new \Facebook(array(
                'appId'  => $app['facebook.app_id'],
                'secret' => $app['facebook.secret'],
            ));
        });

        if (isset($app['facebook.class_path'])) {
            $app['autoloader']->registerPrefix(
                'Facebook',
                $app['facebook.class_path']
            );
        }
    }
}
