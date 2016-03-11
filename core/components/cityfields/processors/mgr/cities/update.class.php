<?php

class cfCityUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'cfCity';
	public $classKey = 'cfCity';
	public $languageTopics = array('cityfields:default');

	/**
	 * @return bool
	 */
	public function beforeSet() {
		$required = array('key','name');
		foreach ($required as $tmp) {
			if (!$this->getProperty($tmp)) {
				$this->addFieldError($tmp, $this->modx->lexicon('field_required'));
			}
		}
		$active = $this->getProperty('active');
		$this->setProperty('active', !empty($active) && $active != 'false');
		return !$this->hasErrors();
	}

}

return 'cfCityUpdateProcessor';