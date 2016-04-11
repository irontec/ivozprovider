<?php

/**
 * Application Model DbTables
 *
 * @package Oasis\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Table definition for HolidayDates
 *
 * @package Oasis\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace Oasis\Mapper\Sql\DbTable;
class HolidayDates extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'HolidayDates';

    /**
     * $_id - this is the primary key name
     *
     * @var binary
     */
    protected $_id = 'id';

    protected $_rowClass = 'Oasis\\Model\\HolidayDates';
    protected $_rowMapperClass = 'Oasis\\Mapper\\Sql\\HolidayDates';

    protected $_sequence = true; // binary
    protected $_referenceMap = array(
        'HolidayDatesIbfk2' => array(
            'columns' => 'locutionId',
            'refTableClass' => 'Oasis\\Mapper\\Sql\\DbTable\\Locutions',
            'refColumns' => 'id'
        ),
        'HolidayDatesIbfk1' => array(
            'columns' => 'calendarId',
            'refTableClass' => 'Oasis\\Mapper\\Sql\\DbTable\\Calendars',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'HolidayDates',
	    'COLUMN_NAME' => 'id',
	    'COLUMN_POSITION' => 1,
	    'DATA_TYPE' => 'binary(36)',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => true,
	    'PRIMARY_POSITION' => 1,
	    'IDENTITY' => false,
	  ),
	  'calendarId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'HolidayDates',
	    'COLUMN_NAME' => 'calendarId',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'binary(36)',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'name' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'HolidayDates',
	    'COLUMN_NAME' => 'name',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '50',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'eventDate' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'HolidayDates',
	    'COLUMN_NAME' => 'eventDate',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'date',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'locutionId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'HolidayDates',
	    'COLUMN_NAME' => 'locutionId',
	    'COLUMN_POSITION' => 5,
	    'DATA_TYPE' => 'binary(36)',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
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
