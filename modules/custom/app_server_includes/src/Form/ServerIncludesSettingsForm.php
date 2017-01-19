<?php

namespace Drupal\app_server_includes\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ServerIncludesSettingsForm
 */
class ServerIncludesSettingsForm extends ConfigFormBase {

  const POLICY_SSI = 'ssi';
  const POLICY_ESI = 'esi';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'app_server_includes_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'app_server_includes.policy',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('server_includes.policy');

    $form['server_includes_policy'] = [
      '#type'          => 'select',
      '#title'         => $this->t('Server Include technology'),
      '#default_value' => $config->get('policy'),
      '#options' => [
          self::POLICY_SSI => $this->t(self::POLICY_SSI),
          self::POLICY_ESI => $this->t(self::POLICY_ESI),
      ],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')
      ->getEditable('server_includes.policy');

    $config
      ->set(
        'policy',
        $form_state->getValue('server_includes_policy')
      )
      ->save();

    parent::submitForm($form, $form_state);
  }
}
