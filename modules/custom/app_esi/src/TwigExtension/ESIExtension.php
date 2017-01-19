<?php

namespace Drupal\app_esi\TwigExtension;


class ESIExtension extends \Twig_Extension
{
    /**
     * This is the same name we used on the services.yml file
     * @return string
     */
    public function getName()
    {
        return 'app_esi.esi_extension';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'render_esi',
                [
                    $this, 'renderESItag',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }

    /**
     * @param string $path
     * @param string|null $alt
     *
     * @return string
     */
    public function renderESItag($path, $alt = null)
    {
        $altAttr = '';
        if ($alt !== null) {
          $altAttr = sprintf('alt="%s"', $alt);
        }

        return  sprintf('<esi:include src="%s" %s onerror="continue"/>', $path, $altAttr);
    }

}
