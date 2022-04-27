<?php

namespace BxrExtra\Processors\Item;

use MODX\Revolution\Processors\Model\CreateProcessor;
use BxrExtra\Model\BxrExtraItem;

/**
 * Create an Item
 * 
 * @package bxrextra
 * @subpackage processors
 */
class Create extends CreateProcessor
{
    public $classKey = BxrExtraItem::class;
    public $languageTopics = ['bxrextra:default'];
    public $objectType = 'bxrextra.items';

    /** @var BxrExtraItem $object */
    public $object;

    public function beforeSet()
    {
        $items = $this->modx->getCollection($this->classKey);

        $this->setProperty('position', count($items));

        return parent::beforeSet();
    }

    public function beforeSave()
    {
        $name = $this->getProperty('name');

        if (empty($name)) {
            $this->addFieldError('name',$this->modx->lexicon('bxrextra.item_err_ns_name'));
        } else if ($this->doesAlreadyExist(array('name' => $name))) {
            $this->addFieldError('name',$this->modx->lexicon('bxrextra.item_err_ae'));
        }
        return parent::beforeSave();
    }
}

