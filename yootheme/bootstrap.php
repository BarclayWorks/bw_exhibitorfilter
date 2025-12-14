<?php

/**
 * @package     Bw.Plugin
 * @subpackage  System.BwExhibitorfilter
 *
 * @copyright   Copyright (C) 2025 Barclay.works Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

namespace Bw\Plugin\System\BwExhibitorfilter\YOOtheme;

defined('_JEXEC') or die;

// Autoload classes from src folder
$classMap = [
    __NAMESPACE__ . '\MenuEventTagSourceListener' => __DIR__ . '/src/MenuEventTagSourceListener.php',
    __NAMESPACE__ . '\MenuEventTagType' => __DIR__ . '/src/MenuEventTagType.php',
    __NAMESPACE__ . '\MenuEventTagQueryType' => __DIR__ . '/src/MenuEventTagQueryType.php',
];

spl_autoload_register(
    function ($class) use ($classMap) {
        if (isset($classMap[$class]) && file_exists($classMap[$class])) {
            require_once $classMap[$class];
            return true;
        }
    },
    true,
    true
);

return [
    'events' => [
        'source.init' => [
            MenuEventTagSourceListener::class => 'initSource',
        ],
    ],
];
