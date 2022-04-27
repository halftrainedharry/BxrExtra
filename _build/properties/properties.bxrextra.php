<?php
/**
 * Properties for the BxrExtra snippet.
 *
 * @package bxrextra
 * @subpackage build
 */
$properties = [
    [
        'name' => 'sortBy',
        'desc' => 'prop_bxrextra.sortby_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'name',
        'lexicon' => 'bxrextra:properties',
    ],
    [
        'name' => 'sortDir',
        'desc' => 'prop_bxrextra.sortdir_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 'ASC',
        'lexicon' => 'bxrextra:properties',
    ],
    [
        'name' => 'limit',
        'desc' => 'prop_bxrextra.limit_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => 5,
        'lexicon' => 'bxrextra:properties',
    ],
    [
        'name' => 'outputSeparator',
        'desc' => 'prop_bxrextra.outputseparator_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'bxrextra:properties',
    ]
/*
    [
        'name' => '',
        'desc' => 'prop_bxrextra.',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'bxrextra:properties',
    ],
    */
];

return $properties;