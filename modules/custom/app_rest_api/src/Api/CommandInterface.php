<?php

namespace Drupal\app_rest_api\Api;

/**
 * Interface CommandInterface
 */
interface CommandInterface
{
    /**
     * @param CommandInputInterface $commandInput
     *
     * @return mixed
     */
    public function __invoke(CommandInputInterface $commandInput = null);
}
