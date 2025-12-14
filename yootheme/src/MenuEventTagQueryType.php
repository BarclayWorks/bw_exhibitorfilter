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

use Joomla\CMS\Factory;
use Joomla\Database\ParameterType;
use function YOOtheme\trans;

class MenuEventTagQueryType
{
    /**
     * Query type configuration - makes the source appear in YOOtheme's picker
     *
     * @return array
     */
    public static function config(): array
    {
        return [
            'fields' => [
                'menuEventTag' => [
                    'type' => 'MenuEventTag',
                    'metadata' => [
                        'label' => trans('Menu Event Tag'),
                        'group' => trans('Custom'),
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolve',
                    ],
                ],
            ],
        ];
    }

    /**
     * Resolve the menu event tag data
     *
     * @return array|null
     */
    public static function resolve(): ?array
    {
        $app = Factory::getApplication();
        $menu = $app->getMenu()->getActive();

        if (!$menu) {
            return null;
        }

        // filter_tag is stored in request params (jform[request][filter_tag])
        // Access via menu query or params
        $tagId = 0;

        // Try query first (where request params end up)
        if (isset($menu->query['filter_tag'])) {
            $filterTag = $menu->query['filter_tag'];
            if (is_array($filterTag)) {
                $tagId = (int) reset($filterTag);
            } else {
                $tagId = (int) $filterTag;
            }
        }

        // Fallback to params
        if (!$tagId) {
            $params = $menu->getParams();
            $filterTag = $params->get('filter_tag', '');
            if (!empty($filterTag)) {
                if (is_array($filterTag)) {
                    $tagId = (int) reset($filterTag);
                } else {
                    $tagIds = explode(',', $filterTag);
                    $tagId = (int) trim($tagIds[0]);
                }
            }
        }

        if (!$tagId) {
            return null;
        }

        // Look up the tag details
        $db = Factory::getContainer()->get('DatabaseDriver');
        $query = $db->getQuery(true)
            ->select([
                $db->quoteName('id'),
                $db->quoteName('alias'),
                $db->quoteName('title'),
            ])
            ->from($db->quoteName('#__tags'))
            ->where($db->quoteName('id') . ' = :tagId')
            ->bind(':tagId', $tagId, ParameterType::INTEGER);

        $db->setQuery($query);
        $tag = $db->loadObject();

        if (!$tag) {
            return null;
        }

        return [
            'tag_alias' => $tag->alias,
            'tag_title' => $tag->title,
            'tag_id' => (int) $tag->id,
        ];
    }
}
