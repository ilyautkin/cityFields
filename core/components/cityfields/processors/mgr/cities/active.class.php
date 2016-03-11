<?php

class cfCityActiveProcessor extends modProcessor {
	public $classKey = 'cfCity';

	/** {inheritDoc} */
	public function process() {
		if (!$ids = explode(',', $this->getProperty('ids'))) {
			return $this->failure($this->modx->lexicon('cityfields_err_ns'));
		}
		$active = $this->getProperty('active');
		$items = $this->modx->getIterator($this->classKey, array('id:IN' => $ids));
		foreach ($items as $item) {
			$item->set('active', $active);
			$item->save();
		}
		return $this->success();
	}

}

return 'cfCityActiveProcessor';