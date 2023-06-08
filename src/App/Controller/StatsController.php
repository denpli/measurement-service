<?php

namespace MeasurementService\App\Controller;

use MeasurementService\Domain\Stats\StatsRepository;

class StatsController
{
    private StatsRepository $statsRepository;

    public function __construct(StatsRepository $statsRepository)
    {
        $this->statsRepository = $statsRepository;
    }

    public function getSensorAvrgTemperaturePerHour(string $sensorId)
    {
        $result = $this->statsRepository->getSensorAvrgTemperaturePerHour($sensorId);

        header('Content-Type: text/plain; charset=utf-8');
        return json_encode($result);
    }

    public function getAllSensorsLastDays(array $data)
    {
        $result = $this->statsRepository->getAvrgTemperatureLastDays($data['days']);

        header('Content-Type: text/plain; charset=utf-8');
        return json_encode($result);
    }
}