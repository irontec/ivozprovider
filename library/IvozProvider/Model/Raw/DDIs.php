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
class DDIs extends ModelAbstract
{

    protected $_recordCallsAcceptedValues = array(
        'none',
        'all',
        'inbound',
        'outbound',
    );
    protected $_routeTypeAcceptedValues = array(
        'user',
        'IVRCommon',
        'IVRCustom',
        'huntGroup',
        'fax',
        'conferenceRoom',
        'friend',
        'queue',
        'retailAccount',
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
     * Database var type int
     *
     * @var int
     */
    protected $_companyId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_DDI;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_DDIE164;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_externalCallFilterId;

    /**
     * [enum:none|all|inbound|outbound]
     * Database var type varchar
     *
     * @var string
     */
    protected $_recordCalls;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_displayName;

    /**
     * [enum:user|IVRCommon|IVRCustom|huntGroup|fax|conferenceRoom|friend|queue|retailAccount]
     * Database var type varchar
     *
     * @var string
     */
    protected $_routeType;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_userId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_IVRCommonId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_IVRCustomId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_huntGroupId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_faxId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_conferenceRoomId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_retailAccountId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_peeringContractId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_countryId;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_billInboundCalls;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_friendValue;

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
    protected $_queueId;


    /**
     * Parent relation DDIs_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation DDIs_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilters
     */
    protected $_ExternalCallFilter;

    /**
     * Parent relation DDIs_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_User;

    /**
     * Parent relation DDIs_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\IVRCommon
     */
    protected $_IVRCommon;

    /**
     * Parent relation DDIs_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\IVRCustom
     */
    protected $_IVRCustom;

    /**
     * Parent relation DDIs_ibfk_6
     *
     * @var \IvozProvider\Model\Raw\HuntGroups
     */
    protected $_HuntGroup;

    /**
     * Parent relation DDIs_ibfk_7
     *
     * @var \IvozProvider\Model\Raw\Faxes
     */
    protected $_Fax;

    /**
     * Parent relation DDIs_ibfk_8
     *
     * @var \IvozProvider\Model\Raw\PeeringContracts
     */
    protected $_PeeringContract;

    /**
     * Parent relation DDIs_ibfk_9
     *
     * @var \IvozProvider\Model\Raw\Countries
     */
    protected $_Country;

    /**
     * Parent relation DDIs_ibfk_10
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation DDIs_ibfk_11
     *
     * @var \IvozProvider\Model\Raw\ConferenceRooms
     */
    protected $_ConferenceRoom;

    /**
     * Parent relation DDIs_ibfk_12
     *
     * @var \IvozProvider\Model\Raw\Languages
     */
    protected $_Language;

    /**
     * Parent relation DDIs_ibfk_13
     *
     * @var \IvozProvider\Model\Raw\Queues
     */
    protected $_Queue;

    /**
     * Parent relation DDIs_ibfk_14
     *
     * @var \IvozProvider\Model\Raw\RetailAccounts
     */
    protected $_RetailAccount;


    /**
     * Dependent relation Companies_ibfk_13
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Companies[]
     */
    protected $_Companies;

    /**
     * Dependent relation Faxes_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Faxes[]
     */
    protected $_Faxes;

    /**
     * Dependent relation Friends_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Friends[]
     */
    protected $_Friends;

    /**
     * Dependent relation OutgoingDDIRules_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\OutgoingDDIRules[]
     */
    protected $_OutgoingDDIRules;

    /**
     * Dependent relation OutgoingDDIRulesPatterns_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns[]
     */
    protected $_OutgoingDDIRulesPatterns;

    /**
     * Dependent relation RetailAccounts_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\RetailAccounts[]
     */
    protected $_RetailAccounts;

    /**
     * Dependent relation Users_ibfk_9
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Users[]
     */
    protected $_Users;

    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
        'companyId'=>'companyId',
        'DDI'=>'DDI',
        'DDIE164'=>'DDIE164',
        'externalCallFilterId'=>'externalCallFilterId',
        'recordCalls'=>'recordCalls',
        'displayName'=>'displayName',
        'routeType'=>'routeType',
        'userId'=>'userId',
        'IVRCommonId'=>'IVRCommonId',
        'IVRCustomId'=>'IVRCustomId',
        'huntGroupId'=>'huntGroupId',
        'faxId'=>'faxId',
        'conferenceRoomId'=>'conferenceRoomId',
        'retailAccountId'=>'retailAccountId',
        'peeringContractId'=>'peeringContractId',
        'countryId'=>'countryId',
        'billInboundCalls'=>'billInboundCalls',
        'friendValue'=>'friendValue',
        'languageId'=>'languageId',
        'queueId'=>'queueId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'recordCalls'=> array('enum:none|all|inbound|outbound'),
            'routeType'=> array('enum:user|IVRCommon|IVRCustom|huntGroup|fax|conferenceRoom|friend|queue|retailAccount'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'DDIsIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'DDIsIbfk2'=> array(
                    'property' => 'ExternalCallFilter',
                    'table_name' => 'ExternalCallFilters',
                ),
            'DDIsIbfk3'=> array(
                    'property' => 'User',
                    'table_name' => 'Users',
                ),
            'DDIsIbfk4'=> array(
                    'property' => 'IVRCommon',
                    'table_name' => 'IVRCommon',
                ),
            'DDIsIbfk5'=> array(
                    'property' => 'IVRCustom',
                    'table_name' => 'IVRCustom',
                ),
            'DDIsIbfk6'=> array(
                    'property' => 'HuntGroup',
                    'table_name' => 'HuntGroups',
                ),
            'DDIsIbfk7'=> array(
                    'property' => 'Fax',
                    'table_name' => 'Faxes',
                ),
            'DDIsIbfk8'=> array(
                    'property' => 'PeeringContract',
                    'table_name' => 'PeeringContracts',
                ),
            'DDIsIbfk9'=> array(
                    'property' => 'Country',
                    'table_name' => 'Countries',
                ),
            'DDIsIbfk10'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'DDIsIbfk11'=> array(
                    'property' => 'ConferenceRoom',
                    'table_name' => 'ConferenceRooms',
                ),
            'DDIsIbfk12'=> array(
                    'property' => 'Language',
                    'table_name' => 'Languages',
                ),
            'DDIsIbfk13'=> array(
                    'property' => 'Queue',
                    'table_name' => 'Queues',
                ),
            'DDIsIbfk14'=> array(
                    'property' => 'RetailAccount',
                    'table_name' => 'RetailAccounts',
                ),
        ));

        $this->setDependentList(array(
            'CompaniesIbfk13' => array(
                    'property' => 'Companies',
                    'table_name' => 'Companies',
                ),
            'FaxesIbfk2' => array(
                    'property' => 'Faxes',
                    'table_name' => 'Faxes',
                ),
            'FriendsIbfk4' => array(
                    'property' => 'Friends',
                    'table_name' => 'Friends',
                ),
            'OutgoingDDIRulesIbfk2' => array(
                    'property' => 'OutgoingDDIRules',
                    'table_name' => 'OutgoingDDIRules',
                ),
            'OutgoingDDIRulesPatternsIbfk3' => array(
                    'property' => 'OutgoingDDIRulesPatterns',
                    'table_name' => 'OutgoingDDIRulesPatterns',
                ),
            'RetailAccountsIbfk4' => array(
                    'property' => 'RetailAccounts',
                    'table_name' => 'RetailAccounts',
                ),
            'UsersIbfk9' => array(
                    'property' => 'Users',
                    'table_name' => 'Users',
                ),
        ));


        $this->setOnDeleteSetNullRelationships(array(
            'Companies_ibfk_13'
        ));


        $this->_defaultValues = array(
            'recordCalls' => 'none',
            'billInboundCalls' => '0',
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
     * @return \IvozProvider\Model\Raw\DDIs
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
     * @return \IvozProvider\Model\Raw\DDIs
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_companyId != $data) {
            $this->_logChange('companyId', $this->_companyId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_companyId = $data;

        } else if (!is_null($data)) {
            $this->_companyId = (int) $data;

        } else {
            $this->_companyId = $data;
        }
        return $this;
    }

    /**
     * Gets column companyId
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->_companyId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setDDI($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_DDI != $data) {
            $this->_logChange('DDI', $this->_DDI, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_DDI = $data;

        } else if (!is_null($data)) {
            $this->_DDI = (string) $data;

        } else {
            $this->_DDI = $data;
        }
        return $this;
    }

    /**
     * Gets column DDI
     *
     * @return string
     */
    public function getDDI()
    {
        return $this->_DDI;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setDDIE164($data)
    {

        if ($this->_DDIE164 != $data) {
            $this->_logChange('DDIE164', $this->_DDIE164, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_DDIE164 = $data;

        } else if (!is_null($data)) {
            $this->_DDIE164 = (string) $data;

        } else {
            $this->_DDIE164 = $data;
        }
        return $this;
    }

    /**
     * Gets column DDIE164
     *
     * @return string
     */
    public function getDDIE164()
    {
        return $this->_DDIE164;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setExternalCallFilterId($data)
    {

        if ($this->_externalCallFilterId != $data) {
            $this->_logChange('externalCallFilterId', $this->_externalCallFilterId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_externalCallFilterId = $data;

        } else if (!is_null($data)) {
            $this->_externalCallFilterId = (int) $data;

        } else {
            $this->_externalCallFilterId = $data;
        }
        return $this;
    }

    /**
     * Gets column externalCallFilterId
     *
     * @return int
     */
    public function getExternalCallFilterId()
    {
        return $this->_externalCallFilterId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setRecordCalls($data)
    {

        if ($this->_recordCalls != $data) {
            $this->_logChange('recordCalls', $this->_recordCalls, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_recordCalls = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_recordCallsAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for recordCalls'));
            }
            $this->_recordCalls = (string) $data;

        } else {
            $this->_recordCalls = $data;
        }
        return $this;
    }

    /**
     * Gets column recordCalls
     *
     * @return string
     */
    public function getRecordCalls()
    {
        return $this->_recordCalls;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setDisplayName($data)
    {

        if ($this->_displayName != $data) {
            $this->_logChange('displayName', $this->_displayName, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_displayName = $data;

        } else if (!is_null($data)) {
            $this->_displayName = (string) $data;

        } else {
            $this->_displayName = $data;
        }
        return $this;
    }

    /**
     * Gets column displayName
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->_displayName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setRouteType($data)
    {

        if ($this->_routeType != $data) {
            $this->_logChange('routeType', $this->_routeType, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_routeType = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_routeTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for routeType'));
            }
            $this->_routeType = (string) $data;

        } else {
            $this->_routeType = $data;
        }
        return $this;
    }

    /**
     * Gets column routeType
     *
     * @return string
     */
    public function getRouteType()
    {
        return $this->_routeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setUserId($data)
    {

        if ($this->_userId != $data) {
            $this->_logChange('userId', $this->_userId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_userId = $data;

        } else if (!is_null($data)) {
            $this->_userId = (int) $data;

        } else {
            $this->_userId = $data;
        }
        return $this;
    }

    /**
     * Gets column userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setIVRCommonId($data)
    {

        if ($this->_IVRCommonId != $data) {
            $this->_logChange('IVRCommonId', $this->_IVRCommonId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_IVRCommonId = $data;

        } else if (!is_null($data)) {
            $this->_IVRCommonId = (int) $data;

        } else {
            $this->_IVRCommonId = $data;
        }
        return $this;
    }

    /**
     * Gets column IVRCommonId
     *
     * @return int
     */
    public function getIVRCommonId()
    {
        return $this->_IVRCommonId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setIVRCustomId($data)
    {

        if ($this->_IVRCustomId != $data) {
            $this->_logChange('IVRCustomId', $this->_IVRCustomId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_IVRCustomId = $data;

        } else if (!is_null($data)) {
            $this->_IVRCustomId = (int) $data;

        } else {
            $this->_IVRCustomId = $data;
        }
        return $this;
    }

    /**
     * Gets column IVRCustomId
     *
     * @return int
     */
    public function getIVRCustomId()
    {
        return $this->_IVRCustomId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setHuntGroupId($data)
    {

        if ($this->_huntGroupId != $data) {
            $this->_logChange('huntGroupId', $this->_huntGroupId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_huntGroupId = $data;

        } else if (!is_null($data)) {
            $this->_huntGroupId = (int) $data;

        } else {
            $this->_huntGroupId = $data;
        }
        return $this;
    }

    /**
     * Gets column huntGroupId
     *
     * @return int
     */
    public function getHuntGroupId()
    {
        return $this->_huntGroupId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setFaxId($data)
    {

        if ($this->_faxId != $data) {
            $this->_logChange('faxId', $this->_faxId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_faxId = $data;

        } else if (!is_null($data)) {
            $this->_faxId = (int) $data;

        } else {
            $this->_faxId = $data;
        }
        return $this;
    }

    /**
     * Gets column faxId
     *
     * @return int
     */
    public function getFaxId()
    {
        return $this->_faxId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setConferenceRoomId($data)
    {

        if ($this->_conferenceRoomId != $data) {
            $this->_logChange('conferenceRoomId', $this->_conferenceRoomId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_conferenceRoomId = $data;

        } else if (!is_null($data)) {
            $this->_conferenceRoomId = (int) $data;

        } else {
            $this->_conferenceRoomId = $data;
        }
        return $this;
    }

    /**
     * Gets column conferenceRoomId
     *
     * @return int
     */
    public function getConferenceRoomId()
    {
        return $this->_conferenceRoomId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setRetailAccountId($data)
    {

        if ($this->_retailAccountId != $data) {
            $this->_logChange('retailAccountId', $this->_retailAccountId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_retailAccountId = $data;

        } else if (!is_null($data)) {
            $this->_retailAccountId = (int) $data;

        } else {
            $this->_retailAccountId = $data;
        }
        return $this;
    }

    /**
     * Gets column retailAccountId
     *
     * @return int
     */
    public function getRetailAccountId()
    {
        return $this->_retailAccountId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setPeeringContractId($data)
    {

        if ($this->_peeringContractId != $data) {
            $this->_logChange('peeringContractId', $this->_peeringContractId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_peeringContractId = $data;

        } else if (!is_null($data)) {
            $this->_peeringContractId = (int) $data;

        } else {
            $this->_peeringContractId = $data;
        }
        return $this;
    }

    /**
     * Gets column peeringContractId
     *
     * @return int
     */
    public function getPeeringContractId()
    {
        return $this->_peeringContractId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
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
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setBillInboundCalls($data)
    {

        if ($this->_billInboundCalls != $data) {
            $this->_logChange('billInboundCalls', $this->_billInboundCalls, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_billInboundCalls = $data;

        } else if (!is_null($data)) {
            $this->_billInboundCalls = (int) $data;

        } else {
            $this->_billInboundCalls = $data;
        }
        return $this;
    }

    /**
     * Gets column billInboundCalls
     *
     * @return int
     */
    public function getBillInboundCalls()
    {
        return $this->_billInboundCalls;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setFriendValue($data)
    {

        if ($this->_friendValue != $data) {
            $this->_logChange('friendValue', $this->_friendValue, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_friendValue = $data;

        } else if (!is_null($data)) {
            $this->_friendValue = (string) $data;

        } else {
            $this->_friendValue = $data;
        }
        return $this;
    }

    /**
     * Gets column friendValue
     *
     * @return string
     */
    public function getFriendValue()
    {
        return $this->_friendValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
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
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setQueueId($data)
    {

        if ($this->_queueId != $data) {
            $this->_logChange('queueId', $this->_queueId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_queueId = $data;

        } else if (!is_null($data)) {
            $this->_queueId = (int) $data;

        } else {
            $this->_queueId = $data;
        }
        return $this;
    }

    /**
     * Gets column queueId
     *
     * @return int
     */
    public function getQueueId()
    {
        return $this->_queueId;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setCompany(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_Company = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCompanyId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Company = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Company;
    }

    /**
     * Sets parent relation ExternalCallFilter
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilters $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setExternalCallFilter(\IvozProvider\Model\Raw\ExternalCallFilters $data)
    {
        $this->_ExternalCallFilter = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setExternalCallFilterId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk2');
        return $this;
    }

    /**
     * Gets parent ExternalCallFilter
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function getExternalCallFilter($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ExternalCallFilter = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ExternalCallFilter;
    }

    /**
     * Sets parent relation User
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_User = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setUserId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk3');
        return $this;
    }

    /**
     * Gets parent User
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_User = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_User;
    }

    /**
     * Sets parent relation IVRCommon
     *
     * @param \IvozProvider\Model\Raw\IVRCommon $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setIVRCommon(\IvozProvider\Model\Raw\IVRCommon $data)
    {
        $this->_IVRCommon = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setIVRCommonId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk4');
        return $this;
    }

    /**
     * Gets parent IVRCommon
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function getIVRCommon($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_IVRCommon = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_IVRCommon;
    }

    /**
     * Sets parent relation IVRCustom
     *
     * @param \IvozProvider\Model\Raw\IVRCustom $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setIVRCustom(\IvozProvider\Model\Raw\IVRCustom $data)
    {
        $this->_IVRCustom = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setIVRCustomId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk5');
        return $this;
    }

    /**
     * Gets parent IVRCustom
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\IVRCustom
     */
    public function getIVRCustom($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_IVRCustom = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_IVRCustom;
    }

    /**
     * Sets parent relation HuntGroup
     *
     * @param \IvozProvider\Model\Raw\HuntGroups $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setHuntGroup(\IvozProvider\Model\Raw\HuntGroups $data)
    {
        $this->_HuntGroup = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setHuntGroupId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk6');
        return $this;
    }

    /**
     * Gets parent HuntGroup
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function getHuntGroup($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk6';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_HuntGroup = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_HuntGroup;
    }

    /**
     * Sets parent relation Fax
     *
     * @param \IvozProvider\Model\Raw\Faxes $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setFax(\IvozProvider\Model\Raw\Faxes $data)
    {
        $this->_Fax = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setFaxId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk7');
        return $this;
    }

    /**
     * Gets parent Fax
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Faxes
     */
    public function getFax($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk7';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Fax = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Fax;
    }

    /**
     * Sets parent relation PeeringContract
     *
     * @param \IvozProvider\Model\Raw\PeeringContracts $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setPeeringContract(\IvozProvider\Model\Raw\PeeringContracts $data)
    {
        $this->_PeeringContract = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPeeringContractId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk8');
        return $this;
    }

    /**
     * Gets parent PeeringContract
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function getPeeringContract($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk8';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PeeringContract = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PeeringContract;
    }

    /**
     * Sets parent relation Country
     *
     * @param \IvozProvider\Model\Raw\Countries $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setCountry(\IvozProvider\Model\Raw\Countries $data)
    {
        $this->_Country = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCountryId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk9');
        return $this;
    }

    /**
     * Gets parent Country
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function getCountry($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk9';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Country = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Country;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\DDIs
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

        $this->_setLoaded('DDIsIbfk10');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk10';

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
     * Sets parent relation ConferenceRoom
     *
     * @param \IvozProvider\Model\Raw\ConferenceRooms $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setConferenceRoom(\IvozProvider\Model\Raw\ConferenceRooms $data)
    {
        $this->_ConferenceRoom = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setConferenceRoomId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk11');
        return $this;
    }

    /**
     * Gets parent ConferenceRoom
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ConferenceRooms
     */
    public function getConferenceRoom($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk11';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ConferenceRoom = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ConferenceRoom;
    }

    /**
     * Sets parent relation Language
     *
     * @param \IvozProvider\Model\Raw\Languages $data
     * @return \IvozProvider\Model\Raw\DDIs
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

        $this->_setLoaded('DDIsIbfk12');
        return $this;
    }

    /**
     * Gets parent Language
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Languages
     */
    public function getLanguage($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk12';

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
     * Sets parent relation Queue
     *
     * @param \IvozProvider\Model\Raw\Queues $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setQueue(\IvozProvider\Model\Raw\Queues $data)
    {
        $this->_Queue = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setQueueId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk13');
        return $this;
    }

    /**
     * Gets parent Queue
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function getQueue($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk13';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Queue = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Queue;
    }

    /**
     * Sets parent relation RetailAccount
     *
     * @param \IvozProvider\Model\Raw\RetailAccounts $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setRetailAccount(\IvozProvider\Model\Raw\RetailAccounts $data)
    {
        $this->_RetailAccount = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setRetailAccountId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk14');
        return $this;
    }

    /**
     * Gets parent RetailAccount
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function getRetailAccount($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk14';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_RetailAccount = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_RetailAccount;
    }

    /**
     * Sets dependent relations Companies_ibfk_13
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Companies
     * @return \IvozProvider\Model\Raw\DDIs
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
     * Sets dependent relations Companies_ibfk_13
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function addCompanies(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_Companies[] = $data;
        $this->_setLoaded('CompaniesIbfk13');
        return $this;
    }

    /**
     * Gets dependent Companies_ibfk_13
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Companies
     */
    public function getCompanies($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk13';

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
     * Sets dependent relations Faxes_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Faxes
     * @return \IvozProvider\Model\Raw\DDIs
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
     * Sets dependent relations Faxes_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\Faxes $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function addFaxes(\IvozProvider\Model\Raw\Faxes $data)
    {
        $this->_Faxes[] = $data;
        $this->_setLoaded('FaxesIbfk2');
        return $this;
    }

    /**
     * Gets dependent Faxes_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Faxes
     */
    public function getFaxes($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FaxesIbfk2';

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
     * Sets dependent relations Friends_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Friends
     * @return \IvozProvider\Model\Raw\DDIs
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
     * Sets dependent relations Friends_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\Friends $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function addFriends(\IvozProvider\Model\Raw\Friends $data)
    {
        $this->_Friends[] = $data;
        $this->_setLoaded('FriendsIbfk4');
        return $this;
    }

    /**
     * Gets dependent Friends_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Friends
     */
    public function getFriends($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FriendsIbfk4';

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
     * Sets dependent relations OutgoingDDIRules_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\OutgoingDDIRules
     * @return \IvozProvider\Model\Raw\DDIs
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
     * Sets dependent relations OutgoingDDIRules_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\OutgoingDDIRules $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function addOutgoingDDIRules(\IvozProvider\Model\Raw\OutgoingDDIRules $data)
    {
        $this->_OutgoingDDIRules[] = $data;
        $this->_setLoaded('OutgoingDDIRulesIbfk2');
        return $this;
    }

    /**
     * Gets dependent OutgoingDDIRules_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function getOutgoingDDIRules($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingDDIRulesIbfk2';

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
     * Sets dependent relations OutgoingDDIRulesPatterns_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setOutgoingDDIRulesPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_OutgoingDDIRulesPatterns === null) {

                $this->getOutgoingDDIRulesPatterns();
            }

            $oldRelations = $this->_OutgoingDDIRulesPatterns;

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

        $this->_OutgoingDDIRulesPatterns = array();

        foreach ($data as $object) {
            $this->addOutgoingDDIRulesPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations OutgoingDDIRulesPatterns_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function addOutgoingDDIRulesPatterns(\IvozProvider\Model\Raw\OutgoingDDIRulesPatterns $data)
    {
        $this->_OutgoingDDIRulesPatterns[] = $data;
        $this->_setLoaded('OutgoingDDIRulesPatternsIbfk3');
        return $this;
    }

    /**
     * Gets dependent OutgoingDDIRulesPatterns_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function getOutgoingDDIRulesPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingDDIRulesPatternsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingDDIRulesPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_OutgoingDDIRulesPatterns;
    }

    /**
     * Sets dependent relations RetailAccounts_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\RetailAccounts
     * @return \IvozProvider\Model\Raw\DDIs
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
     * Sets dependent relations RetailAccounts_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\RetailAccounts $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function addRetailAccounts(\IvozProvider\Model\Raw\RetailAccounts $data)
    {
        $this->_RetailAccounts[] = $data;
        $this->_setLoaded('RetailAccountsIbfk4');
        return $this;
    }

    /**
     * Gets dependent RetailAccounts_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\RetailAccounts
     */
    public function getRetailAccounts($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RetailAccountsIbfk4';

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
     * Sets dependent relations Users_ibfk_9
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Users
     * @return \IvozProvider\Model\Raw\DDIs
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
     * Sets dependent relations Users_ibfk_9
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function addUsers(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_Users[] = $data;
        $this->_setLoaded('UsersIbfk9');
        return $this;
    }

    /**
     * Gets dependent Users_ibfk_9
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Users
     */
    public function getUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk9';

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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\DDIs
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\DDIs')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\DDIs);

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
     * @return null | \IvozProvider\Model\Validator\DDIs
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\DDIs')) {

                $this->setValidator(new \IvozProvider\Validator\DDIs);
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
     * @see \Mapper\Sql\DDIs::delete
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