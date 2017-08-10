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
class ConditionalRoutesConditions extends ModelAbstract
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
    protected $_conditionalRouteId;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_priority;

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
     * Parent relation ConditionalRoutesConditions_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\ConditionalRoutes
     */
    protected $_ConditionalRoute;

    /**
     * Parent relation ConditionalRoutesConditions_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\IVRCommon
     */
    protected $_IVRCommon;

    /**
     * Parent relation ConditionalRoutesConditions_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\IVRCustom
     */
    protected $_IVRCustom;

    /**
     * Parent relation ConditionalRoutesConditions_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\HuntGroups
     */
    protected $_HuntGroup;

    /**
     * Parent relation ConditionalRoutesConditions_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_VoiceMailUser;

    /**
     * Parent relation ConditionalRoutesConditions_ibfk_6
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_User;

    /**
     * Parent relation ConditionalRoutesConditions_ibfk_7
     *
     * @var \IvozProvider\Model\Raw\Queues
     */
    protected $_Queue;

    /**
     * Parent relation ConditionalRoutesConditions_ibfk_8
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_Locution;

    /**
     * Parent relation ConditionalRoutesConditions_ibfk_9
     *
     * @var \IvozProvider\Model\Raw\ConferenceRooms
     */
    protected $_ConferenceRoom;

    /**
     * Parent relation ConditionalRoutesConditions_ibfk_10
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_Extension;


    /**
     * Dependent relation ConditionalRoutesConditionsRelCalendars_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelCalendars[]
     */
    protected $_ConditionalRoutesConditionsRelCalendars;

    /**
     * Dependent relation ConditionalRoutesConditionsRelMatchLists_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelMatchLists[]
     */
    protected $_ConditionalRoutesConditionsRelMatchLists;

    /**
     * Dependent relation ConditionalRoutesConditionsRelSchedules_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelSchedules[]
     */
    protected $_ConditionalRoutesConditionsRelSchedules;

    protected $_columnsList = array(
        'id'=>'id',
        'conditionalRouteId'=>'conditionalRouteId',
        'priority'=>'priority',
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
            'ConditionalRoutesConditionsIbfk1'=> array(
                    'property' => 'ConditionalRoute',
                    'table_name' => 'ConditionalRoutes',
                ),
            'ConditionalRoutesConditionsIbfk2'=> array(
                    'property' => 'IVRCommon',
                    'table_name' => 'IVRCommon',
                ),
            'ConditionalRoutesConditionsIbfk3'=> array(
                    'property' => 'IVRCustom',
                    'table_name' => 'IVRCustom',
                ),
            'ConditionalRoutesConditionsIbfk4'=> array(
                    'property' => 'HuntGroup',
                    'table_name' => 'HuntGroups',
                ),
            'ConditionalRoutesConditionsIbfk5'=> array(
                    'property' => 'VoiceMailUser',
                    'table_name' => 'Users',
                ),
            'ConditionalRoutesConditionsIbfk6'=> array(
                    'property' => 'User',
                    'table_name' => 'Users',
                ),
            'ConditionalRoutesConditionsIbfk7'=> array(
                    'property' => 'Queue',
                    'table_name' => 'Queues',
                ),
            'ConditionalRoutesConditionsIbfk8'=> array(
                    'property' => 'Locution',
                    'table_name' => 'Locutions',
                ),
            'ConditionalRoutesConditionsIbfk9'=> array(
                    'property' => 'ConferenceRoom',
                    'table_name' => 'ConferenceRooms',
                ),
            'ConditionalRoutesConditionsIbfk10'=> array(
                    'property' => 'Extension',
                    'table_name' => 'Extensions',
                ),
        ));

        $this->setDependentList(array(
            'ConditionalRoutesConditionsRelCalendarsIbfk1' => array(
                    'property' => 'ConditionalRoutesConditionsRelCalendars',
                    'table_name' => 'ConditionalRoutesConditionsRelCalendars',
                ),
            'ConditionalRoutesConditionsRelMatchListsIbfk1' => array(
                    'property' => 'ConditionalRoutesConditionsRelMatchLists',
                    'table_name' => 'ConditionalRoutesConditionsRelMatchLists',
                ),
            'ConditionalRoutesConditionsRelSchedulesIbfk1' => array(
                    'property' => 'ConditionalRoutesConditionsRelSchedules',
                    'table_name' => 'ConditionalRoutesConditionsRelSchedules',
                ),
        ));




        $this->_defaultValues = array(
            'priority' => '1',
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function setConditionalRouteId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_conditionalRouteId != $data) {
            $this->_logChange('conditionalRouteId', $this->_conditionalRouteId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_conditionalRouteId = $data;

        } else if (!is_null($data)) {
            $this->_conditionalRouteId = (int) $data;

        } else {
            $this->_conditionalRouteId = $data;
        }
        return $this;
    }

    /**
     * Gets column conditionalRouteId
     *
     * @return int
     */
    public function getConditionalRouteId()
    {
        return $this->_conditionalRouteId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function setPriority($data)
    {

        if ($this->_priority != $data) {
            $this->_logChange('priority', $this->_priority, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_priority = $data;

        } else if (!is_null($data)) {
            $this->_priority = (int) $data;

        } else {
            $this->_priority = $data;
        }
        return $this;
    }

    /**
     * Gets column priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->_priority;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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
     * Sets parent relation ConditionalRoute
     *
     * @param \IvozProvider\Model\Raw\ConditionalRoutes $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function setConditionalRoute(\IvozProvider\Model\Raw\ConditionalRoutes $data)
    {
        $this->_ConditionalRoute = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setConditionalRouteId($primaryKey);
        }

        $this->_setLoaded('ConditionalRoutesConditionsIbfk1');
        return $this;
    }

    /**
     * Gets parent ConditionalRoute
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function getConditionalRoute($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ConditionalRoute = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ConditionalRoute;
    }

    /**
     * Sets parent relation IVRCommon
     *
     * @param \IvozProvider\Model\Raw\IVRCommon $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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

        $this->_setLoaded('ConditionalRoutesConditionsIbfk2');
        return $this;
    }

    /**
     * Gets parent IVRCommon
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function getIVRCommon($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk2';

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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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

        $this->_setLoaded('ConditionalRoutesConditionsIbfk3');
        return $this;
    }

    /**
     * Gets parent IVRCustom
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\IVRCustom
     */
    public function getIVRCustom($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk3';

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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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

        $this->_setLoaded('ConditionalRoutesConditionsIbfk4');
        return $this;
    }

    /**
     * Gets parent HuntGroup
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function getHuntGroup($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk4';

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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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

        $this->_setLoaded('ConditionalRoutesConditionsIbfk5');
        return $this;
    }

    /**
     * Gets parent VoiceMailUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk5';

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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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

        $this->_setLoaded('ConditionalRoutesConditionsIbfk6');
        return $this;
    }

    /**
     * Gets parent User
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk6';

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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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

        $this->_setLoaded('ConditionalRoutesConditionsIbfk7');
        return $this;
    }

    /**
     * Gets parent Queue
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function getQueue($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk7';

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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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

        $this->_setLoaded('ConditionalRoutesConditionsIbfk8');
        return $this;
    }

    /**
     * Gets parent Locution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk8';

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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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

        $this->_setLoaded('ConditionalRoutesConditionsIbfk9');
        return $this;
    }

    /**
     * Gets parent ConferenceRoom
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ConferenceRooms
     */
    public function getConferenceRoom($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk9';

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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
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

        $this->_setLoaded('ConditionalRoutesConditionsIbfk10');
        return $this;
    }

    /**
     * Gets parent Extension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk10';

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
     * Sets dependent relations ConditionalRoutesConditionsRelCalendars_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelCalendars
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function setConditionalRoutesConditionsRelCalendars(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ConditionalRoutesConditionsRelCalendars === null) {

                $this->getConditionalRoutesConditionsRelCalendars();
            }

            $oldRelations = $this->_ConditionalRoutesConditionsRelCalendars;

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

        $this->_ConditionalRoutesConditionsRelCalendars = array();

        foreach ($data as $object) {
            $this->addConditionalRoutesConditionsRelCalendars($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ConditionalRoutesConditionsRelCalendars_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelCalendars $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function addConditionalRoutesConditionsRelCalendars(\IvozProvider\Model\Raw\ConditionalRoutesConditionsRelCalendars $data)
    {
        $this->_ConditionalRoutesConditionsRelCalendars[] = $data;
        $this->_setLoaded('ConditionalRoutesConditionsRelCalendarsIbfk1');
        return $this;
    }

    /**
     * Gets dependent ConditionalRoutesConditionsRelCalendars_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelCalendars
     */
    public function getConditionalRoutesConditionsRelCalendars($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsRelCalendarsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ConditionalRoutesConditionsRelCalendars = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ConditionalRoutesConditionsRelCalendars;
    }

    /**
     * Sets dependent relations ConditionalRoutesConditionsRelMatchLists_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelMatchLists
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function setConditionalRoutesConditionsRelMatchLists(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ConditionalRoutesConditionsRelMatchLists === null) {

                $this->getConditionalRoutesConditionsRelMatchLists();
            }

            $oldRelations = $this->_ConditionalRoutesConditionsRelMatchLists;

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

        $this->_ConditionalRoutesConditionsRelMatchLists = array();

        foreach ($data as $object) {
            $this->addConditionalRoutesConditionsRelMatchLists($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ConditionalRoutesConditionsRelMatchLists_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelMatchLists $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function addConditionalRoutesConditionsRelMatchLists(\IvozProvider\Model\Raw\ConditionalRoutesConditionsRelMatchLists $data)
    {
        $this->_ConditionalRoutesConditionsRelMatchLists[] = $data;
        $this->_setLoaded('ConditionalRoutesConditionsRelMatchListsIbfk1');
        return $this;
    }

    /**
     * Gets dependent ConditionalRoutesConditionsRelMatchLists_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelMatchLists
     */
    public function getConditionalRoutesConditionsRelMatchLists($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsRelMatchListsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ConditionalRoutesConditionsRelMatchLists = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ConditionalRoutesConditionsRelMatchLists;
    }

    /**
     * Sets dependent relations ConditionalRoutesConditionsRelSchedules_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelSchedules
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function setConditionalRoutesConditionsRelSchedules(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ConditionalRoutesConditionsRelSchedules === null) {

                $this->getConditionalRoutesConditionsRelSchedules();
            }

            $oldRelations = $this->_ConditionalRoutesConditionsRelSchedules;

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

        $this->_ConditionalRoutesConditionsRelSchedules = array();

        foreach ($data as $object) {
            $this->addConditionalRoutesConditionsRelSchedules($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ConditionalRoutesConditionsRelSchedules_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelSchedules $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function addConditionalRoutesConditionsRelSchedules(\IvozProvider\Model\Raw\ConditionalRoutesConditionsRelSchedules $data)
    {
        $this->_ConditionalRoutesConditionsRelSchedules[] = $data;
        $this->_setLoaded('ConditionalRoutesConditionsRelSchedulesIbfk1');
        return $this;
    }

    /**
     * Gets dependent ConditionalRoutesConditionsRelSchedules_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelSchedules
     */
    public function getConditionalRoutesConditionsRelSchedules($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsRelSchedulesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ConditionalRoutesConditionsRelSchedules = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ConditionalRoutesConditionsRelSchedules;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\ConditionalRoutesConditions
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\ConditionalRoutesConditions')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\ConditionalRoutesConditions);

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
     * @return null | \IvozProvider\Model\Validator\ConditionalRoutesConditions
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\ConditionalRoutesConditions')) {

                $this->setValidator(new \IvozProvider\Validator\ConditionalRoutesConditions);
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
     * @see \Mapper\Sql\ConditionalRoutesConditions::delete
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