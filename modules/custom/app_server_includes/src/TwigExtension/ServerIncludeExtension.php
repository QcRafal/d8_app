<?php

namespace Drupal\app_server_includes\TwigExtension;


class ServerIncludeExtension extends \Twig_Extension
{
    /**
     * This is the same name we used on the services.yml file
     *
     * @return string
     */
    public function getName()
    {
        return 'app_server_includes.twig_extension';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'render_include_tag',
                [
                    $this, 'renderIncludeTag',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }

    /**
     * Returns server include tag for given policy (ssi or esi)
     *
     * @param string $path
     * @param string|null $alt
     *
     * @return string
     */
    public function renderIncludeTag($path, $alt = null)
    {
        /** @var \Drupal\Core\Template\TwigEnvironment $twig */
        $twig = \Drupal::service('twig');
        $policy = \Drupal::config('server_includes.policy')->get('policy');

        return $twig->renderInline(sprintf('{{ render_%s(\'%s\') }}', $policy, $path));
    }

}
