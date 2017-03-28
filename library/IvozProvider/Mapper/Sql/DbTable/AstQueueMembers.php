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
 * Table definition for ast_queue_members
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class AstQueueMembers extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'ast_queue_members';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'uniqueid';

    protected $_rowClass = 'IvozProvider\\Model\\AstQueueMembers';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\AstQueueMembers';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'AstQueueMembersIbfk1' => array(
            'columns' => 'queueMemberId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\QueueMembers',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'uniqueid' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queue_members',
	    'COLUMN_NAME' => 'uniqueid',
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
	    'IDENTITY' => false,
	  ),
	  'queue_name' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queue_members',
	    'COLUMN_NAME' => 'queue_name',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '80',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'interface' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queue_members',
	    'COLUMN_NAME' => 'interface',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '80',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'membername' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queue_members',
	    'COLUMN_NAME' => 'membername',
	    'COLUMN_POSITION' => 4,
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
	  'state_interface' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queue_members',
	    'COLUMN_NAME' => 'state_interface',
	    'COLUMN_POSITION' => 5,
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
	  'penalty' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queue_members',
	    'COLUMN_NAME' => 'penalty',
	    'COLUMN_POSITION' => 6,
	    'DATA_TYPE' => 'int',
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
	  'paused' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queue_members',
	    'COLUMN_NAME' => 'paused',
	    'COLUMN_POSITION' => 7,
	    'DATA_TYPE' => 'int',
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
	  'queueMemberId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queue_members',
	    'COLUMN_NAME' => 'queueMemberId',
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
	);




}
