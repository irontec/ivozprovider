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
class HuntGroups extends ModelAbstract
{

    protected $_strategyAcceptedValues = array(
        'ringAll',
        'linear',
        'roundRobin',
        'random',
    );
    protected $_noAnswerTargetTypeAcceptedValues = array(
        'number',
        'extension',
        'voicemail',
    );

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
    protected $_description;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_companyId;

    /**
     * [enum:ringAll|linear|roundRobin|random]
     * Database var type varchar
     *
     * @var string
     */
    protected $_strategy;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_ringAllTimeout;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_nextUserPosition;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_noAnswerLocutionId;

    /**
     * [enum:number|extension|voicemail]
     * Database var type varchar
     *
     * @var string
     */
    protected $_noAnswerTargetType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_noAnswerNumberValue;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_noAnswerExtensionId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_noAnswerVoiceMailUserId;


    /**
     * Parent relation HuntGroups_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation HuntGroups_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_NoAnswerLocution;

    /**
     * Parent relation HuntGroups_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_NoAnswerExtension;

    /**
     * Parent relation HuntGroups_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_NoAnswerVoiceMailUser;


    /**
     * Dependent relation ConditionalRoutes_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ConditionalRoutes[]
     */
    protected $_ConditionalRoutes;

    /**
     * Dependent relation ConditionalRoutesConditions_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ConditionalRoutesConditions[]
     */
    protected $_ConditionalRoutesConditions;

    /**
     * Dependent relation DDIs_ibfk_6
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation Extensions_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Extensions[]
     */
    protected $_Extensions;

    /**
     * Dependent relation HuntGroupsRelUsers_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\HuntGroupsRelUsers[]
     */
    protected $_HuntGroupsRelUsers;

    protected $_columnsList = array(
        'id'=>'id',
        'name'=>'name',
        'description'=>'description',
        'companyId'=>'companyId',
        'strategy'=>'strategy',
        'ringAllTimeout'=>'ringAllTimeout',
        'nextUserPosition'=>'nextUserPosition',
        'noAnswerLocutionId'=>'noAnswerLocutionId',
        'noAnswerTargetType'=>'noAnswerTargetType',
        'noAnswerNumberValue'=>'noAnswerNumberValue',
        'noAnswerExtensionId'=>'noAnswerExtensionId',
        'noAnswerVoiceMailUserId'=>'noAnswerVoiceMailUserId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'strategy'=> array('enum:ringAll|linear|roundRobin|random'),
            'noAnswerTargetType'=> array('enum:number|extension|voicemail'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'HuntGroupsIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'HuntGroupsIbfk2'=> array(
                    'property' => 'NoAnswerLocution',
                    'table_name' => 'Locutions',
                ),
            'HuntGroupsIbfk3'=> array(
                    'property' => 'NoAnswerExtension',
                    'table_name' => 'Extensions',
                ),
            'HuntGroupsIbfk4'=> array(
                    'property' => 'NoAnswerVoiceMailUser',
                    'table_name' => 'Users',
                ),
        ));

        $this->setDependentList(array(
            'ConditionalRoutesIbfk4' => array(
                    'property' => 'ConditionalRoutes',
                    'table_name' => 'ConditionalRoutes',
                ),
            'ConditionalRoutesConditionsIbfk4' => array(
                    'property' => 'ConditionalRoutesConditions',
                    'table_name' => 'ConditionalRoutesConditions',
                ),
            'DDIsIbfk6' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'ExtensionsIbfk4' => array(
                    'property' => 'Extensions',
                    'table_name' => 'Extensions',
                ),
            'HuntGroupsRelUsersIbfk1' => array(
                    'property' => 'HuntGroupsRelUsers',
                    'table_name' => 'HuntGroupsRelUsers',
                ),
        ));


        $this->setOnDeleteSetNullRelationships(array(
            'ConditionalRoutes_ibfk_4',
            'ConditionalRoutesConditions_ibfk_4',
            'DDIs_ibfk_6',
            'Extensions_ibfk_4'
        ));


        $this->_defaultValues = array(
            'name' => '',
            'description' => '',
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
     * @return \IvozProvider\Model\Raw\HuntGroups
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
     * @return \IvozProvider\Model\Raw\HuntGroups
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setDescription($data)
    {

        if ($this->_description != $data) {
            $this->_logChange('description', $this->_description, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_description = $data;

        } else if (!is_null($data)) {
            $this->_description = (string) $data;

        } else {
            $this->_description = $data;
        }
        return $this;
    }

    /**
     * Gets column description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\HuntGroups
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
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setStrategy($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setRingAllTimeout($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_ringAllTimeout != $data) {
            $this->_logChange('ringAllTimeout', $this->_ringAllTimeout, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ringAllTimeout = $data;

        } else if (!is_null($data)) {
            $this->_ringAllTimeout = (int) $data;

        } else {
            $this->_ringAllTimeout = $data;
        }
        return $this;
    }

    /**
     * Gets column ringAllTimeout
     *
     * @return int
     */
    public function getRingAllTimeout()
    {
        return $this->_ringAllTimeout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setNextUserPosition($data)
    {

        if ($this->_nextUserPosition != $data) {
            $this->_logChange('nextUserPosition', $this->_nextUserPosition, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nextUserPosition = $data;

        } else if (!is_null($data)) {
            $this->_nextUserPosition = (int) $data;

        } else {
            $this->_nextUserPosition = $data;
        }
        return $this;
    }

    /**
     * Gets column nextUserPosition
     *
     * @return int
     */
    public function getNextUserPosition()
    {
        return $this->_nextUserPosition;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setNoAnswerLocutionId($data)
    {

        if ($this->_noAnswerLocutionId != $data) {
            $this->_logChange('noAnswerLocutionId', $this->_noAnswerLocutionId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_noAnswerLocutionId = $data;

        } else if (!is_null($data)) {
            $this->_noAnswerLocutionId = (int) $data;

        } else {
            $this->_noAnswerLocutionId = $data;
        }
        return $this;
    }

    /**
     * Gets column noAnswerLocutionId
     *
     * @return int
     */
    public function getNoAnswerLocutionId()
    {
        return $this->_noAnswerLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setNoAnswerTargetType($data)
    {

        if ($this->_noAnswerTargetType != $data) {
            $this->_logChange('noAnswerTargetType', $this->_noAnswerTargetType, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_noAnswerTargetType = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_noAnswerTargetTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for noAnswerTargetType'));
            }
            $this->_noAnswerTargetType = (string) $data;

        } else {
            $this->_noAnswerTargetType = $data;
        }
        return $this;
    }

    /**
     * Gets column noAnswerTargetType
     *
     * @return string
     */
    public function getNoAnswerTargetType()
    {
        return $this->_noAnswerTargetType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setNoAnswerNumberValue($data)
    {

        if ($this->_noAnswerNumberValue != $data) {
            $this->_logChange('noAnswerNumberValue', $this->_noAnswerNumberValue, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_noAnswerNumberValue = $data;

        } else if (!is_null($data)) {
            $this->_noAnswerNumberValue = (string) $data;

        } else {
            $this->_noAnswerNumberValue = $data;
        }
        return $this;
    }

    /**
     * Gets column noAnswerNumberValue
     *
     * @return string
     */
    public function getNoAnswerNumberValue()
    {
        return $this->_noAnswerNumberValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setNoAnswerExtensionId($data)
    {

        if ($this->_noAnswerExtensionId != $data) {
            $this->_logChange('noAnswerExtensionId', $this->_noAnswerExtensionId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_noAnswerExtensionId = $data;

        } else if (!is_null($data)) {
            $this->_noAnswerExtensionId = (int) $data;

        } else {
            $this->_noAnswerExtensionId = $data;
        }
        return $this;
    }

    /**
     * Gets column noAnswerExtensionId
     *
     * @return int
     */
    public function getNoAnswerExtensionId()
    {
        return $this->_noAnswerExtensionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setNoAnswerVoiceMailUserId($data)
    {

        if ($this->_noAnswerVoiceMailUserId != $data) {
            $this->_logChange('noAnswerVoiceMailUserId', $this->_noAnswerVoiceMailUserId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_noAnswerVoiceMailUserId = $data;

        } else if (!is_null($data)) {
            $this->_noAnswerVoiceMailUserId = (int) $data;

        } else {
            $this->_noAnswerVoiceMailUserId = $data;
        }
        return $this;
    }

    /**
     * Gets column noAnswerVoiceMailUserId
     *
     * @return int
     */
    public function getNoAnswerVoiceMailUserId()
    {
        return $this->_noAnswerVoiceMailUserId;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\HuntGroups
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

        $this->_setLoaded('HuntGroupsIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupsIbfk1';

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
     * Sets parent relation NoAnswerLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setNoAnswerLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_NoAnswerLocution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setNoAnswerLocutionId($primaryKey);
        }

        $this->_setLoaded('HuntGroupsIbfk2');
        return $this;
    }

    /**
     * Gets parent NoAnswerLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getNoAnswerLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_NoAnswerLocution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_NoAnswerLocution;
    }

    /**
     * Sets parent relation NoAnswerExtension
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setNoAnswerExtension(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_NoAnswerExtension = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setNoAnswerExtensionId($primaryKey);
        }

        $this->_setLoaded('HuntGroupsIbfk3');
        return $this;
    }

    /**
     * Gets parent NoAnswerExtension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getNoAnswerExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_NoAnswerExtension = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_NoAnswerExtension;
    }

    /**
     * Sets parent relation NoAnswerVoiceMailUser
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setNoAnswerVoiceMailUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_NoAnswerVoiceMailUser = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setNoAnswerVoiceMailUserId($primaryKey);
        }

        $this->_setLoaded('HuntGroupsIbfk4');
        return $this;
    }

    /**
     * Gets parent NoAnswerVoiceMailUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getNoAnswerVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupsIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_NoAnswerVoiceMailUser = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_NoAnswerVoiceMailUser;
    }

    /**
     * Sets dependent relations ConditionalRoutes_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ConditionalRoutes
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function setConditionalRoutes(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ConditionalRoutes === null) {

                $this->getConditionalRoutes();
            }

            $oldRelations = $this->_ConditionalRoutes;

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

        $this->_ConditionalRoutes = array();

        foreach ($data as $object) {
            $this->addConditionalRoutes($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ConditionalRoutes_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\ConditionalRoutes $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function addConditionalRoutes(\IvozProvider\Model\Raw\ConditionalRoutes $data)
    {
        $this->_ConditionalRoutes[] = $data;
        $this->_setLoaded('ConditionalRoutesIbfk4');
        return $this;
    }

    /**
     * Gets dependent ConditionalRoutes_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ConditionalRoutes
     */
    public function getConditionalRoutes($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ConditionalRoutes = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ConditionalRoutes;
    }

    /**
     * Sets dependent relations ConditionalRoutesConditions_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ConditionalRoutesConditions
     * @return \IvozProvider\Model\Raw\HuntGroups
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
     * Sets dependent relations ConditionalRoutesConditions_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\ConditionalRoutesConditions $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function addConditionalRoutesConditions(\IvozProvider\Model\Raw\ConditionalRoutesConditions $data)
    {
        $this->_ConditionalRoutesConditions[] = $data;
        $this->_setLoaded('ConditionalRoutesConditionsIbfk4');
        return $this;
    }

    /**
     * Gets dependent ConditionalRoutesConditions_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function getConditionalRoutesConditions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsIbfk4';

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
     * Sets dependent relations DDIs_ibfk_6
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\HuntGroups
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
     * Sets dependent relations DDIs_ibfk_6
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk6');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_6
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk6';

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
     * Sets dependent relations Extensions_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Extensions
     * @return \IvozProvider\Model\Raw\HuntGroups
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
     * Sets dependent relations Extensions_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function addExtensions(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_Extensions[] = $data;
        $this->_setLoaded('ExtensionsIbfk4');
        return $this;
    }

    /**
     * Gets dependent Extensions_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Extensions
     */
    public function getExtensions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExtensionsIbfk4';

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
     * Sets dependent relations HuntGroupsRelUsers_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\HuntGroupsRelUsers
     * @return \IvozProvider\Model\Raw\HuntGroups
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
     * Sets dependent relations HuntGroupsRelUsers_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\HuntGroupsRelUsers $data
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function addHuntGroupsRelUsers(\IvozProvider\Model\Raw\HuntGroupsRelUsers $data)
    {
        $this->_HuntGroupsRelUsers[] = $data;
        $this->_setLoaded('HuntGroupsRelUsersIbfk1');
        return $this;
    }

    /**
     * Gets dependent HuntGroupsRelUsers_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\HuntGroupsRelUsers
     */
    public function getHuntGroupsRelUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupsRelUsersIbfk1';

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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\HuntGroups
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\HuntGroups')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\HuntGroups);

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
     * @return null | \IvozProvider\Model\Validator\HuntGroups
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\HuntGroups')) {

                $this->setValidator(new \IvozProvider\Validator\HuntGroups);
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
     * @see \Mapper\Sql\HuntGroups::delete
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