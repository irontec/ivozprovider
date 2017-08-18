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
 * Table definition for ConditionalRoutesConditions
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class ConditionalRoutesConditions extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'ConditionalRoutesConditions';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\ConditionalRoutesConditions';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\ConditionalRoutesConditions';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'ConditionalRoutesConditionsIbfk1' => array(
            'columns' => 'conditionalRouteId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\ConditionalRoutes',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsIbfk2' => array(
            'columns' => 'IVRCommonId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\IVRCommon',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsIbfk3' => array(
            'columns' => 'IVRCustomId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\IVRCustom',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsIbfk4' => array(
            'columns' => 'huntGroupId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\HuntGroups',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsIbfk5' => array(
            'columns' => 'voiceMailUserId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Users',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsIbfk6' => array(
            'columns' => 'userId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Users',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsIbfk7' => array(
            'columns' => 'queueId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Queues',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsIbfk8' => array(
            'columns' => 'locutionId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Locutions',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsIbfk9' => array(
            'columns' => 'conferenceRoomId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\ConferenceRooms',
            'refColumns' => 'id'
        ),
        'ConditionalRoutesConditionsIbfk10' => array(
            'columns' => 'extensionId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Extensions',
            'refColumns' => 'id'
        )
    );
    protected $_dependentTables = array(
        'IvozProvider\\Mapper\\Sql\\DbTable\\ConditionalRoutesConditionsRelCalendars',
        'IvozProvider\\Mapper\\Sql\\DbTable\\ConditionalRoutesConditionsRelMatchLists',
        'IvozProvider\\Mapper\\Sql\\DbTable\\ConditionalRoutesConditionsRelSchedules'
    );
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
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
	  'conditionalRouteId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'conditionalRouteId',
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
	  'priority' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'priority',
	    'COLUMN_POSITION' => 3,
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
	  'locutionId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'locutionId',
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
	  'routeType' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'routeType',
	    'COLUMN_POSITION' => 5,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '25',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'IVRCommonId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'IVRCommonId',
	    'COLUMN_POSITION' => 6,
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
	  'IVRCustomId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'IVRCustomId',
	    'COLUMN_POSITION' => 7,
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
	  'huntGroupId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'huntGroupId',
	    'COLUMN_POSITION' => 8,
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
	  'voiceMailUserId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'voiceMailUserId',
	    'COLUMN_POSITION' => 9,
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
	  'userId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'userId',
	    'COLUMN_POSITION' => 10,
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
	  'numberValue' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'numberValue',
	    'COLUMN_POSITION' => 11,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '25',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'friendValue' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'friendValue',
	    'COLUMN_POSITION' => 12,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '25',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'queueId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'queueId',
	    'COLUMN_POSITION' => 13,
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
	  'conferenceRoomId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'conferenceRoomId',
	    'COLUMN_POSITION' => 14,
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
	  'extensionId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ConditionalRoutesConditions',
	    'COLUMN_NAME' => 'extensionId',
	    'COLUMN_POSITION' => 15,
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
	);




}
