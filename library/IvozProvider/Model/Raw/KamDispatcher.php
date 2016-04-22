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
class KamDispatcher extends ModelAbstract
{


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
    protected $_setid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_destination;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_flags;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_priority;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_attrs;

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
    protected $_applicationServerId;


    /**
     * Parent relation kam_dispatcher_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\ApplicationServers
     */
    protected $_ApplicationServer;


    protected $_columnsList = array(
        'id'=>'id',
        'setid'=>'setid',
        'destination'=>'destination',
        'flags'=>'flags',
        'priority'=>'priority',
        'attrs'=>'attrs',
        'description'=>'description',
        'applicationServerId'=>'applicationServerId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'KamDispatcherIbfk1'=> array(
                    'property' => 'ApplicationServer',
                    'table_name' => 'ApplicationServers',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'setid' => '0',
            'destination' => '',
            'flags' => '0',
            'priority' => '0',
            'attrs' => '',
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
     * @return \IvozProvider\Model\Raw\KamDispatcher
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
     * @return \IvozProvider\Model\Raw\KamDispatcher
     */
    public function setSetid($data)
    {

        if ($this->_setid != $data) {
            $this->_logChange('setid');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_setid = $data;

        } else if (!is_null($data)) {
            $this->_setid = (int) $data;

        } else {
            $this->_setid = $data;
        }
        return $this;
    }

    /**
     * Gets column setid
     *
     * @return int
     */
    public function getSetid()
    {
        return $this->_setid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamDispatcher
     */
    public function setDestination($data)
    {

        if ($this->_destination != $data) {
            $this->_logChange('destination');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_destination = $data;

        } else if (!is_null($data)) {
            $this->_destination = (string) $data;

        } else {
            $this->_destination = $data;
        }
        return $this;
    }

    /**
     * Gets column destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->_destination;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamDispatcher
     */
    public function setFlags($data)
    {

        if ($this->_flags != $data) {
            $this->_logChange('flags');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_flags = $data;

        } else if (!is_null($data)) {
            $this->_flags = (int) $data;

        } else {
            $this->_flags = $data;
        }
        return $this;
    }

    /**
     * Gets column flags
     *
     * @return int
     */
    public function getFlags()
    {
        return $this->_flags;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamDispatcher
     */
    public function setPriority($data)
    {

        if ($this->_priority != $data) {
            $this->_logChange('priority');
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamDispatcher
     */
    public function setAttrs($data)
    {

        if ($this->_attrs != $data) {
            $this->_logChange('attrs');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_attrs = $data;

        } else if (!is_null($data)) {
            $this->_attrs = (string) $data;

        } else {
            $this->_attrs = $data;
        }
        return $this;
    }

    /**
     * Gets column attrs
     *
     * @return string
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamDispatcher
     */
    public function setDescription($data)
    {

        if ($this->_description != $data) {
            $this->_logChange('description');
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
     * @return \IvozProvider\Model\Raw\KamDispatcher
     */
    public function setApplicationServerId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_applicationServerId != $data) {
            $this->_logChange('applicationServerId');
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
     * Sets parent relation ApplicationServer
     *
     * @param \IvozProvider\Model\Raw\ApplicationServers $data
     * @return \IvozProvider\Model\Raw\KamDispatcher
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

        $this->_setLoaded('KamDispatcherIbfk1');
        return $this;
    }

    /**
     * Gets parent ApplicationServer
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ApplicationServers
     */
    public function getApplicationServer($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamDispatcherIbfk1';

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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\KamDispatcher
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\KamDispatcher')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\KamDispatcher);

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
     * @return null | \IvozProvider\Model\Validator\KamDispatcher
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\KamDispatcher')) {

                $this->setValidator(new \IvozProvider\Validator\KamDispatcher);
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
     * @see \Mapper\Sql\KamDispatcher::delete
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