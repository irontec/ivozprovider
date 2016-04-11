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
class KamTrunksLocation extends ModelAbstract
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
    protected $_ruid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_username;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_domain;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_contact;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_received;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_path;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_expires;

    /**
     * Database var type float
     *
     * @var float
     */
    protected $_q;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callid;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_cseq;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_lastModified;

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
    protected $_cflags;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_userAgent;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_socket;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_methods;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_instance;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_regId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_serverId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_connectionId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_keepalive;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_partition;



    protected $_columnsList = array(
        'id'=>'id',
        'ruid'=>'ruid',
        'username'=>'username',
        'domain'=>'domain',
        'contact'=>'contact',
        'received'=>'received',
        'path'=>'path',
        'expires'=>'expires',
        'q'=>'q',
        'callid'=>'callid',
        'cseq'=>'cseq',
        'last_modified'=>'lastModified',
        'flags'=>'flags',
        'cflags'=>'cflags',
        'user_agent'=>'userAgent',
        'socket'=>'socket',
        'methods'=>'methods',
        'instance'=>'instance',
        'reg_id'=>'regId',
        'server_id'=>'serverId',
        'connection_id'=>'connectionId',
        'keepalive'=>'keepalive',
        'partition'=>'partition',
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
            'ruid' => '',
            'username' => '',
            'contact' => '',
            'expires' => '2030-05-28 21:32:15',
            'q' => '1.00',
            'callid' => 'Default-Call-ID',
            'cseq' => '1',
            'lastModified' => '1900-01-01 00:00:01',
            'flags' => '0',
            'cflags' => '0',
            'userAgent' => '',
            'regId' => '0',
            'serverId' => '0',
            'connectionId' => '0',
            'keepalive' => '0',
            'partition' => '0',
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
     * @return \Oasis\Model\Raw\KamTrunksLocation
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
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setRuid($data)
    {

        if ($this->_ruid != $data) {
            $this->_logChange('ruid');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ruid = $data;

        } else if (!is_null($data)) {
            $this->_ruid = (string) $data;

        } else {
            $this->_ruid = $data;
        }
        return $this;
    }

    /**
     * Gets column ruid
     *
     * @return string
     */
    public function getRuid()
    {
        return $this->_ruid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setUsername($data)
    {

        if ($this->_username != $data) {
            $this->_logChange('username');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_username = $data;

        } else if (!is_null($data)) {
            $this->_username = (string) $data;

        } else {
            $this->_username = $data;
        }
        return $this;
    }

    /**
     * Gets column username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setDomain($data)
    {

        if ($this->_domain != $data) {
            $this->_logChange('domain');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_domain = $data;

        } else if (!is_null($data)) {
            $this->_domain = (string) $data;

        } else {
            $this->_domain = $data;
        }
        return $this;
    }

    /**
     * Gets column domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->_domain;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setContact($data)
    {

        if ($this->_contact != $data) {
            $this->_logChange('contact');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_contact = $data;

        } else if (!is_null($data)) {
            $this->_contact = (string) $data;

        } else {
            $this->_contact = $data;
        }
        return $this;
    }

    /**
     * Gets column contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->_contact;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setReceived($data)
    {

        if ($this->_received != $data) {
            $this->_logChange('received');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_received = $data;

        } else if (!is_null($data)) {
            $this->_received = (string) $data;

        } else {
            $this->_received = $data;
        }
        return $this;
    }

    /**
     * Gets column received
     *
     * @return string
     */
    public function getReceived()
    {
        return $this->_received;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setPath($data)
    {

        if ($this->_path != $data) {
            $this->_logChange('path');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_path = $data;

        } else if (!is_null($data)) {
            $this->_path = (string) $data;

        } else {
            $this->_path = $data;
        }
        return $this;
    }

    /**
     * Gets column path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setExpires($data)
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

        if ($this->_expires != $data) {
            $this->_logChange('expires');
        }

        $this->_expires = $data;
        return $this;
    }

    /**
     * Gets column expires
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getExpires($returnZendDate = false)
    {
        if (is_null($this->_expires)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_expires->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_expires->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setQ($data)
    {

        if ($this->_q != $data) {
            $this->_logChange('q');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_q = $data;

        } else if (!is_null($data)) {
            $this->_q = (float) $data;

        } else {
            $this->_q = $data;
        }
        return $this;
    }

    /**
     * Gets column q
     *
     * @return float
     */
    public function getQ()
    {
        return $this->_q;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
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
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setCseq($data)
    {

        if ($this->_cseq != $data) {
            $this->_logChange('cseq');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_cseq = $data;

        } else if (!is_null($data)) {
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setLastModified($data)
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

        if ($this->_lastModified != $data) {
            $this->_logChange('lastModified');
        }

        $this->_lastModified = $data;
        return $this;
    }

    /**
     * Gets column last_modified
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getLastModified($returnZendDate = false)
    {
        if (is_null($this->_lastModified)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_lastModified->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_lastModified->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
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
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setCflags($data)
    {

        if ($this->_cflags != $data) {
            $this->_logChange('cflags');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_cflags = $data;

        } else if (!is_null($data)) {
            $this->_cflags = (int) $data;

        } else {
            $this->_cflags = $data;
        }
        return $this;
    }

    /**
     * Gets column cflags
     *
     * @return int
     */
    public function getCflags()
    {
        return $this->_cflags;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setUserAgent($data)
    {

        if ($this->_userAgent != $data) {
            $this->_logChange('userAgent');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_userAgent = $data;

        } else if (!is_null($data)) {
            $this->_userAgent = (string) $data;

        } else {
            $this->_userAgent = $data;
        }
        return $this;
    }

    /**
     * Gets column user_agent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->_userAgent;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setSocket($data)
    {

        if ($this->_socket != $data) {
            $this->_logChange('socket');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_socket = $data;

        } else if (!is_null($data)) {
            $this->_socket = (string) $data;

        } else {
            $this->_socket = $data;
        }
        return $this;
    }

    /**
     * Gets column socket
     *
     * @return string
     */
    public function getSocket()
    {
        return $this->_socket;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setMethods($data)
    {

        if ($this->_methods != $data) {
            $this->_logChange('methods');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_methods = $data;

        } else if (!is_null($data)) {
            $this->_methods = (int) $data;

        } else {
            $this->_methods = $data;
        }
        return $this;
    }

    /**
     * Gets column methods
     *
     * @return int
     */
    public function getMethods()
    {
        return $this->_methods;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setInstance($data)
    {

        if ($this->_instance != $data) {
            $this->_logChange('instance');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_instance = $data;

        } else if (!is_null($data)) {
            $this->_instance = (string) $data;

        } else {
            $this->_instance = $data;
        }
        return $this;
    }

    /**
     * Gets column instance
     *
     * @return string
     */
    public function getInstance()
    {
        return $this->_instance;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setRegId($data)
    {

        if ($this->_regId != $data) {
            $this->_logChange('regId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_regId = $data;

        } else if (!is_null($data)) {
            $this->_regId = (int) $data;

        } else {
            $this->_regId = $data;
        }
        return $this;
    }

    /**
     * Gets column reg_id
     *
     * @return int
     */
    public function getRegId()
    {
        return $this->_regId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setServerId($data)
    {

        if ($this->_serverId != $data) {
            $this->_logChange('serverId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_serverId = $data;

        } else if (!is_null($data)) {
            $this->_serverId = (int) $data;

        } else {
            $this->_serverId = $data;
        }
        return $this;
    }

    /**
     * Gets column server_id
     *
     * @return int
     */
    public function getServerId()
    {
        return $this->_serverId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setConnectionId($data)
    {

        if ($this->_connectionId != $data) {
            $this->_logChange('connectionId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_connectionId = $data;

        } else if (!is_null($data)) {
            $this->_connectionId = (int) $data;

        } else {
            $this->_connectionId = $data;
        }
        return $this;
    }

    /**
     * Gets column connection_id
     *
     * @return int
     */
    public function getConnectionId()
    {
        return $this->_connectionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setKeepalive($data)
    {

        if ($this->_keepalive != $data) {
            $this->_logChange('keepalive');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_keepalive = $data;

        } else if (!is_null($data)) {
            $this->_keepalive = (int) $data;

        } else {
            $this->_keepalive = $data;
        }
        return $this;
    }

    /**
     * Gets column keepalive
     *
     * @return int
     */
    public function getKeepalive()
    {
        return $this->_keepalive;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLocation
     */
    public function setPartition($data)
    {

        if ($this->_partition != $data) {
            $this->_logChange('partition');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_partition = $data;

        } else if (!is_null($data)) {
            $this->_partition = (int) $data;

        } else {
            $this->_partition = $data;
        }
        return $this;
    }

    /**
     * Gets column partition
     *
     * @return int
     */
    public function getPartition()
    {
        return $this->_partition;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamTrunksLocation
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamTrunksLocation')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamTrunksLocation);

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
     * @return null | \Oasis\Model\Validator\KamTrunksLocation
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamTrunksLocation')) {

                $this->setValidator(new \Oasis\Validator\KamTrunksLocation);
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
     * @see \Mapper\Sql\KamTrunksLocation::delete
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