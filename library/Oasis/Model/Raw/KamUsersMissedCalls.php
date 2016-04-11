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
class KamUsersMissedCalls extends ModelAbstract
{


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
    protected $_method;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromTag;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_toTag;

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
    protected $_sipCode;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_sipReason;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_time;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_srcIp;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromUser;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromDomain;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ruriUser;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ruriDomain;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_cseq;




    protected $_columnsList = array(
        'id'=>'id',
        'method'=>'method',
        'from_tag'=>'fromTag',
        'to_tag'=>'toTag',
        'callid'=>'callid',
        'sip_code'=>'sipCode',
        'sip_reason'=>'sipReason',
        'time'=>'time',
        'src_ip'=>'srcIp',
        'from_user'=>'fromUser',
        'from_domain'=>'fromDomain',
        'ruri_user'=>'ruriUser',
        'ruri_domain'=>'ruriDomain',
        'cseq'=>'cseq',
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
            'method' => '',
            'fromTag' => '',
            'toTag' => '',
            'callid' => '',
            'sipCode' => '',
            'sipReason' => '',
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
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
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
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setMethod($data)
    {

        if ($this->_method != $data) {
            $this->_logChange('method');
        }

        if (!is_null($data)) {
            $this->_method = (string) $data;
        } else {
            $this->_method = $data;
        }
        return $this;
    }

    /**
     * Gets column method
     *
     * @return string
     */
    public function getMethod()
    {
            return $this->_method;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setFromTag($data)
    {

        if ($this->_fromTag != $data) {
            $this->_logChange('fromTag');
        }

        if (!is_null($data)) {
            $this->_fromTag = (string) $data;
        } else {
            $this->_fromTag = $data;
        }
        return $this;
    }

    /**
     * Gets column from_tag
     *
     * @return string
     */
    public function getFromTag()
    {
            return $this->_fromTag;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setToTag($data)
    {

        if ($this->_toTag != $data) {
            $this->_logChange('toTag');
        }

        if (!is_null($data)) {
            $this->_toTag = (string) $data;
        } else {
            $this->_toTag = $data;
        }
        return $this;
    }

    /**
     * Gets column to_tag
     *
     * @return string
     */
    public function getToTag()
    {
            return $this->_toTag;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setSipCode($data)
    {

        if ($this->_sipCode != $data) {
            $this->_logChange('sipCode');
        }

        if (!is_null($data)) {
            $this->_sipCode = (string) $data;
        } else {
            $this->_sipCode = $data;
        }
        return $this;
    }

    /**
     * Gets column sip_code
     *
     * @return string
     */
    public function getSipCode()
    {
            return $this->_sipCode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setSipReason($data)
    {

        if ($this->_sipReason != $data) {
            $this->_logChange('sipReason');
        }

        if (!is_null($data)) {
            $this->_sipReason = (string) $data;
        } else {
            $this->_sipReason = $data;
        }
        return $this;
    }

    /**
     * Gets column sip_reason
     *
     * @return string
     */
    public function getSipReason()
    {
            return $this->_sipReason;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
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



        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
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
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setSrcIp($data)
    {

        if ($this->_srcIp != $data) {
            $this->_logChange('srcIp');
        }

        if (!is_null($data)) {
            $this->_srcIp = (string) $data;
        } else {
            $this->_srcIp = $data;
        }
        return $this;
    }

    /**
     * Gets column src_ip
     *
     * @return string
     */
    public function getSrcIp()
    {
            return $this->_srcIp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setFromUser($data)
    {

        if ($this->_fromUser != $data) {
            $this->_logChange('fromUser');
        }

        if (!is_null($data)) {
            $this->_fromUser = (string) $data;
        } else {
            $this->_fromUser = $data;
        }
        return $this;
    }

    /**
     * Gets column from_user
     *
     * @return string
     */
    public function getFromUser()
    {
            return $this->_fromUser;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setFromDomain($data)
    {

        if ($this->_fromDomain != $data) {
            $this->_logChange('fromDomain');
        }

        if (!is_null($data)) {
            $this->_fromDomain = (string) $data;
        } else {
            $this->_fromDomain = $data;
        }
        return $this;
    }

    /**
     * Gets column from_domain
     *
     * @return string
     */
    public function getFromDomain()
    {
            return $this->_fromDomain;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setRuriUser($data)
    {

        if ($this->_ruriUser != $data) {
            $this->_logChange('ruriUser');
        }

        if (!is_null($data)) {
            $this->_ruriUser = (string) $data;
        } else {
            $this->_ruriUser = $data;
        }
        return $this;
    }

    /**
     * Gets column ruri_user
     *
     * @return string
     */
    public function getRuriUser()
    {
            return $this->_ruriUser;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setRuriDomain($data)
    {

        if ($this->_ruriDomain != $data) {
            $this->_logChange('ruriDomain');
        }

        if (!is_null($data)) {
            $this->_ruriDomain = (string) $data;
        } else {
            $this->_ruriDomain = $data;
        }
        return $this;
    }

    /**
     * Gets column ruri_domain
     *
     * @return string
     */
    public function getRuriDomain()
    {
            return $this->_ruriDomain;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersMissedCalls
     */
    public function setCseq($data)
    {

        if ($this->_cseq != $data) {
            $this->_logChange('cseq');
        }

        if (!is_null($data)) {
            $this->_cseq = (int) $data;
        } else {
            $this->_cseq = $data;
        }
        return $this;
    }

    /**
     * Gets column cseq
     *
     * @return int
     */
    public function getCseq()
    {
            return $this->_cseq;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamUsersMissedCalls
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamUsersMissedCalls')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamUsersMissedCalls);

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
     * @return null | \Oasis\Model\Validator\KamUsersMissedCalls
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamUsersMissedCalls')) {

                $this->setValidator(new \Oasis\Validator\KamUsersMissedCalls);
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
     * @see \Mapper\Sql\KamUsersMissedCalls::delete
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
