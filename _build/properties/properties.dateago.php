<?php
/**
 * Properties for the dateAgo snippet.
 *
 * @package dateago
 * @subpackage build
 */
$properties = array(
    array(
        'name' => 'input',
        'desc' => 'da_input',
        'type' => 'textfield',
        'value' => '',
        'lexicon' => 'dateago:properties',
    ),
    array(
        'name' => 'dateFormat',
        'desc' => 'da_dateFormat',
        'type' => 'textfield',
        'value' => 'd F Y, H:i',
        'lexicon' => 'dateago:properties',
    ),
    array(
        'name' => 'dateNow',
        'desc' => 'da_dateNow',
        'type' => 'numberfield',
        'value' => 10,
        'lexicon' => 'dateago:properties',
    ),
    array(
        'name' => 'dateDay',
        'desc' => 'da_dateDay',
        'type' => 'textfield',
        'value' => 'day H:i',
        'lexicon' => 'dateago:properties',
    ),
    array(
        'name' => 'dateMinutes',
        'desc' => 'da_dateMinutes',
        'type' => 'numberfield',
        'value' => '59',
        'lexicon' => 'dateago:properties',
    ),
    array(
        'name' => 'dateHours',
        'desc' => 'da_dateHours',
        'type' => 'numberfield',
        'value' => '10',
        'lexicon' => 'dateago:properties',
    ),

);

return $properties;