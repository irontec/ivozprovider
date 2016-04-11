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
class AstPsSubscriptionPersistence extends ModelAbstract
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
    protected $_packet;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_srcName;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_srcPort;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_transportKey;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_localName;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_localPort;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_cseq;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tag;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_endpoint;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_expires;




    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'packet'=>'packet',
        'src_name'=>'srcName',
        'src_port'=>'srcPort',
        'transport_key'=>'transportKey',
        'local_name'=>'localName',
        'local_port'=>'localPort',
        'cseq'=>'cseq',
        'tag'=>'tag',
        'endpoint'=>'endpoint',
        'expires'=>'expires',
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
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
     */
    public function setSorceryId($data)
    {

        if ($this->_sorceryId != $data) {
            $this->_logChange('sorceryId');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
     */
    public function setPacket($data)
    {

        if ($this->_packet != $data) {
            $this->_logChange('packet');
        }

        if (!is_null($data)) {
            $this->_packet = (string) $data;
        } else {
            $this->_packet = $data;
        }
        return $this;
    }

    /**
     * Gets column packet
     *
     * @return string
     */
    public function getPacket()
    {
            return $this->_packet;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
     */
    public function setSrcName($data)
    {

        if ($this->_srcName != $data) {
            $this->_logChange('srcName');
        }

        if (!is_null($data)) {
            $this->_srcName = (string) $data;
        } else {
            $this->_srcName = $data;
        }
        return $this;
    }

    /**
     * Gets column src_name
     *
     * @return string
     */
    public function getSrcName()
    {
            return $this->_srcName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
     */
    public function setSrcPort($data)
    {

        if ($this->_srcPort != $data) {
            $this->_logChange('srcPort');
        }

        if (!is_null($data)) {
            $this->_srcPort = (int) $data;
        } else {
            $this->_srcPort = $data;
        }
        return $this;
    }

    /**
     * Gets column src_port
     *
     * @return int
     */
    public function getSrcPort()
    {
            return $this->_srcPort;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
     */
    public function setTransportKey($data)
    {

        if ($this->_transportKey != $data) {
            $this->_logChange('transportKey');
        }

        if (!is_null($data)) {
            $this->_transportKey = (string) $data;
        } else {
            $this->_transportKey = $data;
        }
        return $this;
    }

    /**
     * Gets column transport_key
     *
     * @return string
     */
    public function getTransportKey()
    {
            return $this->_transportKey;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
     */
    public function setLocalName($data)
    {

        if ($this->_localName != $data) {
            $this->_logChange('localName');
        }

        if (!is_null($data)) {
            $this->_localName = (string) $data;
        } else {
            $this->_localName = $data;
        }
        return $this;
    }

    /**
     * Gets column local_name
     *
     * @return string
     */
    public function getLocalName()
    {
            return $this->_localName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
     */
    public function setLocalPort($data)
    {

        if ($this->_localPort != $data) {
            $this->_logChange('localPort');
        }

        if (!is_null($data)) {
            $this->_localPort = (int) $data;
        } else {
            $this->_localPort = $data;
        }
        return $this;
    }

    /**
     * Gets column local_port
     *
     * @return int
     */
    public function getLocalPort()
    {
            return $this->_localPort;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
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
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
     */
    public function setEndpoint($data)
    {

        if ($this->_endpoint != $data) {
            $this->_logChange('endpoint');
        }

        if (!is_null($data)) {
            $this->_endpoint = (string) $data;
        } else {
            $this->_endpoint = $data;
        }
        return $this;
    }

    /**
     * Gets column endpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
            return $this->_endpoint;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsSubscriptionPersistence
     */
    public function setExpires($data)
    {

        if ($this->_expires != $data) {
            $this->_logChange('expires');
        }

        if (!is_null($data)) {
            $this->_expires = (int) $data;
        } else {
            $this->_expires = $data;
        }
        return $this;
    }

    /**
     * Gets column expires
     *
     * @return int
     */
    public function getExpires()
    {
            return $this->_expires;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstPsSubscriptionPersistence
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstPsSubscriptionPersistence')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstPsSubscriptionPersistence);

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
     * @return null | \Oasis\Model\Validator\AstPsSubscriptionPersistence
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstPsSubscriptionPersistence')) {

                $this->setValidator(new \Oasis\Validator\AstPsSubscriptionPersistence);
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
     * @see \Mapper\Sql\AstPsSubscriptionPersistence::delete
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
}
