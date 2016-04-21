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
 * Table definition for OutgoingRouting
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class OutgoingRouting extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'OutgoingRouting';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\OutgoingRouting';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\OutgoingRouting';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'OutgoingRoutingIbfk1' => array(
            'columns' => 'brandId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Brands',
            'refColumns' => 'id'
        ),
        'OutgoingRoutingIbfk2' => array(
            'columns' => 'companyId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Companies',
            'refColumns' => 'id'
        ),
        'OutgoingRoutingIbfk3' => array(
            'columns' => 'targetPatternId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\TargetPatterns',
            'refColumns' => 'id'
        ),
        'OutgoingRoutingIbfk4' => array(
            'columns' => 'targetGroupId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\TargetGroups',
            'refColumns' => 'id'
        ),
        'OutgoingRoutingIbfk5' => array(
            'columns' => 'peeringContractId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\PeeringContracts',
            'refColumns' => 'id'
        )
    );
    protected $_dependentTables = array(
        'IvozProvider\\Mapper\\Sql\\DbTable\\LcrRuleTarget',
        'IvozProvider\\Mapper\\Sql\\DbTable\\LcrRules'
    );
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingRouting',
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
	  'type' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingRouting',
	    'COLUMN_NAME' => 'type',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'enum(\'pattern\',\'group\')',
	    'DEFAULT' => 'group',
	    'NULLABLE' => true,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'targetPatternId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingRouting',
	    'COLUMN_NAME' => 'targetPatternId',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'int',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'targetGroupId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingRouting',
	    'COLUMN_NAME' => 'targetGroupId',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'int',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'peeringContractId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingRouting',
	    'COLUMN_NAME' => 'peeringContractId',
	    'COLUMN_POSITION' => 5,
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
	  'priority' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingRouting',
	    'COLUMN_NAME' => 'priority',
	    'COLUMN_POSITION' => 6,
	    'DATA_TYPE' => 'tinyint',
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
	  'weight' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingRouting',
	    'COLUMN_NAME' => 'weight',
	    'COLUMN_POSITION' => 7,
	    'DATA_TYPE' => 'int',
	    'DEFAULT' => '1',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'companyId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingRouting',
	    'COLUMN_NAME' => 'companyId',
	    'COLUMN_POSITION' => 8,
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
	  'brandId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingRouting',
	    'COLUMN_NAME' => 'brandId',
	    'COLUMN_POSITION' => 9,
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
