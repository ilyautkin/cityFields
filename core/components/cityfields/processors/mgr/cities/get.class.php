<?php

class cfCityGetProcessor extends modObjectGetProcessor {
	public $objectType = 'cfCity';
	public $classKey = 'cfCity';
	public $languageTopics = array('cityfields:default');

	/** {inheritDoc} */
	public function cleanup() {
		$array = $this->object->toArray('', true);
		return $this->success('', $array);
	}

}

return 'cfCityGetProcessor';
