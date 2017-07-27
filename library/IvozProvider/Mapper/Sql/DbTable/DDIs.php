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
 * Table definition for DDIs
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class DDIs extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'DDIs';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\DDIs';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\DDIs';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'DDIsIbfk1' => array(
            'columns' => 'companyId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Companies',
            'refColumns' => 'id'
        ),
        'DDIsIbfk2' => array(
            'columns' => 'externalCallFilterId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\ExternalCallFilters',
            'refColumns' => 'id'
        ),
        'DDIsIbfk3' => array(
            'columns' => 'userId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Users',
            'refColumns' => 'id'
        ),
        'DDIsIbfk4' => array(
            'columns' => 'IVRCommonId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\IVRCommon',
            'refColumns' => 'id'
        ),
        'DDIsIbfk5' => array(
            'columns' => 'IVRCustomId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\IVRCustom',
            'refColumns' => 'id'
        ),
        'DDIsIbfk6' => array(
            'columns' => 'huntGroupId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\HuntGroups',
            'refColumns' => 'id'
        ),
        'DDIsIbfk7' => array(
            'columns' => 'faxId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Faxes',
            'refColumns' => 'id'
        ),
        'DDIsIbfk8' => array(
            'columns' => 'peeringContractId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\PeeringContracts',
            'refColumns' => 'id'
        ),
        'DDIsIbfk9' => array(
            'columns' => 'countryId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Countries',
            'refColumns' => 'id'
        ),
        'DDIsIbfk10' => array(
            'columns' => 'brandId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Brands',
            'refColumns' => 'id'
        ),
        'DDIsIbfk11' => array(
            'columns' => 'conferenceRoomId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\ConferenceRooms',
            'refColumns' => 'id'
        ),
        'DDIsIbfk12' => array(
            'columns' => 'languageId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Languages',
            'refColumns' => 'id'
        ),
        'DDIsIbfk13' => array(
            'columns' => 'queueId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Queues',
            'refColumns' => 'id'
        ),
        'DDIsIbfk14' => array(
            'columns' => 'retailAccountId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\RetailAccounts',
            'refColumns' => 'id'
        )
    );
    protected $_dependentTables = array(
        'IvozProvider\\Mapper\\Sql\\DbTable\\Companies',
        'IvozProvider\\Mapper\\Sql\\DbTable\\Faxes',
        'IvozProvider\\Mapper\\Sql\\DbTable\\Friends',
        'IvozProvider\\Mapper\\Sql\\DbTable\\OutgoingDDIRules',
        'IvozProvider\\Mapper\\Sql\\DbTable\\OutgoingDDIRulesPatterns',
        'IvozProvider\\Mapper\\Sql\\DbTable\\RetailAccounts',
        'IvozProvider\\Mapper\\Sql\\DbTable\\Users'
    );
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
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
	  'brandId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'brandId',
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
	  'companyId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'companyId',
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
	  'DDI' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'DDI',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '25',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'DDIE164' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'DDIE164',
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
	  'externalCallFilterId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'externalCallFilterId',
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
	  'recordCalls' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'recordCalls',
	    'COLUMN_POSITION' => 7,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => 'none',
	    'NULLABLE' => false,
	    'LENGTH' => '25',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'displayName' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'displayName',
	    'COLUMN_POSITION' => 8,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '50',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'routeType' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'routeType',
	    'COLUMN_POSITION' => 9,
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
	  'userId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
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
	  'IVRCommonId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'IVRCommonId',
	    'COLUMN_POSITION' => 11,
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
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'IVRCustomId',
	    'COLUMN_POSITION' => 12,
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
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'huntGroupId',
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
	  'faxId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'faxId',
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
	  'conferenceRoomId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'conferenceRoomId',
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
	  'retailAccountId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'retailAccountId',
	    'COLUMN_POSITION' => 16,
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
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'peeringContractId',
	    'COLUMN_POSITION' => 17,
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
	  'countryId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'countryId',
	    'COLUMN_POSITION' => 18,
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
	  'billInboundCalls' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'billInboundCalls',
	    'COLUMN_POSITION' => 19,
	    'DATA_TYPE' => 'tinyint',
	    'DEFAULT' => '0',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'friendValue' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'friendValue',
	    'COLUMN_POSITION' => 20,
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
	  'languageId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'languageId',
	    'COLUMN_POSITION' => 21,
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
	  'queueId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'DDIs',
	    'COLUMN_NAME' => 'queueId',
	    'COLUMN_POSITION' => 22,
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
