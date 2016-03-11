<?php

class cfFieldUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'cfField';
	public $classKey = 'cfField';
	public $languageTopics = array('cityfields:default');

	/**
	 * @return bool
	 */
	public function beforeSet() {
		$required = array('city_id','placeholder');
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

return 'cfFieldUpdateProcessor';