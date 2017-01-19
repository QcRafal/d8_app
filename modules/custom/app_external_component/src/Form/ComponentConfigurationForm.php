<?php

namespace Drupal\app_external_component\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ComponentConfigurationForm
 *
 * @package Drupal\app_external_component\Form
 */
class ComponentConfigurationForm extends ContentEntityForm
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        /* @var \Drupal\app_external_component\Entity\ComponentConfiguration $entity */
        $form = parent::buildForm($form, $form_state);
        $entity = $this->entity;

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state) {
        $form_state->setRedirect('entity.component_configuration.collection');

        /* @var \Drupal\app_external_component\Entity\ComponentConfiguration $entity */
        $entity = $this->getEntity();
        $entity->save();
    }
}
