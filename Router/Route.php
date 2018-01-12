<?php

namespace Router;

class Route
{

  public $method;
  public $route;
  public $callback;
  public $parent;

  public function __construct(Builder $builder)
  {
    $this->method = $builder->getMethod();
    $this->route = $builder->getRoute();
    $this->callback = $builder->getCallback();
    $this->parent = $builder->getParent();
  }

  public function dispatch(string $path): Dispatcher
  {
    return new Dispatcher($this, $path);
  }

  public function callback(array $request)
  {
    call_user_func_array($this->callback, [$request]);
  }

}
