<?php
declare(strict_types=1);

use GuzzleHttp\Client;
use League\Event\EventDispatcher;
use MeasurementService\App\Controller\CelsiusCollectorController;
use MeasurementService\App\Controller\CelsiusSensorController;
use MeasurementService\App\Controller\PushController;
use MeasurementService\App\Controller\StatsController;
use MeasurementService\App\DB\Database;
use MeasurementService\Domain\Collector\CelsiusCollector;
use MeasurementService\Domain\Sensor\Sensor;
use MeasurementService\Domain\Stats\StatsRepository;

return [
    Database::class => function () {
        return Database::getInstance();
    },

    PushController::class =>function() {
        return new PushController(new Client());
    },

    EventDispatcher::class => DI\create(EventDispatcher::class),

    Sensor::class => DI\create(Sensor::class)->constructor(DI\get(Database::class), DI\get(EventDispatcher::class)),

    StatsRepository::class => DI\create(StatsRepository::class)->constructor(DI\get(Database::class)),

    CelsiusSensorController::class => DI\create(CelsiusSensorController::class)->constructor(DI\get(Sensor::class)),

    CelsiusCollector::class => DI\create(CelsiusCollector::class)->constructor(DI\get(Database::class)),

    CelsiusCollectorController::class => DI\create(CelsiusCollectorController::class)->constructor(DI\get(CelsiusCollector::class)),

    StatsController::class => DI\create(StatsController::class)->constructor(DI\get(StatsRepository::class)),
];