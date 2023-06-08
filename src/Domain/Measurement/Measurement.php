<?php
declare(strict_types=1);

namespace MeasurementService\Domain\Measurement;
class Measurement
{
    private string $sensorId;
    private float $measurementValue;
    public function __construct(string $sensorId, float $measurementValue)
    {
        $this->sensorId = $sensorId;
        $this->measurementValue = $measurementValue;
    }
    public function getSensorId(): string
    {
        return $this->sensorId;
    }
    public function getMeasurementValue(): float
    {
        return $this->measurementValue;
    }
}