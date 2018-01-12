<?php

namespace Router;

class Builder
{

  public $method;
  public $route;
  public $callback;
  public $parent;

  public function __construct(Router $parent)
  {
    $this->parent = $parent;
  }

  public function getParent(): Router
  {
    return $this->parent;
  }

  public function getMethod(): string
  {
    return $this->method;
  }

  public function setMethod(string $method): self
  {
    $this->method = strtoupper($method);
    return $this;
  }

  public function getRoute(): string
  {
    return $this->route;
  }

  public function setRoute(string $route): self
  {
    $this->route = trim($route);
    return $this;
  }

  public function getCallback(): callable
  {
    return $this->callback;
  }

  public function setCallback(callable $callback): self
  {
    $this->callback = $callback;
    return $this;
  }

  public function build(): Route
  {
    return new Route($this);
  }

}
