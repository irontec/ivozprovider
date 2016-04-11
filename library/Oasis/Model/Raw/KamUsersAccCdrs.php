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
class KamUsersAccCdrs extends ModelAbstract
{


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
    protected $_calldate;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_startTime;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_endTime;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_duration;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_caller;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callee;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_type;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_companyId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_companyName;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_asIden;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_asAddress;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callid;




    protected $_columnsList = array(
        'id'=>'id',
        'calldate'=>'calldate',
        'start_time'=>'startTime',
        'end_time'=>'endTime',
        'duration'=>'duration',
        'caller'=>'caller',
        'callee'=>'callee',
        'type'=>'type',
        'companyId'=>'companyId',
        'companyName'=>'companyName',
        'asIden'=>'asIden',
        'asAddress'=>'asAddress',
        'callid'=>'callid',
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
            'calldate' => 'CURRENT_TIMESTAMP',
            'startTime' => '',
            'endTime' => '',
            'duration' => '',
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
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        if (!is_null($data)) {
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
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setCalldate($data)
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


        if ($this->_calldate != $data) {
            $this->_logChange('calldate');
        }

        $this->_calldate = $data;
        return $this;
    }

    /**
     * Gets column calldate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getCalldate($returnZendDate = false)
    {
    
        if (is_null($this->_calldate)) {

            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_calldate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }


        return $this->_calldate->format('Y-m-d H:i:s');

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setStartTime($data)
    {

        if ($this->_startTime != $data) {
            $this->_logChange('startTime');
        }

        if (!is_null($data)) {
            $this->_startTime = (string) $data;
        } else {
            $this->_startTime = $data;
        }
        return $this;
    }

    /**
     * Gets column start_time
     *
     * @return string
     */
    public function getStartTime()
    {
            return $this->_startTime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setEndTime($data)
    {

        if ($this->_endTime != $data) {
            $this->_logChange('endTime');
        }

        if (!is_null($data)) {
            $this->_endTime = (string) $data;
        } else {
            $this->_endTime = $data;
        }
        return $this;
    }

    /**
     * Gets column end_time
     *
     * @return string
     */
    public function getEndTime()
    {
            return $this->_endTime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setDuration($data)
    {

        if ($this->_duration != $data) {
            $this->_logChange('duration');
        }

        if (!is_null($data)) {
            $this->_duration = (string) $data;
        } else {
            $this->_duration = $data;
        }
        return $this;
    }

    /**
     * Gets column duration
     *
     * @return string
     */
    public function getDuration()
    {
            return $this->_duration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setCaller($data)
    {

        if ($this->_caller != $data) {
            $this->_logChange('caller');
        }

        if (!is_null($data)) {
            $this->_caller = (string) $data;
        } else {
            $this->_caller = $data;
        }
        return $this;
    }

    /**
     * Gets column caller
     *
     * @return string
     */
    public function getCaller()
    {
            return $this->_caller;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setCallee($data)
    {

        if ($this->_callee != $data) {
            $this->_logChange('callee');
        }

        if (!is_null($data)) {
            $this->_callee = (string) $data;
        } else {
            $this->_callee = $data;
        }
        return $this;
    }

    /**
     * Gets column callee
     *
     * @return string
     */
    public function getCallee()
    {
            return $this->_callee;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setType($data)
    {

        if ($this->_type != $data) {
            $this->_logChange('type');
        }

        if (!is_null($data)) {
            $this->_type = (string) $data;
        } else {
            $this->_type = $data;
        }
        return $this;
    }

    /**
     * Gets column type
     *
     * @return string
     */
    public function getType()
    {
            return $this->_type;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setCompanyId($data)
    {

        if ($this->_companyId != $data) {
            $this->_logChange('companyId');
        }

        if (!is_null($data)) {
            $this->_companyId = (string) $data;
        } else {
            $this->_companyId = $data;
        }
        return $this;
    }

    /**
     * Gets column companyId
     *
     * @return string
     */
    public function getCompanyId()
    {
            return $this->_companyId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setCompanyName($data)
    {

        if ($this->_companyName != $data) {
            $this->_logChange('companyName');
        }

        if (!is_null($data)) {
            $this->_companyName = (string) $data;
        } else {
            $this->_companyName = $data;
        }
        return $this;
    }

    /**
     * Gets column companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
            return $this->_companyName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setAsIden($data)
    {

        if ($this->_asIden != $data) {
            $this->_logChange('asIden');
        }

        if (!is_null($data)) {
            $this->_asIden = (string) $data;
        } else {
            $this->_asIden = $data;
        }
        return $this;
    }

    /**
     * Gets column asIden
     *
     * @return string
     */
    public function getAsIden()
    {
            return $this->_asIden;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setAsAddress($data)
    {

        if ($this->_asAddress != $data) {
            $this->_logChange('asAddress');
        }

        if (!is_null($data)) {
            $this->_asAddress = (string) $data;
        } else {
            $this->_asAddress = $data;
        }
        return $this;
    }

    /**
     * Gets column asAddress
     *
     * @return string
     */
    public function getAsAddress()
    {
            return $this->_asAddress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersAccCdrs
     */
    public function setCallid($data)
    {

        if ($this->_callid != $data) {
            $this->_logChange('callid');
        }

        if (!is_null($data)) {
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
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamUsersAccCdrs
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamUsersAccCdrs')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamUsersAccCdrs);

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
     * @return null | \Oasis\Model\Validator\KamUsersAccCdrs
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamUsersAccCdrs')) {

                $this->setValidator(new \Oasis\Validator\KamUsersAccCdrs);
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
     * @see \Mapper\Sql\KamUsersAccCdrs::delete
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
}
