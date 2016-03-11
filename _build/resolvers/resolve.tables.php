<?php

if ($object->xpdo) {
	/* @var modX $modx */
	$modx =& $object->xpdo;

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
		case xPDOTransport::ACTION_UPGRADE:

			$modelPath = $modx->getOption('cityfields_core_path',null,$modx->getOption('core_path').'components/cityfields/').'model/';
			$modx->addPackage('cityfields',$modelPath);
			$m = $modx->getManager();
			$m->createObjectContainer('cfCity');
			$m->createObjectContainer('cfField');

			break;

		case xPDOTransport::ACTION_UNINSTALL:
			break;
	}
}
return true;