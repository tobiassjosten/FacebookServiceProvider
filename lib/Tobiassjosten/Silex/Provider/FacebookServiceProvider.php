<?php

/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this file,
 * You can obtain one at http://mozilla.org/MPL/2.0/. */

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
    
    public function boot(Application $app)
    {
    }
}
