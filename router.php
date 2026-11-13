<?php
$rawUri = $_SERVER['REQUEST_URI'];
$parsedUri = parse_url($rawUri, PHP_URL_PATH);
$filePath = __DIR__ . urldecode($parsedUri);

// Serve existing files (css, js, images, fonts, uploads, php scripts) directly
if ($parsedUri !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    return false;
}

// Route all application endpoints to index.php
require_once __DIR__ . '/index.php';
