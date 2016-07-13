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
 * Table definition for RoutingPatternGroupsRelPatterns
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class RoutingPatternGroupsRelPatterns extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'RoutingPatternGroupsRelPatterns';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\RoutingPatternGroupsRelPatterns';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\RoutingPatternGroupsRelPatterns';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'RoutingPatternGroupsRelPatternsIbfk1' => array(
            'columns' => 'routingPatternId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\RoutingPatterns',
            'refColumns' => 'id'
        ),
        'RoutingPatternGroupsRelPatternsIbfk2' => array(
            'columns' => 'routingPatternGroupId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\RoutingPatternGroups',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'RoutingPatternGroupsRelPatterns',
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
	  'routingPatternId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'RoutingPatternGroupsRelPatterns',
	    'COLUMN_NAME' => 'routingPatternId',
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
	  'routingPatternGroupId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'RoutingPatternGroupsRelPatterns',
	    'COLUMN_NAME' => 'routingPatternGroupId',
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
