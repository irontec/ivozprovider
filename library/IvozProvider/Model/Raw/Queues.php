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
class Queues extends ModelAbstract
{

    protected $_timeoutTargetTypeAcceptedValues = array(
        'number',
        'extension',
        'voicemail',
    );
    protected $_fullTargetTypeAcceptedValues = array(
        'number',
        'extension',
        'voicemail',
    );
    protected $_strategyAcceptedValues = array(
        'ringall',
        'leastrecent',
        'fewestcalls',
        'random',
        'rrmemory',
        'linear',
        'wrandom',
        'rrordered',
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
     * Database var type int
     *
     * @var int
     */
    protected $_maxWaitTime;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timeoutLocutionId;

    /**
     * [enum:number|extension|voicemail]
     * Database var type varchar
     *
     * @var string
     */
    protected $_timeoutTargetType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_timeoutNumberValue;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timeoutExtensionId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timeoutVoiceMailUserId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxlen;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_fullLocutionId;

    /**
     * [enum:number|extension|voicemail]
     * Database var type varchar
     *
     * @var string
     */
    protected $_fullTargetType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fullNumberValue;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_fullExtensionId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_fullVoiceMailUserId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_periodicAnnounceLocutionId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_periodicAnnounceFrequency;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_memberCallRest;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_memberCallTimeout;

    /**
     * Database var type enum('ringall','leastrecent','fewestcalls','random','rrmemory','linear','wrandom','rrordered')
     *
     * @var string
     */
    protected $_strategy;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_weight;


    /**
     * Parent relation Queues_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation Queues_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_PeriodicAnnounceLocution;

    /**
     * Parent relation Queues_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_TimeoutLocution;

    /**
     * Parent relation Queues_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_TimeoutExtension;

    /**
     * Parent relation Queues_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_TimeoutVoiceMailUser;

    /**
     * Parent relation Queues_ibfk_6
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_FullLocution;

    /**
     * Parent relation Queues_ibfk_7
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_FullExtension;

    /**
     * Parent relation Queues_ibfk_8
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_FullVoiceMailUser;


    /**
     * Dependent relation DDIs_ibfk_13
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation Extensions_ibfk_7
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Extensions[]
     */
    protected $_Extensions;

    /**
     * Dependent relation QueueMembers_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\QueueMembers[]
     */
    protected $_QueueMembers;

    /**
     * Dependent relation ast_queues_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\AstQueues[]
     */
    protected $_AstQueues;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'maxWaitTime'=>'maxWaitTime',
        'timeoutLocutionId'=>'timeoutLocutionId',
        'timeoutTargetType'=>'timeoutTargetType',
        'timeoutNumberValue'=>'timeoutNumberValue',
        'timeoutExtensionId'=>'timeoutExtensionId',
        'timeoutVoiceMailUserId'=>'timeoutVoiceMailUserId',
        'maxlen'=>'maxlen',
        'fullLocutionId'=>'fullLocutionId',
        'fullTargetType'=>'fullTargetType',
        'fullNumberValue'=>'fullNumberValue',
        'fullExtensionId'=>'fullExtensionId',
        'fullVoiceMailUserId'=>'fullVoiceMailUserId',
        'periodicAnnounceLocutionId'=>'periodicAnnounceLocutionId',
        'periodicAnnounceFrequency'=>'periodicAnnounceFrequency',
        'memberCallRest'=>'memberCallRest',
        'memberCallTimeout'=>'memberCallTimeout',
        'strategy'=>'strategy',
        'weight'=>'weight',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'timeoutTargetType'=> array('enum:number|extension|voicemail'),
            'fullTargetType'=> array('enum:number|extension|voicemail'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'QueuesIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'QueuesIbfk2'=> array(
                    'property' => 'PeriodicAnnounceLocution',
                    'table_name' => 'Locutions',
                ),
            'QueuesIbfk3'=> array(
                    'property' => 'TimeoutLocution',
                    'table_name' => 'Locutions',
                ),
            'QueuesIbfk4'=> array(
                    'property' => 'TimeoutExtension',
                    'table_name' => 'Extensions',
                ),
            'QueuesIbfk5'=> array(
                    'property' => 'TimeoutVoiceMailUser',
                    'table_name' => 'Users',
                ),
            'QueuesIbfk6'=> array(
                    'property' => 'FullLocution',
                    'table_name' => 'Locutions',
                ),
            'QueuesIbfk7'=> array(
                    'property' => 'FullExtension',
                    'table_name' => 'Extensions',
                ),
            'QueuesIbfk8'=> array(
                    'property' => 'FullVoiceMailUser',
                    'table_name' => 'Users',
                ),
        ));

        $this->setDependentList(array(
            'DDIsIbfk13' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'ExtensionsIbfk7' => array(
                    'property' => 'Extensions',
                    'table_name' => 'Extensions',
                ),
            'QueueMembersIbfk1' => array(
                    'property' => 'QueueMembers',
                    'table_name' => 'QueueMembers',
                ),
            'AstQueuesIbfk1' => array(
                    'property' => 'AstQueues',
                    'table_name' => 'ast_queues',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'QueueMembers_ibfk_1'
        ));

        $this->setOnDeleteSetNullRelationships(array(
            'DDIs_ibfk_13',
            'Extensions_ibfk_7'
        ));


        $this->_defaultValues = array(
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
     * @return \IvozProvider\Model\Raw\Queues
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
     * @return \IvozProvider\Model\Raw\Queues
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
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setName($data)
    {

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
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setMaxWaitTime($data)
    {

        if ($this->_maxWaitTime != $data) {
            $this->_logChange('maxWaitTime', $this->_maxWaitTime, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_maxWaitTime = $data;

        } else if (!is_null($data)) {
            $this->_maxWaitTime = (int) $data;

        } else {
            $this->_maxWaitTime = $data;
        }
        return $this;
    }

    /**
     * Gets column maxWaitTime
     *
     * @return int
     */
    public function getMaxWaitTime()
    {
        return $this->_maxWaitTime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setTimeoutLocutionId($data)
    {

        if ($this->_timeoutLocutionId != $data) {
            $this->_logChange('timeoutLocutionId', $this->_timeoutLocutionId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_timeoutLocutionId = $data;

        } else if (!is_null($data)) {
            $this->_timeoutLocutionId = (int) $data;

        } else {
            $this->_timeoutLocutionId = $data;
        }
        return $this;
    }

    /**
     * Gets column timeoutLocutionId
     *
     * @return int
     */
    public function getTimeoutLocutionId()
    {
        return $this->_timeoutLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setTimeoutTargetType($data)
    {

        if ($this->_timeoutTargetType != $data) {
            $this->_logChange('timeoutTargetType', $this->_timeoutTargetType, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_timeoutTargetType = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_timeoutTargetTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for timeoutTargetType'));
            }
            $this->_timeoutTargetType = (string) $data;

        } else {
            $this->_timeoutTargetType = $data;
        }
        return $this;
    }

    /**
     * Gets column timeoutTargetType
     *
     * @return string
     */
    public function getTimeoutTargetType()
    {
        return $this->_timeoutTargetType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setTimeoutNumberValue($data)
    {

        if ($this->_timeoutNumberValue != $data) {
            $this->_logChange('timeoutNumberValue', $this->_timeoutNumberValue, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_timeoutNumberValue = $data;

        } else if (!is_null($data)) {
            $this->_timeoutNumberValue = (string) $data;

        } else {
            $this->_timeoutNumberValue = $data;
        }
        return $this;
    }

    /**
     * Gets column timeoutNumberValue
     *
     * @return string
     */
    public function getTimeoutNumberValue()
    {
        return $this->_timeoutNumberValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setTimeoutExtensionId($data)
    {

        if ($this->_timeoutExtensionId != $data) {
            $this->_logChange('timeoutExtensionId', $this->_timeoutExtensionId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_timeoutExtensionId = $data;

        } else if (!is_null($data)) {
            $this->_timeoutExtensionId = (int) $data;

        } else {
            $this->_timeoutExtensionId = $data;
        }
        return $this;
    }

    /**
     * Gets column timeoutExtensionId
     *
     * @return int
     */
    public function getTimeoutExtensionId()
    {
        return $this->_timeoutExtensionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setTimeoutVoiceMailUserId($data)
    {

        if ($this->_timeoutVoiceMailUserId != $data) {
            $this->_logChange('timeoutVoiceMailUserId', $this->_timeoutVoiceMailUserId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_timeoutVoiceMailUserId = $data;

        } else if (!is_null($data)) {
            $this->_timeoutVoiceMailUserId = (int) $data;

        } else {
            $this->_timeoutVoiceMailUserId = $data;
        }
        return $this;
    }

    /**
     * Gets column timeoutVoiceMailUserId
     *
     * @return int
     */
    public function getTimeoutVoiceMailUserId()
    {
        return $this->_timeoutVoiceMailUserId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setMaxlen($data)
    {

        if ($this->_maxlen != $data) {
            $this->_logChange('maxlen', $this->_maxlen, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_maxlen = $data;

        } else if (!is_null($data)) {
            $this->_maxlen = (int) $data;

        } else {
            $this->_maxlen = $data;
        }
        return $this;
    }

    /**
     * Gets column maxlen
     *
     * @return int
     */
    public function getMaxlen()
    {
        return $this->_maxlen;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setFullLocutionId($data)
    {

        if ($this->_fullLocutionId != $data) {
            $this->_logChange('fullLocutionId', $this->_fullLocutionId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fullLocutionId = $data;

        } else if (!is_null($data)) {
            $this->_fullLocutionId = (int) $data;

        } else {
            $this->_fullLocutionId = $data;
        }
        return $this;
    }

    /**
     * Gets column fullLocutionId
     *
     * @return int
     */
    public function getFullLocutionId()
    {
        return $this->_fullLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setFullTargetType($data)
    {

        if ($this->_fullTargetType != $data) {
            $this->_logChange('fullTargetType', $this->_fullTargetType, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fullTargetType = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_fullTargetTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for fullTargetType'));
            }
            $this->_fullTargetType = (string) $data;

        } else {
            $this->_fullTargetType = $data;
        }
        return $this;
    }

    /**
     * Gets column fullTargetType
     *
     * @return string
     */
    public function getFullTargetType()
    {
        return $this->_fullTargetType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setFullNumberValue($data)
    {

        if ($this->_fullNumberValue != $data) {
            $this->_logChange('fullNumberValue', $this->_fullNumberValue, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fullNumberValue = $data;

        } else if (!is_null($data)) {
            $this->_fullNumberValue = (string) $data;

        } else {
            $this->_fullNumberValue = $data;
        }
        return $this;
    }

    /**
     * Gets column fullNumberValue
     *
     * @return string
     */
    public function getFullNumberValue()
    {
        return $this->_fullNumberValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setFullExtensionId($data)
    {

        if ($this->_fullExtensionId != $data) {
            $this->_logChange('fullExtensionId', $this->_fullExtensionId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fullExtensionId = $data;

        } else if (!is_null($data)) {
            $this->_fullExtensionId = (int) $data;

        } else {
            $this->_fullExtensionId = $data;
        }
        return $this;
    }

    /**
     * Gets column fullExtensionId
     *
     * @return int
     */
    public function getFullExtensionId()
    {
        return $this->_fullExtensionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setFullVoiceMailUserId($data)
    {

        if ($this->_fullVoiceMailUserId != $data) {
            $this->_logChange('fullVoiceMailUserId', $this->_fullVoiceMailUserId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fullVoiceMailUserId = $data;

        } else if (!is_null($data)) {
            $this->_fullVoiceMailUserId = (int) $data;

        } else {
            $this->_fullVoiceMailUserId = $data;
        }
        return $this;
    }

    /**
     * Gets column fullVoiceMailUserId
     *
     * @return int
     */
    public function getFullVoiceMailUserId()
    {
        return $this->_fullVoiceMailUserId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setPeriodicAnnounceLocutionId($data)
    {

        if ($this->_periodicAnnounceLocutionId != $data) {
            $this->_logChange('periodicAnnounceLocutionId', $this->_periodicAnnounceLocutionId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_periodicAnnounceLocutionId = $data;

        } else if (!is_null($data)) {
            $this->_periodicAnnounceLocutionId = (int) $data;

        } else {
            $this->_periodicAnnounceLocutionId = $data;
        }
        return $this;
    }

    /**
     * Gets column periodicAnnounceLocutionId
     *
     * @return int
     */
    public function getPeriodicAnnounceLocutionId()
    {
        return $this->_periodicAnnounceLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setPeriodicAnnounceFrequency($data)
    {

        if ($this->_periodicAnnounceFrequency != $data) {
            $this->_logChange('periodicAnnounceFrequency', $this->_periodicAnnounceFrequency, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_periodicAnnounceFrequency = $data;

        } else if (!is_null($data)) {
            $this->_periodicAnnounceFrequency = (int) $data;

        } else {
            $this->_periodicAnnounceFrequency = $data;
        }
        return $this;
    }

    /**
     * Gets column periodicAnnounceFrequency
     *
     * @return int
     */
    public function getPeriodicAnnounceFrequency()
    {
        return $this->_periodicAnnounceFrequency;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setMemberCallRest($data)
    {

        if ($this->_memberCallRest != $data) {
            $this->_logChange('memberCallRest', $this->_memberCallRest, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_memberCallRest = $data;

        } else if (!is_null($data)) {
            $this->_memberCallRest = (int) $data;

        } else {
            $this->_memberCallRest = $data;
        }
        return $this;
    }

    /**
     * Gets column memberCallRest
     *
     * @return int
     */
    public function getMemberCallRest()
    {
        return $this->_memberCallRest;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setMemberCallTimeout($data)
    {

        if ($this->_memberCallTimeout != $data) {
            $this->_logChange('memberCallTimeout', $this->_memberCallTimeout, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_memberCallTimeout = $data;

        } else if (!is_null($data)) {
            $this->_memberCallTimeout = (int) $data;

        } else {
            $this->_memberCallTimeout = $data;
        }
        return $this;
    }

    /**
     * Gets column memberCallTimeout
     *
     * @return int
     */
    public function getMemberCallTimeout()
    {
        return $this->_memberCallTimeout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setStrategy($data)
    {

        if ($this->_strategy != $data) {
            $this->_logChange('strategy', $this->_strategy, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_strategy = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_strategyAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for strategy'));
            }
            $this->_strategy = (string) $data;

        } else {
            $this->_strategy = $data;
        }
        return $this;
    }

    /**
     * Gets column strategy
     *
     * @return string
     */
    public function getStrategy()
    {
        return $this->_strategy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setWeight($data)
    {

        if ($this->_weight != $data) {
            $this->_logChange('weight', $this->_weight, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_weight = $data;

        } else if (!is_null($data)) {
            $this->_weight = (int) $data;

        } else {
            $this->_weight = $data;
        }
        return $this;
    }

    /**
     * Gets column weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->_weight;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Queues
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

        $this->_setLoaded('QueuesIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk1';

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
     * Sets parent relation PeriodicAnnounceLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setPeriodicAnnounceLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_PeriodicAnnounceLocution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPeriodicAnnounceLocutionId($primaryKey);
        }

        $this->_setLoaded('QueuesIbfk2');
        return $this;
    }

    /**
     * Gets parent PeriodicAnnounceLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getPeriodicAnnounceLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PeriodicAnnounceLocution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PeriodicAnnounceLocution;
    }

    /**
     * Sets parent relation TimeoutLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setTimeoutLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_TimeoutLocution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTimeoutLocutionId($primaryKey);
        }

        $this->_setLoaded('QueuesIbfk3');
        return $this;
    }

    /**
     * Gets parent TimeoutLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getTimeoutLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TimeoutLocution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TimeoutLocution;
    }

    /**
     * Sets parent relation TimeoutExtension
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setTimeoutExtension(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_TimeoutExtension = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTimeoutExtensionId($primaryKey);
        }

        $this->_setLoaded('QueuesIbfk4');
        return $this;
    }

    /**
     * Gets parent TimeoutExtension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getTimeoutExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TimeoutExtension = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TimeoutExtension;
    }

    /**
     * Sets parent relation TimeoutVoiceMailUser
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setTimeoutVoiceMailUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_TimeoutVoiceMailUser = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTimeoutVoiceMailUserId($primaryKey);
        }

        $this->_setLoaded('QueuesIbfk5');
        return $this;
    }

    /**
     * Gets parent TimeoutVoiceMailUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getTimeoutVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TimeoutVoiceMailUser = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TimeoutVoiceMailUser;
    }

    /**
     * Sets parent relation FullLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setFullLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_FullLocution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setFullLocutionId($primaryKey);
        }

        $this->_setLoaded('QueuesIbfk6');
        return $this;
    }

    /**
     * Gets parent FullLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getFullLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk6';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_FullLocution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_FullLocution;
    }

    /**
     * Sets parent relation FullExtension
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setFullExtension(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_FullExtension = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setFullExtensionId($primaryKey);
        }

        $this->_setLoaded('QueuesIbfk7');
        return $this;
    }

    /**
     * Gets parent FullExtension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getFullExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk7';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_FullExtension = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_FullExtension;
    }

    /**
     * Sets parent relation FullVoiceMailUser
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setFullVoiceMailUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_FullVoiceMailUser = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setFullVoiceMailUserId($primaryKey);
        }

        $this->_setLoaded('QueuesIbfk8');
        return $this;
    }

    /**
     * Gets parent FullVoiceMailUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getFullVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueuesIbfk8';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_FullVoiceMailUser = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_FullVoiceMailUser;
    }

    /**
     * Sets dependent relations DDIs_ibfk_13
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\Queues
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
     * Sets dependent relations DDIs_ibfk_13
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk13');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_13
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk13';

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
     * Sets dependent relations Extensions_ibfk_7
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Extensions
     * @return \IvozProvider\Model\Raw\Queues
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
     * Sets dependent relations Extensions_ibfk_7
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function addExtensions(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_Extensions[] = $data;
        $this->_setLoaded('ExtensionsIbfk7');
        return $this;
    }

    /**
     * Gets dependent Extensions_ibfk_7
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Extensions
     */
    public function getExtensions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExtensionsIbfk7';

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
     * Sets dependent relations QueueMembers_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\QueueMembers
     * @return \IvozProvider\Model\Raw\Queues
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
     * Sets dependent relations QueueMembers_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\QueueMembers $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function addQueueMembers(\IvozProvider\Model\Raw\QueueMembers $data)
    {
        $this->_QueueMembers[] = $data;
        $this->_setLoaded('QueueMembersIbfk1');
        return $this;
    }

    /**
     * Gets dependent QueueMembers_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\QueueMembers
     */
    public function getQueueMembers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueueMembersIbfk1';

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
     * Sets dependent relations ast_queues_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\AstQueues
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function setAstQueues(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_AstQueues === null) {

                $this->getAstQueues();
            }

            $oldRelations = $this->_AstQueues;

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

        $this->_AstQueues = array();

        foreach ($data as $object) {
            $this->addAstQueues($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ast_queues_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\AstQueues $data
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function addAstQueues(\IvozProvider\Model\Raw\AstQueues $data)
    {
        $this->_AstQueues[] = $data;
        $this->_setLoaded('AstQueuesIbfk1');
        return $this;
    }

    /**
     * Gets dependent ast_queues_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\AstQueues
     */
    public function getAstQueues($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstQueuesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_AstQueues = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_AstQueues;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Queues
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Queues')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Queues);

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
     * @return null | \IvozProvider\Model\Validator\Queues
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Queues')) {

                $this->setValidator(new \IvozProvider\Validator\Queues);
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
     * @see \Mapper\Sql\Queues::delete
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