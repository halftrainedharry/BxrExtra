<?php

namespace BxrExtra\Processors\Item;

use MODX\Revolution\Processors\Model\GetListProcessor;
use BxrExtra\Model\BxrExtraItem;
use xPDO\Om\xPDOQuery;

/**
 * Get list Items
 *
 * @package bxrextra
 * @subpackage processors
 */
class GetList extends GetListProcessor
{
    public $classKey = BxrExtraItem::class;
    public $languageTopics = ['bxrextra:default'];
    public $defaultSortField = 'position';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'bxrextra.items';

    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(
                [
                    'name:LIKE' => '%' . $query . '%',
                    'OR:description:LIKE' => '%' . $query . '%',
                ]
            );
        }
        return $c;
    }
}