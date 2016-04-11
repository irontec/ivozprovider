<?php

/**
 * Application Model
 *
 * @package Oasis\Model\Raw
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * 
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model\Raw;
class AstQueueMembers extends ModelAbstract
{


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
    protected $_uniqueid;




    protected $_columnsList = array(
        'queue_name'=>'queueName',
        'interface'=>'interface',
        'membername'=>'membername',
        'state_interface'=>'stateInterface',
        'penalty'=>'penalty',
        'paused'=>'paused',
        'uniqueid'=>'uniqueid',
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
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueMembers
     */
    public function setQueueName($data)
    {

        if ($this->_queueName != $data) {
            $this->_logChange('queueName');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstQueueMembers
     */
    public function setInterface($data)
    {

        if ($this->_interface != $data) {
            $this->_logChange('interface');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstQueueMembers
     */
    public function setMembername($data)
    {

        if ($this->_membername != $data) {
            $this->_logChange('membername');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstQueueMembers
     */
    public function setStateInterface($data)
    {

        if ($this->_stateInterface != $data) {
            $this->_logChange('stateInterface');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstQueueMembers
     */
    public function setPenalty($data)
    {

        if ($this->_penalty != $data) {
            $this->_logChange('penalty');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstQueueMembers
     */
    public function setPaused($data)
    {

        if ($this->_paused != $data) {
            $this->_logChange('paused');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstQueueMembers
     */
    public function setUniqueid($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_uniqueid != $data) {
            $this->_logChange('uniqueid');
        }

        if (!is_null($data)) {
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
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstQueueMembers
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstQueueMembers')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstQueueMembers);

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
     * @return null | \Oasis\Model\Validator\AstQueueMembers
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstQueueMembers')) {

                $this->setValidator(new \Oasis\Validator\AstQueueMembers);
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
        $primaryKey = array();
        if (!$this->getQueueName()) {
            $this->_logger->log('The value for QueueName cannot be empty in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key QueueName does not contain a value');
        } else {
            $primaryKey['queue_name'] = $this->getQueueName();
        }

        if (!$this->getInterface()) {
            $this->_logger->log('The value for Interface cannot be empty in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key Interface does not contain a value');
        } else {
            $primaryKey['interface'] = $this->getInterface();
        }

        return $this->getMapper()->getDbTable()->delete('queue_name = '
                    . $this->getMapper()->getDbTable()->getAdapter()->quote($primaryKey['queue_name'])
                    . ' AND interface = '
                    . $this->getMapper()->getDbTable()->getAdapter()->quote($primaryKey['interface']));
    }
}
