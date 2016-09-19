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
class IVRCommon extends ModelAbstract
{

    protected $_timeoutTargetTypeAcceptedValues = array(
        'number',
        'extension',
        'voicemail',
    );
    protected $_errorTargetTypeAcceptedValues = array(
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
    protected $_blackListRegExp;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_welcomeLocutionId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_noAnswerLocutionId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_errorLocutionId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_successLocutionId;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_timeout;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_noAnswerTimeout;

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
     * [enum:number|extension|voicemail]
     * Database var type varchar
     *
     * @var string
     */
    protected $_errorTargetType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_errorNumberValue;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_errorExtensionId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_errorVoiceMailUserId;


    /**
     * Parent relation IVRCommon_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation IVRCommon_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_WelcomeLocution;

    /**
     * Parent relation IVRCommon_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_NoAnswerLocution;

    /**
     * Parent relation IVRCommon_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_ErrorLocution;

    /**
     * Parent relation IVRCommon_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_SuccessLocution;

    /**
     * Parent relation IVRCommon_ibfk_6
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_TimeoutExtension;

    /**
     * Parent relation IVRCommon_ibfk_7
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_ErrorExtension;

    /**
     * Parent relation IVRCommon_ibfk_8
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_TimeoutVoiceMailUser;

    /**
     * Parent relation IVRCommon_ibfk_9
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_ErrorVoiceMailUser;


    /**
     * Dependent relation DDIs_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation Extensions_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Extensions[]
     */
    protected $_Extensions;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'blackListRegExp'=>'blackListRegExp',
        'welcomeLocutionId'=>'welcomeLocutionId',
        'noAnswerLocutionId'=>'noAnswerLocutionId',
        'errorLocutionId'=>'errorLocutionId',
        'successLocutionId'=>'successLocutionId',
        'timeout'=>'timeout',
        'noAnswerTimeout'=>'noAnswerTimeout',
        'timeoutTargetType'=>'timeoutTargetType',
        'timeoutNumberValue'=>'timeoutNumberValue',
        'timeoutExtensionId'=>'timeoutExtensionId',
        'timeoutVoiceMailUserId'=>'timeoutVoiceMailUserId',
        'errorTargetType'=>'errorTargetType',
        'errorNumberValue'=>'errorNumberValue',
        'errorExtensionId'=>'errorExtensionId',
        'errorVoiceMailUserId'=>'errorVoiceMailUserId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'timeoutTargetType'=> array('enum:number|extension|voicemail'),
            'errorTargetType'=> array('enum:number|extension|voicemail'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'IVRCommonIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'IVRCommonIbfk2'=> array(
                    'property' => 'WelcomeLocution',
                    'table_name' => 'Locutions',
                ),
            'IVRCommonIbfk3'=> array(
                    'property' => 'NoAnswerLocution',
                    'table_name' => 'Locutions',
                ),
            'IVRCommonIbfk4'=> array(
                    'property' => 'ErrorLocution',
                    'table_name' => 'Locutions',
                ),
            'IVRCommonIbfk5'=> array(
                    'property' => 'SuccessLocution',
                    'table_name' => 'Locutions',
                ),
            'IVRCommonIbfk6'=> array(
                    'property' => 'TimeoutExtension',
                    'table_name' => 'Extensions',
                ),
            'IVRCommonIbfk7'=> array(
                    'property' => 'ErrorExtension',
                    'table_name' => 'Extensions',
                ),
            'IVRCommonIbfk8'=> array(
                    'property' => 'TimeoutVoiceMailUser',
                    'table_name' => 'Users',
                ),
            'IVRCommonIbfk9'=> array(
                    'property' => 'ErrorVoiceMailUser',
                    'table_name' => 'Users',
                ),
        ));

        $this->setDependentList(array(
            'DDIsIbfk4' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'ExtensionsIbfk2' => array(
                    'property' => 'Extensions',
                    'table_name' => 'Extensions',
                ),
        ));


        $this->setOnDeleteSetNullRelationships(array(
            'DDIs_ibfk_4',
            'Extensions_ibfk_2'
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
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
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
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_companyId != $data) {
            $this->_logChange('companyId');
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
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_name != $data) {
            $this->_logChange('name');
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
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setBlackListRegExp($data)
    {

        if ($this->_blackListRegExp != $data) {
            $this->_logChange('blackListRegExp');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_blackListRegExp = $data;

        } else if (!is_null($data)) {
            $this->_blackListRegExp = (string) $data;

        } else {
            $this->_blackListRegExp = $data;
        }
        return $this;
    }

    /**
     * Gets column blackListRegExp
     *
     * @return string
     */
    public function getBlackListRegExp()
    {
        return $this->_blackListRegExp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setWelcomeLocutionId($data)
    {

        if ($this->_welcomeLocutionId != $data) {
            $this->_logChange('welcomeLocutionId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_welcomeLocutionId = $data;

        } else if (!is_null($data)) {
            $this->_welcomeLocutionId = (int) $data;

        } else {
            $this->_welcomeLocutionId = $data;
        }
        return $this;
    }

    /**
     * Gets column welcomeLocutionId
     *
     * @return int
     */
    public function getWelcomeLocutionId()
    {
        return $this->_welcomeLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setNoAnswerLocutionId($data)
    {

        if ($this->_noAnswerLocutionId != $data) {
            $this->_logChange('noAnswerLocutionId');
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setErrorLocutionId($data)
    {

        if ($this->_errorLocutionId != $data) {
            $this->_logChange('errorLocutionId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_errorLocutionId = $data;

        } else if (!is_null($data)) {
            $this->_errorLocutionId = (int) $data;

        } else {
            $this->_errorLocutionId = $data;
        }
        return $this;
    }

    /**
     * Gets column errorLocutionId
     *
     * @return int
     */
    public function getErrorLocutionId()
    {
        return $this->_errorLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setSuccessLocutionId($data)
    {

        if ($this->_successLocutionId != $data) {
            $this->_logChange('successLocutionId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_successLocutionId = $data;

        } else if (!is_null($data)) {
            $this->_successLocutionId = (int) $data;

        } else {
            $this->_successLocutionId = $data;
        }
        return $this;
    }

    /**
     * Gets column successLocutionId
     *
     * @return int
     */
    public function getSuccessLocutionId()
    {
        return $this->_successLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setTimeout($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_timeout != $data) {
            $this->_logChange('timeout');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_timeout = $data;

        } else if (!is_null($data)) {
            $this->_timeout = (int) $data;

        } else {
            $this->_timeout = $data;
        }
        return $this;
    }

    /**
     * Gets column timeout
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->_timeout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setNoAnswerTimeout($data)
    {

        if ($this->_noAnswerTimeout != $data) {
            $this->_logChange('noAnswerTimeout');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_noAnswerTimeout = $data;

        } else if (!is_null($data)) {
            $this->_noAnswerTimeout = (int) $data;

        } else {
            $this->_noAnswerTimeout = $data;
        }
        return $this;
    }

    /**
     * Gets column noAnswerTimeout
     *
     * @return int
     */
    public function getNoAnswerTimeout()
    {
        return $this->_noAnswerTimeout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setTimeoutTargetType($data)
    {

        if ($this->_timeoutTargetType != $data) {
            $this->_logChange('timeoutTargetType');
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
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setTimeoutNumberValue($data)
    {

        if ($this->_timeoutNumberValue != $data) {
            $this->_logChange('timeoutNumberValue');
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
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setTimeoutExtensionId($data)
    {

        if ($this->_timeoutExtensionId != $data) {
            $this->_logChange('timeoutExtensionId');
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
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setTimeoutVoiceMailUserId($data)
    {

        if ($this->_timeoutVoiceMailUserId != $data) {
            $this->_logChange('timeoutVoiceMailUserId');
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setErrorTargetType($data)
    {

        if ($this->_errorTargetType != $data) {
            $this->_logChange('errorTargetType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_errorTargetType = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_errorTargetTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for errorTargetType'));
            }
            $this->_errorTargetType = (string) $data;

        } else {
            $this->_errorTargetType = $data;
        }
        return $this;
    }

    /**
     * Gets column errorTargetType
     *
     * @return string
     */
    public function getErrorTargetType()
    {
        return $this->_errorTargetType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setErrorNumberValue($data)
    {

        if ($this->_errorNumberValue != $data) {
            $this->_logChange('errorNumberValue');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_errorNumberValue = $data;

        } else if (!is_null($data)) {
            $this->_errorNumberValue = (string) $data;

        } else {
            $this->_errorNumberValue = $data;
        }
        return $this;
    }

    /**
     * Gets column errorNumberValue
     *
     * @return string
     */
    public function getErrorNumberValue()
    {
        return $this->_errorNumberValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setErrorExtensionId($data)
    {

        if ($this->_errorExtensionId != $data) {
            $this->_logChange('errorExtensionId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_errorExtensionId = $data;

        } else if (!is_null($data)) {
            $this->_errorExtensionId = (int) $data;

        } else {
            $this->_errorExtensionId = $data;
        }
        return $this;
    }

    /**
     * Gets column errorExtensionId
     *
     * @return int
     */
    public function getErrorExtensionId()
    {
        return $this->_errorExtensionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setErrorVoiceMailUserId($data)
    {

        if ($this->_errorVoiceMailUserId != $data) {
            $this->_logChange('errorVoiceMailUserId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_errorVoiceMailUserId = $data;

        } else if (!is_null($data)) {
            $this->_errorVoiceMailUserId = (int) $data;

        } else {
            $this->_errorVoiceMailUserId = $data;
        }
        return $this;
    }

    /**
     * Gets column errorVoiceMailUserId
     *
     * @return int
     */
    public function getErrorVoiceMailUserId()
    {
        return $this->_errorVoiceMailUserId;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\IVRCommon
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

        $this->_setLoaded('IVRCommonIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk1';

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
     * Sets parent relation WelcomeLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setWelcomeLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_WelcomeLocution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setWelcomeLocutionId($primaryKey);
        }

        $this->_setLoaded('IVRCommonIbfk2');
        return $this;
    }

    /**
     * Gets parent WelcomeLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getWelcomeLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_WelcomeLocution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_WelcomeLocution;
    }

    /**
     * Sets parent relation NoAnswerLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\IVRCommon
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

        $this->_setLoaded('IVRCommonIbfk3');
        return $this;
    }

    /**
     * Gets parent NoAnswerLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getNoAnswerLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk3';

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
     * Sets parent relation ErrorLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setErrorLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_ErrorLocution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setErrorLocutionId($primaryKey);
        }

        $this->_setLoaded('IVRCommonIbfk4');
        return $this;
    }

    /**
     * Gets parent ErrorLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getErrorLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ErrorLocution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ErrorLocution;
    }

    /**
     * Sets parent relation SuccessLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setSuccessLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_SuccessLocution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setSuccessLocutionId($primaryKey);
        }

        $this->_setLoaded('IVRCommonIbfk5');
        return $this;
    }

    /**
     * Gets parent SuccessLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getSuccessLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_SuccessLocution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_SuccessLocution;
    }

    /**
     * Sets parent relation TimeoutExtension
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\IVRCommon
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

        $this->_setLoaded('IVRCommonIbfk6');
        return $this;
    }

    /**
     * Gets parent TimeoutExtension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getTimeoutExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk6';

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
     * Sets parent relation ErrorExtension
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setErrorExtension(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_ErrorExtension = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setErrorExtensionId($primaryKey);
        }

        $this->_setLoaded('IVRCommonIbfk7');
        return $this;
    }

    /**
     * Gets parent ErrorExtension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getErrorExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk7';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ErrorExtension = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ErrorExtension;
    }

    /**
     * Sets parent relation TimeoutVoiceMailUser
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\IVRCommon
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

        $this->_setLoaded('IVRCommonIbfk8');
        return $this;
    }

    /**
     * Gets parent TimeoutVoiceMailUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getTimeoutVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk8';

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
     * Sets parent relation ErrorVoiceMailUser
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function setErrorVoiceMailUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_ErrorVoiceMailUser = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setErrorVoiceMailUserId($primaryKey);
        }

        $this->_setLoaded('IVRCommonIbfk9');
        return $this;
    }

    /**
     * Gets parent ErrorVoiceMailUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getErrorVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCommonIbfk9';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ErrorVoiceMailUser = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ErrorVoiceMailUser;
    }

    /**
     * Sets dependent relations DDIs_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\IVRCommon
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
     * Sets dependent relations DDIs_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk4');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk4';

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
     * Sets dependent relations Extensions_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Extensions
     * @return \IvozProvider\Model\Raw\IVRCommon
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
     * Sets dependent relations Extensions_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function addExtensions(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_Extensions[] = $data;
        $this->_setLoaded('ExtensionsIbfk2');
        return $this;
    }

    /**
     * Gets dependent Extensions_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Extensions
     */
    public function getExtensions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExtensionsIbfk2';

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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\IVRCommon
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\IVRCommon')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\IVRCommon);

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
     * @return null | \IvozProvider\Model\Validator\IVRCommon
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\IVRCommon')) {

                $this->setValidator(new \IvozProvider\Validator\IVRCommon);
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
     * @see \Mapper\Sql\IVRCommon::delete
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