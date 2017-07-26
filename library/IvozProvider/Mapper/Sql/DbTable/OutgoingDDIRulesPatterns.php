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
 * Table definition for OutgoingDDIRulesPatterns
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class OutgoingDDIRulesPatterns extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'OutgoingDDIRulesPatterns';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\OutgoingDDIRulesPatterns';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\OutgoingDDIRulesPatterns';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'OutgoingDDIRulesPatternsIbfk1' => array(
            'columns' => 'outgoingDDIRuleId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\OutgoingDDIRules',
            'refColumns' => 'id'
        ),
        'OutgoingDDIRulesPatternsIbfk2' => array(
            'columns' => 'matchListId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\MatchLists',
            'refColumns' => 'id'
        ),
        'OutgoingDDIRulesPatternsIbfk3' => array(
            'columns' => 'forcedDDIId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\DDIs',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingDDIRulesPatterns',
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
	  'outgoingDDIRuleId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingDDIRulesPatterns',
	    'COLUMN_NAME' => 'outgoingDDIRuleId',
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
	  'matchListId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingDDIRulesPatterns',
	    'COLUMN_NAME' => 'matchListId',
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
	  'action' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingDDIRulesPatterns',
	    'COLUMN_NAME' => 'action',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '10',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'forcedDDIId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingDDIRulesPatterns',
	    'COLUMN_NAME' => 'forcedDDIId',
	    'COLUMN_POSITION' => 5,
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
	  'priority' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'OutgoingDDIRulesPatterns',
	    'COLUMN_NAME' => 'priority',
	    'COLUMN_POSITION' => 6,
	    'DATA_TYPE' => 'smallint',
	    'DEFAULT' => '1',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	);




}
