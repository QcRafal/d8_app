<?php

namespace Drupal\app_rest_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\app_rest_api\Api\CommandCollector;
use Drupal\app_rest_api\Api\CommandDispatcher;
use Drupal\app_rest_api\Api\CommandDispatcherInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class ApiController
 *
 * @package Drupal\app_rest_api\Controller
 */
class ApiController extends ControllerBase
{
    /**
     * @var CommandDispatcherInterface
     */
    private $commandDispatcher;

    /**
     * ApiController constructor.
     * @param CommandDispatcherInterface $commandDispatcher
     */
    public function __construct(CommandDispatcherInterface $commandDispatcher)
    {
        $this->commandDispatcher = $commandDispatcher;
    }

    /**
     * @param ContainerInterface $container
     *
     * @return ApiController
     */
    public static function create(ContainerInterface $container)
    {
        /** @var CommandCollector $commandCollector */
        $commandCollector = $container->get('app_rest_api.api.command_collector');

        return new static(
            $commandCollector
        );
    }

    /**
     * @param string $module
     * @param string $action
     * @param Request $request
     *
     * @return Response
     */
    public function callCommand($module, $action, Request $request)
    {
        try {
            $data = $this->commandDispatcher->dispatch($module, $action);
        } catch (HttpException $e) {
            return $this->response(
                [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTrace(),
                ],
                $e->getStatusCode()
            );
        }

        return $this->response($data);
    }

    protected function response($data, $status = Response::HTTP_OK, array $headers = [])
    {
        $serializer = SerializerBuilder::create()->build();

        $context = SerializationContext::create();
        $context->setSerializeNull(true);

        $response = new Response($serializer->serialize($data, 'json', $context), $status, $headers);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
