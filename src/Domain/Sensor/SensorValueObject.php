<?php

declare(strict_types=1);

namespace MeasurementService\Domain\Sensor;
class SensorValueObject
{
    private string $sensorId;
    private int $actionCount;
    private float $temperature;

    public function __construct(string $sensorId, int $actionCount, float $temperature)
    {

        $this->sensorId = $sensorId;
        $this->actionCount = $actionCount;
        $this->temperature = $temperature;
    }
    public function getSensorId(): string
    {
        return $this->sensorId;
    }
    public function getActionCount(): int
    {
        return $this->actionCount;
    }
    public function getTemperature(): float
    {
        return $this->temperature;
    }
}