<?php

use MODX\Revolution\modExtraManagerController;
use BxrExtra\BxrExtra;

/**
 * @package bxrextra
 */
abstract class BxrExtraBaseManagerController extends modExtraManagerController
{
    /** @var BxrExtra $bxrextra */
    public $bxrextra;

    public function initialize()
    {
        $this->bxrextra = $this->modx->services->get('bxrextra');

        $this->addCss($this->bxrextra->getOption('cssUrl') . 'mgr.css');
        $this->addJavascript($this->bxrextra->getOption('jsUrl') . 'mgr/bxrextra.js');
        $this->addHtml('
            <script type="text/javascript">
                Ext.onReady(function() {
                    BxrExtra.config = ' . $this->modx->toJSON($this->bxrextra->options) . ';
                });
            </script>
        ');
        return parent::initialize();
    }

    public function getLanguageTopics()
    {
        return ['bxrextra:default'];
    }

    public function checkPermissions()
    {
        return true;
    }
}