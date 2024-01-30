<?php

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$driver = 'mysql';
$username = 'root';
$password = '';

$config = [
    'host' => '127.0.0.1:3310',
    'port' => '336',
    'dbname' => 'phpiggy'
];

$db = new Database($driver, $config, $username, $password);

$sqlFile = file_get_contents('./database.sql');

$db->query($sqlFile);
