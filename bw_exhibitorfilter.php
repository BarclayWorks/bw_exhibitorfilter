<?php

/**
 * @package     Bw.Plugin
 * @subpackage  System.BwExhibitorfilter
 *
 * @copyright   Copyright (C) 2025 Barclay.works Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later
 *
 * This file handles YOOtheme integration which requires old-style plugin
 * because onAfterInitialise fires before service providers are ready.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use YOOtheme\Application as YOOthemeApp;

class PlgSystemBw_exhibitorfilter extends CMSPlugin
{
    /**
     * Load YOOtheme integration if YOOtheme is present
     */
    public function onAfterInitialise()
    {
        if (!class_exists(YOOthemeApp::class, false)) {
            return;
        }

        $bootstrapPath = __DIR__ . '/yootheme/bootstrap.php';

        if (!file_exists($bootstrapPath)) {
            return;
        }

        $app = YOOthemeApp::getInstance();
        $app->load($bootstrapPath);
    }
}
