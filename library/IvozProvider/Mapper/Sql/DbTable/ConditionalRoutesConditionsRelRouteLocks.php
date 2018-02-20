<?php

/**
 * Application Model DbTables
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Table definition for ConditionalRoutesConditionsRelRouteLocks
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class ConditionalRoutesConditionsRelRouteLocks extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'ConditionalRoutesConditionsRelRouteLocks';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\ConditionalRoutesConditionsRelRouteLocks';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\ConditionalRoutesConditionsRelRouteLocks';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'ConditionalRoutesConditionsRelRouteLocksIbfk1' => array(
            'columns' => 'conditionId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\ConditionalRoutesConditions',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsRelRouteLocksIbfk2' => array(
            'columns' => 'routeLockId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\RouteLocks',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditionsRelRouteLocks',
	    'COLUMN_NAME' => 'id',
	    'COLUMN_POSITION' => 1,
	    'DATA_TYPE' => 'int',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => true,
	    'PRIMARY_POSITION' => 1,
	    'IDENTITY' => true,
	  ),
	  'conditionId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditionsRelRouteLocks',
	    'COLUMN_NAME' => 'conditionId',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'int',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'routeLockId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditionsRelRouteLocks',
	    'COLUMN_NAME' => 'routeLockId',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'int',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	);




}
