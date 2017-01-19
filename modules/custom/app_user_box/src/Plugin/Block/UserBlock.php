<?php

/**
 * @file
 * Contains \Drupal\app_user_box\Plugin\Block\UserBlock.
 */

namespace Drupal\app_user_box\Plugin\Block;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'User Box' Block
 *
 * @Block(
 *     id = "app_user_box",
 *     admin_label = @Translation("app_user_box"),
 *     category = @Translation("App"),
 * )
 */
class UserBlock extends BlockBase
{
    /**
     * @return array
     */
    public function build()
    {
        return [
            '#title' => $this->t('App User Box'),
            '#theme' => 'block__user_box',
            '#content' => $this->renderInclude(),
        ];
    }

    /**
     * Provides rendered server include tag
     *
     * @return \Drupal\Component\Render\MarkupInterface|string
     */
    protected function renderInclude()
    {
        /** @var \Drupal\Core\Template\TwigEnvironment $twig */
        $twig = \Drupal::service('twig');

        return $twig->renderInline('{{ render_include_tag(\'/auth/login\') }}');
    }
}
