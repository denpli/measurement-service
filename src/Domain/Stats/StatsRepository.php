<?php
declare(strict_types=1);

namespace MeasurementService\Domain\Stats;

use MeasurementService\App\DB\Database;

class StatsRepository
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getAvrgTemperatureLastDays(int $days)
    {
        $sql = "SELECT AVG(data_value)::numeric(10, 2) from temperature WHERE created_at > current_date - interval '$days' day;";
        return $this->db->select($sql, []);
    }

    public function getSensorAvrgTemperaturePerHour(string $sensorId)
    {
        $sql = "SELECT DATE_TRUNC('hour', created_at) as per_hour, AVG(data_value)::numeric(10, 2) as avrg_temp FROM temperature GROUP BY per_hour;";
        return $this->db->select($sql, []);
    }
}