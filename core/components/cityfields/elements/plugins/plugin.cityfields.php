<?php
if (!$modx->getOption('cityfields_active')) return false;

$cityFields = $modx->getService('cityfields','cityFields',$modx->getOption('cityfields_core_path',null,$modx->getOption('core_path').'components/cityfields/').'model/cityfields/',$scriptProperties);
if (!($cityFields instanceof cityFields)) return false;

switch($modx->event->name) {

	case 'OnWebPageInit':
		$prefix = $modx->getOption('cityfields_prefix', $config, 'cf.');
		$city_id = $_COOKIE['city_id'];
		if ( empty($city_id) ) {
			$q = $modx->newQuery('cfCity');
			$q->sortby('id', 'ASC');
			$q->limit(1);
			$city = $modx->getObject('cfCity', $q);
			$city_id = $city->get('id');
			setcookie('city_id', $city_id, 31536000, '/');
		}

		$q = $modx->newQuery('cfField');
		$q->where(array('city_id' => $city_id));
		$fields = $modx->getCollection('cfField', $q);
		$placeholders = array();
		foreach ( $fields as $field ) {
			$placeholders[$field->get('placeholder')] = $field->get('value');
		}
		$modx->setPlaceholders($placeholders, $prefix);
		break;

}