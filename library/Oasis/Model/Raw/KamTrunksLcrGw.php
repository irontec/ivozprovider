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
class KamTrunksLcrGw extends ModelAbstract
{


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_lcrId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_gwName;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ipAddr;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_hostname;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_port;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_params;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_uriScheme;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_transport;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_strip;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_prefix;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tag;

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
    protected $_defunct;




    protected $_columnsList = array(
        'id'=>'id',
        'lcr_id'=>'lcrId',
        'gw_name'=>'gwName',
        'ip_addr'=>'ipAddr',
        'hostname'=>'hostname',
        'port'=>'port',
        'params'=>'params',
        'uri_scheme'=>'uriScheme',
        'transport'=>'transport',
        'strip'=>'strip',
        'prefix'=>'prefix',
        'tag'=>'tag',
        'flags'=>'flags',
        'defunct'=>'defunct',
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
            'flags' => '0',
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
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
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
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setLcrId($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_lcrId != $data) {
            $this->_logChange('lcrId');
        }

        if (!is_null($data)) {
            $this->_lcrId = (int) $data;
        } else {
            $this->_lcrId = $data;
        }
        return $this;
    }

    /**
     * Gets column lcr_id
     *
     * @return int
     */
    public function getLcrId()
    {
            return $this->_lcrId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setGwName($data)
    {

        if ($this->_gwName != $data) {
            $this->_logChange('gwName');
        }

        if (!is_null($data)) {
            $this->_gwName = (string) $data;
        } else {
            $this->_gwName = $data;
        }
        return $this;
    }

    /**
     * Gets column gw_name
     *
     * @return string
     */
    public function getGwName()
    {
            return $this->_gwName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setIpAddr($data)
    {

        if ($this->_ipAddr != $data) {
            $this->_logChange('ipAddr');
        }

        if (!is_null($data)) {
            $this->_ipAddr = (string) $data;
        } else {
            $this->_ipAddr = $data;
        }
        return $this;
    }

    /**
     * Gets column ip_addr
     *
     * @return string
     */
    public function getIpAddr()
    {
            return $this->_ipAddr;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setHostname($data)
    {

        if ($this->_hostname != $data) {
            $this->_logChange('hostname');
        }

        if (!is_null($data)) {
            $this->_hostname = (string) $data;
        } else {
            $this->_hostname = $data;
        }
        return $this;
    }

    /**
     * Gets column hostname
     *
     * @return string
     */
    public function getHostname()
    {
            return $this->_hostname;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setPort($data)
    {

        if ($this->_port != $data) {
            $this->_logChange('port');
        }

        if (!is_null($data)) {
            $this->_port = (int) $data;
        } else {
            $this->_port = $data;
        }
        return $this;
    }

    /**
     * Gets column port
     *
     * @return int
     */
    public function getPort()
    {
            return $this->_port;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setParams($data)
    {

        if ($this->_params != $data) {
            $this->_logChange('params');
        }

        if (!is_null($data)) {
            $this->_params = (string) $data;
        } else {
            $this->_params = $data;
        }
        return $this;
    }

    /**
     * Gets column params
     *
     * @return string
     */
    public function getParams()
    {
            return $this->_params;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setUriScheme($data)
    {

        if ($this->_uriScheme != $data) {
            $this->_logChange('uriScheme');
        }

        if (!is_null($data)) {
            $this->_uriScheme = (int) $data;
        } else {
            $this->_uriScheme = $data;
        }
        return $this;
    }

    /**
     * Gets column uri_scheme
     *
     * @return int
     */
    public function getUriScheme()
    {
            return $this->_uriScheme;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setTransport($data)
    {

        if ($this->_transport != $data) {
            $this->_logChange('transport');
        }

        if (!is_null($data)) {
            $this->_transport = (int) $data;
        } else {
            $this->_transport = $data;
        }
        return $this;
    }

    /**
     * Gets column transport
     *
     * @return int
     */
    public function getTransport()
    {
            return $this->_transport;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setStrip($data)
    {

        if ($this->_strip != $data) {
            $this->_logChange('strip');
        }

        if (!is_null($data)) {
            $this->_strip = (int) $data;
        } else {
            $this->_strip = $data;
        }
        return $this;
    }

    /**
     * Gets column strip
     *
     * @return int
     */
    public function getStrip()
    {
            return $this->_strip;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setPrefix($data)
    {

        if ($this->_prefix != $data) {
            $this->_logChange('prefix');
        }

        if (!is_null($data)) {
            $this->_prefix = (string) $data;
        } else {
            $this->_prefix = $data;
        }
        return $this;
    }

    /**
     * Gets column prefix
     *
     * @return string
     */
    public function getPrefix()
    {
            return $this->_prefix;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setTag($data)
    {

        if ($this->_tag != $data) {
            $this->_logChange('tag');
        }

        if (!is_null($data)) {
            $this->_tag = (string) $data;
        } else {
            $this->_tag = $data;
        }
        return $this;
    }

    /**
     * Gets column tag
     *
     * @return string
     */
    public function getTag()
    {
            return $this->_tag;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setFlags($data)
    {

        if ($this->_flags != $data) {
            $this->_logChange('flags');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\KamTrunksLcrGw
     */
    public function setDefunct($data)
    {

        if ($this->_defunct != $data) {
            $this->_logChange('defunct');
        }

        if (!is_null($data)) {
            $this->_defunct = (int) $data;
        } else {
            $this->_defunct = $data;
        }
        return $this;
    }

    /**
     * Gets column defunct
     *
     * @return int
     */
    public function getDefunct()
    {
            return $this->_defunct;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamTrunksLcrGw
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamTrunksLcrGw')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamTrunksLcrGw);

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
     * @return null | \Oasis\Model\Validator\KamTrunksLcrGw
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamTrunksLcrGw')) {

                $this->setValidator(new \Oasis\Validator\KamTrunksLcrGw);
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
     * @see \Mapper\Sql\KamTrunksLcrGw::delete
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
