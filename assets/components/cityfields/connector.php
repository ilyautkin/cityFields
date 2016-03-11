<?php

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('cityfields_core_path', null, $modx->getOption('core_path') . 'components/cityfields/');
require_once $corePath . 'model/cityfields/cityfields.class.php';
$modx->cityFields = new cityFields($modx);

$modx->lexicon->load(array('cityfields:default'));

/* handle request */
$path = $modx->getOption('processorsPath', $modx->cityFields->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));