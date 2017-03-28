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
class AstQueueMembers extends ModelAbstract
{


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_uniqueid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueName;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_interface;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_membername;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_stateInterface;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_penalty;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_paused;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_queueMemberId;


    /**
     * Parent relation ast_queue_members_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\QueueMembers
     */
    protected $_QueueMember;


    protected $_columnsList = array(
        'uniqueid'=>'uniqueid',
        'queue_name'=>'queueName',
        'interface'=>'interface',
        'membername'=>'membername',
        'state_interface'=>'stateInterface',
        'penalty'=>'penalty',
        'paused'=>'paused',
        'queueMemberId'=>'queueMemberId',
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
            'AstQueueMembersIbfk1'=> array(
                    'property' => 'QueueMember',
                    'table_name' => 'QueueMembers',
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstQueueMembers
     */
    public function setUniqueid($data)
    {

        if ($this->_uniqueid != $data) {
            $this->_logChange('uniqueid', $this->_uniqueid, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_uniqueid = $data;

        } else if (!is_null($data)) {
            $this->_uniqueid = (int) $data;

        } else {
            $this->_uniqueid = $data;
        }
        return $this;
    }

    /**
     * Gets column uniqueid
     *
     * @return int
     */
    public function getUniqueid()
    {
        return $this->_uniqueid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstQueueMembers
     */
    public function setQueueName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_queueName != $data) {
            $this->_logChange('queueName', $this->_queueName, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_queueName = $data;

        } else if (!is_null($data)) {
            $this->_queueName = (string) $data;

        } else {
            $this->_queueName = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_name
     *
     * @return string
     */
    public function getQueueName()
    {
        return $this->_queueName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstQueueMembers
     */
    public function setInterface($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_interface != $data) {
            $this->_logChange('interface', $this->_interface, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_interface = $data;

        } else if (!is_null($data)) {
            $this->_interface = (string) $data;

        } else {
            $this->_interface = $data;
        }
        return $this;
    }

    /**
     * Gets column interface
     *
     * @return string
     */
    public function getInterface()
    {
        return $this->_interface;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstQueueMembers
     */
    public function setMembername($data)
    {

        if ($this->_membername != $data) {
            $this->_logChange('membername', $this->_membername, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_membername = $data;

        } else if (!is_null($data)) {
            $this->_membername = (string) $data;

        } else {
            $this->_membername = $data;
        }
        return $this;
    }

    /**
     * Gets column membername
     *
     * @return string
     */
    public function getMembername()
    {
        return $this->_membername;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstQueueMembers
     */
    public function setStateInterface($data)
    {

        if ($this->_stateInterface != $data) {
            $this->_logChange('stateInterface', $this->_stateInterface, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_stateInterface = $data;

        } else if (!is_null($data)) {
            $this->_stateInterface = (string) $data;

        } else {
            $this->_stateInterface = $data;
        }
        return $this;
    }

    /**
     * Gets column state_interface
     *
     * @return string
     */
    public function getStateInterface()
    {
        return $this->_stateInterface;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstQueueMembers
     */
    public function setPenalty($data)
    {

        if ($this->_penalty != $data) {
            $this->_logChange('penalty', $this->_penalty, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_penalty = $data;

        } else if (!is_null($data)) {
            $this->_penalty = (int) $data;

        } else {
            $this->_penalty = $data;
        }
        return $this;
    }

    /**
     * Gets column penalty
     *
     * @return int
     */
    public function getPenalty()
    {
        return $this->_penalty;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstQueueMembers
     */
    public function setPaused($data)
    {

        if ($this->_paused != $data) {
            $this->_logChange('paused', $this->_paused, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_paused = $data;

        } else if (!is_null($data)) {
            $this->_paused = (int) $data;

        } else {
            $this->_paused = $data;
        }
        return $this;
    }

    /**
     * Gets column paused
     *
     * @return int
     */
    public function getPaused()
    {
        return $this->_paused;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstQueueMembers
     */
    public function setQueueMemberId($data)
    {

        if ($this->_queueMemberId != $data) {
            $this->_logChange('queueMemberId', $this->_queueMemberId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_queueMemberId = $data;

        } else if (!is_null($data)) {
            $this->_queueMemberId = (int) $data;

        } else {
            $this->_queueMemberId = $data;
        }
        return $this;
    }

    /**
     * Gets column queueMemberId
     *
     * @return int
     */
    public function getQueueMemberId()
    {
        return $this->_queueMemberId;
    }

    /**
     * Sets parent relation QueueMember
     *
     * @param \IvozProvider\Model\Raw\QueueMembers $data
     * @return \IvozProvider\Model\Raw\AstQueueMembers
     */
    public function setQueueMember(\IvozProvider\Model\Raw\QueueMembers $data)
    {
        $this->_QueueMember = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setQueueMemberId($primaryKey);
        }

        $this->_setLoaded('AstQueueMembersIbfk1');
        return $this;
    }

    /**
     * Gets parent QueueMember
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\QueueMembers
     */
    public function getQueueMember($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstQueueMembersIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_QueueMember = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_QueueMember;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\AstQueueMembers
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\AstQueueMembers')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\AstQueueMembers);

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
     * @return null | \IvozProvider\Model\Validator\AstQueueMembers
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\AstQueueMembers')) {

                $this->setValidator(new \IvozProvider\Validator\AstQueueMembers);
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
     * @see \Mapper\Sql\AstQueueMembers::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getUniqueid() === null) {
            $this->_logger->log('The value for Uniqueid cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'uniqueid = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getUniqueid())
        );
    }

    public function mustUpdateEtag()
    {
        return true;
    }

}