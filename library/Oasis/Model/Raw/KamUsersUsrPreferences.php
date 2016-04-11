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
class KamUsersUsrPreferences extends ModelAbstract
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
    protected $_uuid;

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
    protected $_attribute;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_type;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_value;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_lastModified;




    protected $_columnsList = array(
        'id'=>'id',
        'uuid'=>'uuid',
        'username'=>'username',
        'domain'=>'domain',
        'attribute'=>'attribute',
        'type'=>'type',
        'value'=>'value',
        'last_modified'=>'lastModified',
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
            'uuid' => '',
            'username' => '0',
            'domain' => '',
            'attribute' => '',
            'type' => '0',
            'value' => '',
            'lastModified' => '1900-01-01 00:00:01',
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
     * @return \Oasis\Model\Raw\KamUsersUsrPreferences
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
     * @return \Oasis\Model\Raw\KamUsersUsrPreferences
     */
    public function setUuid($data)
    {

        if ($this->_uuid != $data) {
            $this->_logChange('uuid');
        }

        if (!is_null($data)) {
            $this->_uuid = (string) $data;
        } else {
            $this->_uuid = $data;
        }
        return $this;
    }

    /**
     * Gets column uuid
     *
     * @return string
     */
    public function getUuid()
    {
            return $this->_uuid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersUsrPreferences
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
     * @return \Oasis\Model\Raw\KamUsersUsrPreferences
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
     * @return \Oasis\Model\Raw\KamUsersUsrPreferences
     */
    public function setAttribute($data)
    {

        if ($this->_attribute != $data) {
            $this->_logChange('attribute');
        }

        if (!is_null($data)) {
            $this->_attribute = (string) $data;
        } else {
            $this->_attribute = $data;
        }
        return $this;
    }

    /**
     * Gets column attribute
     *
     * @return string
     */
    public function getAttribute()
    {
            return $this->_attribute;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersUsrPreferences
     */
    public function setType($data)
    {

        if ($this->_type != $data) {
            $this->_logChange('type');
        }

        if (!is_null($data)) {
            $this->_type = (int) $data;
        } else {
            $this->_type = $data;
        }
        return $this;
    }

    /**
     * Gets column type
     *
     * @return int
     */
    public function getType()
    {
            return $this->_type;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersUsrPreferences
     */
    public function setValue($data)
    {

        if ($this->_value != $data) {
            $this->_logChange('value');
        }

        if (!is_null($data)) {
            $this->_value = (string) $data;
        } else {
            $this->_value = $data;
        }
        return $this;
    }

    /**
     * Gets column value
     *
     * @return string
     */
    public function getValue()
    {
            return $this->_value;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\KamUsersUsrPreferences
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
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamUsersUsrPreferences
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamUsersUsrPreferences')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamUsersUsrPreferences);

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
     * @return null | \Oasis\Model\Validator\KamUsersUsrPreferences
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamUsersUsrPreferences')) {

                $this->setValidator(new \Oasis\Validator\KamUsersUsrPreferences);
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
     * @see \Mapper\Sql\KamUsersUsrPreferences::delete
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
