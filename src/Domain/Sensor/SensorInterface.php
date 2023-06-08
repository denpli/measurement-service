<?php
declare(strict_types=1);

namespace MeasurementService\Domain\Sensor;
interface SensorInterface
{
    public function readSensorData(string $sensorId): SensorValueObject;
}