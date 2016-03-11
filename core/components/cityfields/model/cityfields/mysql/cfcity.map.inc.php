<?php
$xpdo_meta_map['cfCity']= array (
  'package' => 'cityfields',
  'version' => '1.1',
  'table' => 'cf_cities',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'id' => NULL,
    'key' => NULL,
    'name' => NULL,
    'active' => NULL,
  ),
  'fieldMeta' => 
  array (
    'id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '30',
      'phptype' => 'string',
      'null' => false,
    ),
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
    'active' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'null' => false,
    ),
  ),
  'composites' => 
  array (
    'Fields' => 
    array (
      'class' => 'cfFields',
      'local' => 'id',
      'foreign' => 'city_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
