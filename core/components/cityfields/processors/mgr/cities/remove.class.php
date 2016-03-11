<?php

class cfCityRemoveProcessor extends modProcessor {
	public $classKey = 'cfCity';

	/** {inheritDoc} */
	public function process() {
		if (!$ids = explode(',', $this->getProperty('ids'))) {
			return $this->failure($this->modx->lexicon('cityfields_err_ns'));
		}
		$items = $this->modx->getIterator($this->classKey, array('id:IN' => $ids));
		foreach ($items as $item) {
			$item->remove();
		}
		return $this->success();
	}

}

return 'cfCityRemoveProcessor';