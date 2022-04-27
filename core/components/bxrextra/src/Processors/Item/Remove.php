<?php

namespace BxrExtra\Processors\Item;

use MODX\Revolution\Processors\Model\RemoveProcessor;
use BxrExtra\Model\BxrExtraItem;

/**
 * Remove an Item.
 * 
 * @package bxrextra
 * @subpackage processors
 */
class Remove extends RemoveProcessor
{
    public $classKey = BxrExtraItem::class;
    public $languageTopics = ['bxrextra:default'];
    public $objectType = 'bxrextra.items';
}