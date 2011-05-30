<?php

namespace Facebook\Tests\Extension;

use Facebook\FacebookExtension;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class FacebookExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!is_dir(__DIR__ . '/../../../vendor/facebook')) {
            $this->markTestSkipped('Facebook SDK was not installed.');
        }
    }

    public function testRegister()
    {
        $app = new Application();

        $app['autoloader']->registerNamespaces(array(
            'Facebook' => __DIR__.'/../../../src',
        ));

        $app->register(new FacebookExtension(), array(
            'facebook.app_id' => '1234567890',
            'facebook.secret' => '7de6da38beb841a75f0ac5becb215f18',
        ));

        $app->get('/', function() use($app) {
            $app['facebook'];
        });
        $request = Request::create('/');
        $app->handle($request);

        $this->assertTrue($app['facebook'] instanceof \Facebook);
        $this->assertSame('1234567890', $app['facebook']->getAppId());
        $this->assertSame('7de6da38beb841a75f0ac5becb215f18', $app['facebook']->getApiSecret());
    }
}
