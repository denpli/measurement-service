<?php
declare(strict_types=1);

use FastRoute\RouteCollector;

return function (RouteCollector $r) {
    $r->addRoute('POST', '/api/push', ['MeasurementService\App\Controller\CelsiusCollectorController', 'push']);
    $r->addRoute('GET', '/sensor/read/{sensorId}', ['MeasurementService\App\Controller\CelsiusSensorController', 'read']);
    $r->addRoute('POST', '/api/stats/all-sensors', ['MeasurementService\App\Controller\StatsController', 'getAllSensorsLastDays']);
    $r->addRoute('GET', '/api/stats/sensor-per-hour/{sensorId}', ['MeasurementService\App\Controller\StatsController', 'getSensorAvrgTemperaturePerHour']);
};