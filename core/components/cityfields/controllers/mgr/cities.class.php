<?php
require_once dirname(dirname(dirname(__FILE__))) . '/index.class.php';

class ControllersCitiesManagerController extends cityFieldsMainController {
	public static function getDefaultController() {
		return 'cities';
	}
}

class CityfieldsCitiesManagerController extends cityFieldsMainController {

	public function getPageTitle() {
		return 'cityFields :: ' . $this->modx->lexicon('cityfields_page');
	}
	
	public function getLanguageTopics() {
		return array('cityfields:manager');
	}

	public function loadCustomCssJs() {
		$this->addLastJavascript($this->cityFields->config['jsUrl'] . 'mgr/cityfields.panel.js');
		$this->addLastJavascript($this->cityFields->config['jsUrl'] . 'mgr/cities.grid.js');
		$this->addLastJavascript($this->cityFields->config['jsUrl'] . 'mgr/fields.grid.js');

		$this->addHtml(str_replace('			', '', '
			<script type="text/javascript">
				Ext.onReady(function() {
					MODx.load({xtype: "cityfields-page-cities"});
				});
			</script>'
		));

		$this->modx->invokeEvent('msOnManagerCustomCssJs', array('controller' => &$this, 'page' => 'cities'));
	}

	public function getTemplateFile() {
		return $this->cityFields->config['templatesPath'] . 'cities.tpl';
	}

}

// MODX 2.3
class ControllersMgrCitiesManagerController extends ControllersCitiesManagerController {
	public static function getDefaultController() {
		return 'mgr/cities';
	}
}

class CityfieldsMgrCitiesManagerController extends CityfieldsCitiesManagerController {
}