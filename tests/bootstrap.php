<?php

require_once __DIR__ . '/silex.phar';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespace('Connector', __DIR__ . '/..');
$loader->register();
