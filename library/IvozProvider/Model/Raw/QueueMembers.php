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
class QueueMembers extends ModelAbstract
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
    protected $_queueId;

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
    protected $_penalty;


    /**
     * Parent relation QueueMembers_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Queues
     */
    protected $_Queue;

    /**
     * Parent relation QueueMembers_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_User;


    /**
     * Dependent relation ast_queue_members_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\AstQueueMembers[]
     */
    protected $_AstQueueMembers;

    protected $_columnsList = array(
        'id'=>'id',
        'queueId'=>'queueId',
        'userId'=>'userId',
        'penalty'=>'penalty',
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
            'QueueMembersIbfk1'=> array(
                    'property' => 'Queue',
                    'table_name' => 'Queues',
                ),
            'QueueMembersIbfk2'=> array(
                    'property' => 'User',
                    'table_name' => 'Users',
                ),
        ));

        $this->setDependentList(array(
            'AstQueueMembersIbfk1' => array(
                    'property' => 'AstQueueMembers',
                    'table_name' => 'ast_queue_members',
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
     * @return \IvozProvider\Model\Raw\QueueMembers
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
     * @return \IvozProvider\Model\Raw\QueueMembers
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
     * @return \IvozProvider\Model\Raw\QueueMembers
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
     * @return \IvozProvider\Model\Raw\QueueMembers
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
     * Sets parent relation Queue
     *
     * @param \IvozProvider\Model\Raw\Queues $data
     * @return \IvozProvider\Model\Raw\QueueMembers
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

        $this->_setLoaded('QueueMembersIbfk1');
        return $this;
    }

    /**
     * Gets parent Queue
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function getQueue($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueueMembersIbfk1';

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
     * Sets parent relation User
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\QueueMembers
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

        $this->_setLoaded('QueueMembersIbfk2');
        return $this;
    }

    /**
     * Gets parent User
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'QueueMembersIbfk2';

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
     * Sets dependent relations ast_queue_members_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\AstQueueMembers
     * @return \IvozProvider\Model\Raw\QueueMembers
     */
    public function setAstQueueMembers(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_AstQueueMembers === null) {

                $this->getAstQueueMembers();
            }

            $oldRelations = $this->_AstQueueMembers;

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

        $this->_AstQueueMembers = array();

        foreach ($data as $object) {
            $this->addAstQueueMembers($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ast_queue_members_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\AstQueueMembers $data
     * @return \IvozProvider\Model\Raw\QueueMembers
     */
    public function addAstQueueMembers(\IvozProvider\Model\Raw\AstQueueMembers $data)
    {
        $this->_AstQueueMembers[] = $data;
        $this->_setLoaded('AstQueueMembersIbfk1');
        return $this;
    }

    /**
     * Gets dependent ast_queue_members_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\AstQueueMembers
     */
    public function getAstQueueMembers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstQueueMembersIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_AstQueueMembers = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_AstQueueMembers;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\QueueMembers
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\QueueMembers')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\QueueMembers);

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
     * @return null | \IvozProvider\Model\Validator\QueueMembers
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\QueueMembers')) {

                $this->setValidator(new \IvozProvider\Validator\QueueMembers);
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
     * @see \Mapper\Sql\QueueMembers::delete
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