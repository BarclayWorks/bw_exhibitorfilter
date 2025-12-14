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

use function YOOtheme\trans;

class MenuEventTagType
{
    /**
     * Define the source type configuration
     *
     * @return array
     */
    public static function config(): array
    {
        return [
            'fields' => [
                'tag_alias' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => trans('Tag Alias'),
                        'filters' => ['limit'],
                    ],
                ],
                'tag_title' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => trans('Tag Title'),
                        'filters' => ['limit'],
                    ],
                ],
                'tag_id' => [
                    'type' => 'Int',
                    'metadata' => [
                        'label' => trans('Tag ID'),
                    ],
                ],
            ],

            'metadata' => [
                'type' => true,
                'label' => trans('Menu Event Tag'),
            ],
        ];
    }
}
