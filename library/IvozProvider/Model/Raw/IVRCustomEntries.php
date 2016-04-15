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
 * [entity]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model\Raw;
class IVRCustomEntries extends ModelAbstract
{

    protected $_targetTypeAcceptedValues = array(
        'number',
        'extension',
        'voicemail',
    );

    /**
     * [uuid:php]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_IVRCustomId;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_entry;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_welcomeLocutionId;

    /**
     * [enum:number|extension|voicemail]
     * Database var type varchar
     *
     * @var string
     */
    protected $_targetType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_targetNumberValue;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_targetExtensionId;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_targetVoiceMailUserId;


    /**
     * Parent relation IVRCustomEntries_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\IVRCustom
     */
    protected $_IVRCustom;

    /**
     * Parent relation IVRCustomEntries_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_WelcomeLocution;

    /**
     * Parent relation IVRCustomEntries_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_TargetExtension;

    /**
     * Parent relation IVRCustomEntries_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_TargetVoiceMailUser;


    protected $_columnsList = array(
        'id'=>'id',
        'IVRCustomId'=>'IVRCustomId',
        'entry'=>'entry',
        'welcomeLocutionId'=>'welcomeLocutionId',
        'targetType'=>'targetType',
        'targetNumberValue'=>'targetNumberValue',
        'targetExtensionId'=>'targetExtensionId',
        'targetVoiceMailUserId'=>'targetVoiceMailUserId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid:php'),
            'targetType'=> array('enum:number|extension|voicemail'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'IVRCustomEntriesIbfk1'=> array(
                    'property' => 'IVRCustom',
                    'table_name' => 'IVRCustom',
                ),
            'IVRCustomEntriesIbfk2'=> array(
                    'property' => 'WelcomeLocution',
                    'table_name' => 'Locutions',
                ),
            'IVRCustomEntriesIbfk3'=> array(
                    'property' => 'TargetExtension',
                    'table_name' => 'Extensions',
                ),
            'IVRCustomEntriesIbfk4'=> array(
                    'property' => 'TargetVoiceMailUser',
                    'table_name' => 'Users',
                ),
        ));

        $this->setDependentList(array(
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
     * @param binary $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        $this->_id = $data;
        return $this;
    }

    /**
     * Gets column id
     *
     * @return binary
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function setIVRCustomId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_IVRCustomId != $data) {
            $this->_logChange('IVRCustomId');
        }

        $this->_IVRCustomId = $data;
        return $this;
    }

    /**
     * Gets column IVRCustomId
     *
     * @return binary
     */
    public function getIVRCustomId()
    {
        return $this->_IVRCustomId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function setEntry($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_entry != $data) {
            $this->_logChange('entry');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_entry = $data;

        } else if (!is_null($data)) {
            $this->_entry = (int) $data;

        } else {
            $this->_entry = $data;
        }
        return $this;
    }

    /**
     * Gets column entry
     *
     * @return int
     */
    public function getEntry()
    {
        return $this->_entry;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function setWelcomeLocutionId($data)
    {

        if ($this->_welcomeLocutionId != $data) {
            $this->_logChange('welcomeLocutionId');
        }

        $this->_welcomeLocutionId = $data;
        return $this;
    }

    /**
     * Gets column welcomeLocutionId
     *
     * @return binary
     */
    public function getWelcomeLocutionId()
    {
        return $this->_welcomeLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function setTargetType($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_targetType != $data) {
            $this->_logChange('targetType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_targetType = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_targetTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for targetType'));
            }
            $this->_targetType = (string) $data;

        } else {
            $this->_targetType = $data;
        }
        return $this;
    }

    /**
     * Gets column targetType
     *
     * @return string
     */
    public function getTargetType()
    {
        return $this->_targetType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function setTargetNumberValue($data)
    {

        if ($this->_targetNumberValue != $data) {
            $this->_logChange('targetNumberValue');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_targetNumberValue = $data;

        } else if (!is_null($data)) {
            $this->_targetNumberValue = (string) $data;

        } else {
            $this->_targetNumberValue = $data;
        }
        return $this;
    }

    /**
     * Gets column targetNumberValue
     *
     * @return string
     */
    public function getTargetNumberValue()
    {
        return $this->_targetNumberValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function setTargetExtensionId($data)
    {

        if ($this->_targetExtensionId != $data) {
            $this->_logChange('targetExtensionId');
        }

        $this->_targetExtensionId = $data;
        return $this;
    }

    /**
     * Gets column targetExtensionId
     *
     * @return binary
     */
    public function getTargetExtensionId()
    {
        return $this->_targetExtensionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function setTargetVoiceMailUserId($data)
    {

        if ($this->_targetVoiceMailUserId != $data) {
            $this->_logChange('targetVoiceMailUserId');
        }

        $this->_targetVoiceMailUserId = $data;
        return $this;
    }

    /**
     * Gets column targetVoiceMailUserId
     *
     * @return binary
     */
    public function getTargetVoiceMailUserId()
    {
        return $this->_targetVoiceMailUserId;
    }

    /**
     * Sets parent relation IVRCustom
     *
     * @param \IvozProvider\Model\Raw\IVRCustom $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
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

        $this->_setLoaded('IVRCustomEntriesIbfk1');
        return $this;
    }

    /**
     * Gets parent IVRCustom
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\IVRCustom
     */
    public function getIVRCustom($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCustomEntriesIbfk1';

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
     * Sets parent relation WelcomeLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
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

        $this->_setLoaded('IVRCustomEntriesIbfk2');
        return $this;
    }

    /**
     * Gets parent WelcomeLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getWelcomeLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCustomEntriesIbfk2';

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
     * Sets parent relation TargetExtension
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function setTargetExtension(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_TargetExtension = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTargetExtensionId($primaryKey);
        }

        $this->_setLoaded('IVRCustomEntriesIbfk3');
        return $this;
    }

    /**
     * Gets parent TargetExtension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getTargetExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCustomEntriesIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TargetExtension = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TargetExtension;
    }

    /**
     * Sets parent relation TargetVoiceMailUser
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\IVRCustomEntries
     */
    public function setTargetVoiceMailUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_TargetVoiceMailUser = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTargetVoiceMailUserId($primaryKey);
        }

        $this->_setLoaded('IVRCustomEntriesIbfk4');
        return $this;
    }

    /**
     * Gets parent TargetVoiceMailUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getTargetVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IVRCustomEntriesIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TargetVoiceMailUser = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TargetVoiceMailUser;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\IVRCustomEntries
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\IVRCustomEntries')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\IVRCustomEntries);

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
     * @return null | \IvozProvider\Model\Validator\IVRCustomEntries
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\IVRCustomEntries')) {

                $this->setValidator(new \IvozProvider\Validator\IVRCustomEntries);
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
     * @see \Mapper\Sql\IVRCustomEntries::delete
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