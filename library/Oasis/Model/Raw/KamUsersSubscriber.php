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
class KamUsersSubscriber extends ModelAbstract
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
    protected $_password;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_emailAddress;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ha1;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ha1b;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_rpid;




    protected $_columnsList = array(
        'id'=>'id',
        'username'=>'username',
        'domain'=>'domain',
        'password'=>'password',
        'email_address'=>'emailAddress',
        'ha1'=>'ha1',
        'ha1b'=>'ha1b',
        'rpid'=>'rpid',
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
            'username' => '',
            'domain' => '',
            'password' => '',
            'emailAddress' => '',
            'ha1' => '',
            'ha1b' => '',
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
     * @return \Oasis\Model\Raw\KamUsersSubscriber
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
     * @return \Oasis\Model\Raw\KamUsersSubscriber
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersSubscriber
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
     * @return \Oasis\Model\Raw\KamUsersSubscriber
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
     * @return \Oasis\Model\Raw\KamUsersSubscriber
     */
    public function setEmailAddress($data)
    {

        if ($this->_emailAddress != $data) {
            $this->_logChange('emailAddress');
        }

        if (!is_null($data)) {
            $this->_emailAddress = (string) $data;
        } else {
            $this->_emailAddress = $data;
        }
        return $this;
    }

    /**
     * Gets column email_address
     *
     * @return string
     */
    public function getEmailAddress()
    {
            return $this->_emailAddress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersSubscriber
     */
    public function setHa1($data)
    {

        if ($this->_ha1 != $data) {
            $this->_logChange('ha1');
        }

        if (!is_null($data)) {
            $this->_ha1 = (string) $data;
        } else {
            $this->_ha1 = $data;
        }
        return $this;
    }

    /**
     * Gets column ha1
     *
     * @return string
     */
    public function getHa1()
    {
            return $this->_ha1;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersSubscriber
     */
    public function setHa1b($data)
    {

        if ($this->_ha1b != $data) {
            $this->_logChange('ha1b');
        }

        if (!is_null($data)) {
            $this->_ha1b = (string) $data;
        } else {
            $this->_ha1b = $data;
        }
        return $this;
    }

    /**
     * Gets column ha1b
     *
     * @return string
     */
    public function getHa1b()
    {
            return $this->_ha1b;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersSubscriber
     */
    public function setRpid($data)
    {

        if ($this->_rpid != $data) {
            $this->_logChange('rpid');
        }

        if (!is_null($data)) {
            $this->_rpid = (string) $data;
        } else {
            $this->_rpid = $data;
        }
        return $this;
    }

    /**
     * Gets column rpid
     *
     * @return string
     */
    public function getRpid()
    {
            return $this->_rpid;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamUsersSubscriber
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamUsersSubscriber')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamUsersSubscriber);

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
     * @return null | \Oasis\Model\Validator\KamUsersSubscriber
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamUsersSubscriber')) {

                $this->setValidator(new \Oasis\Validator\KamUsersSubscriber);
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
     * @see \Mapper\Sql\KamUsersSubscriber::delete
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
