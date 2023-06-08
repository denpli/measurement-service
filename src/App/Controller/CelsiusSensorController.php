<?php
declare(strict_types=1);

namespace MeasurementService\App\Controller;

use MeasurementService\Domain\Sensor\Sensor;

class CelsiusSensorController
{
    private Sensor $sensor;
    public function __construct(Sensor $sensor)
    {
        $this->sensor = $sensor;
    }

    public function read(string $sensorId): string
    {
        $result = $this->sensor->readSensorData($sensorId);

        header('Content-Type: text/plain; charset=utf-8');
        return implode(';', [$result->getActionCount(), $result->getTemperature()]);
    }
}
