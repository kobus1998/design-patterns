<?php

namespace Database\Query;

/**
 * Query object
 */
class Query
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
   * Construct
   * @param object builder object
   */
  public function __construct(Builder $builder)
  {
    $this->adapter = $builder->adapter;
    $this->table = $builder->table;
    $this->find = $builder->find;
    $this->action = $builder->action;
    $this->data = $builder->data;
  }

  /**
   * Execute method based on set action
   */
  public function router()
  {
    if ($this->action == 'insert')
    {
      return $this->adapter->insert($this);
    }
    else if ($this->action == 'fetch')
    {
      return $this->adapter->select($this);
    }
    else if ($this->action == 'update')
    {
      return $this->adapter->update($this);
    }
    else if ($this->action == 'delete')
    {
      return $this->adapter->delete($this);
    }
    else
    {
      return new \Exception("Action: {$this->action} does not exist");
    }
  }

}
