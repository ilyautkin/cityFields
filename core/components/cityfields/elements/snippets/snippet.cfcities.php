<?php
if (!$modx->getOption('cityfields_active')) return false;

$cityFields = $modx->getService('cityfields','cityFields',$modx->getOption('cityfields_core_path',null,$modx->getOption('core_path').'components/cityfields/').'model/cityfields/',$scriptProperties);
if (!($cityFields instanceof cityFields)) return false;

if ( empty($selected) ) $selected = ' selected="selected"';
if ( empty($tplWrapper) ) $tplWrapper = 'cfCities.outer';
if ( empty($tpl) ) $tpl = 'cfCities.row';
$city_id = $_COOKIE['city_id'];

$q = $modx->newQuery('cfCity');
$q->where(array('active' => 1));
$q->sortby('id', 'ASC');
$cities = $modx->getCollection('cfCity', $q);
$rows = '';
foreach ( $cities as $city ) {
	$row = $city->toArray();
	$row['selected'] = ( $city_id == $city->get('id') ) ? $selected : '';
	$rows .= $modx->getChunk($tpl, $row);
}

$modx->regClientScript($cityFields->config['jsUrl'].'web/cityselect.js');
return $modx->getChunk($tplWrapper, array('rows' => $rows));