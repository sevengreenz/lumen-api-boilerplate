<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../', '.env.testing'))->overload();
} catch (Dotenv\Exception\InvalidPathException $e) {
    echo '.env.testing for test is missing.';
    exit(1);
}

return require_once 'bootstrap/app.php';
