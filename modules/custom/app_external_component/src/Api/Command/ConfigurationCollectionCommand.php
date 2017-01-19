<?php

namespace Drupal\app_external_component\Api\Command;

use Drupal\app_rest_api\Api\CommandInputInterface;
use Drupal\app_rest_api\Api\CommandInterface;
use Drupal\app_external_component\Entity\ComponentConfiguration;

/**
 * Class ConfigurationCollectionCommand
 *
 * @package Drupal\app_external_component\Api\Command
 */
class ConfigurationCollectionCommand implements CommandInterface
{
    /**
     * @param CommandInputInterface $commandInput
     *
     * @return array
     */
    public function __invoke(CommandInputInterface $commandInput = null)
    {
        return [
            new ComponentConfiguration(),
            new ComponentConfiguration(),
            new ComponentConfiguration(),
        ];
    }

}
