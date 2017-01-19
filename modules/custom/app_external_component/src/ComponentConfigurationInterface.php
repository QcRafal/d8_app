<?php

namespace Drupal\app_external_component;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Interface ComponentConfigurationInterface
 *
 * @package Drupal\app_external_component
 */
interface ComponentConfigurationInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface
{
}
