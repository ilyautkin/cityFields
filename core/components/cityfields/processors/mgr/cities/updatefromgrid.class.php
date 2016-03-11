<?php

class cfCityUpdateFromGridProcessor extends modObjectUpdateProcessor {
	public $objectType = 'cfCity';
	public $classKey = 'cfCity';
	public $languageTopics = array('cityfields:default');

	/** {@inheritDoc} */
	public function initialize() {
		$data = $this->modx->fromJSON($this->getProperty('data'));
		if (empty($data) ) {
			return $this->modx->lexicon('invalid_data');
		}
		$this->setProperties($data);
		$this->unsetProperty('data');
		return parent::initialize();
	}

}
return 'cfCityUpdateFromGridProcessor';