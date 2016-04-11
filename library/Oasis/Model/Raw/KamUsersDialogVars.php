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
class KamUsersDialogVars extends ModelAbstract
{


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_hashEntry;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_hashId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dialogKey;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dialogValue;




    protected $_columnsList = array(
        'id'=>'id',
        'hash_entry'=>'hashEntry',
        'hash_id'=>'hashId',
        'dialog_key'=>'dialogKey',
        'dialog_value'=>'dialogValue',
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
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersDialogVars
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
     * @return \Oasis\Model\Raw\KamUsersDialogVars
     */
    public function setHashEntry($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_hashEntry != $data) {
            $this->_logChange('hashEntry');
        }

        if (!is_null($data)) {
            $this->_hashEntry = (int) $data;
        } else {
            $this->_hashEntry = $data;
        }
        return $this;
    }

    /**
     * Gets column hash_entry
     *
     * @return int
     */
    public function getHashEntry()
    {
            return $this->_hashEntry;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamUsersDialogVars
     */
    public function setHashId($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_hashId != $data) {
            $this->_logChange('hashId');
        }

        if (!is_null($data)) {
            $this->_hashId = (int) $data;
        } else {
            $this->_hashId = $data;
        }
        return $this;
    }

    /**
     * Gets column hash_id
     *
     * @return int
     */
    public function getHashId()
    {
            return $this->_hashId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialogVars
     */
    public function setDialogKey($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_dialogKey != $data) {
            $this->_logChange('dialogKey');
        }

        if (!is_null($data)) {
            $this->_dialogKey = (string) $data;
        } else {
            $this->_dialogKey = $data;
        }
        return $this;
    }

    /**
     * Gets column dialog_key
     *
     * @return string
     */
    public function getDialogKey()
    {
            return $this->_dialogKey;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamUsersDialogVars
     */
    public function setDialogValue($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_dialogValue != $data) {
            $this->_logChange('dialogValue');
        }

        if (!is_null($data)) {
            $this->_dialogValue = (string) $data;
        } else {
            $this->_dialogValue = $data;
        }
        return $this;
    }

    /**
     * Gets column dialog_value
     *
     * @return string
     */
    public function getDialogValue()
    {
            return $this->_dialogValue;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamUsersDialogVars
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamUsersDialogVars')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamUsersDialogVars);

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
     * @return null | \Oasis\Model\Validator\KamUsersDialogVars
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamUsersDialogVars')) {

                $this->setValidator(new \Oasis\Validator\KamUsersDialogVars);
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
     * @see \Mapper\Sql\KamUsersDialogVars::delete
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
