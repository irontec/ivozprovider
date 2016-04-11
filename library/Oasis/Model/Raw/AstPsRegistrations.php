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
class AstPsRegistrations extends ModelAbstract
{

    protected $_authRejectionPermanentAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_supportPathAcceptedValues = array(
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
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_authRejectionPermanent;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_clientUri;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_contactUser;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_expiration;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxRetries;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_outboundAuth;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_outboundProxy;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_retryInterval;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_forbiddenRetryInterval;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_serverUri;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_transport;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_supportPath;




    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'auth_rejection_permanent'=>'authRejectionPermanent',
        'client_uri'=>'clientUri',
        'contact_user'=>'contactUser',
        'expiration'=>'expiration',
        'max_retries'=>'maxRetries',
        'outbound_auth'=>'outboundAuth',
        'outbound_proxy'=>'outboundProxy',
        'retry_interval'=>'retryInterval',
        'forbidden_retry_interval'=>'forbiddenRetryInterval',
        'server_uri'=>'serverUri',
        'transport'=>'transport',
        'support_path'=>'supportPath',
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
     * @return \Oasis\Model\Raw\AstPsRegistrations
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
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setAuthRejectionPermanent($data)
    {

        if ($this->_authRejectionPermanent != $data) {
            $this->_logChange('authRejectionPermanent');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_authRejectionPermanentAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for authRejectionPermanent'));
            }
            $this->_authRejectionPermanent = (string) $data;
        } else {
            $this->_authRejectionPermanent = $data;
        }
        return $this;
    }

    /**
     * Gets column auth_rejection_permanent
     *
     * @return string
     */
    public function getAuthRejectionPermanent()
    {
            return $this->_authRejectionPermanent;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setClientUri($data)
    {

        if ($this->_clientUri != $data) {
            $this->_logChange('clientUri');
        }

        if (!is_null($data)) {
            $this->_clientUri = (string) $data;
        } else {
            $this->_clientUri = $data;
        }
        return $this;
    }

    /**
     * Gets column client_uri
     *
     * @return string
     */
    public function getClientUri()
    {
            return $this->_clientUri;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setContactUser($data)
    {

        if ($this->_contactUser != $data) {
            $this->_logChange('contactUser');
        }

        if (!is_null($data)) {
            $this->_contactUser = (string) $data;
        } else {
            $this->_contactUser = $data;
        }
        return $this;
    }

    /**
     * Gets column contact_user
     *
     * @return string
     */
    public function getContactUser()
    {
            return $this->_contactUser;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setExpiration($data)
    {

        if ($this->_expiration != $data) {
            $this->_logChange('expiration');
        }

        if (!is_null($data)) {
            $this->_expiration = (int) $data;
        } else {
            $this->_expiration = $data;
        }
        return $this;
    }

    /**
     * Gets column expiration
     *
     * @return int
     */
    public function getExpiration()
    {
            return $this->_expiration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setMaxRetries($data)
    {

        if ($this->_maxRetries != $data) {
            $this->_logChange('maxRetries');
        }

        if (!is_null($data)) {
            $this->_maxRetries = (int) $data;
        } else {
            $this->_maxRetries = $data;
        }
        return $this;
    }

    /**
     * Gets column max_retries
     *
     * @return int
     */
    public function getMaxRetries()
    {
            return $this->_maxRetries;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setOutboundAuth($data)
    {

        if ($this->_outboundAuth != $data) {
            $this->_logChange('outboundAuth');
        }

        if (!is_null($data)) {
            $this->_outboundAuth = (string) $data;
        } else {
            $this->_outboundAuth = $data;
        }
        return $this;
    }

    /**
     * Gets column outbound_auth
     *
     * @return string
     */
    public function getOutboundAuth()
    {
            return $this->_outboundAuth;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setOutboundProxy($data)
    {

        if ($this->_outboundProxy != $data) {
            $this->_logChange('outboundProxy');
        }

        if (!is_null($data)) {
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
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setRetryInterval($data)
    {

        if ($this->_retryInterval != $data) {
            $this->_logChange('retryInterval');
        }

        if (!is_null($data)) {
            $this->_retryInterval = (int) $data;
        } else {
            $this->_retryInterval = $data;
        }
        return $this;
    }

    /**
     * Gets column retry_interval
     *
     * @return int
     */
    public function getRetryInterval()
    {
            return $this->_retryInterval;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setForbiddenRetryInterval($data)
    {

        if ($this->_forbiddenRetryInterval != $data) {
            $this->_logChange('forbiddenRetryInterval');
        }

        if (!is_null($data)) {
            $this->_forbiddenRetryInterval = (int) $data;
        } else {
            $this->_forbiddenRetryInterval = $data;
        }
        return $this;
    }

    /**
     * Gets column forbidden_retry_interval
     *
     * @return int
     */
    public function getForbiddenRetryInterval()
    {
            return $this->_forbiddenRetryInterval;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setServerUri($data)
    {

        if ($this->_serverUri != $data) {
            $this->_logChange('serverUri');
        }

        if (!is_null($data)) {
            $this->_serverUri = (string) $data;
        } else {
            $this->_serverUri = $data;
        }
        return $this;
    }

    /**
     * Gets column server_uri
     *
     * @return string
     */
    public function getServerUri()
    {
            return $this->_serverUri;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setTransport($data)
    {

        if ($this->_transport != $data) {
            $this->_logChange('transport');
        }

        if (!is_null($data)) {
            $this->_transport = (string) $data;
        } else {
            $this->_transport = $data;
        }
        return $this;
    }

    /**
     * Gets column transport
     *
     * @return string
     */
    public function getTransport()
    {
            return $this->_transport;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsRegistrations
     */
    public function setSupportPath($data)
    {

        if ($this->_supportPath != $data) {
            $this->_logChange('supportPath');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_supportPathAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for supportPath'));
            }
            $this->_supportPath = (string) $data;
        } else {
            $this->_supportPath = $data;
        }
        return $this;
    }

    /**
     * Gets column support_path
     *
     * @return string
     */
    public function getSupportPath()
    {
            return $this->_supportPath;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstPsRegistrations
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstPsRegistrations')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstPsRegistrations);

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
     * @return null | \Oasis\Model\Validator\AstPsRegistrations
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstPsRegistrations')) {

                $this->setValidator(new \Oasis\Validator\AstPsRegistrations);
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
     * @see \Mapper\Sql\AstPsRegistrations::delete
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
