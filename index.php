<?php

require __DIR__ . '/Database/Connection.php';
require __DIR__ . '/Database/Query/Query.php';
require __DIR__ . '/Database/Query/Builder.php';
require __DIR__ . '/Database/Adapter/Adapter.php';
require __DIR__ . '/Database/Adapter/Mysql.php';

use \Database\Connection;
use \Database\Adapter\Mysql;

(array) $config = [
  'host' => 'localhost',
  'port' => '3306',
  'user' => 'root',
  'pass' => '',
  'dbname' => '?'
];

$adapter = new Mysql($config);
$database = new Connection($adapter);

/**
 * Call voorbeeld:
 * $database->table('table')->find('id', '1')->fetch();
 * $database->table('table')->insert([data]);
 * $database->table('table')->find('id', '1')->update([data]);
 * $database->table('table')->find('id', '1')->delete();
 */
