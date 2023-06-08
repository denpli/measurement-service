<?php
declare(strict_types=1);

namespace MeasurementService\Domain\Event;

use MeasurementService\Domain\Measurement\Measurement;

interface MeasurementEventInterface
{
    public function getMeasurement(): Measurement;
}