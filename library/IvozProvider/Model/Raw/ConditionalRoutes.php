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
class ConditionalRoutes extends ModelAbstract
{

    protected $_routeTypeAcceptedValues = array(
        'user',
        'number',
        'IVRCommon',
        'IVRCustom',
        'huntGroup',
        'voicemail',
        'friend',
        'queue',
        'conferenceRoom',
        'extension',
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
    protected $_locutionId;

    /**
     * [enum:user|number|IVRCommon|IVRCustom|huntGroup|voicemail|friend|queue|conferenceRoom|extension]
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
    protected $_voiceMailUserId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_userId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_numberValue;

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
    protected $_queueId;

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
    protected $_extensionId;


    /**
     * Parent relation ConditionalRoutes_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation ConditionalRoutes_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\IVRCommon
     */
    protected $_IVRCommon;

    /**
     * Parent relation ConditionalRoutes_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\IVRCustom
     */
    protected $_IVRCustom;

    /**
     * Parent relation ConditionalRoutes_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\HuntGroups
     */
    protected $_HuntGroup;

    /**
     * Parent relation ConditionalRoutes_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_VoiceMailUser;

    /**
     * Parent relation ConditionalRoutes_ibfk_6
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_User;

    /**
     * Parent relation ConditionalRoutes_ibfk_7
     *
     * @var \IvozProvider\Model\Raw\Queues
     */
    protected $_Queue;

    /**
     * Parent relation ConditionalRoutes_ibfk_8
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_Locution;

    /**
     * Parent relation ConditionalRoutes_ibfk_9
     *
     * @var \IvozProvider\Model\Raw\ConferenceRooms
     */
    protected $_ConferenceRoom;

    /**
     * Parent relation ConditionalRoutes_ibfk_10
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_Extension;


    /**
     * Dependent relation ConditionalRoutesConditions_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ConditionalRoutesConditions[]
     */
    protected $_ConditionalRoutesConditions;

    /**
     * Dependent relation DDIs_ibfk_15
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation Extensions_ibfk_8
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Extensions[]
     */
    protected $_Extensions;

    /**
     * Dependent relation IVRCustomEntries_ibfk_5
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\IVRCustomEntries[]
     */
    protected $_IVRCustomEntries;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'locutionId'=>'locutionId',
        'routeType'=>'routeType',
        'IVRCommonId'=>'IVRCommonId',
        'IVRCustomId'=>'IVRCustomId',
        'huntGroupId'=>'huntGroupId',
        'voiceMailUserId'=>'voiceMailUserId',
        'userId'=>'userId',
        'numberValue'=>'numberValue',
        'friendValue'=>'friendValue',
        'queueId'=>'queueId',
        'conferenceRoomId'=>'conferenceRoomId',
        'extensionId'=>'extensionId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'routeType'=> array('enum:user|number|IVRCommon|IVRCustom|huntGroup|voicemail|friend|queue|conferenceRoom|extension'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'ConditionalRoutesIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'ConditionalRoutesIbfk2'=> array(
                    'property' => 'IVRCommon',
                    'table_name' => 'IVRCommon',
                ),
            'ConditionalRoutesIbfk3'=> array(
                    'property' => 'IVRCustom',
                    'table_name' => 'IVRCustom',
                ),
            'ConditionalRoutesIbfk4'=> array(
                    'property' => 'HuntGroup',
                    'table_name' => 'HuntGroups',
                ),
            'ConditionalRoutesIbfk5'=> array(
                    'property' => 'VoiceMailUser',
                    'table_name' => 'Users',
                ),
            'ConditionalRoutesIbfk6'=> array(
                    'property' => 'User',
                    'table_name' => 'Users',
                ),
            'ConditionalRoutesIbfk7'=> array(
                    'property' => 'Queue',
                    'table_name' => 'Queues',
                ),
            'ConditionalRoutesIbfk8'=> array(
                    'property' => 'Locution',
                    'table_name' => 'Locutions',
                ),
            'ConditionalRoutesIbfk9'=> array(
                    'property' => 'ConferenceRoom',
                    'table_name' => 'ConferenceRooms',
                ),
            'ConditionalRoutesIbfk10'=> array(
                    'property' => 'Extension',
                    'table_name' => 'Extensions',
                ),
        ));

        $this->setDependentList(array(
            'ConditionalRoutesConditionsIbfk1' => array(
                    'property' => 'ConditionalRoutesConditions',
                    'table_name' => 'ConditionalRoutesConditions',
                ),
            'DDIsIbfk15' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'ExtensionsIbfk8' => array(
                    'property' => 'Extensions',
                    'table_name' => 'Extensions',
                ),
            'IVRCustomEntriesIbfk5' => array(
                    'property' => 'IVRCustomEntries',
                    'table_name' => 'IVRCustomEntries',
                ),
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function setLocutionId($data)
    {

        if ($this->_locutionId != $data) {
            $this->_logChange('locutionId', $this->_locutionId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_locutionId = $data;

        } else if (!is_null($data)) {
            $this->_locutionId = (int) $data;

        } else {
            $this->_locutionId = $data;
        }
        return $this;
    }

    /**
     * Gets column locutionId
     *
     * @return int
     */
    public function getLocutionId()
    {
        return $this->_locutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function setVoiceMailUserId($data)
    {

        if ($this->_voiceMailUserId != $data) {
            $this->_logChange('voiceMailUserId', $this->_voiceMailUserId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_voiceMailUserId = $data;

        } else if (!is_null($data)) {
            $this->_voiceMailUserId = (int) $data;

        } else {
            $this->_voiceMailUserId = $data;
        }
        return $this;
    }

    /**
     * Gets column voiceMailUserId
     *
     * @return int
     */
    public function getVoiceMailUserId()
    {
        return $this->_voiceMailUserId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function setNumberValue($data)
    {

        if ($this->_numberValue != $data) {
            $this->_logChange('numberValue', $this->_numberValue, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_numberValue = $data;

        } else if (!is_null($data)) {
            $this->_numberValue = (string) $data;

        } else {
            $this->_numberValue = $data;
        }
        return $this;
    }

    /**
     * Gets column numberValue
     *
     * @return string
     */
    public function getNumberValue()
    {
        return $this->_numberValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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

        $this->_setLoaded('ConditionalRoutesIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk1';

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
     * Sets parent relation IVRCommon
     *
     * @param \IvozProvider\Model\Raw\IVRCommon $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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

        $this->_setLoaded('ConditionalRoutesIbfk2');
        return $this;
    }

    /**
     * Gets parent IVRCommon
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function getIVRCommon($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk2';

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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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

        $this->_setLoaded('ConditionalRoutesIbfk3');
        return $this;
    }

    /**
     * Gets parent IVRCustom
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\IVRCustom
     */
    public function getIVRCustom($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk3';

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
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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

        $this->_setLoaded('ConditionalRoutesIbfk4');
        return $this;
    }

    /**
     * Gets parent HuntGroup
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function getHuntGroup($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk4';

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
     * Sets parent relation VoiceMailUser
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function setVoiceMailUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_VoiceMailUser = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setVoiceMailUserId($primaryKey);
        }

        $this->_setLoaded('ConditionalRoutesIbfk5');
        return $this;
    }

    /**
     * Gets parent VoiceMailUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_VoiceMailUser = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_VoiceMailUser;
    }

    /**
     * Sets parent relation User
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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

        $this->_setLoaded('ConditionalRoutesIbfk6');
        return $this;
    }

    /**
     * Gets parent User
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk6';

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
     * Sets parent relation Queue
     *
     * @param \IvozProvider\Model\Raw\Queues $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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

        $this->_setLoaded('ConditionalRoutesIbfk7');
        return $this;
    }

    /**
     * Gets parent Queue
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function getQueue($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk7';

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
     * Sets parent relation Locution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function setLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_Locution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setLocutionId($primaryKey);
        }

        $this->_setLoaded('ConditionalRoutesIbfk8');
        return $this;
    }

    /**
     * Gets parent Locution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk8';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Locution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Locution;
    }

    /**
     * Sets parent relation ConferenceRoom
     *
     * @param \IvozProvider\Model\Raw\ConferenceRooms $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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

        $this->_setLoaded('ConditionalRoutesIbfk9');
        return $this;
    }

    /**
     * Gets parent ConferenceRoom
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ConferenceRooms
     */
    public function getConferenceRoom($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk9';

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
     * Sets parent relation Extension
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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

        $this->_setLoaded('ConditionalRoutesIbfk10');
        return $this;
    }

    /**
     * Gets parent Extension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk10';

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
     * Sets dependent relations ConditionalRoutesConditions_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ConditionalRoutesConditions
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function setConditionalRoutesConditions(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ConditionalRoutesConditions === null) {

                $this->getConditionalRoutesConditions();
            }

            $oldRelations = $this->_ConditionalRoutesConditions;

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

        $this->_ConditionalRoutesConditions = array();

        foreach ($data as $object) {
            $this->addConditionalRoutesConditions($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ConditionalRoutesConditions_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\ConditionalRoutesConditions $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function addConditionalRoutesConditions(\IvozProvider\Model\Raw\ConditionalRoutesConditions $data)
    {
        $this->_ConditionalRoutesConditions[] = $data;
        $this->_setLoaded('ConditionalRoutesConditionsIbfk1');
        return $this;
    }

    /**
     * Gets dependent ConditionalRoutesConditions_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function getConditionalRoutesConditions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ConditionalRoutesConditions = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ConditionalRoutesConditions;
    }

    /**
     * Sets dependent relations DDIs_ibfk_15
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * Sets dependent relations DDIs_ibfk_15
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk15');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_15
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk15';

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
     * Sets dependent relations Extensions_ibfk_8
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Extensions
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * Sets dependent relations Extensions_ibfk_8
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function addExtensions(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_Extensions[] = $data;
        $this->_setLoaded('ExtensionsIbfk8');
        return $this;
    }

    /**
     * Gets dependent Extensions_ibfk_8
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Extensions
     */
    public function getExtensions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExtensionsIbfk8';

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
     * Sets dependent relations IVRCustomEntries_ibfk_5
     *
     * @param array $data An array of \IvozProvider\Model\Raw\IVRCustomEntries
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
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
     * Sets dependent relations IVRCustomEntries_ibfk_5
     *
     * @param \IvozProvider\Model\Raw\IVRCustomEntries $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function addIVRCustomEntries(\IvozProvider\Model\Raw\IVRCustomEntries $data)
    {
        $this->_IVRCustomEntries[] = $data;
        $this->_setLoaded('IVRCustomEntriesIbfk5');
        return $this;
    }

    /**
     * Gets dependent IVRCustomEntries_ibfk_5
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function getIVRCustomEntries($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCustomEntriesIbfk5';

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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\ConditionalRoutes
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\ConditionalRoutes')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\ConditionalRoutes);

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
     * @return null | \IvozProvider\Model\Validator\ConditionalRoutes
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\ConditionalRoutes')) {

                $this->setValidator(new \IvozProvider\Validator\ConditionalRoutes);
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
     * @see \Mapper\Sql\ConditionalRoutes::delete
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