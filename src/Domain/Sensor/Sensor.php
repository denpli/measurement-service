<?php
declare(strict_types=1);

namespace MeasurementService\Domain\Sensor;

use League\Event\EventDispatcher;
use MeasurementService\App\DB\Database;
use MeasurementService\Domain\Event\CelsiusTemperatureReadEvent;
class Sensor implements SensorInterface
{
    private Database $db;
    private EventDispatcher $eventDispatcher;
    public function __construct(Database $db, EventDispatcher $eventDispatcher)
    {
        $this->db = $db;
        $this->eventDispatcher = $eventDispatcher;
    }
    public function readSensorData(string $sensorId): SensorValueObject
    {
        $temperature = $this->emulateExternalSensor();
        $sensorActionCount = $this->sensorCounterUpdate($sensorId);

        $result = new SensorValueObject($sensorId, $sensorActionCount, $temperature);

        $this->eventDispatcher->dispatch(new CelsiusTemperatureReadEvent($result));

        return $result;
    }
    private function emulateExternalSensor(): float
    {
        return round(rand(-1000, 8000) / 100, 2);
    }
    private function sensorCounterUpdate(string $sensorId): int
    {
        $sql = "UPDATE sensors SET action_count = action_count + 1 WHERE id = '$sensorId' RETURNING action_count;";
        $sqlResult = $this->db->rawUpdateWithReturnValue($sql);

        if(!is_array($sqlResult) || !array_key_exists('action_count', $sqlResult)) {
            throw new \Exception('Invalid action count');
        }

        return $sqlResult['action_count'];
    }
}