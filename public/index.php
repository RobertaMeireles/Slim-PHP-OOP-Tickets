<?php

use Slim\App;

require_once '../vendor/autoload.php';

$settings = require '../src/settings.php';
$app = new App($settings);

require_once '../src/dependencies.php';
require_once '../src/routes.php';

$app->run();