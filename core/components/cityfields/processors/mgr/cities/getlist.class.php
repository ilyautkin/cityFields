<?php

class cfCityGetListProcessor extends modObjectGetListProcessor {
	public $classKey = 'cfCity';
	public $defaultSortField = 'id';
	public $defaultSortDirection  = 'ASC';

	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray('', true);
		return $array;
	}

}

return 'cfCityGetListProcessor';