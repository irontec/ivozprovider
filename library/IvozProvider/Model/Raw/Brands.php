<?php

/**
 * Application Model
 *
 * @package IvozProvider\Model\Raw
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity][rest]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model\Raw;
class Brands extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_logoFso;


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_nif;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_domainUsers;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_defaultTimezoneId;

    /**
     * [FSO]
     * Database var type int
     *
     * @var int
     */
    protected $_logoFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_logoMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_logoBaseName;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_postalAddress;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_postalCode;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_town;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_province;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_country;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_registryData;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_languageId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_FromName;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_FromAddress;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_recordingsLimitMB;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_recordingsLimitEmail;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxCalls;


    /**
     * Parent relation Brands_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Languages
     */
    protected $_Language;

    /**
     * Parent relation Brands_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Timezones
     */
    protected $_DefaultTimezone;


    /**
     * Dependent relation BrandOperators_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\BrandOperators[]
     */
    protected $_BrandOperators;

    /**
     * Dependent relation BrandServices_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\BrandServices[]
     */
    protected $_BrandServices;

    /**
     * Dependent relation BrandURLs_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\BrandURLs[]
     */
    protected $_BrandURLs;

    /**
     * Dependent relation Companies_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Companies[]
     */
    protected $_Companies;

    /**
     * Dependent relation DDIs_ibfk_10
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation Domains_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Domains[]
     */
    protected $_Domains;

    /**
     * Dependent relation FeaturesRelBrands_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\FeaturesRelBrands[]
     */
    protected $_FeaturesRelBrands;

    /**
     * Dependent relation FixedCosts_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\FixedCosts[]
     */
    protected $_FixedCosts;

    /**
     * Dependent relation FixedCostsRelInvoices_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\FixedCostsRelInvoices[]
     */
    protected $_FixedCostsRelInvoices;

    /**
     * Dependent relation GenericCallACLPatterns_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\GenericCallACLPatterns[]
     */
    protected $_GenericCallACLPatterns;

    /**
     * Dependent relation fGenericMusicOnHold_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\GenericMusicOnHold[]
     */
    protected $_GenericMusicOnHold;

    /**
     * Dependent relation InvoiceTemplates_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\InvoiceTemplates[]
     */
    protected $_InvoiceTemplates;

    /**
     * Dependent relation Invoices_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Invoices[]
     */
    protected $_Invoices;

    /**
     * Dependent relation OutgoingRouting_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\OutgoingRouting[]
     */
    protected $_OutgoingRouting;

    /**
     * Dependent relation ParsedCDRs_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ParsedCDRs[]
     */
    protected $_ParsedCDRs;

    /**
     * Dependent relation PeerServers_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PeerServers[]
     */
    protected $_PeerServers;

    /**
     * Dependent relation PeeringContracts_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PeeringContracts[]
     */
    protected $_PeeringContracts;

    /**
     * Dependent relation PricingPlans_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PricingPlans[]
     */
    protected $_PricingPlans;

    /**
     * Dependent relation PricingPlansRelCompanies_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PricingPlansRelCompanies[]
     */
    protected $_PricingPlansRelCompanies;

    /**
     * Dependent relation PricingPlansRelTargetPatterns_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns[]
     */
    protected $_PricingPlansRelTargetPatterns;

    /**
     * Dependent relation RetailAccounts_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\RetailAccounts[]
     */
    protected $_RetailAccounts;

    /**
     * Dependent relation RoutingPatternGroups_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\RoutingPatternGroups[]
     */
    protected $_RoutingPatternGroups;

    /**
     * Dependent relation RoutingPatterns_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\RoutingPatterns[]
     */
    protected $_RoutingPatterns;

    /**
     * Dependent relation TargetPatterns_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\TargetPatterns[]
     */
    protected $_TargetPatterns;

    /**
     * Dependent relation TransformationRulesetGroupsTrunks_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks[]
     */
    protected $_TransformationRulesetGroupsTrunks;

    /**
     * Dependent relation kam_acc_cdrs_ibfk_5
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\KamAccCdrs[]
     */
    protected $_KamAccCdrs;

    /**
     * Dependent relation kam_trunks_uacreg_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\KamTrunksUacreg[]
     */
    protected $_KamTrunksUacreg;

    protected $_columnsList = array(
        'id'=>'id',
        'name'=>'name',
        'nif'=>'nif',
        'domain_users'=>'domainUsers',
        'defaultTimezoneId'=>'defaultTimezoneId',
        'logoFileSize'=>'logoFileSize',
        'logoMimeType'=>'logoMimeType',
        'logoBaseName'=>'logoBaseName',
        'postalAddress'=>'postalAddress',
        'postalCode'=>'postalCode',
        'town'=>'town',
        'province'=>'province',
        'country'=>'country',
        'registryData'=>'registryData',
        'languageId'=>'languageId',
        'FromName'=>'FromName',
        'FromAddress'=>'FromAddress',
        'recordingsLimitMB'=>'recordingsLimitMB',
        'recordingsLimitEmail'=>'recordingsLimitEmail',
        'maxCalls'=>'maxCalls',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'logoFileSize'=> array('FSO'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'BrandsIbfk2'=> array(
                    'property' => 'Language',
                    'table_name' => 'Languages',
                ),
            'BrandsIbfk3'=> array(
                    'property' => 'DefaultTimezone',
                    'table_name' => 'Timezones',
                ),
        ));

        $this->setDependentList(array(
            'BrandOperatorsIbfk3' => array(
                    'property' => 'BrandOperators',
                    'table_name' => 'BrandOperators',
                ),
            'BrandServicesIbfk1' => array(
                    'property' => 'BrandServices',
                    'table_name' => 'BrandServices',
                ),
            'BrandURLsIbfk1' => array(
                    'property' => 'BrandURLs',
                    'table_name' => 'BrandURLs',
                ),
            'CompaniesIbfk4' => array(
                    'property' => 'Companies',
                    'table_name' => 'Companies',
                ),
            'DDIsIbfk10' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'DomainsIbfk2' => array(
                    'property' => 'Domains',
                    'table_name' => 'Domains',
                ),
            'FeaturesRelBrandsIbfk1' => array(
                    'property' => 'FeaturesRelBrands',
                    'table_name' => 'FeaturesRelBrands',
                ),
            'FixedCostsIbfk1' => array(
                    'property' => 'FixedCosts',
                    'table_name' => 'FixedCosts',
                ),
            'FixedCostsRelInvoicesIbfk1' => array(
                    'property' => 'FixedCostsRelInvoices',
                    'table_name' => 'FixedCostsRelInvoices',
                ),
            'GenericCallACLPatternsIbfk1' => array(
                    'property' => 'GenericCallACLPatterns',
                    'table_name' => 'GenericCallACLPatterns',
                ),
            'FGenericMusicOnHoldIbfk1' => array(
                    'property' => 'GenericMusicOnHold',
                    'table_name' => 'GenericMusicOnHold',
                ),
            'InvoiceTemplatesIbfk1' => array(
                    'property' => 'InvoiceTemplates',
                    'table_name' => 'InvoiceTemplates',
                ),
            'InvoicesIbfk1' => array(
                    'property' => 'Invoices',
                    'table_name' => 'Invoices',
                ),
            'OutgoingRoutingIbfk1' => array(
                    'property' => 'OutgoingRouting',
                    'table_name' => 'OutgoingRouting',
                ),
            'ParsedCDRsIbfk1' => array(
                    'property' => 'ParsedCDRs',
                    'table_name' => 'ParsedCDRs',
                ),
            'PeerServersIbfk2' => array(
                    'property' => 'PeerServers',
                    'table_name' => 'PeerServers',
                ),
            'PeeringContractsIbfk1' => array(
                    'property' => 'PeeringContracts',
                    'table_name' => 'PeeringContracts',
                ),
            'PricingPlansIbfk1' => array(
                    'property' => 'PricingPlans',
                    'table_name' => 'PricingPlans',
                ),
            'PricingPlansRelCompaniesIbfk3' => array(
                    'property' => 'PricingPlansRelCompanies',
                    'table_name' => 'PricingPlansRelCompanies',
                ),
            'PricingPlansRelTargetPatternsIbfk3' => array(
                    'property' => 'PricingPlansRelTargetPatterns',
                    'table_name' => 'PricingPlansRelTargetPatterns',
                ),
            'RetailAccountsIbfk1' => array(
                    'property' => 'RetailAccounts',
                    'table_name' => 'RetailAccounts',
                ),
            'RoutingPatternGroupsIbfk1' => array(
                    'property' => 'RoutingPatternGroups',
                    'table_name' => 'RoutingPatternGroups',
                ),
            'RoutingPatternsIbfk1' => array(
                    'property' => 'RoutingPatterns',
                    'table_name' => 'RoutingPatterns',
                ),
            'TargetPatternsIbfk1' => array(
                    'property' => 'TargetPatterns',
                    'table_name' => 'TargetPatterns',
                ),
            'TransformationRulesetGroupsTrunksIbfk1' => array(
                    'property' => 'TransformationRulesetGroupsTrunks',
                    'table_name' => 'TransformationRulesetGroupsTrunks',
                ),
            'KamAccCdrsIbfk5' => array(
                    'property' => 'KamAccCdrs',
                    'table_name' => 'kam_acc_cdrs',
                ),
            'KamTrunksUacregIbfk1' => array(
                    'property' => 'KamTrunksUacreg',
                    'table_name' => 'kam_trunks_uacreg',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'BrandOperators_ibfk_3',
            'BrandServices_ibfk_1',
            'BrandURLs_ibfk_1'
        ));



        $this->_defaultValues = array(
            'maxCalls' => '0',
        );

        $this->_initFileObjects();
        parent::__construct();
    }

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }
    /**************************************************************************
    ************************** File System Object (FSO)************************
    ***************************************************************************/

    protected function _initFileObjects()
    {
        $this->_logoFso = new \Iron_Model_Fso($this, $this->getLogoSpecs());

        return $this;
    }

    public function getFileObjects()
    {

        return array('logo');
    }

    public function getLogoSpecs()
    {
        return array(
            'basePath' => 'logo',
            'sizeName' => 'logoFileSize',
            'mimeName' => 'logoMimeType',
            'baseNameName' => 'logoBaseName',
        );
    }

    public function putLogo($filePath = '',$baseName = '')
    {
        $this->_logoFso->put($filePath);

        if (!empty($baseName)) {

            $this->_logoFso->setBaseName($baseName);
        }
    }

    public function fetchLogo($autoload = true)
    {
        if ($autoload === true && $this->getlogoFileSize() > 0) {

            $this->_logoFso->fetch();
        }

        return $this->_logoFso;
    }

    public function removeLogo()
    {
        $this->_logoFso->remove();
        $this->_logoFso = null;

        return true;
    }

    public function getLogoUrl($profile)
    {
        $fsoConfig = \Zend_Registry::get('fsoConfig');
        $profileConf = $fsoConfig->$profile;

        if (is_null($profileConf)) {
            throw new \Exception('Profile invalid. not exist in fso.ini');
        }
        $routeMap = isset($profileConf->routeMap) ? $profileConf->routeMap : $fsoConfig->config->routeMap;

        $fsoColumn = $profileConf->fso;
        $fsoSkipColumns = array(
                $fsoColumn."FileSize",
                $fsoColumn."MimeType",
        );
        $fsoBaseNameColum = $fsoColumn."BaseName";

        foreach ($this->_columnsList as $column) {
            if (in_array($column, $fsoSkipColumns)) {
                continue;
            }
            $getter = "get".ucfirst($column);
            $search = "{".$column."}";
            if ($column == $fsoBaseNameColum) {
                $search = "{basename}";
            }
            $routeMap = str_replace($search, $this->$getter(), $routeMap);
        }

        if (!$routeMap) {
            return null;
        }
        $route = array(
            'profile' => $profile,
            'routeMap' => $routeMap
        );

        if (\Zend_Controller_Front::getInstance()) {
            $view = \Zend_Controller_Front::getInstance()
                ->getParam('bootstrap')
                ->getResource('view');
        } else {
            $view = new \Zend_View();
        }
        $fsoUrl = $view->serverUrl($view->url($route, 'fso'));

        return $fsoUrl;

    }


    /**************************************************************************
    *********************************** /FSO ***********************************
    ***************************************************************************/

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id', $this->_id, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_id = $data;

        } else if (!is_null($data)) {
            $this->_id = (int) $data;

        } else {
            $this->_id = $data;
        }
        return $this;
    }

    /**
     * Gets column id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_name != $data) {
            $this->_logChange('name', $this->_name, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_name = $data;

        } else if (!is_null($data)) {
            $this->_name = (string) $data;

        } else {
            $this->_name = $data;
        }
        return $this;
    }

    /**
     * Gets column name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setNif($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_nif != $data) {
            $this->_logChange('nif', $this->_nif, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nif = $data;

        } else if (!is_null($data)) {
            $this->_nif = (string) $data;

        } else {
            $this->_nif = $data;
        }
        return $this;
    }

    /**
     * Gets column nif
     *
     * @return string
     */
    public function getNif()
    {
        return $this->_nif;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setDomainUsers($data)
    {

        if ($this->_domainUsers != $data) {
            $this->_logChange('domainUsers', $this->_domainUsers, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_domainUsers = $data;

        } else if (!is_null($data)) {
            $this->_domainUsers = (string) $data;

        } else {
            $this->_domainUsers = $data;
        }
        return $this;
    }

    /**
     * Gets column domain_users
     *
     * @return string
     */
    public function getDomainUsers()
    {
        return $this->_domainUsers;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setDefaultTimezoneId($data)
    {

        if ($this->_defaultTimezoneId != $data) {
            $this->_logChange('defaultTimezoneId', $this->_defaultTimezoneId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_defaultTimezoneId = $data;

        } else if (!is_null($data)) {
            $this->_defaultTimezoneId = (int) $data;

        } else {
            $this->_defaultTimezoneId = $data;
        }
        return $this;
    }

    /**
     * Gets column defaultTimezoneId
     *
     * @return int
     */
    public function getDefaultTimezoneId()
    {
        return $this->_defaultTimezoneId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setLogoFileSize($data)
    {

        if ($this->_logoFileSize != $data) {
            $this->_logChange('logoFileSize', $this->_logoFileSize, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_logoFileSize = $data;

        } else if (!is_null($data)) {
            $this->_logoFileSize = (int) $data;

        } else {
            $this->_logoFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column logoFileSize
     *
     * @return int
     */
    public function getLogoFileSize()
    {
        return $this->_logoFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setLogoMimeType($data)
    {

        if ($this->_logoMimeType != $data) {
            $this->_logChange('logoMimeType', $this->_logoMimeType, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_logoMimeType = $data;

        } else if (!is_null($data)) {
            $this->_logoMimeType = (string) $data;

        } else {
            $this->_logoMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column logoMimeType
     *
     * @return string
     */
    public function getLogoMimeType()
    {
        return $this->_logoMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setLogoBaseName($data)
    {

        if ($this->_logoBaseName != $data) {
            $this->_logChange('logoBaseName', $this->_logoBaseName, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_logoBaseName = $data;

        } else if (!is_null($data)) {
            $this->_logoBaseName = (string) $data;

        } else {
            $this->_logoBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column logoBaseName
     *
     * @return string
     */
    public function getLogoBaseName()
    {
        return $this->_logoBaseName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setPostalAddress($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_postalAddress != $data) {
            $this->_logChange('postalAddress', $this->_postalAddress, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_postalAddress = $data;

        } else if (!is_null($data)) {
            $this->_postalAddress = (string) $data;

        } else {
            $this->_postalAddress = $data;
        }
        return $this;
    }

    /**
     * Gets column postalAddress
     *
     * @return string
     */
    public function getPostalAddress()
    {
        return $this->_postalAddress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setPostalCode($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_postalCode != $data) {
            $this->_logChange('postalCode', $this->_postalCode, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_postalCode = $data;

        } else if (!is_null($data)) {
            $this->_postalCode = (string) $data;

        } else {
            $this->_postalCode = $data;
        }
        return $this;
    }

    /**
     * Gets column postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->_postalCode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setTown($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_town != $data) {
            $this->_logChange('town', $this->_town, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_town = $data;

        } else if (!is_null($data)) {
            $this->_town = (string) $data;

        } else {
            $this->_town = $data;
        }
        return $this;
    }

    /**
     * Gets column town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->_town;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setProvince($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_province != $data) {
            $this->_logChange('province', $this->_province, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_province = $data;

        } else if (!is_null($data)) {
            $this->_province = (string) $data;

        } else {
            $this->_province = $data;
        }
        return $this;
    }

    /**
     * Gets column province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->_province;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setCountry($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_country != $data) {
            $this->_logChange('country', $this->_country, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_country = $data;

        } else if (!is_null($data)) {
            $this->_country = (string) $data;

        } else {
            $this->_country = $data;
        }
        return $this;
    }

    /**
     * Gets column country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setRegistryData($data)
    {

        if ($this->_registryData != $data) {
            $this->_logChange('registryData', $this->_registryData, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_registryData = $data;

        } else if (!is_null($data)) {
            $this->_registryData = (string) $data;

        } else {
            $this->_registryData = $data;
        }
        return $this;
    }

    /**
     * Gets column registryData
     *
     * @return string
     */
    public function getRegistryData()
    {
        return $this->_registryData;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setLanguageId($data)
    {

        if ($this->_languageId != $data) {
            $this->_logChange('languageId', $this->_languageId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_languageId = $data;

        } else if (!is_null($data)) {
            $this->_languageId = (int) $data;

        } else {
            $this->_languageId = $data;
        }
        return $this;
    }

    /**
     * Gets column languageId
     *
     * @return int
     */
    public function getLanguageId()
    {
        return $this->_languageId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setFromName($data)
    {

        if ($this->_FromName != $data) {
            $this->_logChange('FromName', $this->_FromName, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_FromName = $data;

        } else if (!is_null($data)) {
            $this->_FromName = (string) $data;

        } else {
            $this->_FromName = $data;
        }
        return $this;
    }

    /**
     * Gets column FromName
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->_FromName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setFromAddress($data)
    {

        if ($this->_FromAddress != $data) {
            $this->_logChange('FromAddress', $this->_FromAddress, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_FromAddress = $data;

        } else if (!is_null($data)) {
            $this->_FromAddress = (string) $data;

        } else {
            $this->_FromAddress = $data;
        }
        return $this;
    }

    /**
     * Gets column FromAddress
     *
     * @return string
     */
    public function getFromAddress()
    {
        return $this->_FromAddress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setRecordingsLimitMB($data)
    {

        if ($this->_recordingsLimitMB != $data) {
            $this->_logChange('recordingsLimitMB', $this->_recordingsLimitMB, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_recordingsLimitMB = $data;

        } else if (!is_null($data)) {
            $this->_recordingsLimitMB = (int) $data;

        } else {
            $this->_recordingsLimitMB = $data;
        }
        return $this;
    }

    /**
     * Gets column recordingsLimitMB
     *
     * @return int
     */
    public function getRecordingsLimitMB()
    {
        return $this->_recordingsLimitMB;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setRecordingsLimitEmail($data)
    {

        if ($this->_recordingsLimitEmail != $data) {
            $this->_logChange('recordingsLimitEmail', $this->_recordingsLimitEmail, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_recordingsLimitEmail = $data;

        } else if (!is_null($data)) {
            $this->_recordingsLimitEmail = (string) $data;

        } else {
            $this->_recordingsLimitEmail = $data;
        }
        return $this;
    }

    /**
     * Gets column recordingsLimitEmail
     *
     * @return string
     */
    public function getRecordingsLimitEmail()
    {
        return $this->_recordingsLimitEmail;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setMaxCalls($data)
    {

        if ($this->_maxCalls != $data) {
            $this->_logChange('maxCalls', $this->_maxCalls, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_maxCalls = $data;

        } else if (!is_null($data)) {
            $this->_maxCalls = (int) $data;

        } else {
            $this->_maxCalls = $data;
        }
        return $this;
    }

    /**
     * Gets column maxCalls
     *
     * @return int
     */
    public function getMaxCalls()
    {
        return $this->_maxCalls;
    }

    /**
     * Sets parent relation Language
     *
     * @param \IvozProvider\Model\Raw\Languages $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setLanguage(\IvozProvider\Model\Raw\Languages $data)
    {
        $this->_Language = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setLanguageId($primaryKey);
        }

        $this->_setLoaded('BrandsIbfk2');
        return $this;
    }

    /**
     * Gets parent Language
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Languages
     */
    public function getLanguage($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Language = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Language;
    }

    /**
     * Sets parent relation DefaultTimezone
     *
     * @param \IvozProvider\Model\Raw\Timezones $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setDefaultTimezone(\IvozProvider\Model\Raw\Timezones $data)
    {
        $this->_DefaultTimezone = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setDefaultTimezoneId($primaryKey);
        }

        $this->_setLoaded('BrandsIbfk3');
        return $this;
    }

    /**
     * Gets parent DefaultTimezone
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function getDefaultTimezone($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_DefaultTimezone = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_DefaultTimezone;
    }

    /**
     * Sets dependent relations BrandOperators_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\BrandOperators
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setBrandOperators(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_BrandOperators === null) {

                $this->getBrandOperators();
            }

            $oldRelations = $this->_BrandOperators;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_BrandOperators = array();

        foreach ($data as $object) {
            $this->addBrandOperators($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations BrandOperators_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\BrandOperators $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addBrandOperators(\IvozProvider\Model\Raw\BrandOperators $data)
    {
        $this->_BrandOperators[] = $data;
        $this->_setLoaded('BrandOperatorsIbfk3');
        return $this;
    }

    /**
     * Gets dependent BrandOperators_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\BrandOperators
     */
    public function getBrandOperators($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandOperatorsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_BrandOperators = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_BrandOperators;
    }

    /**
     * Sets dependent relations BrandServices_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\BrandServices
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setBrandServices(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_BrandServices === null) {

                $this->getBrandServices();
            }

            $oldRelations = $this->_BrandServices;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_BrandServices = array();

        foreach ($data as $object) {
            $this->addBrandServices($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations BrandServices_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\BrandServices $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addBrandServices(\IvozProvider\Model\Raw\BrandServices $data)
    {
        $this->_BrandServices[] = $data;
        $this->_setLoaded('BrandServicesIbfk1');
        return $this;
    }

    /**
     * Gets dependent BrandServices_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\BrandServices
     */
    public function getBrandServices($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandServicesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_BrandServices = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_BrandServices;
    }

    /**
     * Sets dependent relations BrandURLs_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\BrandURLs
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setBrandURLs(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_BrandURLs === null) {

                $this->getBrandURLs();
            }

            $oldRelations = $this->_BrandURLs;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_BrandURLs = array();

        foreach ($data as $object) {
            $this->addBrandURLs($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations BrandURLs_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\BrandURLs $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addBrandURLs(\IvozProvider\Model\Raw\BrandURLs $data)
    {
        $this->_BrandURLs[] = $data;
        $this->_setLoaded('BrandURLsIbfk1');
        return $this;
    }

    /**
     * Gets dependent BrandURLs_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\BrandURLs
     */
    public function getBrandURLs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandURLsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_BrandURLs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_BrandURLs;
    }

    /**
     * Sets dependent relations Companies_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Companies
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setCompanies(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Companies === null) {

                $this->getCompanies();
            }

            $oldRelations = $this->_Companies;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_Companies = array();

        foreach ($data as $object) {
            $this->addCompanies($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Companies_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addCompanies(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_Companies[] = $data;
        $this->_setLoaded('CompaniesIbfk4');
        return $this;
    }

    /**
     * Gets dependent Companies_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Companies
     */
    public function getCompanies($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Companies = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Companies;
    }

    /**
     * Sets dependent relations DDIs_ibfk_10
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setDDIs(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_DDIs === null) {

                $this->getDDIs();
            }

            $oldRelations = $this->_DDIs;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_DDIs = array();

        foreach ($data as $object) {
            $this->addDDIs($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations DDIs_ibfk_10
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk10');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_10
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk10';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_DDIs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_DDIs;
    }

    /**
     * Sets dependent relations Domains_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Domains
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setDomains(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Domains === null) {

                $this->getDomains();
            }

            $oldRelations = $this->_Domains;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_Domains = array();

        foreach ($data as $object) {
            $this->addDomains($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Domains_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\Domains $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addDomains(\IvozProvider\Model\Raw\Domains $data)
    {
        $this->_Domains[] = $data;
        $this->_setLoaded('DomainsIbfk2');
        return $this;
    }

    /**
     * Gets dependent Domains_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Domains
     */
    public function getDomains($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DomainsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Domains = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Domains;
    }

    /**
     * Sets dependent relations FeaturesRelBrands_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\FeaturesRelBrands
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setFeaturesRelBrands(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_FeaturesRelBrands === null) {

                $this->getFeaturesRelBrands();
            }

            $oldRelations = $this->_FeaturesRelBrands;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_FeaturesRelBrands = array();

        foreach ($data as $object) {
            $this->addFeaturesRelBrands($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations FeaturesRelBrands_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\FeaturesRelBrands $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addFeaturesRelBrands(\IvozProvider\Model\Raw\FeaturesRelBrands $data)
    {
        $this->_FeaturesRelBrands[] = $data;
        $this->_setLoaded('FeaturesRelBrandsIbfk1');
        return $this;
    }

    /**
     * Gets dependent FeaturesRelBrands_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\FeaturesRelBrands
     */
    public function getFeaturesRelBrands($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FeaturesRelBrandsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_FeaturesRelBrands = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_FeaturesRelBrands;
    }

    /**
     * Sets dependent relations FixedCosts_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\FixedCosts
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setFixedCosts(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_FixedCosts === null) {

                $this->getFixedCosts();
            }

            $oldRelations = $this->_FixedCosts;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_FixedCosts = array();

        foreach ($data as $object) {
            $this->addFixedCosts($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations FixedCosts_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\FixedCosts $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addFixedCosts(\IvozProvider\Model\Raw\FixedCosts $data)
    {
        $this->_FixedCosts[] = $data;
        $this->_setLoaded('FixedCostsIbfk1');
        return $this;
    }

    /**
     * Gets dependent FixedCosts_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\FixedCosts
     */
    public function getFixedCosts($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FixedCostsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_FixedCosts = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_FixedCosts;
    }

    /**
     * Sets dependent relations FixedCostsRelInvoices_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\FixedCostsRelInvoices
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setFixedCostsRelInvoices(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_FixedCostsRelInvoices === null) {

                $this->getFixedCostsRelInvoices();
            }

            $oldRelations = $this->_FixedCostsRelInvoices;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_FixedCostsRelInvoices = array();

        foreach ($data as $object) {
            $this->addFixedCostsRelInvoices($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations FixedCostsRelInvoices_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\FixedCostsRelInvoices $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addFixedCostsRelInvoices(\IvozProvider\Model\Raw\FixedCostsRelInvoices $data)
    {
        $this->_FixedCostsRelInvoices[] = $data;
        $this->_setLoaded('FixedCostsRelInvoicesIbfk1');
        return $this;
    }

    /**
     * Gets dependent FixedCostsRelInvoices_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\FixedCostsRelInvoices
     */
    public function getFixedCostsRelInvoices($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FixedCostsRelInvoicesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_FixedCostsRelInvoices = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_FixedCostsRelInvoices;
    }

    /**
     * Sets dependent relations GenericCallACLPatterns_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\GenericCallACLPatterns
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setGenericCallACLPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_GenericCallACLPatterns === null) {

                $this->getGenericCallACLPatterns();
            }

            $oldRelations = $this->_GenericCallACLPatterns;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_GenericCallACLPatterns = array();

        foreach ($data as $object) {
            $this->addGenericCallACLPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations GenericCallACLPatterns_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\GenericCallACLPatterns $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addGenericCallACLPatterns(\IvozProvider\Model\Raw\GenericCallACLPatterns $data)
    {
        $this->_GenericCallACLPatterns[] = $data;
        $this->_setLoaded('GenericCallACLPatternsIbfk1');
        return $this;
    }

    /**
     * Gets dependent GenericCallACLPatterns_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\GenericCallACLPatterns
     */
    public function getGenericCallACLPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'GenericCallACLPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_GenericCallACLPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_GenericCallACLPatterns;
    }

    /**
     * Sets dependent relations fGenericMusicOnHold_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\GenericMusicOnHold
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setGenericMusicOnHold(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_GenericMusicOnHold === null) {

                $this->getGenericMusicOnHold();
            }

            $oldRelations = $this->_GenericMusicOnHold;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_GenericMusicOnHold = array();

        foreach ($data as $object) {
            $this->addGenericMusicOnHold($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fGenericMusicOnHold_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\GenericMusicOnHold $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addGenericMusicOnHold(\IvozProvider\Model\Raw\GenericMusicOnHold $data)
    {
        $this->_GenericMusicOnHold[] = $data;
        $this->_setLoaded('FGenericMusicOnHoldIbfk1');
        return $this;
    }

    /**
     * Gets dependent fGenericMusicOnHold_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\GenericMusicOnHold
     */
    public function getGenericMusicOnHold($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FGenericMusicOnHoldIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_GenericMusicOnHold = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_GenericMusicOnHold;
    }

    /**
     * Sets dependent relations InvoiceTemplates_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\InvoiceTemplates
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setInvoiceTemplates(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_InvoiceTemplates === null) {

                $this->getInvoiceTemplates();
            }

            $oldRelations = $this->_InvoiceTemplates;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_InvoiceTemplates = array();

        foreach ($data as $object) {
            $this->addInvoiceTemplates($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations InvoiceTemplates_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\InvoiceTemplates $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addInvoiceTemplates(\IvozProvider\Model\Raw\InvoiceTemplates $data)
    {
        $this->_InvoiceTemplates[] = $data;
        $this->_setLoaded('InvoiceTemplatesIbfk1');
        return $this;
    }

    /**
     * Gets dependent InvoiceTemplates_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\InvoiceTemplates
     */
    public function getInvoiceTemplates($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'InvoiceTemplatesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_InvoiceTemplates = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_InvoiceTemplates;
    }

    /**
     * Sets dependent relations Invoices_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Invoices
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setInvoices(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Invoices === null) {

                $this->getInvoices();
            }

            $oldRelations = $this->_Invoices;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_Invoices = array();

        foreach ($data as $object) {
            $this->addInvoices($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Invoices_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Invoices $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addInvoices(\IvozProvider\Model\Raw\Invoices $data)
    {
        $this->_Invoices[] = $data;
        $this->_setLoaded('InvoicesIbfk1');
        return $this;
    }

    /**
     * Gets dependent Invoices_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Invoices
     */
    public function getInvoices($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'InvoicesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Invoices = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Invoices;
    }

    /**
     * Sets dependent relations OutgoingRouting_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\OutgoingRouting
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setOutgoingRouting(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_OutgoingRouting === null) {

                $this->getOutgoingRouting();
            }

            $oldRelations = $this->_OutgoingRouting;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_OutgoingRouting = array();

        foreach ($data as $object) {
            $this->addOutgoingRouting($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations OutgoingRouting_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\OutgoingRouting $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addOutgoingRouting(\IvozProvider\Model\Raw\OutgoingRouting $data)
    {
        $this->_OutgoingRouting[] = $data;
        $this->_setLoaded('OutgoingRoutingIbfk1');
        return $this;
    }

    /**
     * Gets dependent OutgoingRouting_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\OutgoingRouting
     */
    public function getOutgoingRouting($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingRoutingIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingRouting = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_OutgoingRouting;
    }

    /**
     * Sets dependent relations ParsedCDRs_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ParsedCDRs
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setParsedCDRs(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ParsedCDRs === null) {

                $this->getParsedCDRs();
            }

            $oldRelations = $this->_ParsedCDRs;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_ParsedCDRs = array();

        foreach ($data as $object) {
            $this->addParsedCDRs($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ParsedCDRs_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\ParsedCDRs $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addParsedCDRs(\IvozProvider\Model\Raw\ParsedCDRs $data)
    {
        $this->_ParsedCDRs[] = $data;
        $this->_setLoaded('ParsedCDRsIbfk1');
        return $this;
    }

    /**
     * Gets dependent ParsedCDRs_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function getParsedCDRs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ParsedCDRsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ParsedCDRs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ParsedCDRs;
    }

    /**
     * Sets dependent relations PeerServers_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PeerServers
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setPeerServers(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PeerServers === null) {

                $this->getPeerServers();
            }

            $oldRelations = $this->_PeerServers;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_PeerServers = array();

        foreach ($data as $object) {
            $this->addPeerServers($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PeerServers_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\PeerServers $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addPeerServers(\IvozProvider\Model\Raw\PeerServers $data)
    {
        $this->_PeerServers[] = $data;
        $this->_setLoaded('PeerServersIbfk2');
        return $this;
    }

    /**
     * Gets dependent PeerServers_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PeerServers
     */
    public function getPeerServers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeerServersIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PeerServers = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PeerServers;
    }

    /**
     * Sets dependent relations PeeringContracts_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PeeringContracts
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setPeeringContracts(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PeeringContracts === null) {

                $this->getPeeringContracts();
            }

            $oldRelations = $this->_PeeringContracts;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_PeeringContracts = array();

        foreach ($data as $object) {
            $this->addPeeringContracts($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PeeringContracts_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\PeeringContracts $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addPeeringContracts(\IvozProvider\Model\Raw\PeeringContracts $data)
    {
        $this->_PeeringContracts[] = $data;
        $this->_setLoaded('PeeringContractsIbfk1');
        return $this;
    }

    /**
     * Gets dependent PeeringContracts_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PeeringContracts
     */
    public function getPeeringContracts($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeeringContractsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PeeringContracts = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PeeringContracts;
    }

    /**
     * Sets dependent relations PricingPlans_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PricingPlans
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setPricingPlans(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PricingPlans === null) {

                $this->getPricingPlans();
            }

            $oldRelations = $this->_PricingPlans;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_PricingPlans = array();

        foreach ($data as $object) {
            $this->addPricingPlans($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PricingPlans_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\PricingPlans $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addPricingPlans(\IvozProvider\Model\Raw\PricingPlans $data)
    {
        $this->_PricingPlans[] = $data;
        $this->_setLoaded('PricingPlansIbfk1');
        return $this;
    }

    /**
     * Gets dependent PricingPlans_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PricingPlans
     */
    public function getPricingPlans($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PricingPlansIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PricingPlans = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PricingPlans;
    }

    /**
     * Sets dependent relations PricingPlansRelCompanies_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PricingPlansRelCompanies
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setPricingPlansRelCompanies(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PricingPlansRelCompanies === null) {

                $this->getPricingPlansRelCompanies();
            }

            $oldRelations = $this->_PricingPlansRelCompanies;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_PricingPlansRelCompanies = array();

        foreach ($data as $object) {
            $this->addPricingPlansRelCompanies($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PricingPlansRelCompanies_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\PricingPlansRelCompanies $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addPricingPlansRelCompanies(\IvozProvider\Model\Raw\PricingPlansRelCompanies $data)
    {
        $this->_PricingPlansRelCompanies[] = $data;
        $this->_setLoaded('PricingPlansRelCompaniesIbfk3');
        return $this;
    }

    /**
     * Gets dependent PricingPlansRelCompanies_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PricingPlansRelCompanies
     */
    public function getPricingPlansRelCompanies($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PricingPlansRelCompaniesIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PricingPlansRelCompanies = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PricingPlansRelCompanies;
    }

    /**
     * Sets dependent relations PricingPlansRelTargetPatterns_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setPricingPlansRelTargetPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PricingPlansRelTargetPatterns === null) {

                $this->getPricingPlansRelTargetPatterns();
            }

            $oldRelations = $this->_PricingPlansRelTargetPatterns;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_PricingPlansRelTargetPatterns = array();

        foreach ($data as $object) {
            $this->addPricingPlansRelTargetPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PricingPlansRelTargetPatterns_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addPricingPlansRelTargetPatterns(\IvozProvider\Model\Raw\PricingPlansRelTargetPatterns $data)
    {
        $this->_PricingPlansRelTargetPatterns[] = $data;
        $this->_setLoaded('PricingPlansRelTargetPatternsIbfk3');
        return $this;
    }

    /**
     * Gets dependent PricingPlansRelTargetPatterns_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     */
    public function getPricingPlansRelTargetPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PricingPlansRelTargetPatternsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PricingPlansRelTargetPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PricingPlansRelTargetPatterns;
    }

    /**
     * Sets dependent relations RetailAccounts_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\RetailAccounts
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setRetailAccounts(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_RetailAccounts === null) {

                $this->getRetailAccounts();
            }

            $oldRelations = $this->_RetailAccounts;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_RetailAccounts = array();

        foreach ($data as $object) {
            $this->addRetailAccounts($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations RetailAccounts_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\RetailAccounts $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addRetailAccounts(\IvozProvider\Model\Raw\RetailAccounts $data)
    {
        $this->_RetailAccounts[] = $data;
        $this->_setLoaded('RetailAccountsIbfk1');
        return $this;
    }

    /**
     * Gets dependent RetailAccounts_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\RetailAccounts
     */
    public function getRetailAccounts($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RetailAccountsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_RetailAccounts = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_RetailAccounts;
    }

    /**
     * Sets dependent relations RoutingPatternGroups_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\RoutingPatternGroups
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setRoutingPatternGroups(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_RoutingPatternGroups === null) {

                $this->getRoutingPatternGroups();
            }

            $oldRelations = $this->_RoutingPatternGroups;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_RoutingPatternGroups = array();

        foreach ($data as $object) {
            $this->addRoutingPatternGroups($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations RoutingPatternGroups_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\RoutingPatternGroups $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addRoutingPatternGroups(\IvozProvider\Model\Raw\RoutingPatternGroups $data)
    {
        $this->_RoutingPatternGroups[] = $data;
        $this->_setLoaded('RoutingPatternGroupsIbfk1');
        return $this;
    }

    /**
     * Gets dependent RoutingPatternGroups_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\RoutingPatternGroups
     */
    public function getRoutingPatternGroups($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RoutingPatternGroupsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_RoutingPatternGroups = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_RoutingPatternGroups;
    }

    /**
     * Sets dependent relations RoutingPatterns_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\RoutingPatterns
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setRoutingPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_RoutingPatterns === null) {

                $this->getRoutingPatterns();
            }

            $oldRelations = $this->_RoutingPatterns;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_RoutingPatterns = array();

        foreach ($data as $object) {
            $this->addRoutingPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations RoutingPatterns_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\RoutingPatterns $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addRoutingPatterns(\IvozProvider\Model\Raw\RoutingPatterns $data)
    {
        $this->_RoutingPatterns[] = $data;
        $this->_setLoaded('RoutingPatternsIbfk1');
        return $this;
    }

    /**
     * Gets dependent RoutingPatterns_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function getRoutingPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RoutingPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_RoutingPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_RoutingPatterns;
    }

    /**
     * Sets dependent relations TargetPatterns_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\TargetPatterns
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setTargetPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_TargetPatterns === null) {

                $this->getTargetPatterns();
            }

            $oldRelations = $this->_TargetPatterns;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_TargetPatterns = array();

        foreach ($data as $object) {
            $this->addTargetPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations TargetPatterns_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\TargetPatterns $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addTargetPatterns(\IvozProvider\Model\Raw\TargetPatterns $data)
    {
        $this->_TargetPatterns[] = $data;
        $this->_setLoaded('TargetPatternsIbfk1');
        return $this;
    }

    /**
     * Gets dependent TargetPatterns_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\TargetPatterns
     */
    public function getTargetPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TargetPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_TargetPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_TargetPatterns;
    }

    /**
     * Sets dependent relations TransformationRulesetGroupsTrunks_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setTransformationRulesetGroupsTrunks(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_TransformationRulesetGroupsTrunks === null) {

                $this->getTransformationRulesetGroupsTrunks();
            }

            $oldRelations = $this->_TransformationRulesetGroupsTrunks;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_TransformationRulesetGroupsTrunks = array();

        foreach ($data as $object) {
            $this->addTransformationRulesetGroupsTrunks($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations TransformationRulesetGroupsTrunks_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addTransformationRulesetGroupsTrunks(\IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks $data)
    {
        $this->_TransformationRulesetGroupsTrunks[] = $data;
        $this->_setLoaded('TransformationRulesetGroupsTrunksIbfk1');
        return $this;
    }

    /**
     * Gets dependent TransformationRulesetGroupsTrunks_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function getTransformationRulesetGroupsTrunks($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TransformationRulesetGroupsTrunksIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_TransformationRulesetGroupsTrunks = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_TransformationRulesetGroupsTrunks;
    }

    /**
     * Sets dependent relations kam_acc_cdrs_ibfk_5
     *
     * @param array $data An array of \IvozProvider\Model\Raw\KamAccCdrs
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setKamAccCdrs(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KamAccCdrs === null) {

                $this->getKamAccCdrs();
            }

            $oldRelations = $this->_KamAccCdrs;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_KamAccCdrs = array();

        foreach ($data as $object) {
            $this->addKamAccCdrs($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations kam_acc_cdrs_ibfk_5
     *
     * @param \IvozProvider\Model\Raw\KamAccCdrs $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addKamAccCdrs(\IvozProvider\Model\Raw\KamAccCdrs $data)
    {
        $this->_KamAccCdrs[] = $data;
        $this->_setLoaded('KamAccCdrsIbfk5');
        return $this;
    }

    /**
     * Gets dependent kam_acc_cdrs_ibfk_5
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function getKamAccCdrs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamAccCdrsIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KamAccCdrs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KamAccCdrs;
    }

    /**
     * Sets dependent relations kam_trunks_uacreg_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\KamTrunksUacreg
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function setKamTrunksUacreg(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KamTrunksUacreg === null) {

                $this->getKamTrunksUacreg();
            }

            $oldRelations = $this->_KamTrunksUacreg;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_KamTrunksUacreg = array();

        foreach ($data as $object) {
            $this->addKamTrunksUacreg($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations kam_trunks_uacreg_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\KamTrunksUacreg $data
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function addKamTrunksUacreg(\IvozProvider\Model\Raw\KamTrunksUacreg $data)
    {
        $this->_KamTrunksUacreg[] = $data;
        $this->_setLoaded('KamTrunksUacregIbfk1');
        return $this;
    }

    /**
     * Gets dependent kam_trunks_uacreg_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\KamTrunksUacreg
     */
    public function getKamTrunksUacreg($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamTrunksUacregIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KamTrunksUacreg = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KamTrunksUacreg;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Brands
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Brands')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Brands);

            } else {

                 new \Exception("Not a valid mapper class found");
            }

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(false);
        }

        return $this->_mapper;
    }

    /**
     * Returns the validator class for this model
     *
     * @return null | \IvozProvider\Model\Validator\Brands
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Brands')) {

                $this->setValidator(new \IvozProvider\Validator\Brands);
            }
        }

        return $this->_validator;
    }

    public function setFromArray($data)
    {
        return $this->getMapper()->loadModel($data, $this);
    }

    /**
     * Deletes current row by deleting the row that matches the primary key
     *
     * @see \Mapper\Sql\Brands::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getId() === null) {
            $this->_logger->log('The value for Id cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'id = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getId())
        );
    }

    public function mustUpdateEtag()
    {
        return true;
    }

}