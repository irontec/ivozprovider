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
class AstPsContacts extends ModelAbstract
{


    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_sorceryId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_uri;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_expirationTime;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_qualifyFrequency;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_qualifyTimeout;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_outboundProxy;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_path;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_userAgent;



    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'uri'=>'uri',
        'expiration_time'=>'expirationTime',
        'qualify_frequency'=>'qualifyFrequency',
        'qualify_timeout'=>'qualifyTimeout',
        'outbound_proxy'=>'outboundProxy',
        'path'=>'path',
        'user_agent'=>'userAgent',
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
     * @return \IvozProvider\Model\Raw\AstPsContacts
     */
    public function setSorceryId($data)
    {

        if ($this->_sorceryId != $data) {
            $this->_logChange('sorceryId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sorceryId = $data;

        } else if (!is_null($data)) {
            $this->_sorceryId = (string) $data;

        } else {
            $this->_sorceryId = $data;
        }
        return $this;
    }

    /**
     * Gets column sorcery_id
     *
     * @return string
     */
    public function getSorceryId()
    {
        return $this->_sorceryId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsContacts
     */
    public function setUri($data)
    {

        if ($this->_uri != $data) {
            $this->_logChange('uri');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_uri = $data;

        } else if (!is_null($data)) {
            $this->_uri = (string) $data;

        } else {
            $this->_uri = $data;
        }
        return $this;
    }

    /**
     * Gets column uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsContacts
     */
    public function setExpirationTime($data)
    {

        if ($this->_expirationTime != $data) {
            $this->_logChange('expirationTime');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_expirationTime = $data;

        } else if (!is_null($data)) {
            $this->_expirationTime = (string) $data;

        } else {
            $this->_expirationTime = $data;
        }
        return $this;
    }

    /**
     * Gets column expiration_time
     *
     * @return string
     */
    public function getExpirationTime()
    {
        return $this->_expirationTime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsContacts
     */
    public function setQualifyFrequency($data)
    {

        if ($this->_qualifyFrequency != $data) {
            $this->_logChange('qualifyFrequency');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_qualifyFrequency = $data;

        } else if (!is_null($data)) {
            $this->_qualifyFrequency = (int) $data;

        } else {
            $this->_qualifyFrequency = $data;
        }
        return $this;
    }

    /**
     * Gets column qualify_frequency
     *
     * @return int
     */
    public function getQualifyFrequency()
    {
        return $this->_qualifyFrequency;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsContacts
     */
    public function setQualifyTimeout($data)
    {

        if ($this->_qualifyTimeout != $data) {
            $this->_logChange('qualifyTimeout');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_qualifyTimeout = $data;

        } else if (!is_null($data)) {
            $this->_qualifyTimeout = (int) $data;

        } else {
            $this->_qualifyTimeout = $data;
        }
        return $this;
    }

    /**
     * Gets column qualify_timeout
     *
     * @return int
     */
    public function getQualifyTimeout()
    {
        return $this->_qualifyTimeout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsContacts
     */
    public function setOutboundProxy($data)
    {

        if ($this->_outboundProxy != $data) {
            $this->_logChange('outboundProxy');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outboundProxy = $data;

        } else if (!is_null($data)) {
            $this->_outboundProxy = (string) $data;

        } else {
            $this->_outboundProxy = $data;
        }
        return $this;
    }

    /**
     * Gets column outbound_proxy
     *
     * @return string
     */
    public function getOutboundProxy()
    {
        return $this->_outboundProxy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \IvozProvider\Model\Raw\AstPsContacts
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
     * @return text
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsContacts
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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\AstPsContacts
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\AstPsContacts')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\AstPsContacts);

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
     * @return null | \IvozProvider\Model\Validator\AstPsContacts
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\AstPsContacts')) {

                $this->setValidator(new \IvozProvider\Validator\AstPsContacts);
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
     * @see \Mapper\Sql\AstPsContacts::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getSorceryId() === null) {
            $this->_logger->log('The value for SorceryId cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'sorcery_id = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getSorceryId())
        );
    }

    public function mustUpdateEtag()
    {
        return true;
    }

}