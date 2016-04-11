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
class AstPsTransports extends ModelAbstract
{

    protected $_methodAcceptedValues = array(
        'default',
        'unspecified',
        'tlsv1',
        'sslv2',
        'sslv3',
        'sslv23',
    );
    protected $_protocolAcceptedValues = array(
        'udp',
        'tcp',
        'tls',
        'ws',
        'wss',
    );
    protected $_requireClientCertAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_verifyClientAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_verifyServerAcceptedValues = array(
        'yes',
        'no',
    );

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_sorceryId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_asyncOperations;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_bind;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_caListFile;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_certFile;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_cipher;

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
    protected $_externalMediaAddress;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_externalSignalingAddress;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_externalSignalingPort;

    /**
     * Database var type enum('default','unspecified','tlsv1','sslv2','sslv3','sslv23')
     *
     * @var string
     */
    protected $_method;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_localNet;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_password;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_privKeyFile;

    /**
     * Database var type enum('udp','tcp','tls','ws','wss')
     *
     * @var string
     */
    protected $_protocol;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_requireClientCert;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_verifyClient;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_verifyServer;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tos;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_cos;




    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'async_operations'=>'asyncOperations',
        'bind'=>'bind',
        'ca_list_file'=>'caListFile',
        'cert_file'=>'certFile',
        'cipher'=>'cipher',
        'domain'=>'domain',
        'external_media_address'=>'externalMediaAddress',
        'external_signaling_address'=>'externalSignalingAddress',
        'external_signaling_port'=>'externalSignalingPort',
        'method'=>'method',
        'local_net'=>'localNet',
        'password'=>'password',
        'priv_key_file'=>'privKeyFile',
        'protocol'=>'protocol',
        'require_client_cert'=>'requireClientCert',
        'verify_client'=>'verifyClient',
        'verify_server'=>'verifyServer',
        'tos'=>'tos',
        'cos'=>'cos',
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
     * @return \Oasis\Model\Raw\AstPsTransports
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
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setAsyncOperations($data)
    {

        if ($this->_asyncOperations != $data) {
            $this->_logChange('asyncOperations');
        }

        if (!is_null($data)) {
            $this->_asyncOperations = (int) $data;
        } else {
            $this->_asyncOperations = $data;
        }
        return $this;
    }

    /**
     * Gets column async_operations
     *
     * @return int
     */
    public function getAsyncOperations()
    {
            return $this->_asyncOperations;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setBind($data)
    {

        if ($this->_bind != $data) {
            $this->_logChange('bind');
        }

        if (!is_null($data)) {
            $this->_bind = (string) $data;
        } else {
            $this->_bind = $data;
        }
        return $this;
    }

    /**
     * Gets column bind
     *
     * @return string
     */
    public function getBind()
    {
            return $this->_bind;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setCaListFile($data)
    {

        if ($this->_caListFile != $data) {
            $this->_logChange('caListFile');
        }

        if (!is_null($data)) {
            $this->_caListFile = (string) $data;
        } else {
            $this->_caListFile = $data;
        }
        return $this;
    }

    /**
     * Gets column ca_list_file
     *
     * @return string
     */
    public function getCaListFile()
    {
            return $this->_caListFile;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setCertFile($data)
    {

        if ($this->_certFile != $data) {
            $this->_logChange('certFile');
        }

        if (!is_null($data)) {
            $this->_certFile = (string) $data;
        } else {
            $this->_certFile = $data;
        }
        return $this;
    }

    /**
     * Gets column cert_file
     *
     * @return string
     */
    public function getCertFile()
    {
            return $this->_certFile;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setCipher($data)
    {

        if ($this->_cipher != $data) {
            $this->_logChange('cipher');
        }

        if (!is_null($data)) {
            $this->_cipher = (string) $data;
        } else {
            $this->_cipher = $data;
        }
        return $this;
    }

    /**
     * Gets column cipher
     *
     * @return string
     */
    public function getCipher()
    {
            return $this->_cipher;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setDomain($data)
    {

        if ($this->_domain != $data) {
            $this->_logChange('domain');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setExternalMediaAddress($data)
    {

        if ($this->_externalMediaAddress != $data) {
            $this->_logChange('externalMediaAddress');
        }

        if (!is_null($data)) {
            $this->_externalMediaAddress = (string) $data;
        } else {
            $this->_externalMediaAddress = $data;
        }
        return $this;
    }

    /**
     * Gets column external_media_address
     *
     * @return string
     */
    public function getExternalMediaAddress()
    {
            return $this->_externalMediaAddress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setExternalSignalingAddress($data)
    {

        if ($this->_externalSignalingAddress != $data) {
            $this->_logChange('externalSignalingAddress');
        }

        if (!is_null($data)) {
            $this->_externalSignalingAddress = (string) $data;
        } else {
            $this->_externalSignalingAddress = $data;
        }
        return $this;
    }

    /**
     * Gets column external_signaling_address
     *
     * @return string
     */
    public function getExternalSignalingAddress()
    {
            return $this->_externalSignalingAddress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setExternalSignalingPort($data)
    {

        if ($this->_externalSignalingPort != $data) {
            $this->_logChange('externalSignalingPort');
        }

        if (!is_null($data)) {
            $this->_externalSignalingPort = (int) $data;
        } else {
            $this->_externalSignalingPort = $data;
        }
        return $this;
    }

    /**
     * Gets column external_signaling_port
     *
     * @return int
     */
    public function getExternalSignalingPort()
    {
            return $this->_externalSignalingPort;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setMethod($data)
    {

        if ($this->_method != $data) {
            $this->_logChange('method');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_methodAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for method'));
            }
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
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setLocalNet($data)
    {

        if ($this->_localNet != $data) {
            $this->_logChange('localNet');
        }

        if (!is_null($data)) {
            $this->_localNet = (string) $data;
        } else {
            $this->_localNet = $data;
        }
        return $this;
    }

    /**
     * Gets column local_net
     *
     * @return string
     */
    public function getLocalNet()
    {
            return $this->_localNet;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setPassword($data)
    {

        if ($this->_password != $data) {
            $this->_logChange('password');
        }

        if (!is_null($data)) {
            $this->_password = (string) $data;
        } else {
            $this->_password = $data;
        }
        return $this;
    }

    /**
     * Gets column password
     *
     * @return string
     */
    public function getPassword()
    {
            return $this->_password;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setPrivKeyFile($data)
    {

        if ($this->_privKeyFile != $data) {
            $this->_logChange('privKeyFile');
        }

        if (!is_null($data)) {
            $this->_privKeyFile = (string) $data;
        } else {
            $this->_privKeyFile = $data;
        }
        return $this;
    }

    /**
     * Gets column priv_key_file
     *
     * @return string
     */
    public function getPrivKeyFile()
    {
            return $this->_privKeyFile;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setProtocol($data)
    {

        if ($this->_protocol != $data) {
            $this->_logChange('protocol');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_protocolAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for protocol'));
            }
            $this->_protocol = (string) $data;
        } else {
            $this->_protocol = $data;
        }
        return $this;
    }

    /**
     * Gets column protocol
     *
     * @return string
     */
    public function getProtocol()
    {
            return $this->_protocol;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setRequireClientCert($data)
    {

        if ($this->_requireClientCert != $data) {
            $this->_logChange('requireClientCert');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_requireClientCertAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for requireClientCert'));
            }
            $this->_requireClientCert = (string) $data;
        } else {
            $this->_requireClientCert = $data;
        }
        return $this;
    }

    /**
     * Gets column require_client_cert
     *
     * @return string
     */
    public function getRequireClientCert()
    {
            return $this->_requireClientCert;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setVerifyClient($data)
    {

        if ($this->_verifyClient != $data) {
            $this->_logChange('verifyClient');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_verifyClientAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for verifyClient'));
            }
            $this->_verifyClient = (string) $data;
        } else {
            $this->_verifyClient = $data;
        }
        return $this;
    }

    /**
     * Gets column verify_client
     *
     * @return string
     */
    public function getVerifyClient()
    {
            return $this->_verifyClient;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setVerifyServer($data)
    {

        if ($this->_verifyServer != $data) {
            $this->_logChange('verifyServer');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_verifyServerAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for verifyServer'));
            }
            $this->_verifyServer = (string) $data;
        } else {
            $this->_verifyServer = $data;
        }
        return $this;
    }

    /**
     * Gets column verify_server
     *
     * @return string
     */
    public function getVerifyServer()
    {
            return $this->_verifyServer;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setTos($data)
    {

        if ($this->_tos != $data) {
            $this->_logChange('tos');
        }

        if (!is_null($data)) {
            $this->_tos = (string) $data;
        } else {
            $this->_tos = $data;
        }
        return $this;
    }

    /**
     * Gets column tos
     *
     * @return string
     */
    public function getTos()
    {
            return $this->_tos;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsTransports
     */
    public function setCos($data)
    {

        if ($this->_cos != $data) {
            $this->_logChange('cos');
        }

        if (!is_null($data)) {
            $this->_cos = (int) $data;
        } else {
            $this->_cos = $data;
        }
        return $this;
    }

    /**
     * Gets column cos
     *
     * @return int
     */
    public function getCos()
    {
            return $this->_cos;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstPsTransports
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstPsTransports')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstPsTransports);

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
     * @return null | \Oasis\Model\Validator\AstPsTransports
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstPsTransports')) {

                $this->setValidator(new \Oasis\Validator\AstPsTransports);
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
     * @see \Mapper\Sql\AstPsTransports::delete
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
