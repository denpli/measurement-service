<?php

namespace MeasurementService\App\Controller;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use League\Event\Listener;
use MeasurementService\Domain\Event\MeasurementEventInterface;
use MeasurementService\Domain\Measurement\Measurement;

class PushController implements Listener
{
    const PUSH_URL = 'http://host.docker.internal/api/push';
    private Client $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function celsiusTemperaturePush(Measurement $measurement): void
    {
        $request = $this->buildRequest($measurement);
        $this->client->sendAsync($request)->wait();
    }

    public function __invoke(object $event): void
    {
        if ($event instanceof MeasurementEventInterface) {
            $this->celsiusTemperaturePush($event->getMeasurement());
        }
    }
    private function buildRequest(Measurement $measurement): Request
    {
        $headers = ['Content-Type' => 'application/json'];
        $body = json_encode(['sensor_uuid' => $measurement->getSensorId(), 'temperature' => $measurement->getMeasurementValue()]);

        return new Request('POST', self::PUSH_URL, $headers, $body);
    }
}