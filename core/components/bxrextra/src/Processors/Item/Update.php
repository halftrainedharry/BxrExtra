<?php

namespace BxrExtra\Processors\Item;

use MODX\Revolution\Processors\Model\UpdateProcessor;
use BxrExtra\Model\BxrExtraItem;

/**
 * Update an Item
 * 
 * @package bxrextra
 * @subpackage processors
 */
class Update extends UpdateProcessor
{
    public $classKey = BxrExtraItem::class;
    public $languageTopics = ['bxrextra:default'];
    public $objectType = 'bxrextra.items';

    /** @var BxrExtraItem $object */
    public $object;

    public function beforeSet()
    {
        $name = $this->getProperty('name');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('bxrextra.item_err_ns_name'));
        } else if ($this->modx->getCount($this->classKey, array('name' => $name)) && ($this->object->name != $name)) {
            $this->addFieldError('name',$this->modx->lexicon('bxrextra.item_err_ae'));
        }
        return parent::beforeSet();
    }
}   