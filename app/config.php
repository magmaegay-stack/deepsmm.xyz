<?php
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '127.0.0.1:8000';
$url = $protocol . "://" . $host;

define('PATH', realpath(__DIR__ . '/..'));
define('SUBFOLDER', false);
define('URL', $url);
define('STYLESHEETS_URL', $url);
date_default_timezone_set('Europe/Rome');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);

return [
  'db' => [
    'name'    =>  getenv('DB_NAME') ? getenv('DB_NAME') : 'smmpanel',
    'host'    =>  getenv('DB_HOST') ? getenv('DB_HOST') : '127.0.0.1',
    'user'    =>  getenv('DB_USER') ? getenv('DB_USER') : 'root',
    'pass'    =>  getenv('DB_PASS') !== false ? getenv('DB_PASS') : 'root',
    'charset' =>  'utf8mb4' 
  ]
];
