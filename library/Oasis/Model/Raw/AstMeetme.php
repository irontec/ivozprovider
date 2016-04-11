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
class AstMeetme extends ModelAbstract
{


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_bookid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_confno;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_starttime;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_endtime;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pin;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_adminpin;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_opts;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_adminopts;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_recordingfilename;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_recordingformat;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxusers;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_members;




    protected $_columnsList = array(
        'bookid'=>'bookid',
        'confno'=>'confno',
        'starttime'=>'starttime',
        'endtime'=>'endtime',
        'pin'=>'pin',
        'adminpin'=>'adminpin',
        'opts'=>'opts',
        'adminopts'=>'adminopts',
        'recordingfilename'=>'recordingfilename',
        'recordingformat'=>'recordingformat',
        'maxusers'=>'maxusers',
        'members'=>'members',
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
     * @param int $data
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setBookid($data)
    {

        if ($this->_bookid != $data) {
            $this->_logChange('bookid');
        }

        if (!is_null($data)) {
            $this->_bookid = (int) $data;
        } else {
            $this->_bookid = $data;
        }
        return $this;
    }

    /**
     * Gets column bookid
     *
     * @return int
     */
    public function getBookid()
    {
            return $this->_bookid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setConfno($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_confno != $data) {
            $this->_logChange('confno');
        }

        if (!is_null($data)) {
            $this->_confno = (string) $data;
        } else {
            $this->_confno = $data;
        }
        return $this;
    }

    /**
     * Gets column confno
     *
     * @return string
     */
    public function getConfno()
    {
            return $this->_confno;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setStarttime($data)
    {

        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }

        if ($data === 'CURRENT_TIMESTAMP') {
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


        if ($this->_starttime != $data) {
            $this->_logChange('starttime');
        }

        $this->_starttime = $data;
        return $this;
    }

    /**
     * Gets column starttime
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getStarttime($returnZendDate = false)
    {
    
        if (is_null($this->_starttime)) {

            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_starttime->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }


        return $this->_starttime->format('Y-m-d H:i:s');

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setEndtime($data)
    {

        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }

        if ($data === 'CURRENT_TIMESTAMP') {
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


        if ($this->_endtime != $data) {
            $this->_logChange('endtime');
        }

        $this->_endtime = $data;
        return $this;
    }

    /**
     * Gets column endtime
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getEndtime($returnZendDate = false)
    {
    
        if (is_null($this->_endtime)) {

            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_endtime->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }


        return $this->_endtime->format('Y-m-d H:i:s');

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setPin($data)
    {

        if ($this->_pin != $data) {
            $this->_logChange('pin');
        }

        if (!is_null($data)) {
            $this->_pin = (string) $data;
        } else {
            $this->_pin = $data;
        }
        return $this;
    }

    /**
     * Gets column pin
     *
     * @return string
     */
    public function getPin()
    {
            return $this->_pin;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setAdminpin($data)
    {

        if ($this->_adminpin != $data) {
            $this->_logChange('adminpin');
        }

        if (!is_null($data)) {
            $this->_adminpin = (string) $data;
        } else {
            $this->_adminpin = $data;
        }
        return $this;
    }

    /**
     * Gets column adminpin
     *
     * @return string
     */
    public function getAdminpin()
    {
            return $this->_adminpin;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setOpts($data)
    {

        if ($this->_opts != $data) {
            $this->_logChange('opts');
        }

        if (!is_null($data)) {
            $this->_opts = (string) $data;
        } else {
            $this->_opts = $data;
        }
        return $this;
    }

    /**
     * Gets column opts
     *
     * @return string
     */
    public function getOpts()
    {
            return $this->_opts;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setAdminopts($data)
    {

        if ($this->_adminopts != $data) {
            $this->_logChange('adminopts');
        }

        if (!is_null($data)) {
            $this->_adminopts = (string) $data;
        } else {
            $this->_adminopts = $data;
        }
        return $this;
    }

    /**
     * Gets column adminopts
     *
     * @return string
     */
    public function getAdminopts()
    {
            return $this->_adminopts;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setRecordingfilename($data)
    {

        if ($this->_recordingfilename != $data) {
            $this->_logChange('recordingfilename');
        }

        if (!is_null($data)) {
            $this->_recordingfilename = (string) $data;
        } else {
            $this->_recordingfilename = $data;
        }
        return $this;
    }

    /**
     * Gets column recordingfilename
     *
     * @return string
     */
    public function getRecordingfilename()
    {
            return $this->_recordingfilename;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setRecordingformat($data)
    {

        if ($this->_recordingformat != $data) {
            $this->_logChange('recordingformat');
        }

        if (!is_null($data)) {
            $this->_recordingformat = (string) $data;
        } else {
            $this->_recordingformat = $data;
        }
        return $this;
    }

    /**
     * Gets column recordingformat
     *
     * @return string
     */
    public function getRecordingformat()
    {
            return $this->_recordingformat;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setMaxusers($data)
    {

        if ($this->_maxusers != $data) {
            $this->_logChange('maxusers');
        }

        if (!is_null($data)) {
            $this->_maxusers = (int) $data;
        } else {
            $this->_maxusers = $data;
        }
        return $this;
    }

    /**
     * Gets column maxusers
     *
     * @return int
     */
    public function getMaxusers()
    {
            return $this->_maxusers;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstMeetme
     */
    public function setMembers($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_members != $data) {
            $this->_logChange('members');
        }

        if (!is_null($data)) {
            $this->_members = (int) $data;
        } else {
            $this->_members = $data;
        }
        return $this;
    }

    /**
     * Gets column members
     *
     * @return int
     */
    public function getMembers()
    {
            return $this->_members;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstMeetme
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstMeetme')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstMeetme);

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
     * @return null | \Oasis\Model\Validator\AstMeetme
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstMeetme')) {

                $this->setValidator(new \Oasis\Validator\AstMeetme);
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
     * @see \Mapper\Sql\AstMeetme::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getBookid() === null) {
            $this->_logger->log('The value for Bookid cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'bookid = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getBookid())
        );
    }
}
