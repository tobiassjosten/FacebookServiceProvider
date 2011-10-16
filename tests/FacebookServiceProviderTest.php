<?php

namespace TobiassjostenSilexProvider\Facebook\Tests;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use TobiassjostenSilexProvider\Facebook\FacebookServiceProvider;

class FacebookServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    private $classPath;

    public function __construct()
    {
        $this->classPath = __DIR__.'/facebook-php-sdk/src/facebook.php';
    }

    public function setUp()
    {
        if (!file_exists($this->classPath)) {
            $this->markTestSkipped('Facebook SDK was not installed.');
        }
    }

    public function testRegister()
    {
        $app = new Application();

        $app['autoloader']->registerNamespaces(array(
            'TobiassjostenSilexProvider\Facebook' => __DIR__.'/../../../',
        ));

        $app->register(new FacebookServiceProvider(), array(
            'facebook.class_file' => $this->classPath,
            'facebook.app_id'     => '1234567890',
            'facebook.secret'     => '7de6da38beb841a75f0ac5becb215f18',
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
