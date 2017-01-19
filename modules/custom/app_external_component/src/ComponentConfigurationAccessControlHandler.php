<?php

namespace Drupal\app_external_component;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Class ComponentConfigurationAccessControlHandler
 *
 * @package Drupal\app_external_component
 */
class ComponentConfigurationAccessControlHandler extends EntityAccessControlHandler
{
    /**
     * @param EntityInterface $entity
     * @param string $operation
     * @param AccountInterface $account
     *
     * @return AccessResult
     */
    protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
        switch ($operation) {
            case 'view':
                return AccessResult::allowedIfHasPermission($account, 'view component_configuration entity');

            case 'edit':
                return AccessResult::allowedIfHasPermission($account, 'edit component_configuration entity');

            case 'delete':
                return AccessResult::allowedIfHasPermission($account, 'delete component_configuration entity');
        }
        return AccessResult::allowed();
    }

    /**
     * @param AccountInterface $account
     * @param array $context
     * @param null $entity_bundle
     *
     * @return AccessResult
     */
    protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
        return AccessResult::allowedIfHasPermission($account, 'add component_configuration entity');
    }
}
