<?php

/**
 * @file
 * Includes the autoloader created by Composer.
 *
 * @see composer.json
 * @see index.php
 * @see core/install.php
 * @see core/rebuild.php
 * @see core/modules/statistics/statistics.php
 */

$autolod = require __DIR__ . '/vendor/autoload.php';

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');

return $autolod;
