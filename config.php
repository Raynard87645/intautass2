<?php
    require 'vendor/autoload.php';

    use Dotenv\Dotenv;

    // Load the .env file
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // Optionally define constants for environment variables
    define('DB_HOST', $_ENV['DB_HOST']);
    define('DB_USERNAME', $_ENV['DB_USERNAME']);
    define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
    define('DB_DATABASE', $_ENV['DB_DATABASE']);
    define('DB_PORT', $_ENV['DB_PORT']);
?>