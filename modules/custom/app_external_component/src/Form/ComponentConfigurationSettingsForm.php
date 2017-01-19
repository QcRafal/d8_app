<?php

namespace Drupal\app_external_component\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ComponentConfigurationSettingsForm extends FormBase
{
    /**
     * Returns a unique string identifying the form.
     *
     * @return string
     *   The unique string identifying the form.
     */
    public function getFormId() {
        return 'content_entity_example_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        // Empty implementation of the abstract submit class.
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['contact_settings']['#markup'] = 'Settings form for ContentEntityExample. Manage field settings here.';

        return $form;
    }
}
