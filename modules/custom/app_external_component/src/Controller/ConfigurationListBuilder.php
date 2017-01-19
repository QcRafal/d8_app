<?php

namespace Drupal\app_external_component\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;
use Drupal\app_external_component\ComponentConfiguration\ComponentConfiguration;

class ConfigurationListBuilder extends EntityListBuilder
{
    /**
     * {@inheritdoc}
     *
     * We override ::render() so that we can add our own content above the table.
     * parent::render() is where EntityListBuilder creates the table using our
     * buildHeader() and buildRow() implementations.
     */
    public function render()
    {
        $build['description'] = array(
            '#markup' => $this->t('Content Entity Example implements a Inventory model. These contacts are fieldable entities. You can manage the fields on the <a href="@adminlink">Inventory admin page</a>.', array(
                '@adminlink' => \Drupal::urlGenerator()
                    ->generateFromRoute('manage_inventory.inventory_settings'),
            )),
        );
        $build['table'] = parent::render();
        return $build;
    }

    /**
     * {@inheritdoc}
     *
     * Building the header and content lines for the inventory list.
     *
     * Calling the parent::buildHeader() adds a column for the possible actions
     * and inserts the 'edit' and 'delete' links as defined for the entity type.
     */
    public function buildHeader() {
        $header['id'] = $this->t('ConfigurationID');
        $header['name'] = $this->t('Name');
        return $header + parent::buildHeader();
    }

    /**
     * @param ComponentConfiguration|EntityInterface $entity
     *
     * @return array|mixed
     */
    public function buildRow(EntityInterface $entity) {
        /* @var ComponentConfiguration $entity */
        $row['id'] = $entity->id();
        $row['name'] = $entity->link();

        return $row + parent::buildRow($entity);
    }

}
