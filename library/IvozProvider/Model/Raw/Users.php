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
class Users extends ModelAbstract
{

    protected $_externalIpCallsAcceptedValues = array(
        '0',
        '1',
        '2',
        '3',
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
    protected $_companyId;

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
    protected $_lastname;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_email;

    /**
     * [password]
     * Database var type varchar
     *
     * @var string
     */
    protected $_pass;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timezoneId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_terminalId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_extensionId;

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
     * Database var type int
     *
     * @var int
     */
    protected $_callACLId;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_doNotDisturb;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_isBoss;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_bossAssistantId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_exceptionBoosAssistantRegExp;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_active;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_maxCalls;

    /**
     * [enum:0|1|2|3]
     * Database var type tinyint
     *
     * @var int
     */
    protected $_externalIpCalls;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_voicemailEnabled;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_voicemailSendMail;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_voicemailAttachSound;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tokenKey;

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
     * Database var type varchar
     *
     * @var string
     */
    protected $_areaCode;


    /**
     * Parent relation Users_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation Users_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Terminals
     */
    protected $_Terminal;

    /**
     * Parent relation Users_ibfk_7
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_Extension;

    /**
     * Parent relation Users_ibfk_8
     *
     * @var \IvozProvider\Model\Raw\Timezones
     */
    protected $_Timezone;

    /**
     * Parent relation Users_ibfk_9
     *
     * @var \IvozProvider\Model\Raw\DDIs
     */
    protected $_OutgoingDDI;

    /**
     * Parent relation Users_ibfk_10
     *
     * @var \IvozProvider\Model\Raw\CallACL
     */
    protected $_CallACL;

    /**
     * Parent relation Users_ibfk_11
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_BossAssistant;

    /**
     * Parent relation Users_ibfk_12
     *
     * @var \IvozProvider\Model\Raw\Countries
     */
    protected $_Country;

    /**
     * Parent relation Users_ibfk_13
     *
     * @var \IvozProvider\Model\Raw\Languages
     */
    protected $_Language;

    /**
     * Parent relation Users_ibfk_14
     *
     * @var \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    protected $_OutgoingDDIRule;


    /**
     * Dependent relation CallForwardSettings_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\CallForwardSettings[]
     */
    protected $_CallForwardSettingsByUser;

    /**
     * Dependent relation CallForwardSettings_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\CallForwardSettings[]
     */
    protected $_CallForwardSettingsByVoiceMailUser;

    /**
     * Dependent relation DDIs_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation Extensions_ibfk_6
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Extensions[]
     */
    protected $_Extensions;

    /**
     * Dependent relation ExternalCallFilters_ibfk_7
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilters[]
     */
    protected $_ExternalCallFiltersByHolidayVoiceMailUser;

    /**
     * Dependent relation ExternalCallFilters_ibfk_8
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilters[]
     */
    protected $_ExternalCallFiltersByOutOfScheduleVoiceMailUser;

    /**
     * Dependent relation HuntGroups_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\HuntGroups[]
     */
    protected $_HuntGroups;

    /**
     * Dependent relation HuntGroupsRelUsers_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\HuntGroupsRelUsers[]
     */
    protected $_HuntGroupsRelUsers;

    /**
     * Dependent relation IVRCommon_ibfk_8
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\IVRCommon[]
     */
    protected $_IVRCommonByTimeoutVoiceMailUser;

    /**
     * Dependent relation IVRCommon_ibfk_9
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\IVRCommon[]
     */
    protected $_IVRCommonByErrorVoiceMailUser;

    /**
     * Dependent relation IVRCustom_ibfk_8
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\IVRCustom[]
     */
    protected $_IVRCustomByTimeoutVoiceMailUser;

    /**
     * Dependent relation IVRCustom_ibfk_9
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\IVRCustom[]
     */
    protected $_IVRCustomByErrorVoiceMailUser;

    /**
     * Dependent relation IVRCustomEntries_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\IVRCustomEntries[]
     */
    protected $_IVRCustomEntries;

    /**
     * Dependent relation PickUpRelUsers_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PickUpRelUsers[]
     */
    protected $_PickUpRelUsers;

    /**
     * Dependent relation QueueMembers_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\QueueMembers[]
     */
    protected $_QueueMembers;

    /**
     * Dependent relation Queues_ibfk_5
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Queues[]
     */
    protected $_QueuesByTimeoutVoiceMailUser;

    /**
     * Dependent relation Queues_ibfk_8
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Queues[]
     */
    protected $_QueuesByFullVoiceMailUser;

    /**
     * Dependent relation Users_ibfk_11
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Users[]
     */
    protected $_Users;

    /**
     * Dependent relation ast_voicemail_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\AstVoicemail[]
     */
    protected $_AstVoicemail;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'lastname'=>'lastname',
        'email'=>'email',
        'pass'=>'pass',
        'timezoneId'=>'timezoneId',
        'terminalId'=>'terminalId',
        'extensionId'=>'extensionId',
        'outgoingDDIId'=>'outgoingDDIId',
        'outgoingDDIRuleId'=>'outgoingDDIRuleId',
        'callACLId'=>'callACLId',
        'doNotDisturb'=>'doNotDisturb',
        'isBoss'=>'isBoss',
        'bossAssistantId'=>'bossAssistantId',
        'exceptionBoosAssistantRegExp'=>'exceptionBoosAssistantRegExp',
        'active'=>'active',
        'maxCalls'=>'maxCalls',
        'externalIpCalls'=>'externalIpCalls',
        'voicemailEnabled'=>'voicemailEnabled',
        'voicemailSendMail'=>'voicemailSendMail',
        'voicemailAttachSound'=>'voicemailAttachSound',
        'tokenKey'=>'tokenKey',
        'countryId'=>'countryId',
        'languageId'=>'languageId',
        'areaCode'=>'areaCode',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'pass'=> array('password'),
            'externalIpCalls'=> array('enum:0|1|2|3'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'UsersIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'UsersIbfk3'=> array(
                    'property' => 'Terminal',
                    'table_name' => 'Terminals',
                ),
            'UsersIbfk7'=> array(
                    'property' => 'Extension',
                    'table_name' => 'Extensions',
                ),
            'UsersIbfk8'=> array(
                    'property' => 'Timezone',
                    'table_name' => 'Timezones',
                ),
            'UsersIbfk9'=> array(
                    'property' => 'OutgoingDDI',
                    'table_name' => 'DDIs',
                ),
            'UsersIbfk10'=> array(
                    'property' => 'CallACL',
                    'table_name' => 'CallACL',
                ),
            'UsersIbfk11'=> array(
                    'property' => 'BossAssistant',
                    'table_name' => 'Users',
                ),
            'UsersIbfk12'=> array(
                    'property' => 'Country',
                    'table_name' => 'Countries',
                ),
            'UsersIbfk13'=> array(
                    'property' => 'Language',
                    'table_name' => 'Languages',
                ),
            'UsersIbfk14'=> array(
                    'property' => 'OutgoingDDIRule',
                    'table_name' => 'OutgoingDDIRules',
                ),
        ));

        $this->setDependentList(array(
            'CallForwardSettingsIbfk1' => array(
                    'property' => 'CallForwardSettingsByUser',
                    'table_name' => 'CallForwardSettings',
                ),
            'CallForwardSettingsIbfk3' => array(
                    'property' => 'CallForwardSettingsByVoiceMailUser',
                    'table_name' => 'CallForwardSettings',
                ),
            'DDIsIbfk3' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'ExtensionsIbfk6' => array(
                    'property' => 'Extensions',
                    'table_name' => 'Extensions',
                ),
            'ExternalCallFiltersIbfk7' => array(
                    'property' => 'ExternalCallFiltersByHolidayVoiceMailUser',
                    'table_name' => 'ExternalCallFilters',
                ),
            'ExternalCallFiltersIbfk8' => array(
                    'property' => 'ExternalCallFiltersByOutOfScheduleVoiceMailUser',
                    'table_name' => 'ExternalCallFilters',
                ),
            'HuntGroupsIbfk4' => array(
                    'property' => 'HuntGroups',
                    'table_name' => 'HuntGroups',
                ),
            'HuntGroupsRelUsersIbfk2' => array(
                    'property' => 'HuntGroupsRelUsers',
                    'table_name' => 'HuntGroupsRelUsers',
                ),
            'IVRCommonIbfk8' => array(
                    'property' => 'IVRCommonByTimeoutVoiceMailUser',
                    'table_name' => 'IVRCommon',
                ),
            'IVRCommonIbfk9' => array(
                    'property' => 'IVRCommonByErrorVoiceMailUser',
                    'table_name' => 'IVRCommon',
                ),
            'IVRCustomIbfk8' => array(
                    'property' => 'IVRCustomByTimeoutVoiceMailUser',
                    'table_name' => 'IVRCustom',
                ),
            'IVRCustomIbfk9' => array(
                    'property' => 'IVRCustomByErrorVoiceMailUser',
                    'table_name' => 'IVRCustom',
                ),
            'IVRCustomEntriesIbfk4' => array(
                    'property' => 'IVRCustomEntries',
                    'table_name' => 'IVRCustomEntries',
                ),
            'PickUpRelUsersIbfk2' => array(
                    'property' => 'PickUpRelUsers',
                    'table_name' => 'PickUpRelUsers',
                ),
            'QueueMembersIbfk2' => array(
                    'property' => 'QueueMembers',
                    'table_name' => 'QueueMembers',
                ),
            'QueuesIbfk5' => array(
                    'property' => 'QueuesByTimeoutVoiceMailUser',
                    'table_name' => 'Queues',
                ),
            'QueuesIbfk8' => array(
                    'property' => 'QueuesByFullVoiceMailUser',
                    'table_name' => 'Queues',
                ),
            'UsersIbfk11' => array(
                    'property' => 'Users',
                    'table_name' => 'Users',
                ),
            'AstVoicemailIbfk1' => array(
                    'property' => 'AstVoicemail',
                    'table_name' => 'ast_voicemail',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'CallForwardSettings_ibfk_1',
            'CallForwardSettings_ibfk_3',
            'HuntGroupsRelUsers_ibfk_2',
            'PickUpRelUsers_ibfk_2',
            'QueueMembers_ibfk_2'
        ));

        $this->setOnDeleteSetNullRelationships(array(
            'DDIs_ibfk_3',
            'Extensions_ibfk_6',
            'ExternalCallFilters_ibfk_7',
            'ExternalCallFilters_ibfk_8',
            'HuntGroups_ibfk_4',
            'IVRCommon_ibfk_8',
            'IVRCommon_ibfk_9',
            'IVRCustom_ibfk_8',
            'IVRCustom_ibfk_9',
            'IVRCustomEntries_ibfk_4',
            'Queues_ibfk_5',
            'Queues_ibfk_8',
            'Users_ibfk_11'
        ));


        $this->_defaultValues = array(
            'doNotDisturb' => '0',
            'isBoss' => '0',
            'active' => '0',
            'maxCalls' => '0',
            'externalIpCalls' => '0',
            'voicemailEnabled' => '1',
            'voicemailSendMail' => '0',
            'voicemailAttachSound' => '1',
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
     * @return \IvozProvider\Model\Raw\Users
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
     * @return \IvozProvider\Model\Raw\Users
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
     * @return \IvozProvider\Model\Raw\Users
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
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setLastname($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_lastname != $data) {
            $this->_logChange('lastname', $this->_lastname, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_lastname = $data;

        } else if (!is_null($data)) {
            $this->_lastname = (string) $data;

        } else {
            $this->_lastname = $data;
        }
        return $this;
    }

    /**
     * Gets column lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->_lastname;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setEmail($data)
    {

        if ($this->_email != $data) {
            $this->_logChange('email', $this->_email, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_email = $data;

        } else if (!is_null($data)) {
            $this->_email = (string) $data;

        } else {
            $this->_email = $data;
        }
        return $this;
    }

    /**
     * Gets column email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setPass($data)
    {

        if ($this->_pass != $data) {
            $this->_logChange('pass', $this->_pass, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pass = $data;

        } else if (!is_null($data)) {
            $this->_pass = (string) $data;

        } else {
            $this->_pass = $data;
        }
        return $this;
    }

    /**
     * Gets column pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->_pass;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setTimezoneId($data)
    {

        if ($this->_timezoneId != $data) {
            $this->_logChange('timezoneId', $this->_timezoneId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_timezoneId = $data;

        } else if (!is_null($data)) {
            $this->_timezoneId = (int) $data;

        } else {
            $this->_timezoneId = $data;
        }
        return $this;
    }

    /**
     * Gets column timezoneId
     *
     * @return int
     */
    public function getTimezoneId()
    {
        return $this->_timezoneId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setTerminalId($data)
    {

        if ($this->_terminalId != $data) {
            $this->_logChange('terminalId', $this->_terminalId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_terminalId = $data;

        } else if (!is_null($data)) {
            $this->_terminalId = (int) $data;

        } else {
            $this->_terminalId = $data;
        }
        return $this;
    }

    /**
     * Gets column terminalId
     *
     * @return int
     */
    public function getTerminalId()
    {
        return $this->_terminalId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setExtensionId($data)
    {

        if ($this->_extensionId != $data) {
            $this->_logChange('extensionId', $this->_extensionId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_extensionId = $data;

        } else if (!is_null($data)) {
            $this->_extensionId = (int) $data;

        } else {
            $this->_extensionId = $data;
        }
        return $this;
    }

    /**
     * Gets column extensionId
     *
     * @return int
     */
    public function getExtensionId()
    {
        return $this->_extensionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
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
     * @return \IvozProvider\Model\Raw\Users
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
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setCallACLId($data)
    {

        if ($this->_callACLId != $data) {
            $this->_logChange('callACLId', $this->_callACLId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callACLId = $data;

        } else if (!is_null($data)) {
            $this->_callACLId = (int) $data;

        } else {
            $this->_callACLId = $data;
        }
        return $this;
    }

    /**
     * Gets column callACLId
     *
     * @return int
     */
    public function getCallACLId()
    {
        return $this->_callACLId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setDoNotDisturb($data)
    {

        if ($this->_doNotDisturb != $data) {
            $this->_logChange('doNotDisturb', $this->_doNotDisturb, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_doNotDisturb = $data;

        } else if (!is_null($data)) {
            $this->_doNotDisturb = (int) $data;

        } else {
            $this->_doNotDisturb = $data;
        }
        return $this;
    }

    /**
     * Gets column doNotDisturb
     *
     * @return int
     */
    public function getDoNotDisturb()
    {
        return $this->_doNotDisturb;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setIsBoss($data)
    {

        if ($this->_isBoss != $data) {
            $this->_logChange('isBoss', $this->_isBoss, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_isBoss = $data;

        } else if (!is_null($data)) {
            $this->_isBoss = (int) $data;

        } else {
            $this->_isBoss = $data;
        }
        return $this;
    }

    /**
     * Gets column isBoss
     *
     * @return int
     */
    public function getIsBoss()
    {
        return $this->_isBoss;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setBossAssistantId($data)
    {

        if ($this->_bossAssistantId != $data) {
            $this->_logChange('bossAssistantId', $this->_bossAssistantId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_bossAssistantId = $data;

        } else if (!is_null($data)) {
            $this->_bossAssistantId = (int) $data;

        } else {
            $this->_bossAssistantId = $data;
        }
        return $this;
    }

    /**
     * Gets column bossAssistantId
     *
     * @return int
     */
    public function getBossAssistantId()
    {
        return $this->_bossAssistantId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setExceptionBoosAssistantRegExp($data)
    {

        if ($this->_exceptionBoosAssistantRegExp != $data) {
            $this->_logChange('exceptionBoosAssistantRegExp', $this->_exceptionBoosAssistantRegExp, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_exceptionBoosAssistantRegExp = $data;

        } else if (!is_null($data)) {
            $this->_exceptionBoosAssistantRegExp = (string) $data;

        } else {
            $this->_exceptionBoosAssistantRegExp = $data;
        }
        return $this;
    }

    /**
     * Gets column exceptionBoosAssistantRegExp
     *
     * @return string
     */
    public function getExceptionBoosAssistantRegExp()
    {
        return $this->_exceptionBoosAssistantRegExp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setActive($data)
    {

        if ($this->_active != $data) {
            $this->_logChange('active', $this->_active, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_active = $data;

        } else if (!is_null($data)) {
            $this->_active = (int) $data;

        } else {
            $this->_active = $data;
        }
        return $this;
    }

    /**
     * Gets column active
     *
     * @return int
     */
    public function getActive()
    {
        return $this->_active;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
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
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setExternalIpCalls($data)
    {

        if ($this->_externalIpCalls != $data) {
            $this->_logChange('externalIpCalls', $this->_externalIpCalls, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_externalIpCalls = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_externalIpCallsAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for externalIpCalls'));
            }
            $this->_externalIpCalls = (int) $data;

        } else {
            $this->_externalIpCalls = $data;
        }
        return $this;
    }

    /**
     * Gets column externalIpCalls
     *
     * @return int
     */
    public function getExternalIpCalls()
    {
        return $this->_externalIpCalls;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setVoicemailEnabled($data)
    {

        if ($this->_voicemailEnabled != $data) {
            $this->_logChange('voicemailEnabled', $this->_voicemailEnabled, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_voicemailEnabled = $data;

        } else if (!is_null($data)) {
            $this->_voicemailEnabled = (int) $data;

        } else {
            $this->_voicemailEnabled = $data;
        }
        return $this;
    }

    /**
     * Gets column voicemailEnabled
     *
     * @return int
     */
    public function getVoicemailEnabled()
    {
        return $this->_voicemailEnabled;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setVoicemailSendMail($data)
    {

        if ($this->_voicemailSendMail != $data) {
            $this->_logChange('voicemailSendMail', $this->_voicemailSendMail, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_voicemailSendMail = $data;

        } else if (!is_null($data)) {
            $this->_voicemailSendMail = (int) $data;

        } else {
            $this->_voicemailSendMail = $data;
        }
        return $this;
    }

    /**
     * Gets column voicemailSendMail
     *
     * @return int
     */
    public function getVoicemailSendMail()
    {
        return $this->_voicemailSendMail;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setVoicemailAttachSound($data)
    {

        if ($this->_voicemailAttachSound != $data) {
            $this->_logChange('voicemailAttachSound', $this->_voicemailAttachSound, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_voicemailAttachSound = $data;

        } else if (!is_null($data)) {
            $this->_voicemailAttachSound = (int) $data;

        } else {
            $this->_voicemailAttachSound = $data;
        }
        return $this;
    }

    /**
     * Gets column voicemailAttachSound
     *
     * @return int
     */
    public function getVoicemailAttachSound()
    {
        return $this->_voicemailAttachSound;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setTokenKey($data)
    {

        if ($this->_tokenKey != $data) {
            $this->_logChange('tokenKey', $this->_tokenKey, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tokenKey = $data;

        } else if (!is_null($data)) {
            $this->_tokenKey = (string) $data;

        } else {
            $this->_tokenKey = $data;
        }
        return $this;
    }

    /**
     * Gets column tokenKey
     *
     * @return string
     */
    public function getTokenKey()
    {
        return $this->_tokenKey;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Users
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
     * @return \IvozProvider\Model\Raw\Users
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
     * @return \IvozProvider\Model\Raw\Users
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
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Users
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

        $this->_setLoaded('UsersIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk1';

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
     * Sets parent relation Terminal
     *
     * @param \IvozProvider\Model\Raw\Terminals $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setTerminal(\IvozProvider\Model\Raw\Terminals $data)
    {
        $this->_Terminal = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTerminalId($primaryKey);
        }

        $this->_setLoaded('UsersIbfk3');
        return $this;
    }

    /**
     * Gets parent Terminal
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Terminals
     */
    public function getTerminal($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Terminal = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Terminal;
    }

    /**
     * Sets parent relation Extension
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setExtension(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_Extension = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setExtensionId($primaryKey);
        }

        $this->_setLoaded('UsersIbfk7');
        return $this;
    }

    /**
     * Gets parent Extension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk7';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Extension = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Extension;
    }

    /**
     * Sets parent relation Timezone
     *
     * @param \IvozProvider\Model\Raw\Timezones $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setTimezone(\IvozProvider\Model\Raw\Timezones $data)
    {
        $this->_Timezone = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTimezoneId($primaryKey);
        }

        $this->_setLoaded('UsersIbfk8');
        return $this;
    }

    /**
     * Gets parent Timezone
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function getTimezone($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk8';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Timezone = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Timezone;
    }

    /**
     * Sets parent relation OutgoingDDI
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\Users
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

        $this->_setLoaded('UsersIbfk9');
        return $this;
    }

    /**
     * Gets parent OutgoingDDI
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function getOutgoingDDI($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk9';

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
     * Sets parent relation CallACL
     *
     * @param \IvozProvider\Model\Raw\CallACL $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setCallACL(\IvozProvider\Model\Raw\CallACL $data)
    {
        $this->_CallACL = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCallACLId($primaryKey);
        }

        $this->_setLoaded('UsersIbfk10');
        return $this;
    }

    /**
     * Gets parent CallACL
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\CallACL
     */
    public function getCallACL($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk10';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_CallACL = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_CallACL;
    }

    /**
     * Sets parent relation BossAssistant
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setBossAssistant(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_BossAssistant = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setBossAssistantId($primaryKey);
        }

        $this->_setLoaded('UsersIbfk11');
        return $this;
    }

    /**
     * Gets parent BossAssistant
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getBossAssistant($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk11';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_BossAssistant = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_BossAssistant;
    }

    /**
     * Sets parent relation Country
     *
     * @param \IvozProvider\Model\Raw\Countries $data
     * @return \IvozProvider\Model\Raw\Users
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

        $this->_setLoaded('UsersIbfk12');
        return $this;
    }

    /**
     * Gets parent Country
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function getCountry($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk12';

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
     * Sets parent relation Language
     *
     * @param \IvozProvider\Model\Raw\Languages $data
     * @return \IvozProvider\Model\Raw\Users
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

        $this->_setLoaded('UsersIbfk13');
        return $this;
    }

    /**
     * Gets parent Language
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Languages
     */
    public function getLanguage($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk13';

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
     * Sets parent relation OutgoingDDIRule
     *
     * @param \IvozProvider\Model\Raw\OutgoingDDIRules $data
     * @return \IvozProvider\Model\Raw\Users
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

        $this->_setLoaded('UsersIbfk14');
        return $this;
    }

    /**
     * Gets parent OutgoingDDIRule
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function getOutgoingDDIRule($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk14';

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
     * Sets dependent relations CallForwardSettings_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\CallForwardSettings
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setCallForwardSettingsByUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_CallForwardSettingsByUser === null) {

                $this->getCallForwardSettingsByUser();
            }

            $oldRelations = $this->_CallForwardSettingsByUser;

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

        $this->_CallForwardSettingsByUser = array();

        foreach ($data as $object) {
            $this->addCallForwardSettingsByUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations CallForwardSettings_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\CallForwardSettings $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addCallForwardSettingsByUser(\IvozProvider\Model\Raw\CallForwardSettings $data)
    {
        $this->_CallForwardSettingsByUser[] = $data;
        $this->_setLoaded('CallForwardSettingsIbfk1');
        return $this;
    }

    /**
     * Gets dependent CallForwardSettings_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\CallForwardSettings
     */
    public function getCallForwardSettingsByUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CallForwardSettingsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_CallForwardSettingsByUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_CallForwardSettingsByUser;
    }

    /**
     * Sets dependent relations CallForwardSettings_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\CallForwardSettings
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setCallForwardSettingsByVoiceMailUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_CallForwardSettingsByVoiceMailUser === null) {

                $this->getCallForwardSettingsByVoiceMailUser();
            }

            $oldRelations = $this->_CallForwardSettingsByVoiceMailUser;

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

        $this->_CallForwardSettingsByVoiceMailUser = array();

        foreach ($data as $object) {
            $this->addCallForwardSettingsByVoiceMailUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations CallForwardSettings_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\CallForwardSettings $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addCallForwardSettingsByVoiceMailUser(\IvozProvider\Model\Raw\CallForwardSettings $data)
    {
        $this->_CallForwardSettingsByVoiceMailUser[] = $data;
        $this->_setLoaded('CallForwardSettingsIbfk3');
        return $this;
    }

    /**
     * Gets dependent CallForwardSettings_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\CallForwardSettings
     */
    public function getCallForwardSettingsByVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CallForwardSettingsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_CallForwardSettingsByVoiceMailUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_CallForwardSettingsByVoiceMailUser;
    }

    /**
     * Sets dependent relations DDIs_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\Users
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
     * Sets dependent relations DDIs_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk3');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk3';

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
     * Sets dependent relations Extensions_ibfk_6
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Extensions
     * @return \IvozProvider\Model\Raw\Users
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
     * Sets dependent relations Extensions_ibfk_6
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addExtensions(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_Extensions[] = $data;
        $this->_setLoaded('ExtensionsIbfk6');
        return $this;
    }

    /**
     * Gets dependent Extensions_ibfk_6
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Extensions
     */
    public function getExtensions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExtensionsIbfk6';

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
     * Sets dependent relations ExternalCallFilters_ibfk_7
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ExternalCallFilters
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setExternalCallFiltersByHolidayVoiceMailUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ExternalCallFiltersByHolidayVoiceMailUser === null) {

                $this->getExternalCallFiltersByHolidayVoiceMailUser();
            }

            $oldRelations = $this->_ExternalCallFiltersByHolidayVoiceMailUser;

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

        $this->_ExternalCallFiltersByHolidayVoiceMailUser = array();

        foreach ($data as $object) {
            $this->addExternalCallFiltersByHolidayVoiceMailUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ExternalCallFilters_ibfk_7
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilters $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addExternalCallFiltersByHolidayVoiceMailUser(\IvozProvider\Model\Raw\ExternalCallFilters $data)
    {
        $this->_ExternalCallFiltersByHolidayVoiceMailUser[] = $data;
        $this->_setLoaded('ExternalCallFiltersIbfk7');
        return $this;
    }

    /**
     * Gets dependent ExternalCallFilters_ibfk_7
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function getExternalCallFiltersByHolidayVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk7';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ExternalCallFiltersByHolidayVoiceMailUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ExternalCallFiltersByHolidayVoiceMailUser;
    }

    /**
     * Sets dependent relations ExternalCallFilters_ibfk_8
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ExternalCallFilters
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setExternalCallFiltersByOutOfScheduleVoiceMailUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ExternalCallFiltersByOutOfScheduleVoiceMailUser === null) {

                $this->getExternalCallFiltersByOutOfScheduleVoiceMailUser();
            }

            $oldRelations = $this->_ExternalCallFiltersByOutOfScheduleVoiceMailUser;

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

        $this->_ExternalCallFiltersByOutOfScheduleVoiceMailUser = array();

        foreach ($data as $object) {
            $this->addExternalCallFiltersByOutOfScheduleVoiceMailUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ExternalCallFilters_ibfk_8
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilters $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addExternalCallFiltersByOutOfScheduleVoiceMailUser(\IvozProvider\Model\Raw\ExternalCallFilters $data)
    {
        $this->_ExternalCallFiltersByOutOfScheduleVoiceMailUser[] = $data;
        $this->_setLoaded('ExternalCallFiltersIbfk8');
        return $this;
    }

    /**
     * Gets dependent ExternalCallFilters_ibfk_8
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function getExternalCallFiltersByOutOfScheduleVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk8';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ExternalCallFiltersByOutOfScheduleVoiceMailUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ExternalCallFiltersByOutOfScheduleVoiceMailUser;
    }

    /**
     * Sets dependent relations HuntGroups_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\HuntGroups
     * @return \IvozProvider\Model\Raw\Users
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
     * Sets dependent relations HuntGroups_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\HuntGroups $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addHuntGroups(\IvozProvider\Model\Raw\HuntGroups $data)
    {
        $this->_HuntGroups[] = $data;
        $this->_setLoaded('HuntGroupsIbfk4');
        return $this;
    }

    /**
     * Gets dependent HuntGroups_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\HuntGroups
     */
    public function getHuntGroups($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupsIbfk4';

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
     * Sets dependent relations HuntGroupsRelUsers_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\HuntGroupsRelUsers
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setHuntGroupsRelUsers(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_HuntGroupsRelUsers === null) {

                $this->getHuntGroupsRelUsers();
            }

            $oldRelations = $this->_HuntGroupsRelUsers;

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

        $this->_HuntGroupsRelUsers = array();

        foreach ($data as $object) {
            $this->addHuntGroupsRelUsers($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations HuntGroupsRelUsers_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\HuntGroupsRelUsers $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addHuntGroupsRelUsers(\IvozProvider\Model\Raw\HuntGroupsRelUsers $data)
    {
        $this->_HuntGroupsRelUsers[] = $data;
        $this->_setLoaded('HuntGroupsRelUsersIbfk2');
        return $this;
    }

    /**
     * Gets dependent HuntGroupsRelUsers_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\HuntGroupsRelUsers
     */
    public function getHuntGroupsRelUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupsRelUsersIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_HuntGroupsRelUsers = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_HuntGroupsRelUsers;
    }

    /**
     * Sets dependent relations IVRCommon_ibfk_8
     *
     * @param array $data An array of \IvozProvider\Model\Raw\IVRCommon
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setIVRCommonByTimeoutVoiceMailUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_IVRCommonByTimeoutVoiceMailUser === null) {

                $this->getIVRCommonByTimeoutVoiceMailUser();
            }

            $oldRelations = $this->_IVRCommonByTimeoutVoiceMailUser;

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

        $this->_IVRCommonByTimeoutVoiceMailUser = array();

        foreach ($data as $object) {
            $this->addIVRCommonByTimeoutVoiceMailUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations IVRCommon_ibfk_8
     *
     * @param \IvozProvider\Model\Raw\IVRCommon $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addIVRCommonByTimeoutVoiceMailUser(\IvozProvider\Model\Raw\IVRCommon $data)
    {
        $this->_IVRCommonByTimeoutVoiceMailUser[] = $data;
        $this->_setLoaded('IVRCommonIbfk8');
        return $this;
    }

    /**
     * Gets dependent IVRCommon_ibfk_8
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\IVRCommon
     */
    public function getIVRCommonByTimeoutVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk8';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_IVRCommonByTimeoutVoiceMailUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_IVRCommonByTimeoutVoiceMailUser;
    }

    /**
     * Sets dependent relations IVRCommon_ibfk_9
     *
     * @param array $data An array of \IvozProvider\Model\Raw\IVRCommon
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setIVRCommonByErrorVoiceMailUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_IVRCommonByErrorVoiceMailUser === null) {

                $this->getIVRCommonByErrorVoiceMailUser();
            }

            $oldRelations = $this->_IVRCommonByErrorVoiceMailUser;

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

        $this->_IVRCommonByErrorVoiceMailUser = array();

        foreach ($data as $object) {
            $this->addIVRCommonByErrorVoiceMailUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations IVRCommon_ibfk_9
     *
     * @param \IvozProvider\Model\Raw\IVRCommon $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addIVRCommonByErrorVoiceMailUser(\IvozProvider\Model\Raw\IVRCommon $data)
    {
        $this->_IVRCommonByErrorVoiceMailUser[] = $data;
        $this->_setLoaded('IVRCommonIbfk9');
        return $this;
    }

    /**
     * Gets dependent IVRCommon_ibfk_9
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\IVRCommon
     */
    public function getIVRCommonByErrorVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk9';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_IVRCommonByErrorVoiceMailUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_IVRCommonByErrorVoiceMailUser;
    }

    /**
     * Sets dependent relations IVRCustom_ibfk_8
     *
     * @param array $data An array of \IvozProvider\Model\Raw\IVRCustom
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setIVRCustomByTimeoutVoiceMailUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_IVRCustomByTimeoutVoiceMailUser === null) {

                $this->getIVRCustomByTimeoutVoiceMailUser();
            }

            $oldRelations = $this->_IVRCustomByTimeoutVoiceMailUser;

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

        $this->_IVRCustomByTimeoutVoiceMailUser = array();

        foreach ($data as $object) {
            $this->addIVRCustomByTimeoutVoiceMailUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations IVRCustom_ibfk_8
     *
     * @param \IvozProvider\Model\Raw\IVRCustom $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addIVRCustomByTimeoutVoiceMailUser(\IvozProvider\Model\Raw\IVRCustom $data)
    {
        $this->_IVRCustomByTimeoutVoiceMailUser[] = $data;
        $this->_setLoaded('IVRCustomIbfk8');
        return $this;
    }

    /**
     * Gets dependent IVRCustom_ibfk_8
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\IVRCustom
     */
    public function getIVRCustomByTimeoutVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCustomIbfk8';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_IVRCustomByTimeoutVoiceMailUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_IVRCustomByTimeoutVoiceMailUser;
    }

    /**
     * Sets dependent relations IVRCustom_ibfk_9
     *
     * @param array $data An array of \IvozProvider\Model\Raw\IVRCustom
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setIVRCustomByErrorVoiceMailUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_IVRCustomByErrorVoiceMailUser === null) {

                $this->getIVRCustomByErrorVoiceMailUser();
            }

            $oldRelations = $this->_IVRCustomByErrorVoiceMailUser;

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

        $this->_IVRCustomByErrorVoiceMailUser = array();

        foreach ($data as $object) {
            $this->addIVRCustomByErrorVoiceMailUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations IVRCustom_ibfk_9
     *
     * @param \IvozProvider\Model\Raw\IVRCustom $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addIVRCustomByErrorVoiceMailUser(\IvozProvider\Model\Raw\IVRCustom $data)
    {
        $this->_IVRCustomByErrorVoiceMailUser[] = $data;
        $this->_setLoaded('IVRCustomIbfk9');
        return $this;
    }

    /**
     * Gets dependent IVRCustom_ibfk_9
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\IVRCustom
     */
    public function getIVRCustomByErrorVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCustomIbfk9';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_IVRCustomByErrorVoiceMailUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_IVRCustomByErrorVoiceMailUser;
    }

    /**
     * Sets dependent relations IVRCustomEntries_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\IVRCustomEntries
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setIVRCustomEntries(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_IVRCustomEntries === null) {

                $this->getIVRCustomEntries();
            }

            $oldRelations = $this->_IVRCustomEntries;

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

        $this->_IVRCustomEntries = array();

        foreach ($data as $object) {
            $this->addIVRCustomEntries($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations IVRCustomEntries_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\IVRCustomEntries $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addIVRCustomEntries(\IvozProvider\Model\Raw\IVRCustomEntries $data)
    {
        $this->_IVRCustomEntries[] = $data;
        $this->_setLoaded('IVRCustomEntriesIbfk4');
        return $this;
    }

    /**
     * Gets dependent IVRCustomEntries_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function getIVRCustomEntries($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCustomEntriesIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_IVRCustomEntries = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_IVRCustomEntries;
    }

    /**
     * Sets dependent relations PickUpRelUsers_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PickUpRelUsers
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setPickUpRelUsers(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PickUpRelUsers === null) {

                $this->getPickUpRelUsers();
            }

            $oldRelations = $this->_PickUpRelUsers;

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

        $this->_PickUpRelUsers = array();

        foreach ($data as $object) {
            $this->addPickUpRelUsers($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PickUpRelUsers_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\PickUpRelUsers $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addPickUpRelUsers(\IvozProvider\Model\Raw\PickUpRelUsers $data)
    {
        $this->_PickUpRelUsers[] = $data;
        $this->_setLoaded('PickUpRelUsersIbfk2');
        return $this;
    }

    /**
     * Gets dependent PickUpRelUsers_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PickUpRelUsers
     */
    public function getPickUpRelUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PickUpRelUsersIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PickUpRelUsers = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PickUpRelUsers;
    }

    /**
     * Sets dependent relations QueueMembers_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\QueueMembers
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setQueueMembers(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_QueueMembers === null) {

                $this->getQueueMembers();
            }

            $oldRelations = $this->_QueueMembers;

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

        $this->_QueueMembers = array();

        foreach ($data as $object) {
            $this->addQueueMembers($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations QueueMembers_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\QueueMembers $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addQueueMembers(\IvozProvider\Model\Raw\QueueMembers $data)
    {
        $this->_QueueMembers[] = $data;
        $this->_setLoaded('QueueMembersIbfk2');
        return $this;
    }

    /**
     * Gets dependent QueueMembers_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\QueueMembers
     */
    public function getQueueMembers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueueMembersIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_QueueMembers = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_QueueMembers;
    }

    /**
     * Sets dependent relations Queues_ibfk_5
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Queues
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setQueuesByTimeoutVoiceMailUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_QueuesByTimeoutVoiceMailUser === null) {

                $this->getQueuesByTimeoutVoiceMailUser();
            }

            $oldRelations = $this->_QueuesByTimeoutVoiceMailUser;

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

        $this->_QueuesByTimeoutVoiceMailUser = array();

        foreach ($data as $object) {
            $this->addQueuesByTimeoutVoiceMailUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Queues_ibfk_5
     *
     * @param \IvozProvider\Model\Raw\Queues $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addQueuesByTimeoutVoiceMailUser(\IvozProvider\Model\Raw\Queues $data)
    {
        $this->_QueuesByTimeoutVoiceMailUser[] = $data;
        $this->_setLoaded('QueuesIbfk5');
        return $this;
    }

    /**
     * Gets dependent Queues_ibfk_5
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Queues
     */
    public function getQueuesByTimeoutVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_QueuesByTimeoutVoiceMailUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_QueuesByTimeoutVoiceMailUser;
    }

    /**
     * Sets dependent relations Queues_ibfk_8
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Queues
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setQueuesByFullVoiceMailUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_QueuesByFullVoiceMailUser === null) {

                $this->getQueuesByFullVoiceMailUser();
            }

            $oldRelations = $this->_QueuesByFullVoiceMailUser;

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

        $this->_QueuesByFullVoiceMailUser = array();

        foreach ($data as $object) {
            $this->addQueuesByFullVoiceMailUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Queues_ibfk_8
     *
     * @param \IvozProvider\Model\Raw\Queues $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addQueuesByFullVoiceMailUser(\IvozProvider\Model\Raw\Queues $data)
    {
        $this->_QueuesByFullVoiceMailUser[] = $data;
        $this->_setLoaded('QueuesIbfk8');
        return $this;
    }

    /**
     * Gets dependent Queues_ibfk_8
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Queues
     */
    public function getQueuesByFullVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk8';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_QueuesByFullVoiceMailUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_QueuesByFullVoiceMailUser;
    }

    /**
     * Sets dependent relations Users_ibfk_11
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Users
     * @return \IvozProvider\Model\Raw\Users
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
     * Sets dependent relations Users_ibfk_11
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addUsers(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_Users[] = $data;
        $this->_setLoaded('UsersIbfk11');
        return $this;
    }

    /**
     * Gets dependent Users_ibfk_11
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Users
     */
    public function getUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk11';

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
     * Sets dependent relations ast_voicemail_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\AstVoicemail
     * @return \IvozProvider\Model\Raw\Users
     */
    public function setAstVoicemail(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_AstVoicemail === null) {

                $this->getAstVoicemail();
            }

            $oldRelations = $this->_AstVoicemail;

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

        $this->_AstVoicemail = array();

        foreach ($data as $object) {
            $this->addAstVoicemail($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ast_voicemail_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\AstVoicemail $data
     * @return \IvozProvider\Model\Raw\Users
     */
    public function addAstVoicemail(\IvozProvider\Model\Raw\AstVoicemail $data)
    {
        $this->_AstVoicemail[] = $data;
        $this->_setLoaded('AstVoicemailIbfk1');
        return $this;
    }

    /**
     * Gets dependent ast_voicemail_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\AstVoicemail
     */
    public function getAstVoicemail($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstVoicemailIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_AstVoicemail = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_AstVoicemail;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Users
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Users')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Users);

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
     * @return null | \IvozProvider\Model\Validator\Users
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Users')) {

                $this->setValidator(new \IvozProvider\Validator\Users);
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
     * @see \Mapper\Sql\Users::delete
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