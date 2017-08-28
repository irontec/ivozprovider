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
 * Table definition for ast_ps_endpoints
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class AstPsEndpoints extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'ast_ps_endpoints';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\AstPsEndpoints';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\AstPsEndpoints';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'AstPsEndpointsIbfk1' => array(
            'columns' => 'terminalId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Terminals',
            'refColumns' => 'id'
        ),
        'AstPsEndpointsIbfk2' => array(
            'columns' => 'friendId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Friends',
            'refColumns' => 'id'
        ),
        'AstPsEndpointsIbfk3' => array(
            'columns' => 'retailAccountId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\RetailAccounts',
            'refColumns' => 'id'
        )
    );
    protected $_dependentTables = array(
        'IvozProvider\\Mapper\\Sql\\DbTable\\AstPsAors'
    );
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
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
	  'sorcery_id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'sorcery_id',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '40',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'from_domain' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'from_domain',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '190',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'terminalId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'terminalId',
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
	  'friendId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'friendId',
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
	  'retailAccountId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'retailAccountId',
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
	  'aors' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'aors',
	    'COLUMN_POSITION' => 7,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '200',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'callerid' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'callerid',
	    'COLUMN_POSITION' => 8,
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
	  'context' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'context',
	    'COLUMN_POSITION' => 9,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => 'users',
	    'NULLABLE' => false,
	    'LENGTH' => '40',
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
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'disallow',
	    'COLUMN_POSITION' => 10,
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
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'allow',
	    'COLUMN_POSITION' => 11,
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
	  'direct_media' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'direct_media',
	    'COLUMN_POSITION' => 12,
	    'DATA_TYPE' => 'enum(\'yes\',\'no\')',
	    'DEFAULT' => 'yes',
	    'NULLABLE' => true,
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
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'direct_media_method',
	    'COLUMN_POSITION' => 13,
	    'DATA_TYPE' => 'enum(\'invite\',\'reinvite\',\'update\')',
	    'DEFAULT' => 'update',
	    'NULLABLE' => true,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'mailboxes' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'mailboxes',
	    'COLUMN_POSITION' => 14,
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
	  'pickup_group' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'pickup_group',
	    'COLUMN_POSITION' => 15,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '40',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'send_diversion' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'send_diversion',
	    'COLUMN_POSITION' => 16,
	    'DATA_TYPE' => 'enum(\'yes\',\'no\')',
	    'DEFAULT' => 'yes',
	    'NULLABLE' => true,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'send_pai' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'send_pai',
	    'COLUMN_POSITION' => 17,
	    'DATA_TYPE' => 'enum(\'yes\',\'no\')',
	    'DEFAULT' => 'yes',
	    'NULLABLE' => true,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  '100rel' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => '100rel',
	    'COLUMN_POSITION' => 18,
	    'DATA_TYPE' => 'enum(\'no\',\'required\',\'yes\')',
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
	  'outbound_proxy' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'outbound_proxy',
	    'COLUMN_POSITION' => 19,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '256',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'trust_id_inbound' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ast_ps_endpoints',
	    'COLUMN_NAME' => 'trust_id_inbound',
	    'COLUMN_POSITION' => 20,
	    'DATA_TYPE' => 'enum(\'yes\',\'no\')',
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
