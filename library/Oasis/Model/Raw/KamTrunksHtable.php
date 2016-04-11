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
class KamTrunksHtable extends ModelAbstract
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
    protected $_keyName;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_keyType;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_valueType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_keyValue;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_expires;




    protected $_columnsList = array(
        'id'=>'id',
        'key_name'=>'keyName',
        'key_type'=>'keyType',
        'value_type'=>'valueType',
        'key_value'=>'keyValue',
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
            'keyName' => '',
            'keyType' => '0',
            'valueType' => '0',
            'keyValue' => '',
            'expires' => '0',
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
     * @return \Oasis\Model\Raw\KamTrunksHtable
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
     * @return \Oasis\Model\Raw\KamTrunksHtable
     */
    public function setKeyName($data)
    {

        if ($this->_keyName != $data) {
            $this->_logChange('keyName');
        }

        if (!is_null($data)) {
            $this->_keyName = (string) $data;
        } else {
            $this->_keyName = $data;
        }
        return $this;
    }

    /**
     * Gets column key_name
     *
     * @return string
     */
    public function getKeyName()
    {
            return $this->_keyName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksHtable
     */
    public function setKeyType($data)
    {

        if ($this->_keyType != $data) {
            $this->_logChange('keyType');
        }

        if (!is_null($data)) {
            $this->_keyType = (int) $data;
        } else {
            $this->_keyType = $data;
        }
        return $this;
    }

    /**
     * Gets column key_type
     *
     * @return int
     */
    public function getKeyType()
    {
            return $this->_keyType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksHtable
     */
    public function setValueType($data)
    {

        if ($this->_valueType != $data) {
            $this->_logChange('valueType');
        }

        if (!is_null($data)) {
            $this->_valueType = (int) $data;
        } else {
            $this->_valueType = $data;
        }
        return $this;
    }

    /**
     * Gets column value_type
     *
     * @return int
     */
    public function getValueType()
    {
            return $this->_valueType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksHtable
     */
    public function setKeyValue($data)
    {

        if ($this->_keyValue != $data) {
            $this->_logChange('keyValue');
        }

        if (!is_null($data)) {
            $this->_keyValue = (string) $data;
        } else {
            $this->_keyValue = $data;
        }
        return $this;
    }

    /**
     * Gets column key_value
     *
     * @return string
     */
    public function getKeyValue()
    {
            return $this->_keyValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksHtable
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
     * @return Oasis\Mapper\Sql\KamTrunksHtable
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamTrunksHtable')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamTrunksHtable);

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
     * @return null | \Oasis\Model\Validator\KamTrunksHtable
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamTrunksHtable')) {

                $this->setValidator(new \Oasis\Validator\KamTrunksHtable);
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
     * @see \Mapper\Sql\KamTrunksHtable::delete
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
