<?php
declare(strict_types=1);

namespace MeasurementService\Domain\Collector;

use MeasurementService\App\DB\Database;
use MeasurementService\Domain\Measurement\Measurement;

class CelsiusCollector
{
    private Database $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function collect(Measurement $measurement): void
    {
        $sql = "INSERT INTO temperature(sensor_uuid, data_value) VALUES(:sensor_uuid, :data_value)";
        $this->db->insert($sql, [':sensor_uuid' => $measurement->getSensorId(), ':data_value' => $measurement->getMeasurementValue()]);
    }
}