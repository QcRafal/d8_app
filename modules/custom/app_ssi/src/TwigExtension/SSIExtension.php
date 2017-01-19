<?php

namespace Drupal\app_ssi\TwigExtension;


class SSIExtension extends \Twig_Extension
{
    /**
     * This is the same name we used on the services.yml file
     * @return string
     */
    public function getName()
    {
        return 'app_ssi.ssi_extension';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'render_ssi',
                [
                    $this, 'renderSSItag',
                ],
                [
                    'is_safe' => ['html'],
                ]
            ),
        ];
    }

    /**
     * @param $path
     *
     * @return string
     */
    public function renderSSItag($path)
    {
        return sprintf('<!--# include virtual="%s" wait="yes" -->', $path);
    }

}
