<?php
/**
 * Add snippets to build
 * 
 * @package dateago
 * @subpackage build
 */
$snippets = array();

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
	'id' => 0
	,'name' => 'dateAgo'
	,'description' => 'Snippet that makes your dates look cool.'
	,'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/dateago.php')
	,'source' => 1
	,'static' => 1
	,'static_file' => 'core/components/dateago/elements/snippets/dateago.php'
),'',true,true);
$properties = include $sources['build'].'properties/dateago.php';
$snippets[0]->setProperties($properties);
unset($properties);

return $snippets;