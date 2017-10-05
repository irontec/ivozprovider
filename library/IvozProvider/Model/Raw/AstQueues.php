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
class AstQueues extends ModelAbstract
{

    protected $_autopauseAcceptedValues = array(
        'yes',
        'no',
        'all',
    );
    protected $_ringinuseAcceptedValues = array(
        'yes',
        'no',
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
    protected $_periodicAnnounce;

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
    protected $_timeout;

    /**
     * Database var type enum('yes','no','all')
     *
     * @var string
     */
    protected $_autopause;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_ringinuse;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_wrapuptime;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxlen;

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
     * Database var type int
     *
     * @var int
     */
    protected $_queueId;


    /**
     * Parent relation ast_queues_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Queues
     */
    protected $_Queue;


    protected $_columnsList = array(
        'id'=>'id',
        'name'=>'name',
        'periodic_announce'=>'periodicAnnounce',
        'periodic_announce_frequency'=>'periodicAnnounceFrequency',
        'timeout'=>'timeout',
        'autopause'=>'autopause',
        'ringinuse'=>'ringinuse',
        'wrapuptime'=>'wrapuptime',
        'maxlen'=>'maxlen',
        'strategy'=>'strategy',
        'weight'=>'weight',
        'queueId'=>'queueId',
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
            'AstQueuesIbfk1'=> array(
                    'property' => 'Queue',
                    'table_name' => 'Queues',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'autopause' => 'no',
            'ringinuse' => 'no',
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
     * @return \IvozProvider\Model\Raw\AstQueues
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
     * @return \IvozProvider\Model\Raw\AstQueues
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
     * @return \IvozProvider\Model\Raw\AstQueues
     */
    public function setPeriodicAnnounce($data)
    {

        if ($this->_periodicAnnounce != $data) {
            $this->_logChange('periodicAnnounce', $this->_periodicAnnounce, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_periodicAnnounce = $data;

        } else if (!is_null($data)) {
            $this->_periodicAnnounce = (string) $data;

        } else {
            $this->_periodicAnnounce = $data;
        }
        return $this;
    }

    /**
     * Gets column periodic_announce
     *
     * @return string
     */
    public function getPeriodicAnnounce()
    {
        return $this->_periodicAnnounce;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstQueues
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
     * Gets column periodic_announce_frequency
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
     * @return \IvozProvider\Model\Raw\AstQueues
     */
    public function setTimeout($data)
    {

        if ($this->_timeout != $data) {
            $this->_logChange('timeout', $this->_timeout, $data);
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstQueues
     */
    public function setAutopause($data)
    {

        if ($this->_autopause != $data) {
            $this->_logChange('autopause', $this->_autopause, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_autopause = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_autopauseAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(sprintf(_('Invalid value for %s'), 'autopause'));
            }
            $this->_autopause = (string) $data;

        } else {
            $this->_autopause = $data;
        }
        return $this;
    }

    /**
     * Gets column autopause
     *
     * @return string
     */
    public function getAutopause()
    {
        return $this->_autopause;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstQueues
     */
    public function setRinginuse($data)
    {

        if ($this->_ringinuse != $data) {
            $this->_logChange('ringinuse', $this->_ringinuse, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ringinuse = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_ringinuseAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(sprintf(_('Invalid value for %s'), 'ringinuse'));
            }
            $this->_ringinuse = (string) $data;

        } else {
            $this->_ringinuse = $data;
        }
        return $this;
    }

    /**
     * Gets column ringinuse
     *
     * @return string
     */
    public function getRinginuse()
    {
        return $this->_ringinuse;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstQueues
     */
    public function setWrapuptime($data)
    {

        if ($this->_wrapuptime != $data) {
            $this->_logChange('wrapuptime', $this->_wrapuptime, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_wrapuptime = $data;

        } else if (!is_null($data)) {
            $this->_wrapuptime = (int) $data;

        } else {
            $this->_wrapuptime = $data;
        }
        return $this;
    }

    /**
     * Gets column wrapuptime
     *
     * @return int
     */
    public function getWrapuptime()
    {
        return $this->_wrapuptime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstQueues
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstQueues
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
                throw new \InvalidArgumentException(sprintf(_('Invalid value for %s'), 'strategy'));
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
     * @return \IvozProvider\Model\Raw\AstQueues
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
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstQueues
     */
    public function setQueueId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * Sets parent relation Queue
     *
     * @param \IvozProvider\Model\Raw\Queues $data
     * @return \IvozProvider\Model\Raw\AstQueues
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

        $this->_setLoaded('AstQueuesIbfk1');
        return $this;
    }

    /**
     * Gets parent Queue
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Queues
     */
    public function getQueue($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstQueuesIbfk1';

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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\AstQueues
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\AstQueues')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\AstQueues);

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
     * @return null | \IvozProvider\Model\Validator\AstQueues
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\AstQueues')) {

                $this->setValidator(new \IvozProvider\Validator\AstQueues);
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
     * @see \Mapper\Sql\AstQueues::delete
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