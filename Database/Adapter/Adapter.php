<?php

namespace Database\Adapter;

/**
 * Abstract adapter for query builder library
 */
abstract class Adapter
{

  /**
   * @var object database connection
   */
  public $connection;

  /**
   * Construct
   * @param array config
   */
  public function __construct(array $config)
  {
    $this->config = $config;
    $this->connect();
  }

  /**
   * Select from database
   * @param object query class
   */
  abstract function select (\Database\Query\Query $query);

  /**
   * Insert into database
   * @param object query class
   */
  abstract function insert (\Database\Query\Query $query);

  /**
   * Update value in database
   * @param object query class
   */
  abstract function update (\Database\Query\Query $query);

  /**
   * Delete from database
   * @param object query class
   */
  abstract function delete(\Database\Query\Query $query);

  /**
   * Set connection to database
   * @param object query class
   */
  abstract function connect ();

}
