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
class AstQueueLog extends ModelAbstract
{

    protected $_parsedAcceptedValues = array(
        '0',
        '1',
        '2',
    );

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_time;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queuename;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_agent;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_event;

    /**
     * Database var type enum('0','1','2')
     *
     * @var string
     */
    protected $_parsed;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_data1;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_data2;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_data3;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_data4;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_data5;



    protected $_columnsList = array(
        'id'=>'id',
        'time'=>'time',
        'callid'=>'callid',
        'queuename'=>'queuename',
        'agent'=>'agent',
        'event'=>'event',
        'parsed'=>'parsed',
        'data1'=>'data1',
        'data2'=>'data2',
        'data3'=>'data3',
        'data4'=>'data4',
        'data5'=>'data5',
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
            'time' => 'CURRENT_TIMESTAMP',
            'callid' => '',
            'queuename' => '',
            'agent' => '',
            'event' => '',
            'parsed' => '0',
            'data1' => '',
            'data2' => '',
            'data3' => '',
            'data4' => '',
            'data5' => '',
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
     * @return \Oasis\Model\Raw\AstQueueLog
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
     * @param string|Zend_Date|DateTime $date
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setTime($data)
    {
        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }
        if ($data === 'CURRENT_TIMESTAMP' || is_null($data)) {
            $data = \Zend_Date::now()->setTimezone('UTC');
        }

        if ($data instanceof \Zend_Date) {

            $data = new \DateTime($data->toString('yyyy-MM-dd HH:mm:ss'), new \DateTimeZone($data->getTimezone()));

        } elseif (!is_null($data) && !$data instanceof \DateTime) {

            $data = new \DateTime($data, new \DateTimeZone('UTC'));
        }
        if ($data instanceof \DateTime && $data->getTimezone()->getName() != 'UTC') {

            $data->setTimezone(new \DateTimeZone('UTC'));
        }

        if ($this->_time != $data) {
            $this->_logChange('time');
        }

        $this->_time = $data;
        return $this;
    }

    /**
     * Gets column time
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getTime($returnZendDate = false)
    {
        if (is_null($this->_time)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_time->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_time->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setCallid($data)
    {

        if ($this->_callid != $data) {
            $this->_logChange('callid');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callid = $data;

        } else if (!is_null($data)) {
            $this->_callid = (string) $data;

        } else {
            $this->_callid = $data;
        }
        return $this;
    }

    /**
     * Gets column callid
     *
     * @return string
     */
    public function getCallid()
    {
        return $this->_callid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setQueuename($data)
    {

        if ($this->_queuename != $data) {
            $this->_logChange('queuename');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_queuename = $data;

        } else if (!is_null($data)) {
            $this->_queuename = (string) $data;

        } else {
            $this->_queuename = $data;
        }
        return $this;
    }

    /**
     * Gets column queuename
     *
     * @return string
     */
    public function getQueuename()
    {
        return $this->_queuename;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setAgent($data)
    {

        if ($this->_agent != $data) {
            $this->_logChange('agent');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_agent = $data;

        } else if (!is_null($data)) {
            $this->_agent = (string) $data;

        } else {
            $this->_agent = $data;
        }
        return $this;
    }

    /**
     * Gets column agent
     *
     * @return string
     */
    public function getAgent()
    {
        return $this->_agent;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setEvent($data)
    {

        if ($this->_event != $data) {
            $this->_logChange('event');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_event = $data;

        } else if (!is_null($data)) {
            $this->_event = (string) $data;

        } else {
            $this->_event = $data;
        }
        return $this;
    }

    /**
     * Gets column event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->_event;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setParsed($data)
    {

        if ($this->_parsed != $data) {
            $this->_logChange('parsed');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_parsed = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_parsedAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for parsed'));
            }
            $this->_parsed = (string) $data;

        } else {
            $this->_parsed = $data;
        }
        return $this;
    }

    /**
     * Gets column parsed
     *
     * @return string
     */
    public function getParsed()
    {
        return $this->_parsed;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setData1($data)
    {

        if ($this->_data1 != $data) {
            $this->_logChange('data1');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_data1 = $data;

        } else if (!is_null($data)) {
            $this->_data1 = (string) $data;

        } else {
            $this->_data1 = $data;
        }
        return $this;
    }

    /**
     * Gets column data1
     *
     * @return string
     */
    public function getData1()
    {
        return $this->_data1;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setData2($data)
    {

        if ($this->_data2 != $data) {
            $this->_logChange('data2');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_data2 = $data;

        } else if (!is_null($data)) {
            $this->_data2 = (string) $data;

        } else {
            $this->_data2 = $data;
        }
        return $this;
    }

    /**
     * Gets column data2
     *
     * @return string
     */
    public function getData2()
    {
        return $this->_data2;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setData3($data)
    {

        if ($this->_data3 != $data) {
            $this->_logChange('data3');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_data3 = $data;

        } else if (!is_null($data)) {
            $this->_data3 = (string) $data;

        } else {
            $this->_data3 = $data;
        }
        return $this;
    }

    /**
     * Gets column data3
     *
     * @return string
     */
    public function getData3()
    {
        return $this->_data3;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setData4($data)
    {

        if ($this->_data4 != $data) {
            $this->_logChange('data4');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_data4 = $data;

        } else if (!is_null($data)) {
            $this->_data4 = (string) $data;

        } else {
            $this->_data4 = $data;
        }
        return $this;
    }

    /**
     * Gets column data4
     *
     * @return string
     */
    public function getData4()
    {
        return $this->_data4;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueueLog
     */
    public function setData5($data)
    {

        if ($this->_data5 != $data) {
            $this->_logChange('data5');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_data5 = $data;

        } else if (!is_null($data)) {
            $this->_data5 = (string) $data;

        } else {
            $this->_data5 = $data;
        }
        return $this;
    }

    /**
     * Gets column data5
     *
     * @return string
     */
    public function getData5()
    {
        return $this->_data5;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstQueueLog
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstQueueLog')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstQueueLog);

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
     * @return null | \Oasis\Model\Validator\AstQueueLog
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstQueueLog')) {

                $this->setValidator(new \Oasis\Validator\AstQueueLog);
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
     * @see \Mapper\Sql\AstQueueLog::delete
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