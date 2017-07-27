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
class Companies extends ModelAbstract
{

    protected $_typeAcceptedValues = array(
        'vpbx',
        'retail',
    );

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;

    /**
     * [enum:vpbx|retail]
     * Database var type varchar
     *
     * @var string
     */
    protected $_type;

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
    protected $_domainUsers;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_nif;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_defaultTimezoneId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_applicationServerId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_externalMaxCalls;

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
    protected $_outboundPrefix;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_countryId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_languageId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_mediaRelaySetsId;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_ipFilter;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_onDemandRecord;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_onDemandRecordCode;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_areaCode;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_externallyExtraOpts;

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
    protected $_outgoingDDIId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_outgoingDDIRuleId;


    /**
     * Parent relation Companies_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation Companies_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\ApplicationServers
     */
    protected $_ApplicationServer;

    /**
     * Parent relation Companies_ibfk_9
     *
     * @var \IvozProvider\Model\Raw\Countries
     */
    protected $_Countries;

    /**
     * Parent relation Companies_ibfk_10
     *
     * @var \IvozProvider\Model\Raw\Languages
     */
    protected $_Language;

    /**
     * Parent relation Companies_ibfk_11
     *
     * @var \IvozProvider\Model\Raw\MediaRelaySets
     */
    protected $_MediaRelaySets;

    /**
     * Parent relation Companies_ibfk_12
     *
     * @var \IvozProvider\Model\Raw\Timezones
     */
    protected $_DefaultTimezone;

    /**
     * Parent relation Companies_ibfk_13
     *
     * @var \IvozProvider\Model\Raw\DDIs
     */
    protected $_OutgoingDDI;

    /**
     * Parent relation Companies_ibfk_14
     *
     * @var \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    protected $_OutgoingDDIRule;


    /**
     * Dependent relation Calendars_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Calendars[]
     */
    protected $_Calendars;

    /**
     * Dependent relation CallAcl_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\CallACL[]
     */
    protected $_CallACL;

    /**
     * Dependent relation CallACLPatterns_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\CallACLPatterns[]
     */
    protected $_CallACLPatterns;

    /**
     * Dependent relation CompanyAdmins_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\CompanyAdmins[]
     */
    protected $_CompanyAdmins;

    /**
     * Dependent relation CompanyServices_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\CompanyServices[]
     */
    protected $_CompanyServices;

    /**
     * Dependent relation ConferenceRooms_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ConferenceRooms[]
     */
    protected $_ConferenceRooms;

    /**
     * Dependent relation DDIs_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation Domains_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Domains[]
     */
    protected $_Domains;

    /**
     * Dependent relation Extensions_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Extensions[]
     */
    protected $_Extensions;

    /**
     * Dependent relation ExternalCallFilters_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilters[]
     */
    protected $_ExternalCallFilters;

    /**
     * Dependent relation Faxes_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Faxes[]
     */
    protected $_Faxes;

    /**
     * Dependent relation FeaturesRelCompanies_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\FeaturesRelCompanies[]
     */
    protected $_FeaturesRelCompanies;

    /**
     * Dependent relation Friends_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Friends[]
     */
    protected $_Friends;

    /**
     * Dependent relation HuntGroups_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\HuntGroups[]
     */
    protected $_HuntGroups;

    /**
     * Dependent relation IVRCommon_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\IVRCommon[]
     */
    protected $_IVRCommon;

    /**
     * Dependent relation IVRCustom_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\IVRCustom[]
     */
    protected $_IVRCustom;

    /**
     * Dependent relation Invoices_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Invoices[]
     */
    protected $_Invoices;

    /**
     * Dependent relation Locutions_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Locutions[]
     */
    protected $_Locutions;

    /**
     * Dependent relation MatchList_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\MatchLists[]
     */
    protected $_MatchLists;

    /**
     * Dependent relation MusicOnHold_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\MusicOnHold[]
     */
    protected $_MusicOnHold;

    /**
     * Dependent relation OutgoingDDIRules_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\OutgoingDDIRules[]
     */
    protected $_OutgoingDDIRules;

    /**
     * Dependent relation OutgoingRouting_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\OutgoingRouting[]
     */
    protected $_OutgoingRouting;

    /**
     * Dependent relation ParsedCDRs_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ParsedCDRs[]
     */
    protected $_ParsedCDRs;

    /**
     * Dependent relation PickUpGroups_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PickUpGroups[]
     */
    protected $_PickUpGroups;

    /**
     * Dependent relation PricingPlansRelCompanies_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PricingPlansRelCompanies[]
     */
    protected $_PricingPlansRelCompanies;

    /**
     * Dependent relation Queues_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Queues[]
     */
    protected $_Queues;

    /**
     * Dependent relation Recordings_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Recordings[]
     */
    protected $_Recordings;

    /**
     * Dependent relation RetailAccounts_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\RetailAccounts[]
     */
    protected $_RetailAccounts;

    /**
     * Dependent relation Schedules_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Schedules[]
     */
    protected $_Schedules;

    /**
     * Dependent relation Terminals_CompanyId_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Terminals[]
     */
    protected $_Terminals;

    /**
     * Dependent relation Users_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Users[]
     */
    protected $_Users;

    /**
     * Dependent relation kam_acc_cdrs_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\KamAccCdrs[]
     */
    protected $_KamAccCdrs;

    /**
     * Dependent relation kam_users_address_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\KamUsersAddress[]
     */
    protected $_KamUsersAddress;

    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
        'type'=>'type',
        'name'=>'name',
        'domain_users'=>'domainUsers',
        'nif'=>'nif',
        'defaultTimezoneId'=>'defaultTimezoneId',
        'applicationServerId'=>'applicationServerId',
        'externalMaxCalls'=>'externalMaxCalls',
        'postalAddress'=>'postalAddress',
        'postalCode'=>'postalCode',
        'town'=>'town',
        'province'=>'province',
        'country'=>'country',
        'outbound_prefix'=>'outboundPrefix',
        'countryId'=>'countryId',
        'languageId'=>'languageId',
        'mediaRelaySetsId'=>'mediaRelaySetsId',
        'ipFilter'=>'ipFilter',
        'onDemandRecord'=>'onDemandRecord',
        'onDemandRecordCode'=>'onDemandRecordCode',
        'areaCode'=>'areaCode',
        'externallyExtraOpts'=>'externallyExtraOpts',
        'recordingsLimitMB'=>'recordingsLimitMB',
        'recordingsLimitEmail'=>'recordingsLimitEmail',
        'outgoingDDIId'=>'outgoingDDIId',
        'outgoingDDIRuleId'=>'outgoingDDIRuleId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'type'=> array('enum:vpbx|retail'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'CompaniesIbfk4'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'CompaniesIbfk5'=> array(
                    'property' => 'ApplicationServer',
                    'table_name' => 'ApplicationServers',
                ),
            'CompaniesIbfk9'=> array(
                    'property' => 'Countries',
                    'table_name' => 'Countries',
                ),
            'CompaniesIbfk10'=> array(
                    'property' => 'Language',
                    'table_name' => 'Languages',
                ),
            'CompaniesIbfk11'=> array(
                    'property' => 'MediaRelaySets',
                    'table_name' => 'MediaRelaySets',
                ),
            'CompaniesIbfk12'=> array(
                    'property' => 'DefaultTimezone',
                    'table_name' => 'Timezones',
                ),
            'CompaniesIbfk13'=> array(
                    'property' => 'OutgoingDDI',
                    'table_name' => 'DDIs',
                ),
            'CompaniesIbfk14'=> array(
                    'property' => 'OutgoingDDIRule',
                    'table_name' => 'OutgoingDDIRules',
                ),
        ));

        $this->setDependentList(array(
            'CalendarsIbfk1' => array(
                    'property' => 'Calendars',
                    'table_name' => 'Calendars',
                ),
            'CallAclIbfk1' => array(
                    'property' => 'CallACL',
                    'table_name' => 'CallACL',
                ),
            'CallACLPatternsIbfk1' => array(
                    'property' => 'CallACLPatterns',
                    'table_name' => 'CallACLPatterns',
                ),
            'CompanyAdminsIbfk1' => array(
                    'property' => 'CompanyAdmins',
                    'table_name' => 'CompanyAdmins',
                ),
            'CompanyServicesIbfk1' => array(
                    'property' => 'CompanyServices',
                    'table_name' => 'CompanyServices',
                ),
            'ConferenceRoomsIbfk1' => array(
                    'property' => 'ConferenceRooms',
                    'table_name' => 'ConferenceRooms',
                ),
            'DDIsIbfk1' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'DomainsIbfk1' => array(
                    'property' => 'Domains',
                    'table_name' => 'Domains',
                ),
            'ExtensionsIbfk1' => array(
                    'property' => 'Extensions',
                    'table_name' => 'Extensions',
                ),
            'ExternalCallFiltersIbfk1' => array(
                    'property' => 'ExternalCallFilters',
                    'table_name' => 'ExternalCallFilters',
                ),
            'FaxesIbfk1' => array(
                    'property' => 'Faxes',
                    'table_name' => 'Faxes',
                ),
            'FeaturesRelCompaniesIbfk1' => array(
                    'property' => 'FeaturesRelCompanies',
                    'table_name' => 'FeaturesRelCompanies',
                ),
            'FriendsIbfk1' => array(
                    'property' => 'Friends',
                    'table_name' => 'Friends',
                ),
            'HuntGroupsIbfk1' => array(
                    'property' => 'HuntGroups',
                    'table_name' => 'HuntGroups',
                ),
            'IVRCommonIbfk1' => array(
                    'property' => 'IVRCommon',
                    'table_name' => 'IVRCommon',
                ),
            'IVRCustomIbfk1' => array(
                    'property' => 'IVRCustom',
                    'table_name' => 'IVRCustom',
                ),
            'InvoicesIbfk2' => array(
                    'property' => 'Invoices',
                    'table_name' => 'Invoices',
                ),
            'LocutionsIbfk1' => array(
                    'property' => 'Locutions',
                    'table_name' => 'Locutions',
                ),
            'MatchListIbfk1' => array(
                    'property' => 'MatchLists',
                    'table_name' => 'MatchLists',
                ),
            'MusicOnHoldIbfk1' => array(
                    'property' => 'MusicOnHold',
                    'table_name' => 'MusicOnHold',
                ),
            'OutgoingDDIRulesIbfk1' => array(
                    'property' => 'OutgoingDDIRules',
                    'table_name' => 'OutgoingDDIRules',
                ),
            'OutgoingRoutingIbfk2' => array(
                    'property' => 'OutgoingRouting',
                    'table_name' => 'OutgoingRouting',
                ),
            'ParsedCDRsIbfk2' => array(
                    'property' => 'ParsedCDRs',
                    'table_name' => 'ParsedCDRs',
                ),
            'PickUpGroupsIbfk1' => array(
                    'property' => 'PickUpGroups',
                    'table_name' => 'PickUpGroups',
                ),
            'PricingPlansRelCompaniesIbfk2' => array(
                    'property' => 'PricingPlansRelCompanies',
                    'table_name' => 'PricingPlansRelCompanies',
                ),
            'QueuesIbfk1' => array(
                    'property' => 'Queues',
                    'table_name' => 'Queues',
                ),
            'RecordingsIbfk1' => array(
                    'property' => 'Recordings',
                    'table_name' => 'Recordings',
                ),
            'RetailAccountsIbfk2' => array(
                    'property' => 'RetailAccounts',
                    'table_name' => 'RetailAccounts',
                ),
            'SchedulesIbfk1' => array(
                    'property' => 'Schedules',
                    'table_name' => 'Schedules',
                ),
            'TerminalsCompanyIdIbfk2' => array(
                    'property' => 'Terminals',
                    'table_name' => 'Terminals',
                ),
            'UsersIbfk1' => array(
                    'property' => 'Users',
                    'table_name' => 'Users',
                ),
            'KamAccCdrsIbfk4' => array(
                    'property' => 'KamAccCdrs',
                    'table_name' => 'kam_acc_cdrs',
                ),
            'KamUsersAddressIbfk1' => array(
                    'property' => 'KamUsersAddress',
                    'table_name' => 'kam_users_address',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'Calendars_ibfk_1',
            'CallAcl_ibfk_1',
            'CallACLPatterns_ibfk_1'
        ));



        $this->_defaultValues = array(
            'type' => 'vpbx',
            'externalMaxCalls' => '0',
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

        return $this;
    }

    public function getFileObjects()
    {

        return array();
    }


    /**************************************************************************
    *********************************** /FSO ***********************************
    ***************************************************************************/

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setBrandId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_brandId != $data) {
            $this->_logChange('brandId', $this->_brandId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_brandId = $data;

        } else if (!is_null($data)) {
            $this->_brandId = (int) $data;

        } else {
            $this->_brandId = $data;
        }
        return $this;
    }

    /**
     * Gets column brandId
     *
     * @return int
     */
    public function getBrandId()
    {
        return $this->_brandId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setType($data)
    {

        if ($this->_type != $data) {
            $this->_logChange('type', $this->_type, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_type = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_typeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for type'));
            }
            $this->_type = (string) $data;

        } else {
            $this->_type = $data;
        }
        return $this;
    }

    /**
     * Gets column type
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Companies
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
     * @return \IvozProvider\Model\Raw\Companies
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\Companies
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
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
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setApplicationServerId($data)
    {

        if ($this->_applicationServerId != $data) {
            $this->_logChange('applicationServerId', $this->_applicationServerId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_applicationServerId = $data;

        } else if (!is_null($data)) {
            $this->_applicationServerId = (int) $data;

        } else {
            $this->_applicationServerId = $data;
        }
        return $this;
    }

    /**
     * Gets column applicationServerId
     *
     * @return int
     */
    public function getApplicationServerId()
    {
        return $this->_applicationServerId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setExternalMaxCalls($data)
    {

        if ($this->_externalMaxCalls != $data) {
            $this->_logChange('externalMaxCalls', $this->_externalMaxCalls, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_externalMaxCalls = $data;

        } else if (!is_null($data)) {
            $this->_externalMaxCalls = (int) $data;

        } else {
            $this->_externalMaxCalls = $data;
        }
        return $this;
    }

    /**
     * Gets column externalMaxCalls
     *
     * @return int
     */
    public function getExternalMaxCalls()
    {
        return $this->_externalMaxCalls;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Companies
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
     * @return \IvozProvider\Model\Raw\Companies
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
     * @return \IvozProvider\Model\Raw\Companies
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
     * @return \IvozProvider\Model\Raw\Companies
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
     * @return \IvozProvider\Model\Raw\Companies
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
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setOutboundPrefix($data)
    {

        if ($this->_outboundPrefix != $data) {
            $this->_logChange('outboundPrefix', $this->_outboundPrefix, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outboundPrefix = $data;

        } else if (!is_null($data)) {
            $this->_outboundPrefix = (string) $data;

        } else {
            $this->_outboundPrefix = $data;
        }
        return $this;
    }

    /**
     * Gets column outbound_prefix
     *
     * @return string
     */
    public function getOutboundPrefix()
    {
        return $this->_outboundPrefix;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setCountryId($data)
    {

        if ($this->_countryId != $data) {
            $this->_logChange('countryId', $this->_countryId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_countryId = $data;

        } else if (!is_null($data)) {
            $this->_countryId = (int) $data;

        } else {
            $this->_countryId = $data;
        }
        return $this;
    }

    /**
     * Gets column countryId
     *
     * @return int
     */
    public function getCountryId()
    {
        return $this->_countryId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setMediaRelaySetsId($data)
    {

        if ($this->_mediaRelaySetsId != $data) {
            $this->_logChange('mediaRelaySetsId', $this->_mediaRelaySetsId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mediaRelaySetsId = $data;

        } else if (!is_null($data)) {
            $this->_mediaRelaySetsId = (int) $data;

        } else {
            $this->_mediaRelaySetsId = $data;
        }
        return $this;
    }

    /**
     * Gets column mediaRelaySetsId
     *
     * @return int
     */
    public function getMediaRelaySetsId()
    {
        return $this->_mediaRelaySetsId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setIpFilter($data)
    {

        if ($this->_ipFilter != $data) {
            $this->_logChange('ipFilter', $this->_ipFilter, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ipFilter = $data;

        } else if (!is_null($data)) {
            $this->_ipFilter = (int) $data;

        } else {
            $this->_ipFilter = $data;
        }
        return $this;
    }

    /**
     * Gets column ipFilter
     *
     * @return int
     */
    public function getIpFilter()
    {
        return $this->_ipFilter;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setOnDemandRecord($data)
    {

        if ($this->_onDemandRecord != $data) {
            $this->_logChange('onDemandRecord', $this->_onDemandRecord, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_onDemandRecord = $data;

        } else if (!is_null($data)) {
            $this->_onDemandRecord = (int) $data;

        } else {
            $this->_onDemandRecord = $data;
        }
        return $this;
    }

    /**
     * Gets column onDemandRecord
     *
     * @return int
     */
    public function getOnDemandRecord()
    {
        return $this->_onDemandRecord;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setOnDemandRecordCode($data)
    {

        if ($this->_onDemandRecordCode != $data) {
            $this->_logChange('onDemandRecordCode', $this->_onDemandRecordCode, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_onDemandRecordCode = $data;

        } else if (!is_null($data)) {
            $this->_onDemandRecordCode = (string) $data;

        } else {
            $this->_onDemandRecordCode = $data;
        }
        return $this;
    }

    /**
     * Gets column onDemandRecordCode
     *
     * @return string
     */
    public function getOnDemandRecordCode()
    {
        return $this->_onDemandRecordCode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setAreaCode($data)
    {

        if ($this->_areaCode != $data) {
            $this->_logChange('areaCode', $this->_areaCode, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_areaCode = $data;

        } else if (!is_null($data)) {
            $this->_areaCode = (string) $data;

        } else {
            $this->_areaCode = $data;
        }
        return $this;
    }

    /**
     * Gets column areaCode
     *
     * @return string
     */
    public function getAreaCode()
    {
        return $this->_areaCode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setExternallyExtraOpts($data)
    {

        if ($this->_externallyExtraOpts != $data) {
            $this->_logChange('externallyExtraOpts', $this->_externallyExtraOpts, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_externallyExtraOpts = $data;

        } else if (!is_null($data)) {
            $this->_externallyExtraOpts = (string) $data;

        } else {
            $this->_externallyExtraOpts = $data;
        }
        return $this;
    }

    /**
     * Gets column externallyExtraOpts
     *
     * @return text
     */
    public function getExternallyExtraOpts()
    {
        return $this->_externallyExtraOpts;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
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
     * @return \IvozProvider\Model\Raw\Companies
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
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setOutgoingDDIId($data)
    {

        if ($this->_outgoingDDIId != $data) {
            $this->_logChange('outgoingDDIId', $this->_outgoingDDIId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outgoingDDIId = $data;

        } else if (!is_null($data)) {
            $this->_outgoingDDIId = (int) $data;

        } else {
            $this->_outgoingDDIId = $data;
        }
        return $this;
    }

    /**
     * Gets column outgoingDDIId
     *
     * @return int
     */
    public function getOutgoingDDIId()
    {
        return $this->_outgoingDDIId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setOutgoingDDIRuleId($data)
    {

        if ($this->_outgoingDDIRuleId != $data) {
            $this->_logChange('outgoingDDIRuleId', $this->_outgoingDDIRuleId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outgoingDDIRuleId = $data;

        } else if (!is_null($data)) {
            $this->_outgoingDDIRuleId = (int) $data;

        } else {
            $this->_outgoingDDIRuleId = $data;
        }
        return $this;
    }

    /**
     * Gets column outgoingDDIRuleId
     *
     * @return int
     */
    public function getOutgoingDDIRuleId()
    {
        return $this->_outgoingDDIRuleId;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setBrand(\IvozProvider\Model\Raw\Brands $data)
    {
        $this->_Brand = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setBrandId($primaryKey);
        }

        $this->_setLoaded('CompaniesIbfk4');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Brand = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Brand;
    }

    /**
     * Sets parent relation ApplicationServer
     *
     * @param \IvozProvider\Model\Raw\ApplicationServers $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setApplicationServer(\IvozProvider\Model\Raw\ApplicationServers $data)
    {
        $this->_ApplicationServer = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setApplicationServerId($primaryKey);
        }

        $this->_setLoaded('CompaniesIbfk5');
        return $this;
    }

    /**
     * Gets parent ApplicationServer
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ApplicationServers
     */
    public function getApplicationServer($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ApplicationServer = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ApplicationServer;
    }

    /**
     * Sets parent relation Country
     *
     * @param \IvozProvider\Model\Raw\Countries $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setCountries(\IvozProvider\Model\Raw\Countries $data)
    {
        $this->_Countries = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCountryId($primaryKey);
        }

        $this->_setLoaded('CompaniesIbfk9');
        return $this;
    }

    /**
     * Gets parent Country
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function getCountries($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk9';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Countries = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Countries;
    }

    /**
     * Sets parent relation Language
     *
     * @param \IvozProvider\Model\Raw\Languages $data
     * @return \IvozProvider\Model\Raw\Companies
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

        $this->_setLoaded('CompaniesIbfk10');
        return $this;
    }

    /**
     * Gets parent Language
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Languages
     */
    public function getLanguage($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk10';

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
     * Sets parent relation MediaRelaySets
     *
     * @param \IvozProvider\Model\Raw\MediaRelaySets $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setMediaRelaySets(\IvozProvider\Model\Raw\MediaRelaySets $data)
    {
        $this->_MediaRelaySets = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setMediaRelaySetsId($primaryKey);
        }

        $this->_setLoaded('CompaniesIbfk11');
        return $this;
    }

    /**
     * Gets parent MediaRelaySets
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\MediaRelaySets
     */
    public function getMediaRelaySets($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk11';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_MediaRelaySets = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_MediaRelaySets;
    }

    /**
     * Sets parent relation DefaultTimezone
     *
     * @param \IvozProvider\Model\Raw\Timezones $data
     * @return \IvozProvider\Model\Raw\Companies
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

        $this->_setLoaded('CompaniesIbfk12');
        return $this;
    }

    /**
     * Gets parent DefaultTimezone
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function getDefaultTimezone($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk12';

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
     * Sets parent relation OutgoingDDI
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setOutgoingDDI(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_OutgoingDDI = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutgoingDDIId($primaryKey);
        }

        $this->_setLoaded('CompaniesIbfk13');
        return $this;
    }

    /**
     * Gets parent OutgoingDDI
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function getOutgoingDDI($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk13';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingDDI = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_OutgoingDDI;
    }

    /**
     * Sets parent relation OutgoingDDIRule
     *
     * @param \IvozProvider\Model\Raw\OutgoingDDIRules $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setOutgoingDDIRule(\IvozProvider\Model\Raw\OutgoingDDIRules $data)
    {
        $this->_OutgoingDDIRule = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutgoingDDIRuleId($primaryKey);
        }

        $this->_setLoaded('CompaniesIbfk14');
        return $this;
    }

    /**
     * Gets parent OutgoingDDIRule
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function getOutgoingDDIRule($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk14';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingDDIRule = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_OutgoingDDIRule;
    }

    /**
     * Sets dependent relations Calendars_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Calendars
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setCalendars(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Calendars === null) {

                $this->getCalendars();
            }

            $oldRelations = $this->_Calendars;

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

        $this->_Calendars = array();

        foreach ($data as $object) {
            $this->addCalendars($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Calendars_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Calendars $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addCalendars(\IvozProvider\Model\Raw\Calendars $data)
    {
        $this->_Calendars[] = $data;
        $this->_setLoaded('CalendarsIbfk1');
        return $this;
    }

    /**
     * Gets dependent Calendars_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Calendars
     */
    public function getCalendars($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CalendarsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Calendars = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Calendars;
    }

    /**
     * Sets dependent relations CallAcl_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\CallACL
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setCallACL(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_CallACL === null) {

                $this->getCallACL();
            }

            $oldRelations = $this->_CallACL;

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

        $this->_CallACL = array();

        foreach ($data as $object) {
            $this->addCallACL($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations CallAcl_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\CallACL $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addCallACL(\IvozProvider\Model\Raw\CallACL $data)
    {
        $this->_CallACL[] = $data;
        $this->_setLoaded('CallAclIbfk1');
        return $this;
    }

    /**
     * Gets dependent CallAcl_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\CallACL
     */
    public function getCallACL($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CallAclIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_CallACL = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_CallACL;
    }

    /**
     * Sets dependent relations CallACLPatterns_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\CallACLPatterns
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setCallACLPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_CallACLPatterns === null) {

                $this->getCallACLPatterns();
            }

            $oldRelations = $this->_CallACLPatterns;

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

        $this->_CallACLPatterns = array();

        foreach ($data as $object) {
            $this->addCallACLPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations CallACLPatterns_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\CallACLPatterns $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addCallACLPatterns(\IvozProvider\Model\Raw\CallACLPatterns $data)
    {
        $this->_CallACLPatterns[] = $data;
        $this->_setLoaded('CallACLPatternsIbfk1');
        return $this;
    }

    /**
     * Gets dependent CallACLPatterns_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\CallACLPatterns
     */
    public function getCallACLPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CallACLPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_CallACLPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_CallACLPatterns;
    }

    /**
     * Sets dependent relations CompanyAdmins_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\CompanyAdmins
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setCompanyAdmins(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_CompanyAdmins === null) {

                $this->getCompanyAdmins();
            }

            $oldRelations = $this->_CompanyAdmins;

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

        $this->_CompanyAdmins = array();

        foreach ($data as $object) {
            $this->addCompanyAdmins($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations CompanyAdmins_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\CompanyAdmins $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addCompanyAdmins(\IvozProvider\Model\Raw\CompanyAdmins $data)
    {
        $this->_CompanyAdmins[] = $data;
        $this->_setLoaded('CompanyAdminsIbfk1');
        return $this;
    }

    /**
     * Gets dependent CompanyAdmins_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\CompanyAdmins
     */
    public function getCompanyAdmins($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompanyAdminsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_CompanyAdmins = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_CompanyAdmins;
    }

    /**
     * Sets dependent relations CompanyServices_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\CompanyServices
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setCompanyServices(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_CompanyServices === null) {

                $this->getCompanyServices();
            }

            $oldRelations = $this->_CompanyServices;

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

        $this->_CompanyServices = array();

        foreach ($data as $object) {
            $this->addCompanyServices($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations CompanyServices_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\CompanyServices $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addCompanyServices(\IvozProvider\Model\Raw\CompanyServices $data)
    {
        $this->_CompanyServices[] = $data;
        $this->_setLoaded('CompanyServicesIbfk1');
        return $this;
    }

    /**
     * Gets dependent CompanyServices_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\CompanyServices
     */
    public function getCompanyServices($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompanyServicesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_CompanyServices = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_CompanyServices;
    }

    /**
     * Sets dependent relations ConferenceRooms_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ConferenceRooms
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setConferenceRooms(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ConferenceRooms === null) {

                $this->getConferenceRooms();
            }

            $oldRelations = $this->_ConferenceRooms;

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

        $this->_ConferenceRooms = array();

        foreach ($data as $object) {
            $this->addConferenceRooms($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ConferenceRooms_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\ConferenceRooms $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addConferenceRooms(\IvozProvider\Model\Raw\ConferenceRooms $data)
    {
        $this->_ConferenceRooms[] = $data;
        $this->_setLoaded('ConferenceRoomsIbfk1');
        return $this;
    }

    /**
     * Gets dependent ConferenceRooms_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ConferenceRooms
     */
    public function getConferenceRooms($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConferenceRoomsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ConferenceRooms = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ConferenceRooms;
    }

    /**
     * Sets dependent relations DDIs_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\Companies
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
     * Sets dependent relations DDIs_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk1');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk1';

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
     * Sets dependent relations Domains_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Domains
     * @return \IvozProvider\Model\Raw\Companies
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
     * Sets dependent relations Domains_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Domains $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addDomains(\IvozProvider\Model\Raw\Domains $data)
    {
        $this->_Domains[] = $data;
        $this->_setLoaded('DomainsIbfk1');
        return $this;
    }

    /**
     * Gets dependent Domains_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Domains
     */
    public function getDomains($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DomainsIbfk1';

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
     * Sets dependent relations Extensions_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Extensions
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setExtensions(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Extensions === null) {

                $this->getExtensions();
            }

            $oldRelations = $this->_Extensions;

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

        $this->_Extensions = array();

        foreach ($data as $object) {
            $this->addExtensions($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Extensions_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addExtensions(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_Extensions[] = $data;
        $this->_setLoaded('ExtensionsIbfk1');
        return $this;
    }

    /**
     * Gets dependent Extensions_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Extensions
     */
    public function getExtensions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExtensionsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Extensions = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Extensions;
    }

    /**
     * Sets dependent relations ExternalCallFilters_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ExternalCallFilters
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setExternalCallFilters(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ExternalCallFilters === null) {

                $this->getExternalCallFilters();
            }

            $oldRelations = $this->_ExternalCallFilters;

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

        $this->_ExternalCallFilters = array();

        foreach ($data as $object) {
            $this->addExternalCallFilters($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ExternalCallFilters_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilters $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addExternalCallFilters(\IvozProvider\Model\Raw\ExternalCallFilters $data)
    {
        $this->_ExternalCallFilters[] = $data;
        $this->_setLoaded('ExternalCallFiltersIbfk1');
        return $this;
    }

    /**
     * Gets dependent ExternalCallFilters_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function getExternalCallFilters($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ExternalCallFilters = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ExternalCallFilters;
    }

    /**
     * Sets dependent relations Faxes_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Faxes
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setFaxes(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Faxes === null) {

                $this->getFaxes();
            }

            $oldRelations = $this->_Faxes;

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

        $this->_Faxes = array();

        foreach ($data as $object) {
            $this->addFaxes($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Faxes_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Faxes $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addFaxes(\IvozProvider\Model\Raw\Faxes $data)
    {
        $this->_Faxes[] = $data;
        $this->_setLoaded('FaxesIbfk1');
        return $this;
    }

    /**
     * Gets dependent Faxes_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Faxes
     */
    public function getFaxes($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FaxesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Faxes = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Faxes;
    }

    /**
     * Sets dependent relations FeaturesRelCompanies_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\FeaturesRelCompanies
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setFeaturesRelCompanies(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_FeaturesRelCompanies === null) {

                $this->getFeaturesRelCompanies();
            }

            $oldRelations = $this->_FeaturesRelCompanies;

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

        $this->_FeaturesRelCompanies = array();

        foreach ($data as $object) {
            $this->addFeaturesRelCompanies($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations FeaturesRelCompanies_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\FeaturesRelCompanies $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addFeaturesRelCompanies(\IvozProvider\Model\Raw\FeaturesRelCompanies $data)
    {
        $this->_FeaturesRelCompanies[] = $data;
        $this->_setLoaded('FeaturesRelCompaniesIbfk1');
        return $this;
    }

    /**
     * Gets dependent FeaturesRelCompanies_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\FeaturesRelCompanies
     */
    public function getFeaturesRelCompanies($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FeaturesRelCompaniesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_FeaturesRelCompanies = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_FeaturesRelCompanies;
    }

    /**
     * Sets dependent relations Friends_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Friends
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setFriends(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Friends === null) {

                $this->getFriends();
            }

            $oldRelations = $this->_Friends;

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

        $this->_Friends = array();

        foreach ($data as $object) {
            $this->addFriends($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Friends_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Friends $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addFriends(\IvozProvider\Model\Raw\Friends $data)
    {
        $this->_Friends[] = $data;
        $this->_setLoaded('FriendsIbfk1');
        return $this;
    }

    /**
     * Gets dependent Friends_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Friends
     */
    public function getFriends($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FriendsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Friends = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Friends;
    }

    /**
     * Sets dependent relations HuntGroups_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\HuntGroups
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setHuntGroups(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_HuntGroups === null) {

                $this->getHuntGroups();
            }

            $oldRelations = $this->_HuntGroups;

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

        $this->_HuntGroups = array();

        foreach ($data as $object) {
            $this->addHuntGroups($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations HuntGroups_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\HuntGroups $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addHuntGroups(\IvozProvider\Model\Raw\HuntGroups $data)
    {
        $this->_HuntGroups[] = $data;
        $this->_setLoaded('HuntGroupsIbfk1');
        return $this;
    }

    /**
     * Gets dependent HuntGroups_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\HuntGroups
     */
    public function getHuntGroups($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_HuntGroups = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_HuntGroups;
    }

    /**
     * Sets dependent relations IVRCommon_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\IVRCommon
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setIVRCommon(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_IVRCommon === null) {

                $this->getIVRCommon();
            }

            $oldRelations = $this->_IVRCommon;

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

        $this->_IVRCommon = array();

        foreach ($data as $object) {
            $this->addIVRCommon($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations IVRCommon_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\IVRCommon $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addIVRCommon(\IvozProvider\Model\Raw\IVRCommon $data)
    {
        $this->_IVRCommon[] = $data;
        $this->_setLoaded('IVRCommonIbfk1');
        return $this;
    }

    /**
     * Gets dependent IVRCommon_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\IVRCommon
     */
    public function getIVRCommon($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_IVRCommon = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_IVRCommon;
    }

    /**
     * Sets dependent relations IVRCustom_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\IVRCustom
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setIVRCustom(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_IVRCustom === null) {

                $this->getIVRCustom();
            }

            $oldRelations = $this->_IVRCustom;

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

        $this->_IVRCustom = array();

        foreach ($data as $object) {
            $this->addIVRCustom($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations IVRCustom_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\IVRCustom $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addIVRCustom(\IvozProvider\Model\Raw\IVRCustom $data)
    {
        $this->_IVRCustom[] = $data;
        $this->_setLoaded('IVRCustomIbfk1');
        return $this;
    }

    /**
     * Gets dependent IVRCustom_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\IVRCustom
     */
    public function getIVRCustom($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCustomIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_IVRCustom = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_IVRCustom;
    }

    /**
     * Sets dependent relations Invoices_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Invoices
     * @return \IvozProvider\Model\Raw\Companies
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
     * Sets dependent relations Invoices_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\Invoices $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addInvoices(\IvozProvider\Model\Raw\Invoices $data)
    {
        $this->_Invoices[] = $data;
        $this->_setLoaded('InvoicesIbfk2');
        return $this;
    }

    /**
     * Gets dependent Invoices_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Invoices
     */
    public function getInvoices($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'InvoicesIbfk2';

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
     * Sets dependent relations Locutions_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Locutions
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setLocutions(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Locutions === null) {

                $this->getLocutions();
            }

            $oldRelations = $this->_Locutions;

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

        $this->_Locutions = array();

        foreach ($data as $object) {
            $this->addLocutions($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Locutions_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addLocutions(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_Locutions[] = $data;
        $this->_setLoaded('LocutionsIbfk1');
        return $this;
    }

    /**
     * Gets dependent Locutions_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Locutions
     */
    public function getLocutions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LocutionsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Locutions = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Locutions;
    }

    /**
     * Sets dependent relations MatchList_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\MatchLists
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setMatchLists(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_MatchLists === null) {

                $this->getMatchLists();
            }

            $oldRelations = $this->_MatchLists;

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

        $this->_MatchLists = array();

        foreach ($data as $object) {
            $this->addMatchLists($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations MatchList_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\MatchLists $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addMatchLists(\IvozProvider\Model\Raw\MatchLists $data)
    {
        $this->_MatchLists[] = $data;
        $this->_setLoaded('MatchListIbfk1');
        return $this;
    }

    /**
     * Gets dependent MatchList_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\MatchLists
     */
    public function getMatchLists($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'MatchListIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_MatchLists = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_MatchLists;
    }

    /**
     * Sets dependent relations MusicOnHold_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\MusicOnHold
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setMusicOnHold(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_MusicOnHold === null) {

                $this->getMusicOnHold();
            }

            $oldRelations = $this->_MusicOnHold;

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

        $this->_MusicOnHold = array();

        foreach ($data as $object) {
            $this->addMusicOnHold($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations MusicOnHold_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\MusicOnHold $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addMusicOnHold(\IvozProvider\Model\Raw\MusicOnHold $data)
    {
        $this->_MusicOnHold[] = $data;
        $this->_setLoaded('MusicOnHoldIbfk1');
        return $this;
    }

    /**
     * Gets dependent MusicOnHold_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\MusicOnHold
     */
    public function getMusicOnHold($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'MusicOnHoldIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_MusicOnHold = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_MusicOnHold;
    }

    /**
     * Sets dependent relations OutgoingDDIRules_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\OutgoingDDIRules
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setOutgoingDDIRules(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_OutgoingDDIRules === null) {

                $this->getOutgoingDDIRules();
            }

            $oldRelations = $this->_OutgoingDDIRules;

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

        $this->_OutgoingDDIRules = array();

        foreach ($data as $object) {
            $this->addOutgoingDDIRules($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations OutgoingDDIRules_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\OutgoingDDIRules $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addOutgoingDDIRules(\IvozProvider\Model\Raw\OutgoingDDIRules $data)
    {
        $this->_OutgoingDDIRules[] = $data;
        $this->_setLoaded('OutgoingDDIRulesIbfk1');
        return $this;
    }

    /**
     * Gets dependent OutgoingDDIRules_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function getOutgoingDDIRules($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingDDIRulesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingDDIRules = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_OutgoingDDIRules;
    }

    /**
     * Sets dependent relations OutgoingRouting_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\OutgoingRouting
     * @return \IvozProvider\Model\Raw\Companies
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
     * Sets dependent relations OutgoingRouting_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\OutgoingRouting $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addOutgoingRouting(\IvozProvider\Model\Raw\OutgoingRouting $data)
    {
        $this->_OutgoingRouting[] = $data;
        $this->_setLoaded('OutgoingRoutingIbfk2');
        return $this;
    }

    /**
     * Gets dependent OutgoingRouting_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\OutgoingRouting
     */
    public function getOutgoingRouting($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingRoutingIbfk2';

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
     * Sets dependent relations ParsedCDRs_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ParsedCDRs
     * @return \IvozProvider\Model\Raw\Companies
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
     * Sets dependent relations ParsedCDRs_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\ParsedCDRs $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addParsedCDRs(\IvozProvider\Model\Raw\ParsedCDRs $data)
    {
        $this->_ParsedCDRs[] = $data;
        $this->_setLoaded('ParsedCDRsIbfk2');
        return $this;
    }

    /**
     * Gets dependent ParsedCDRs_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function getParsedCDRs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ParsedCDRsIbfk2';

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
     * Sets dependent relations PickUpGroups_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PickUpGroups
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setPickUpGroups(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PickUpGroups === null) {

                $this->getPickUpGroups();
            }

            $oldRelations = $this->_PickUpGroups;

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

        $this->_PickUpGroups = array();

        foreach ($data as $object) {
            $this->addPickUpGroups($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PickUpGroups_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\PickUpGroups $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addPickUpGroups(\IvozProvider\Model\Raw\PickUpGroups $data)
    {
        $this->_PickUpGroups[] = $data;
        $this->_setLoaded('PickUpGroupsIbfk1');
        return $this;
    }

    /**
     * Gets dependent PickUpGroups_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PickUpGroups
     */
    public function getPickUpGroups($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PickUpGroupsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PickUpGroups = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PickUpGroups;
    }

    /**
     * Sets dependent relations PricingPlansRelCompanies_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PricingPlansRelCompanies
     * @return \IvozProvider\Model\Raw\Companies
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
     * Sets dependent relations PricingPlansRelCompanies_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\PricingPlansRelCompanies $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addPricingPlansRelCompanies(\IvozProvider\Model\Raw\PricingPlansRelCompanies $data)
    {
        $this->_PricingPlansRelCompanies[] = $data;
        $this->_setLoaded('PricingPlansRelCompaniesIbfk2');
        return $this;
    }

    /**
     * Gets dependent PricingPlansRelCompanies_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PricingPlansRelCompanies
     */
    public function getPricingPlansRelCompanies($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PricingPlansRelCompaniesIbfk2';

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
     * Sets dependent relations Queues_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Queues
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setQueues(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Queues === null) {

                $this->getQueues();
            }

            $oldRelations = $this->_Queues;

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

        $this->_Queues = array();

        foreach ($data as $object) {
            $this->addQueues($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Queues_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Queues $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addQueues(\IvozProvider\Model\Raw\Queues $data)
    {
        $this->_Queues[] = $data;
        $this->_setLoaded('QueuesIbfk1');
        return $this;
    }

    /**
     * Gets dependent Queues_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Queues
     */
    public function getQueues($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Queues = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Queues;
    }

    /**
     * Sets dependent relations Recordings_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Recordings
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setRecordings(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Recordings === null) {

                $this->getRecordings();
            }

            $oldRelations = $this->_Recordings;

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

        $this->_Recordings = array();

        foreach ($data as $object) {
            $this->addRecordings($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Recordings_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Recordings $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addRecordings(\IvozProvider\Model\Raw\Recordings $data)
    {
        $this->_Recordings[] = $data;
        $this->_setLoaded('RecordingsIbfk1');
        return $this;
    }

    /**
     * Gets dependent Recordings_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Recordings
     */
    public function getRecordings($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RecordingsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Recordings = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Recordings;
    }

    /**
     * Sets dependent relations RetailAccounts_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\RetailAccounts
     * @return \IvozProvider\Model\Raw\Companies
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
     * Sets dependent relations RetailAccounts_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\RetailAccounts $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addRetailAccounts(\IvozProvider\Model\Raw\RetailAccounts $data)
    {
        $this->_RetailAccounts[] = $data;
        $this->_setLoaded('RetailAccountsIbfk2');
        return $this;
    }

    /**
     * Gets dependent RetailAccounts_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\RetailAccounts
     */
    public function getRetailAccounts($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RetailAccountsIbfk2';

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
     * Sets dependent relations Schedules_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Schedules
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setSchedules(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Schedules === null) {

                $this->getSchedules();
            }

            $oldRelations = $this->_Schedules;

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

        $this->_Schedules = array();

        foreach ($data as $object) {
            $this->addSchedules($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Schedules_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Schedules $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addSchedules(\IvozProvider\Model\Raw\Schedules $data)
    {
        $this->_Schedules[] = $data;
        $this->_setLoaded('SchedulesIbfk1');
        return $this;
    }

    /**
     * Gets dependent Schedules_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Schedules
     */
    public function getSchedules($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'SchedulesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Schedules = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Schedules;
    }

    /**
     * Sets dependent relations Terminals_CompanyId_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Terminals
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setTerminals(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Terminals === null) {

                $this->getTerminals();
            }

            $oldRelations = $this->_Terminals;

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

        $this->_Terminals = array();

        foreach ($data as $object) {
            $this->addTerminals($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Terminals_CompanyId_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\Terminals $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addTerminals(\IvozProvider\Model\Raw\Terminals $data)
    {
        $this->_Terminals[] = $data;
        $this->_setLoaded('TerminalsCompanyIdIbfk2');
        return $this;
    }

    /**
     * Gets dependent Terminals_CompanyId_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Terminals
     */
    public function getTerminals($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TerminalsCompanyIdIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Terminals = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Terminals;
    }

    /**
     * Sets dependent relations Users_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Users
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setUsers(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Users === null) {

                $this->getUsers();
            }

            $oldRelations = $this->_Users;

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

        $this->_Users = array();

        foreach ($data as $object) {
            $this->addUsers($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Users_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addUsers(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_Users[] = $data;
        $this->_setLoaded('UsersIbfk1');
        return $this;
    }

    /**
     * Gets dependent Users_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Users
     */
    public function getUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Users = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Users;
    }

    /**
     * Sets dependent relations kam_acc_cdrs_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\KamAccCdrs
     * @return \IvozProvider\Model\Raw\Companies
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
     * Sets dependent relations kam_acc_cdrs_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\KamAccCdrs $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addKamAccCdrs(\IvozProvider\Model\Raw\KamAccCdrs $data)
    {
        $this->_KamAccCdrs[] = $data;
        $this->_setLoaded('KamAccCdrsIbfk4');
        return $this;
    }

    /**
     * Gets dependent kam_acc_cdrs_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function getKamAccCdrs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamAccCdrsIbfk4';

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
     * Sets dependent relations kam_users_address_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\KamUsersAddress
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function setKamUsersAddress(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KamUsersAddress === null) {

                $this->getKamUsersAddress();
            }

            $oldRelations = $this->_KamUsersAddress;

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

        $this->_KamUsersAddress = array();

        foreach ($data as $object) {
            $this->addKamUsersAddress($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations kam_users_address_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\KamUsersAddress $data
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function addKamUsersAddress(\IvozProvider\Model\Raw\KamUsersAddress $data)
    {
        $this->_KamUsersAddress[] = $data;
        $this->_setLoaded('KamUsersAddressIbfk1');
        return $this;
    }

    /**
     * Gets dependent kam_users_address_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\KamUsersAddress
     */
    public function getKamUsersAddress($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamUsersAddressIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KamUsersAddress = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KamUsersAddress;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Companies
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Companies')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Companies);

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
     * @return null | \IvozProvider\Model\Validator\Companies
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Companies')) {

                $this->setValidator(new \IvozProvider\Validator\Companies);
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
     * @see \Mapper\Sql\Companies::delete
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