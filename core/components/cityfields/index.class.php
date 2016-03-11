<?php

require_once dirname(__FILE__) . '/model/cityfields/cityfields.class.php';

abstract class cityFieldsMainController extends modExtraManagerController {
	/** @var cityFields $cityfields */
	public $cityFields;


	public function initialize() {
		$this->cityFields = new cityFields($this->modx);

		$this->addJavaScript($this->cityFields->config['jsUrl'] . 'mgr/cityfields.js');
		$this->addHtml(str_replace('		', '', '
		<script type="text/javascript">
			cityFields.config = ' . $this->modx->toJSON($this->cityFields->config) . ';
			cityFields.config.connector_url = "' . $this->cityFields->config['connectorUrl'] . '";
		</script>'));

		parent::initialize();
	}


	public function getLanguageTopics() {
		return array('cityfields:default');
	}


	public function checkPermissions() {
		return true;
	}
}


/**
 * @package quip
 * @subpackage controllers
 */
class IndexManagerController extends cityFieldsMainController {
	public static function getDefaultController() {
		return 'mgr/cities';
	}
}
