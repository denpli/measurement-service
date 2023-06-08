<?php
declare(strict_types=1);

namespace MeasurementService\App\Controller;

use MeasurementService\Domain\Collector\CelsiusCollector;
use MeasurementService\Domain\Measurement\Measurement;

class CelsiusCollectorController
{
    private CelsiusCollector $celsiusCollector;
    public function __construct(CelsiusCollector $celsiusCollector)
    {
        $this->celsiusCollector = $celsiusCollector;
    }
    public function push(array $data): void
    {
        $measurement = new Measurement($data['sensorId'], $data['temperature']);
        $this->celsiusCollector->collect($measurement);
    }
}