<?php

require_once dirname(__FILE__,2) . '/index.class.php';

/**
 * Loads the home page.
 *
 * @package bxrextra
 * @subpackage controllers
 */
class BxrExtraHomeManagerController extends BxrExtraBaseManagerController
{
    public function process(array $scriptProperties = [])
    {
    }

    public function getPageTitle()
    { 
        return $this->modx->lexicon('bxrextra');
    }

    public function loadCustomCssJs()
    {
        $this->addJavascript($this->bxrextra->getOption('jsUrl') . 'mgr/extra/griddraganddrop.js');
        $this->addJavascript($this->bxrextra->getOption('jsUrl') . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->bxrextra->getOption('jsUrl') . 'mgr/widgets/home.panel.js');
        $this->addLastJavascript($this->bxrextra->getOption('jsUrl') . 'mgr/sections/home.js');
    }

    public function getTemplateFile()
    {
        return $this->bxrextra->getOption('templatesPath') . 'home.tpl';
    }
}