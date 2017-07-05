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
 * Table definition for Users
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class Users extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'Users';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\Users';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\Users';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'UsersIbfk1' => array(
            'columns' => 'companyId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Companies',
            'refColumns' => 'id'
        ),
        'UsersIbfk3' => array(
            'columns' => 'terminalId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Terminals',
            'refColumns' => 'id'
        ),
        'UsersIbfk7' => array(
            'columns' => 'extensionId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Extensions',
            'refColumns' => 'id'
        ),
        'UsersIbfk8' => array(
            'columns' => 'timezoneId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Timezones',
            'refColumns' => 'id'
        ),
        'UsersIbfk9' => array(
            'columns' => 'outgoingDDIId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\DDIs',
            'refColumns' => 'id'
        ),
        'UsersIbfk10' => array(
            'columns' => 'callACLId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\CallACL',
            'refColumns' => 'id'
        ),
        'UsersIbfk11' => array(
            'columns' => 'bossAssistantId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Users',
            'refColumns' => 'id'
        ),
        'UsersIbfk12' => array(
            'columns' => 'countryId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Countries',
            'refColumns' => 'id'
        ),
        'UsersIbfk13' => array(
            'columns' => 'languageId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Languages',
            'refColumns' => 'id'
        ),
        'UsersIbfk14' => array(
            'columns' => 'outgoingDDIRuleId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\OutgoingDDIRules',
            'refColumns' => 'id'
        )
    );
    protected $_dependentTables = array(
        'IvozProvider\\Mapper\\Sql\\DbTable\\CallForwardSettings',
        'IvozProvider\\Mapper\\Sql\\DbTable\\CallForwardSettings',
        'IvozProvider\\Mapper\\Sql\\DbTable\\DDIs',
        'IvozProvider\\Mapper\\Sql\\DbTable\\Extensions',
        'IvozProvider\\Mapper\\Sql\\DbTable\\ExternalCallFilters',
        'IvozProvider\\Mapper\\Sql\\DbTable\\ExternalCallFilters',
        'IvozProvider\\Mapper\\Sql\\DbTable\\HuntGroups',
        'IvozProvider\\Mapper\\Sql\\DbTable\\HuntGroupsRelUsers',
        'IvozProvider\\Mapper\\Sql\\DbTable\\IVRCommon',
        'IvozProvider\\Mapper\\Sql\\DbTable\\IVRCommon',
        'IvozProvider\\Mapper\\Sql\\DbTable\\IVRCustom',
        'IvozProvider\\Mapper\\Sql\\DbTable\\IVRCustom',
        'IvozProvider\\Mapper\\Sql\\DbTable\\IVRCustomEntries',
        'IvozProvider\\Mapper\\Sql\\DbTable\\PickUpRelUsers',
        'IvozProvider\\Mapper\\Sql\\DbTable\\QueueMembers',
        'IvozProvider\\Mapper\\Sql\\DbTable\\Queues',
        'IvozProvider\\Mapper\\Sql\\DbTable\\Queues',
        'IvozProvider\\Mapper\\Sql\\DbTable\\Users',
        'IvozProvider\\Mapper\\Sql\\DbTable\\AstVoicemail'
    );
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
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
	  'companyId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'companyId',
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
	  'name' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'name',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '100',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'lastname' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'lastname',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '100',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'email' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'email',
	    'COLUMN_POSITION' => 5,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '100',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'pass' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'pass',
	    'COLUMN_POSITION' => 6,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '80',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'timezoneId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'timezoneId',
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
	  'terminalId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'terminalId',
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
	  'extensionId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'extensionId',
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
	  'outgoingDDIId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'outgoingDDIId',
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
	  'outgoingDDIRuleId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'outgoingDDIRuleId',
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
	  'callACLId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'callACLId',
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
	  'doNotDisturb' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'doNotDisturb',
	    'COLUMN_POSITION' => 13,
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
	  'isBoss' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'isBoss',
	    'COLUMN_POSITION' => 14,
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
	  'bossAssistantId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'bossAssistantId',
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
	  'exceptionBoosAssistantRegExp' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'exceptionBoosAssistantRegExp',
	    'COLUMN_POSITION' => 16,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '255',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'active' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'active',
	    'COLUMN_POSITION' => 17,
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
	  'maxCalls' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'maxCalls',
	    'COLUMN_POSITION' => 18,
	    'DATA_TYPE' => 'smallint',
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
	  'externalIpCalls' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'externalIpCalls',
	    'COLUMN_POSITION' => 19,
	    'DATA_TYPE' => 'tinyint',
	    'DEFAULT' => '0',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'voicemailEnabled' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'voicemailEnabled',
	    'COLUMN_POSITION' => 20,
	    'DATA_TYPE' => 'tinyint',
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
	  'voicemailSendMail' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'voicemailSendMail',
	    'COLUMN_POSITION' => 21,
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
	  'voicemailAttachSound' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'voicemailAttachSound',
	    'COLUMN_POSITION' => 22,
	    'DATA_TYPE' => 'tinyint',
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
	  'tokenKey' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'tokenKey',
	    'COLUMN_POSITION' => 23,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '125',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'countryId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'countryId',
	    'COLUMN_POSITION' => 24,
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
	  'languageId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'languageId',
	    'COLUMN_POSITION' => 25,
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
	  'areaCode' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Users',
	    'COLUMN_NAME' => 'areaCode',
	    'COLUMN_POSITION' => 26,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '10',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	);




}
