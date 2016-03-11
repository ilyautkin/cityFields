<?php

$properties = array();

$tmp = array(
	'tplWrapper' => array(
		'type' => 'textfield',
		'value' => 'cfCities.outer',
	),
	'tpl' => array(
		'type' => 'textfield',
		'value' => 'cfCities.row',
	),
	'selected' => array(
		'type' => 'textfield',
		'value' => ' selected="selected"',
	)
);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;