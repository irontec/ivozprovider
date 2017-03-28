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
 * Table definition for ast_queues
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class AstQueues extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'ast_queues';

    /**
     * $_id - this is the primary key name
     *
     * @var string
     */
    protected $_id = 'name';

    protected $_rowClass = 'IvozProvider\\Model\\AstQueues';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\AstQueues';

    protected $_sequence = true; // string
    protected $_referenceMap = array(
        'AstQueuesIbfk1' => array(
            'columns' => 'queueId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Queues',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'name' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'name',
	    'COLUMN_POSITION' => 1,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '128',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => true,
	    'PRIMARY_POSITION' => 1,
	    'IDENTITY' => false,
	  ),
	  'periodic_announce' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'periodic_announce',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '128',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'periodic_announce_frequency' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'periodic_announce_frequency',
	    'COLUMN_POSITION' => 3,
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
	  'timeout' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'timeout',
	    'COLUMN_POSITION' => 4,
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
	  'autopause' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'autopause',
	    'COLUMN_POSITION' => 5,
	    'DATA_TYPE' => 'enum(\'yes\',\'no\',\'all\')',
	    'DEFAULT' => 'no',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'ringinuse' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'ringinuse',
	    'COLUMN_POSITION' => 6,
	    'DATA_TYPE' => 'enum(\'yes\',\'no\')',
	    'DEFAULT' => 'no',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'wrapuptime' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'wrapuptime',
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
	  'maxlen' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'maxlen',
	    'COLUMN_POSITION' => 8,
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
	  'strategy' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'strategy',
	    'COLUMN_POSITION' => 9,
	    'DATA_TYPE' => 'enum(\'ringall\',\'leastrecent\',\'fewestcalls\',\'random\',\'rrmemory\',\'linear\',\'wrandom\',\'rrordered\')',
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
	  'weight' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'weight',
	    'COLUMN_POSITION' => 10,
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
	  'queueId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_queues',
	    'COLUMN_NAME' => 'queueId',
	    'COLUMN_POSITION' => 11,
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
