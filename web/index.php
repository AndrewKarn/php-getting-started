<?php

require('../vendor/autoload.php');

$app = new Silex\Application();

$app['debug'] = (getenv('ENVIRONMENT' != 'production'));

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return !$app['debug'] ? 'You are in development mode' : 'Hello World!';
});

$app->run();
