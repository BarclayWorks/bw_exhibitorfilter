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

use YOOtheme\Builder\Source;

class MenuEventTagSourceListener
{
    /**
     * Register custom source types
     *
     * @param Source $source
     */
    public static function initSource($source): void
    {
        $source->objectType('MenuEventTag', MenuEventTagType::config());
        $source->queryType(MenuEventTagQueryType::config());
    }
}
