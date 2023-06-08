<?php

declare(strict_types=1);

use MeasurementService\Core;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$core = new Core(
    new DI\ContainerBuilder()
);

$core->dispatch();