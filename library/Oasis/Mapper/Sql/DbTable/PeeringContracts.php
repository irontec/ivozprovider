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
 * Table definition for PeeringContracts
 *
 * @package Oasis\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace Oasis\Mapper\Sql\DbTable;
class PeeringContracts extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'PeeringContracts';

    /**
     * $_id - this is the primary key name
     *
     * @var binary
     */
    protected $_id = 'id';

    protected $_rowClass = 'Oasis\\Model\\PeeringContracts';
    protected $_rowMapperClass = 'Oasis\\Mapper\\Sql\\PeeringContracts';

    protected $_sequence = true; // binary
    protected $_referenceMap = array(
        'PeeringContractsIbfk2' => array(
            'columns' => 'transformationRulesetGroupsTrunksId',
            'refTableClass' => 'Oasis\\Mapper\\Sql\\DbTable\\TransformationRulesetGroupsTrunks',
            'refColumns' => 'id'
        ),
        'PeeringContractsIbfk1' => array(
            'columns' => 'brandId',
            'refTableClass' => 'Oasis\\Mapper\\Sql\\DbTable\\Brands',
            'refColumns' => 'id'
        )
    );
    protected $_dependentTables = array(
        'Oasis\\Mapper\\Sql\\DbTable\\PeerServers',
        'Oasis\\Mapper\\Sql\\DbTable\\PeeringContractsRelLcrRules',
        'Oasis\\Mapper\\Sql\\DbTable\\KamTrunksUacreg'
    );
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'PeeringContracts',
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
	  'brandId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'PeeringContracts',
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
	  'description' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'PeeringContracts',
	    'COLUMN_NAME' => 'description',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => '',
	    'NULLABLE' => false,
	    'LENGTH' => '500',
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
	    'TABLE_NAME' => 'PeeringContracts',
	    'COLUMN_NAME' => 'name',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => '',
	    'NULLABLE' => false,
	    'LENGTH' => '200',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'transformationRulesetGroupsTrunksId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'PeeringContracts',
	    'COLUMN_NAME' => 'transformationRulesetGroupsTrunksId',
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
