<?php
/**
 * The base BxrExtra snippet.
 *
 * @var \MODX\Revolution\modX $modx
 * @var array $scriptProperties
 * @package bxrextra
 */

use BxrExtra\Model\BxrExtraItem;

/** @var \BxrExtra\BxrExtra $bxrextra */
$bxrextra = $modx->services->get('bxrextra');

// Do your snippet code here. This demo grabs 5 items from our custom table.
$tpl = $modx->getOption('tpl', $scriptProperties, '@INLINE <li><strong>[[+name]]</strong> - [[+description]]</li>');
$sortBy = $modx->getOption('sortBy', $scriptProperties, 'name');
$sortDir = $modx->getOption('sortDir', $scriptProperties, 'ASC');
$limit = $modx->getOption('limit', $scriptProperties, 5);
$outputSeparator = $modx->getOption('outputSeparator', $scriptProperties, "\n");

// build query
$c = $modx->newQuery(BxrExtraItem::class);
$c->sortby($sortBy, $sortDir);
$c->limit($limit);
$items = $modx->getCollection(BxrExtraItem::class, $c);

// iterate through items
$list = [];
foreach ($items as $item) {
    $itemArray = $item->toArray();
    $list[] = $bxrextra->getChunk($tpl,$itemArray);
}

// output
$output = implode($outputSeparator, $list);
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, false);
if (!empty($toPlaceholder)) {
    // if using a placeholder, output nothing and set output to specified placeholder
    $modx->setPlaceholder($toPlaceholder, $output);
    return '';
}
// by default just return output
return $output;