<?php

namespace Router;

/**
 * Manager
 */
class Router
{

  public $routes = [];
  public $max = 0;
  public $current = 0;
  public $on;

  public function __construct()
  {
    $this->on = [
      'error' => function () {}, 
      'before' => function () {}, 
      'after' => function () {}
    ];
  }

  private function set(string $method, string $route, callable $callback): Builder
  {
    $this->max++;
    $builder = (new Builder($this))
            ->setMethod($method)
            ->setRoute($route)
            ->setCallback($callback);

    $this->routes[] = $builder;
    return $builder;
  }

  public function get(string $route, callable $callback): Builder
  {
    return $this->set('GET', $route, $callback);
  }

  public function post(string $route, callable $callback): Builder
  {
    return $this->set('POST', $route, $callback);
  }

  public function put(string $route, callable $callback): Builder
  {
    return $this->set('PUT', $route, $callback);
  }

  public function on(string $type, callable $callback)
  {
    $this->on[$type] = $callback;
    return $this;
  }

  public function dispatch(string $path)
  {
    foreach ($this->routes as $builder)
    {
      $this->current++;
      $route = $builder->build();
      
      if ($route->method !== $_SERVER['REQUEST_METHOD'])
      {
        continue;
      }

      $route->dispatch($path);
    }
  }

}
