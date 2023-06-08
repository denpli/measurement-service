<?php
declare(strict_types=1);

namespace MeasurementService\Domain\Event;

use MeasurementService\Domain\Measurement\Measurement;
use MeasurementService\Domain\Sensor\SensorValueObject;

class CelsiusTemperatureReadEvent implements MeasurementEventInterface
{
    private Measurement $measurement;
    public function __construct(SensorValueObject $sensorValueObject)
    {
        $this->measurement = new Measurement($sensorValueObject->getSensorId(), $sensorValueObject->getTemperature());
    }
    public function getMeasurement(): Measurement
    {
        return $this->measurement;
    }
}