<?php

use \PDO;
use \PDOException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Slim\Views\PhpRenderer;

$container = $app->getContainer();

$container['db'] = function($c) {
    $settings = $c->get('settings')['db'];
    extract($settings);

    try {
        $dsn = "mysql:host=$host;dbname=$name;port=$port";

        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    } catch (PDOException $e) {
        return null;
    }
};

$container['logger'] = function($c) {
    $logger = New Logger('app_logger');
    $fileHandler = new StreamHandler('../logs/app.log');
    $logger->pushHandler($fileHandler);

    return $logger;
};

$container['view'] = new PhpRenderer('../templates');