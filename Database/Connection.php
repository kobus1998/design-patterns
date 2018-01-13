<?php

declare(strict_types=1);

namespace Database;

/**
 * Create a database instance
 */
class Connection
{
  /**
   * @var object a database adapter
   */
  public $adapter;

  /**
   * Construct
   * @param object database adapter
   */
  public function __construct (\Database\Adapter\Adapter $adapter)
  {
    $this->adapter = $adapter;
    $this->adapter->connect();
  }

  /**
   * Make a query
   * @param string table name
   * @return object query builder
   */
  public function table(string $table): \Database\Query\Builder
  {
    return (new Query\Builder($this->adapter))->setTable($table);
  }

}
