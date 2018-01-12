<?php

namespace Router;

trait Helper
{

  public function arrayFilter(array $array, callable $callback): array
  {
    $result = [];
    foreach ($array as $value)
    {
      if ($callback($value))
      {
        $result[] = $value;
      }
    }

    return $result;
  }

}
