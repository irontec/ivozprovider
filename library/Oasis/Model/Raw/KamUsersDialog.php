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
class KamUsersDialog extends ModelAbstract
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
    protected $_hashEntry;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_hashId;

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
    protected $_fromUri;

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
    protected $_toUri;

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
    protected $_callerCseq;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_calleeCseq;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callerRouteSet;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_calleeRouteSet;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callerContact;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_calleeContact;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callerSock;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_calleeSock;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_state;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_startTime;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timeout;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_sflags;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_iflags;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_torouteName;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_reqUri;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_xdata;




    protected $_columnsList = array(
        'id'=>'id',
        'hash_entry'=>'hashEntry',
        'hash_id'=>'hashId',
        'callid'=>'callid',
        'from_uri'=>'fromUri',
        'from_tag'=>'fromTag',
        'to_uri'=>'toUri',
        'to_tag'=>'toTag',
        'caller_cseq'=>'callerCseq',
        'callee_cseq'=>'calleeCseq',
        'caller_route_set'=>'callerRouteSet',
        'callee_route_set'=>'calleeRouteSet',
        'caller_contact'=>'callerContact',
        'callee_contact'=>'calleeContact',
        'caller_sock'=>'callerSock',
        'callee_sock'=>'calleeSock',
        'state'=>'state',
        'start_time'=>'startTime',
        'timeout'=>'timeout',
        'sflags'=>'sflags',
        'iflags'=>'iflags',
        'toroute_name'=>'torouteName',
        'req_uri'=>'reqUri',
        'xdata'=>'xdata',
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
            'timeout' => '0',
            'sflags' => '0',
            'iflags' => '0',
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
     * @return \Oasis\Model\Raw\KamUsersDialog
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
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setHashEntry($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_hashEntry != $data) {
            $this->_logChange('hashEntry');
        }

        if (!is_null($data)) {
            $this->_hashEntry = (int) $data;
        } else {
            $this->_hashEntry = $data;
        }
        return $this;
    }

    /**
     * Gets column hash_entry
     *
     * @return int
     */
    public function getHashEntry()
    {
            return $this->_hashEntry;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setHashId($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_hashId != $data) {
            $this->_logChange('hashId');
        }

        if (!is_null($data)) {
            $this->_hashId = (int) $data;
        } else {
            $this->_hashId = $data;
        }
        return $this;
    }

    /**
     * Gets column hash_id
     *
     * @return int
     */
    public function getHashId()
    {
            return $this->_hashId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setCallid($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setFromUri($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_fromUri != $data) {
            $this->_logChange('fromUri');
        }

        if (!is_null($data)) {
            $this->_fromUri = (string) $data;
        } else {
            $this->_fromUri = $data;
        }
        return $this;
    }

    /**
     * Gets column from_uri
     *
     * @return string
     */
    public function getFromUri()
    {
            return $this->_fromUri;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setFromTag($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setToUri($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_toUri != $data) {
            $this->_logChange('toUri');
        }

        if (!is_null($data)) {
            $this->_toUri = (string) $data;
        } else {
            $this->_toUri = $data;
        }
        return $this;
    }

    /**
     * Gets column to_uri
     *
     * @return string
     */
    public function getToUri()
    {
            return $this->_toUri;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setToTag($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setCallerCseq($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_callerCseq != $data) {
            $this->_logChange('callerCseq');
        }

        if (!is_null($data)) {
            $this->_callerCseq = (string) $data;
        } else {
            $this->_callerCseq = $data;
        }
        return $this;
    }

    /**
     * Gets column caller_cseq
     *
     * @return string
     */
    public function getCallerCseq()
    {
            return $this->_callerCseq;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setCalleeCseq($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_calleeCseq != $data) {
            $this->_logChange('calleeCseq');
        }

        if (!is_null($data)) {
            $this->_calleeCseq = (string) $data;
        } else {
            $this->_calleeCseq = $data;
        }
        return $this;
    }

    /**
     * Gets column callee_cseq
     *
     * @return string
     */
    public function getCalleeCseq()
    {
            return $this->_calleeCseq;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setCallerRouteSet($data)
    {

        if ($this->_callerRouteSet != $data) {
            $this->_logChange('callerRouteSet');
        }

        if (!is_null($data)) {
            $this->_callerRouteSet = (string) $data;
        } else {
            $this->_callerRouteSet = $data;
        }
        return $this;
    }

    /**
     * Gets column caller_route_set
     *
     * @return string
     */
    public function getCallerRouteSet()
    {
            return $this->_callerRouteSet;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setCalleeRouteSet($data)
    {

        if ($this->_calleeRouteSet != $data) {
            $this->_logChange('calleeRouteSet');
        }

        if (!is_null($data)) {
            $this->_calleeRouteSet = (string) $data;
        } else {
            $this->_calleeRouteSet = $data;
        }
        return $this;
    }

    /**
     * Gets column callee_route_set
     *
     * @return string
     */
    public function getCalleeRouteSet()
    {
            return $this->_calleeRouteSet;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setCallerContact($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_callerContact != $data) {
            $this->_logChange('callerContact');
        }

        if (!is_null($data)) {
            $this->_callerContact = (string) $data;
        } else {
            $this->_callerContact = $data;
        }
        return $this;
    }

    /**
     * Gets column caller_contact
     *
     * @return string
     */
    public function getCallerContact()
    {
            return $this->_callerContact;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setCalleeContact($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_calleeContact != $data) {
            $this->_logChange('calleeContact');
        }

        if (!is_null($data)) {
            $this->_calleeContact = (string) $data;
        } else {
            $this->_calleeContact = $data;
        }
        return $this;
    }

    /**
     * Gets column callee_contact
     *
     * @return string
     */
    public function getCalleeContact()
    {
            return $this->_calleeContact;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setCallerSock($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_callerSock != $data) {
            $this->_logChange('callerSock');
        }

        if (!is_null($data)) {
            $this->_callerSock = (string) $data;
        } else {
            $this->_callerSock = $data;
        }
        return $this;
    }

    /**
     * Gets column caller_sock
     *
     * @return string
     */
    public function getCallerSock()
    {
            return $this->_callerSock;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setCalleeSock($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_calleeSock != $data) {
            $this->_logChange('calleeSock');
        }

        if (!is_null($data)) {
            $this->_calleeSock = (string) $data;
        } else {
            $this->_calleeSock = $data;
        }
        return $this;
    }

    /**
     * Gets column callee_sock
     *
     * @return string
     */
    public function getCalleeSock()
    {
            return $this->_calleeSock;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setState($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_state != $data) {
            $this->_logChange('state');
        }

        if (!is_null($data)) {
            $this->_state = (int) $data;
        } else {
            $this->_state = $data;
        }
        return $this;
    }

    /**
     * Gets column state
     *
     * @return int
     */
    public function getState()
    {
            return $this->_state;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setStartTime($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_startTime != $data) {
            $this->_logChange('startTime');
        }

        if (!is_null($data)) {
            $this->_startTime = (int) $data;
        } else {
            $this->_startTime = $data;
        }
        return $this;
    }

    /**
     * Gets column start_time
     *
     * @return int
     */
    public function getStartTime()
    {
            return $this->_startTime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setTimeout($data)
    {

        if ($this->_timeout != $data) {
            $this->_logChange('timeout');
        }

        if (!is_null($data)) {
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
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setSflags($data)
    {

        if ($this->_sflags != $data) {
            $this->_logChange('sflags');
        }

        if (!is_null($data)) {
            $this->_sflags = (int) $data;
        } else {
            $this->_sflags = $data;
        }
        return $this;
    }

    /**
     * Gets column sflags
     *
     * @return int
     */
    public function getSflags()
    {
            return $this->_sflags;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setIflags($data)
    {

        if ($this->_iflags != $data) {
            $this->_logChange('iflags');
        }

        if (!is_null($data)) {
            $this->_iflags = (int) $data;
        } else {
            $this->_iflags = $data;
        }
        return $this;
    }

    /**
     * Gets column iflags
     *
     * @return int
     */
    public function getIflags()
    {
            return $this->_iflags;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setTorouteName($data)
    {

        if ($this->_torouteName != $data) {
            $this->_logChange('torouteName');
        }

        if (!is_null($data)) {
            $this->_torouteName = (string) $data;
        } else {
            $this->_torouteName = $data;
        }
        return $this;
    }

    /**
     * Gets column toroute_name
     *
     * @return string
     */
    public function getTorouteName()
    {
            return $this->_torouteName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setReqUri($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_reqUri != $data) {
            $this->_logChange('reqUri');
        }

        if (!is_null($data)) {
            $this->_reqUri = (string) $data;
        } else {
            $this->_reqUri = $data;
        }
        return $this;
    }

    /**
     * Gets column req_uri
     *
     * @return string
     */
    public function getReqUri()
    {
            return $this->_reqUri;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialog
     */
    public function setXdata($data)
    {

        if ($this->_xdata != $data) {
            $this->_logChange('xdata');
        }

        if (!is_null($data)) {
            $this->_xdata = (string) $data;
        } else {
            $this->_xdata = $data;
        }
        return $this;
    }

    /**
     * Gets column xdata
     *
     * @return string
     */
    public function getXdata()
    {
            return $this->_xdata;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamUsersDialog
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamUsersDialog')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamUsersDialog);

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
     * @return null | \Oasis\Model\Validator\KamUsersDialog
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamUsersDialog')) {

                $this->setValidator(new \Oasis\Validator\KamUsersDialog);
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
     * @see \Mapper\Sql\KamUsersDialog::delete
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
