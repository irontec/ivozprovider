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
 * Table definition for Brands
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Mapper\Sql\DbTable;
class Brands extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'Brands';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'IvozProvider\\Model\\Brands';
    protected $_rowMapperClass = 'IvozProvider\\Mapper\\Sql\\Brands';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'BrandsIbfk2' => array(
            'columns' => 'languageId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Languages',
            'refColumns' => 'id'
        ),
        'BrandsIbfk3' => array(
            'columns' => 'defaultTimezoneId',
            'refTableClass' => 'IvozProvider\\Mapper\\Sql\\DbTable\\Timezones',
            'refColumns' => 'id'
        )
    );
    protected $_dependentTables = array(
        'IvozProvider\\Mapper\\Sql\\DbTable\\BrandOperators',
        'IvozProvider\\Mapper\\Sql\\DbTable\\BrandServices',
        'IvozProvider\\Mapper\\Sql\\DbTable\\BrandURLs',
        'IvozProvider\\Mapper\\Sql\\DbTable\\Companies',
        'IvozProvider\\Mapper\\Sql\\DbTable\\DDIs',
        'IvozProvider\\Mapper\\Sql\\DbTable\\Domains',
        'IvozProvider\\Mapper\\Sql\\DbTable\\FeaturesRelBrands',
        'IvozProvider\\Mapper\\Sql\\DbTable\\FixedCosts',
        'IvozProvider\\Mapper\\Sql\\DbTable\\FixedCostsRelInvoices',
        'IvozProvider\\Mapper\\Sql\\DbTable\\GenericCallACLPatterns',
        'IvozProvider\\Mapper\\Sql\\DbTable\\GenericMusicOnHold',
        'IvozProvider\\Mapper\\Sql\\DbTable\\InvoiceTemplates',
        'IvozProvider\\Mapper\\Sql\\DbTable\\Invoices',
        'IvozProvider\\Mapper\\Sql\\DbTable\\OutgoingRouting',
        'IvozProvider\\Mapper\\Sql\\DbTable\\ParsedCDRs',
        'IvozProvider\\Mapper\\Sql\\DbTable\\PeerServers',
        'IvozProvider\\Mapper\\Sql\\DbTable\\PeeringContracts',
        'IvozProvider\\Mapper\\Sql\\DbTable\\PricingPlans',
        'IvozProvider\\Mapper\\Sql\\DbTable\\PricingPlansRelCompanies',
        'IvozProvider\\Mapper\\Sql\\DbTable\\PricingPlansRelTargetPatterns',
        'IvozProvider\\Mapper\\Sql\\DbTable\\RetailAccounts',
        'IvozProvider\\Mapper\\Sql\\DbTable\\RoutingPatternGroups',
        'IvozProvider\\Mapper\\Sql\\DbTable\\RoutingPatterns',
        'IvozProvider\\Mapper\\Sql\\DbTable\\TargetPatterns',
        'IvozProvider\\Mapper\\Sql\\DbTable\\TransformationRulesetGroupsTrunks',
        'IvozProvider\\Mapper\\Sql\\DbTable\\KamAccCdrs',
        'IvozProvider\\Mapper\\Sql\\DbTable\\KamTrunksUacreg'
    );
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
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
	  'name' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'name',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '75',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'nif' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'nif',
	    'COLUMN_POSITION' => 3,
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
	  'domain_users' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'domain_users',
	    'COLUMN_POSITION' => 4,
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
	  'defaultTimezoneId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'defaultTimezoneId',
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
	  'logoFileSize' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'logoFileSize',
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
	  'logoMimeType' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'logoMimeType',
	    'COLUMN_POSITION' => 7,
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
	  'logoBaseName' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'logoBaseName',
	    'COLUMN_POSITION' => 8,
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
	  'postalAddress' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'postalAddress',
	    'COLUMN_POSITION' => 9,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '255',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'postalCode' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'postalCode',
	    'COLUMN_POSITION' => 10,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '10',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'town' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'town',
	    'COLUMN_POSITION' => 11,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '255',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'province' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'province',
	    'COLUMN_POSITION' => 12,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '255',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'country' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'country',
	    'COLUMN_POSITION' => 13,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => '255',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'registryData' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'registryData',
	    'COLUMN_POSITION' => 14,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '1024',
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
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'languageId',
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
	  'FromName' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'FromName',
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
	  'FromAddress' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'FromAddress',
	    'COLUMN_POSITION' => 17,
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
	  'recordingsLimitMB' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'recordingsLimitMB',
	    'COLUMN_POSITION' => 18,
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
	  'recordingsLimitEmail' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'Brands',
	    'COLUMN_NAME' => 'recordingsLimitEmail',
	    'COLUMN_POSITION' => 19,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => NULL,
	    'NULLABLE' => true,
	    'LENGTH' => '250',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	);




}
