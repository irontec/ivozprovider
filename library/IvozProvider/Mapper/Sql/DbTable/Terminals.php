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
 * Table definition for Terminals
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class Terminals extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'Terminals';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\Terminals';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\Terminals';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'TerminalsCompanyIdIbfk2' => array(
            'columns' => 'companyId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Companies',
            'refColumns' => 'id'
        ),
        'TerminalsIbfk1' => array(
            'columns' => 'TerminalModelId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\TerminalModels',
            'refColumns' => 'id'
        )
    );
    protected $_dependentTables = array(
        'IvozProvider\\Mapper\\Sql\\DbTable\\Users',
        'IvozProvider\\Mapper\\Sql\\DbTable\\AstPsEndpoints'
    );
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
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
	  'TerminalModelId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'TerminalModelId',
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
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'name',
	    'COLUMN_POSITION' => 3,
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
	  'disallow' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'disallow',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => 'all',
	    'NULLABLE' => false,
	    'LENGTH' => '200',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'allow' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'allow',
	    'COLUMN_POSITION' => 5,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => 'alaw',
	    'NULLABLE' => false,
	    'LENGTH' => '200',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'direct_media' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'direct_media',
	    'COLUMN_POSITION' => 6,
	    'DATA_TYPE' => 'enum(\'yes\',\'no\')',
	    'DEFAULT' => 'yes',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'direct_media_method' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'direct_media_method',
	    'COLUMN_POSITION' => 7,
	    'DATA_TYPE' => 'enum(\'invite\',\'reinvite\',\'update\')',
	    'DEFAULT' => 'update',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'dtmf_mode' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'dtmf_mode',
	    'COLUMN_POSITION' => 8,
	    'DATA_TYPE' => 'enum(\'rfc4733\',\'inband\',\'info\')',
	    'DEFAULT' => 'rfc4733',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'password' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'password',
	    'COLUMN_POSITION' => 9,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => '',
	    'NULLABLE' => false,
	    'LENGTH' => '25',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'companyId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'companyId',
	    'COLUMN_POSITION' => 10,
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
	  'mac' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'mac',
	    'COLUMN_POSITION' => 11,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '12',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'lastProvisionDate' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Terminals',
	    'COLUMN_NAME' => 'lastProvisionDate',
	    'COLUMN_POSITION' => 12,
	    'DATA_TYPE' => 'timestamp',
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
