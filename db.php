<?php
$config = require 'config.php'
$config = new sqli($config['host'], $config['user'], $config['password'], $config['db_name']);

if($config->Connect_error) {
    http_response_code(500);
    diw(json_encode(['error' => 'DB Connection failed']));
}
?>