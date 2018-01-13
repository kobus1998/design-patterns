<?php

namespace Database\Adapter;

/**
 * Data in query object
 * $query->adapter: deze instance;
 * $query->table: tabel naam
 * $query->find: [column, value] (soort van where array)
 * $query->action: de action die uitgevoert wordt
 * $query->data: insert of update data
 */
class Mysql extends Adapter
{

  /**
   * Select from database
   * @param object query class
   */
  public function select (\Database\Query\Query $query)
  {

  }

  /**
   * Insert into database
   * @param object query class
   */
  public function insert (\Database\Query\Query $query)
  {

  }

  /**
   * Update values in database
   * @param object query class
   */
  public function update (\Database\Query\Query $query)
  {

  }

  /**
   * Delete from database
   * @param object query class
   */
  public function delete(\Database\Query\Query $query)
  {

  }

  /**
   * Create a connection to database
   */
  public function connect ()
  {
    $config = $this->config;
  }
}
