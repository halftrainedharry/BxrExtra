<?php
/**
 * Adds modMenus into package
 *
 * @package bxrextra
 * @subpackage build
 */
$menu = $modx->newObject('modMenu');
$menu->fromArray(
    [
        'text' => 'bxrextra',
        'parent' => 'components',
        'description' => 'bxrextra.menu_desc',
        'icon' => '',
        'menuindex' => 0,
        'action' => 'home',
        'namespace' => 'bxrextra',
        'params' => '',
        'handler' => '',
    ], '', true, true
);

return $menu;