<?php

namespace Drupal\app_rest_api\Api;

/**
 * Interface CommandDispatcher
 */
interface CommandDispatcherInterface
{
    public function dispatch($module, $action, CommandInputInterface $params = null);
}
