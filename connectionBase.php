<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php';
require 'dbClass.php';

use Conn\DB\PDOFunc;

$conn = PDOFunc\connect($config);
if(!$conn) die('unable to connect with db');