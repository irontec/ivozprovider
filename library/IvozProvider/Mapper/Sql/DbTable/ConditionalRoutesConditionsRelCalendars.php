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
 * Table definition for ConditionalRoutesConditionsRelCalendars
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class ConditionalRoutesConditionsRelCalendars extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'ConditionalRoutesConditionsRelCalendars';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\ConditionalRoutesConditionsRelCalendars';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\ConditionalRoutesConditionsRelCalendars';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'ConditionalRoutesConditionsRelCalendarsIbfk1' => array(
            'columns' => 'conditionId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\ConditionalRoutesConditions',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsRelCalendarsIbfk2' => array(
            'columns' => 'calendarId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Calendars',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditionsRelCalendars',
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
	    'TABLE_NAME' => 'ConditionalRoutesConditionsRelCalendars',
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
	  'calendarId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditionsRelCalendars',
	    'COLUMN_NAME' => 'calendarId',
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
