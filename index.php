<?php

require __DIR__ . '/Router/Dispatcher.php';
require __DIR__ . '/Router/Route.php';
require __DIR__ . '/Router/Builder.php';
require __DIR__ . '/Router/Router.php';

use Router\Router;

$router = new Router();

$reqUrl = '/';

if (isset($_SERVER['PATH_INFO']))
{
  $reqUrl = $_SERVER['PATH_INFO'];
}

if (strpos($reqUrl, 'api'))
{
  // api routes
  $router->get('/api', function ($request) {
    echo 'api docs';
  });

  $router->get('/api/user', function ($request) {
    echo 'user index api';
  });

  $router->get('/api/user/:userId', function ($request) {
    echo 'user detail api ' . $request['userId'];
  });

}
else
{
  // view
  $router->get('/', function ($request) {
    echo 'home view';
  });

  $router->get('/user', function ($request) {
    echo 'user index view';
  });

  $router->get('/user/:userId', function ($request) {
    echo 'user detail view ' . $request['userId'];
  });

  $router->post('/post', function ($request) {
    echo 'post\'ed';
  });
}

$router->on('before', function () {
  // echo 'before';
});

$router->on('after', function () {
  // echo 'after';
});

$router->on('error', function ($code) {
  echo $code;
});

$dispatcher = $router->dispatch($reqUrl);
