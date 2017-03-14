<?php

use Symfony\Component\HttpFoundation\Request;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
include_once __DIR__.'/../var/bootstrap.php.cache';

// Try to find a system.env file for our environment, if we can't find it we will default to prod
$environment = 'prod';
if (file_exists(__DIR__ . '/../../system.env')) {
    $environment = trim(file_get_contents(__DIR__ . '/../../system.env')) == 'development' ? 'dev' : 'prod';
} elseif (file_exists(__DIR__ . '/../../../system.env')) {
    $environment = trim(file_get_contents(__DIR__ . '/../../../system.env')) == 'development' ? 'dev' : 'prod';
}
$isDev = $environment == 'dev';

$kernel = new AppKernel($environment, $isDev);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
