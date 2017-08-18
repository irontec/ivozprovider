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
 * Table definition for ConditionalRoutesConditionsRelMatchLists
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class ConditionalRoutesConditionsRelMatchLists extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'ConditionalRoutesConditionsRelMatchLists';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\ConditionalRoutesConditionsRelMatchLists';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\ConditionalRoutesConditionsRelMatchLists';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'ConditionalRoutesConditionsRelMatchListsIbfk1' => array(
            'columns' => 'conditionId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\ConditionalRoutesConditions',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsRelMatchListsIbfk2' => array(
            'columns' => 'matchListId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\MatchLists',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditionsRelMatchLists',
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
	    'TABLE_NAME' => 'ConditionalRoutesConditionsRelMatchLists',
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
	  'matchListId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditionsRelMatchLists',
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
	);




}
