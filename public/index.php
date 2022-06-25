<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Application;

$application = new Application();
echo $application->run();
