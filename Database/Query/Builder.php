<?php

declare(strict_types=1);

namespace Database\Query;

/**
 * Execute functions: fetch, insert, update, delete
 */
class Builder
{

  /**
   * @var object adapter
   */
  public $adapter;

  /**
   * @var string table name
   */
  public $table;

  /**
   * @var array find
   */
  public $find = [];

  /**
   * @var string action type
   */
  public $action;

  /**
   * @var array data for update and insert
   */
  public $data;

  /**
   * @param object adapter
   */
  public function __construct(\Database\Adapter\Adapter $adapter)
  {
    $this->adapter = $adapter;
  }

  /**
   * Set table property
   * @param string table name
   * @return self
   */
  public function setTable(string $table): self
  {
    $this->table = $table;
    return $this;
  }

  /**
   * Set find object
   * @param string column name
   * @param string value
   * @return self
   */
  public function find(string $column, string $value): self
  {
    $this->find = ['column' => $column, 'value' => $value];
    return $this;
  }

  /**
   * Execute insert function of adapter
   * @param array insert data
   * @return object query router function
   */
  public function insert(array $data)
  {
    $this->action = 'insert';
    $this->data = $data;
    return $this->execute();
  }

  /**
   * Execute update function of adapter
   * @param array update data
   * @return object query router function
   */
  public function update(array $data)
  {
    $this->action = 'update';
    $this->data = $data;
    return $this->execute();
  }

  /**
   * Execute delete function of adapter
   * @return object query router function
   */
  public function delete()
  {
    $this->action = 'delete';
    return $this->execute();
  }

  /**
   * Execute select function of adapter
   * @return object query router function
   */
  public function fetch()
  {
    $this->action = 'fetch';
    return $this->execute();
  }

  /**
   * Execute adapter router
   * @return object query router function
   */
  public function execute()
  {
    return (new Query($this))->router();
  }

}
