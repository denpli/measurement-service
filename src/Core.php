<?php
declare(strict_types=1);

namespace MeasurementService;

use DI\Container;
use DI\ContainerBuilder;
use FastRoute\Dispatcher;
use League\Event\EventDispatcher;
use MeasurementService\App\Controller\PushController;
use MeasurementService\Domain\Event\CelsiusTemperatureReadEvent;
use function FastRoute\simpleDispatcher;

final class Core
{
    private Container $container;
    private array $routes;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->container = $this->loadServices($containerBuilder);
        $this->routes = $this->loadRoutes();
        $this->eventDispatcherSetup();
    }

    public function dispatch()
    {
        switch ($this->routes[0]) {
            case Dispatcher::NOT_FOUND:
                echo '404 Not Found';
                break;

            case Dispatcher::METHOD_NOT_ALLOWED:
                echo '405 Method Not Allowed';
                break;

            case Dispatcher::FOUND:
                $controller = $this->routes[1];
                $parameters = $this->routes[2];

                if (in_array($_SERVER['REQUEST_METHOD'], ['POST', 'PUT'])) {
                    $post = fopen('php://input', 'r');
                    $parameters = [get_object_vars(json_decode(stream_get_contents($post)))];
                    fclose($post);
                }
                $response = $this->container->call($controller, $parameters);
                echo $response;
        }
    }

    private function loadServices(ContainerBuilder $containerBuilder)
    {
        $containerBuilder->useAutowiring(false);
        $containerBuilder->useAttributes(false);
        $containerBuilder->addDefinitions(dirname(__DIR__) . '/config/services.php');

        return $containerBuilder->build();
    }

    private function loadRoutes(): array
    {
        $routesCollection = require dirname(__DIR__) . '/config/routes.php';
        $dispatcher = simpleDispatcher($routesCollection);

        return $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }

    private function eventDispatcherSetup()
    {
        $eventDispatcher = $this->container->get(EventDispatcher::class);
        $pushController = $this->container->get(PushController::class);

        $eventDispatcher->subscribeTo(CelsiusTemperatureReadEvent::class, $pushController);
    }

    private function response($response, $mode)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }
}