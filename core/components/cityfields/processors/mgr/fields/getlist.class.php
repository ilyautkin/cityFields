<?php

class cfFieldGetListProcessor extends modObjectGetListProcessor {
	public $classKey = 'cfField';
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

return 'cfFieldGetListProcessor';