<?php

class cfFieldGetProcessor extends modObjectGetProcessor {
	public $objectType = 'cfField';
	public $classKey = 'cfField';
	public $languageTopics = array('cityfields:default');

	/** {inheritDoc} */
	public function cleanup() {
		$array = $this->object->toArray('', true);
		return $this->success('', $array);
	}

}

return 'cfFieldGetProcessor';
