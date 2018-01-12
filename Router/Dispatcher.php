<?php

namespace Router;

class Dispatcher
{
  use Helper;

  public $route;
  public $path;
  public $params;

  public function __construct(Route $route, string $path)
  {
    $this->route = $route;
    $this->path = $path;
    $this->execute();
  }

  private function execute()
  {
    $route = $this->routeToArray($this->route->route);
    $path = $this->routeToArray($this->path);

    $before = $this->route->parent->on['before'];
    $after = $this->route->parent->on['after'];
    $error = $this->route->parent->on['error'];

    $current = $this->route->parent->current;
    $max = count($this->route->parent->routes);

    if (count($route) === count($path))
    {
      $validatableParams = $this->createValidatableParams($route, $path);

      if (count($route) === 0 && count($path) === 0)
      {
        $isValid = true;
      }
      else
      {
        $isValid = $this->validateRoute($validatableParams);
      }

      if ($isValid)
      {
        $before();

        $this->route->callback($this->mapRequest($validatableParams));

        $after();
        
        die;
      }
    }

    if ($current === $max)
    {
      $error(404);
    }

  }

  private function mapRequest (array $validatableParams): array
  {
    $result = [];
    foreach ($validatableParams as $param)
    {
      if ($param['isParam'])
      {
        $key = ltrim($param['key'], ':');
        $result[$key] = $param['val'];
      }
    }

    return $result;
  }

  private function normalizeRouteDelimiter(string $route): string
  {
    if ($route[0] != '/')
    {
      $route = '/' . $route;
    }

    if ($route[strlen($route) -1] == '/')
    {
      $route = substr($route, 0, -1);
    }

    return $route;
  }

  private function routeToArray(string $route): array
  {
    $route = $this->normalizeRouteDelimiter($route);
    $params = explode('/', $route);
    array_shift($params);
    return $params;
  }

  private function createValidatableParams(array $routeParams, array $urlParams): array
  {
    $result = [];
    foreach ($routeParams as $key => $route)
    {
      if ($route[0] == ':')
      {
        $result[] = [
          'hasToMatch' => false,
          'isParam' => true,
          'key' => $route,
          'val' => $urlParams[$key]
        ];
      }
      else
      {
        $result[] = [
          'hasToMatch' => true,
          'isParam' => false,
          'key' => $route,
          'val' => $urlParams[$key]
        ];
      }
    }

    return $result;
  }

  private function validateRoute(array $validatableParams): bool
  {
    (bool) $success = true;
    foreach ($validatableParams as $param)
    {
      $hasToMatch = $param['hasToMatch'];
      $value = $param['val'];
      $key = $param['key'];

      if ($hasToMatch && $value != $key)
      {
        $success = false;
      }
      else if (!$hasToMatch && $value == '')
      {
        $success = false;
      }
    }

    return $success;
  }

}
