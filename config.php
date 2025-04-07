<?php
    require 'vendor/autoload.php';

    // If the .env file was not configured properly, display a helpful message.
    if(!file_exists('.env')) {
        ?>
        <h1>Missing <code>.env</code></h1>
    
        <p>Make a copy of <code>.env.example</code>, place it in the same directory as composer.json, and name it <code>.env</code>, then populate the variables.</p>
        <p>It should look something like the following, but contain your <a href='https://dashboard.stripe.com/test/apikeys'>API keys</a>:</p>
       
        <hr>
    
        <p>You can use this command to get started:</p>
        <pre>cp .env.example .env</pre>
    
        <?php
        exit;
    }

    use Dotenv\Dotenv;

    // Load the .env file
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // Optionally define constants for environment variables
    define('APP_NAME', $_ENV["APP_NAME"]);
    define('STRIPE_SECRET_KEY', $_ENV["STRIPE_SECRET_KEY"]);
    define("STRIPE_PUBLISHABLE_KEY", $_ENV["STRIPE_PUBLISHABLE_KEY"]);
    define('DB_HOST', $_ENV['DB_HOST']);
    define('DB_USERNAME', $_ENV['DB_USERNAME']);
    define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
    define('DB_DATABASE', $_ENV['DB_DATABASE']);
    define('DB_PORT', $_ENV['DB_PORT']);
    define('MAIL_MAILER', $_ENV['MAIL_MAILER']);
    define('MAIL_HOST', $_ENV['MAIL_HOST']);
    define('MAIL_PORT', $_ENV['MAIL_PORT']);
    define('MAIL_USERNAME', $_ENV['MAIL_USERNAME']);
    define('MAIL_PASSWORD', $_ENV['MAIL_PASSWORD']);
    define('MAIL_ENCRYPTION', $_ENV['MAIL_ENCRYPTION']);
    define('MAIL_FROM_ADDRESS', $_ENV['MAIL_FROM_ADDRESS']);
    define('MAIL_FROM_NAME', $_ENV['MAIL_FROM_NAME']);

?>