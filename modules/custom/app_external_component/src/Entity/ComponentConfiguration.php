<?php

/**
 * @file
 * Contains \Drupal\app_external_component\Entity\ComponentConfiguration.
 */

namespace Drupal\app_external_component\Entity;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Entity\Annotation\ContentEntityType;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;
use Drupal\app_external_component\ComponentConfigurationInterface;

/**
 * Class ComponentConfiguration
 *
 * @ContentEntityType(
 *   id = "component_configuration",
 *   label = @Translation("Component Configuration Entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\app_external_component\Entity\Controller\ComponentConfigurationListBuilder",
 *     "form" = {
 *       "default" = "Drupal\app_external_component\Form\ComponentConfigurationForm",
 *       "add" = "Drupal\app_external_component\Form\ComponentConfigurationForm",
 *       "edit" = "Drupal\app_external_component\Form\ComponentConfigurationForm",
 *       "delete" = "Drupal\app_external_component\Form\ComponentConfigurationDeleteForm",
 *     },
 *     "access" = "Drupal\app_external_component\ComponentConfigurationAccessControlHandler",
 *   },
 *   list_cache_contexts = { "user" },
 *   base_table = "app_component_configuration",
 *   admin_permission = "administer component_configuration entity",
 *   entity_keys = {
 *     "id" = "id"
 *   },
 *   links = {
 *     "canonical" = "/component_configuration/{component_configuration}",
 *     "edit-form" = "/component_configuration/{component_configuration}/edit",
 *     "delete-form" = "/component_configuration/{component_configuration}/delete",
 *     "collection" = "/component_configuration/list"
 *   },
 *   field_ui_base_route = "component_configuration.configuration_settings",
 * )
 *
 * @Serializer\ExclusionPolicy("all")
 */
class ComponentConfiguration extends ContentEntityBase implements ComponentConfigurationInterface
{
    use EntityChangedTrait;

    /**
     * {@inheritdoc}
     *
     * When a new entity instance is added, set the user_id entity reference to
     * the current user as the creator of the instance.
     */
    public static function preCreate(EntityStorageInterface $storage_controller, array &$values)
    {
        parent::preCreate($storage_controller, $values);
        $values += array(
            'user_id' => \Drupal::currentUser()->id(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedTime() {
        return $this->get('created')->value;
    }
    /**
     * {@inheritdoc}
     */
    public function getChangedTime() {
        return $this->get('changed')->value;
    }
    /**
     * {@inheritdoc}
     */
    public function setChangedTime($timestamp) {
        $this->set('changed', $timestamp);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        return $this->get('user_id')->entity;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(UserInterface $account)
    {
        $this->set('user_id', $account->id());

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwnerId()
    {
        return $this->get('user_id')->target_id;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwnerId($uid)
    {
        $this->set('user_id', $uid);

        return $this;
    }

    public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

        $fields = [];

        $fields['id'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('ID'))
            ->setDescription(t('The ID of the Component Configuration  entity.'))
            ->setReadOnly(TRUE)
            ->setSetting('unsigned', TRUE);

        $fields['uuid'] = BaseFieldDefinition::create('uuid')
            ->setLabel(t('UUID'))
            ->setDescription(t('The UUID of the Component Configuration entity creator.'))
            ->setReadOnly(TRUE);

        $fields['name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Name'))
            ->setDescription(t('The name of the Configured Component.'))
            ->setSettings(array(
                'default_value' => '',
                'max_length' => 255,
                'text_processing' => 0,
            ))
            ->setDisplayOptions('view', array(
                'label' => 'above',
                'type' => 'string',
                'weight' => -6,
            ))
            ->setDisplayOptions('form', array(
                'type' => 'string_textfield',
                'weight' => -6,
            ))
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['created'] = BaseFieldDefinition::create('created')
            ->setLabel(t('Created'))
            ->setDescription(t('The time that the entity was created.'));

        $fields['changed'] = BaseFieldDefinition::create('changed')
            ->setLabel(t('Changed'))
            ->setDescription(t('The time that the entity was last edited.'));

        return $fields;
    }
}
