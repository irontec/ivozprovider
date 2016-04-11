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
class AstPsAuths extends ModelAbstract
{

    protected $_authTypeAcceptedValues = array(
        'md5',
        'userpass',
    );

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_sorceryId;

    /**
     * Database var type enum('md5','userpass')
     *
     * @var string
     */
    protected $_authType;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_nonceLifetime;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_md5Cred;

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
    protected $_realm;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_username;




    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'auth_type'=>'authType',
        'nonce_lifetime'=>'nonceLifetime',
        'md5_cred'=>'md5Cred',
        'password'=>'password',
        'realm'=>'realm',
        'username'=>'username',
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
     * @return \Oasis\Model\Raw\AstPsAuths
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
     * @return \Oasis\Model\Raw\AstPsAuths
     */
    public function setAuthType($data)
    {

        if ($this->_authType != $data) {
            $this->_logChange('authType');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_authTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for authType'));
            }
            $this->_authType = (string) $data;
        } else {
            $this->_authType = $data;
        }
        return $this;
    }

    /**
     * Gets column auth_type
     *
     * @return string
     */
    public function getAuthType()
    {
            return $this->_authType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsAuths
     */
    public function setNonceLifetime($data)
    {

        if ($this->_nonceLifetime != $data) {
            $this->_logChange('nonceLifetime');
        }

        if (!is_null($data)) {
            $this->_nonceLifetime = (int) $data;
        } else {
            $this->_nonceLifetime = $data;
        }
        return $this;
    }

    /**
     * Gets column nonce_lifetime
     *
     * @return int
     */
    public function getNonceLifetime()
    {
            return $this->_nonceLifetime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsAuths
     */
    public function setMd5Cred($data)
    {

        if ($this->_md5Cred != $data) {
            $this->_logChange('md5Cred');
        }

        if (!is_null($data)) {
            $this->_md5Cred = (string) $data;
        } else {
            $this->_md5Cred = $data;
        }
        return $this;
    }

    /**
     * Gets column md5_cred
     *
     * @return string
     */
    public function getMd5Cred()
    {
            return $this->_md5Cred;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsAuths
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
     * @return \Oasis\Model\Raw\AstPsAuths
     */
    public function setRealm($data)
    {

        if ($this->_realm != $data) {
            $this->_logChange('realm');
        }

        if (!is_null($data)) {
            $this->_realm = (string) $data;
        } else {
            $this->_realm = $data;
        }
        return $this;
    }

    /**
     * Gets column realm
     *
     * @return string
     */
    public function getRealm()
    {
            return $this->_realm;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsAuths
     */
    public function setUsername($data)
    {

        if ($this->_username != $data) {
            $this->_logChange('username');
        }

        if (!is_null($data)) {
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
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstPsAuths
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstPsAuths')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstPsAuths);

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
     * @return null | \Oasis\Model\Validator\AstPsAuths
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstPsAuths')) {

                $this->setValidator(new \Oasis\Validator\AstPsAuths);
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
     * @see \Mapper\Sql\AstPsAuths::delete
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
