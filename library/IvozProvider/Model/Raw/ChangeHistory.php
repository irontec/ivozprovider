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
class ChangeHistory extends ModelAbstract
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
    protected $_user;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_date;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_action;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_table;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_objid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_field;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_oldValue;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_newValue;



    protected $_columnsList = array(
        'id'=>'id',
        'user'=>'user',
        'date'=>'date',
        'action'=>'action',
        'table'=>'table',
        'objid'=>'objid',
        'field'=>'field',
        'old_value'=>'oldValue',
        'new_value'=>'newValue',
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
            'date' => 'CURRENT_TIMESTAMP',
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
     * @return \IvozProvider\Model\Raw\ChangeHistory
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_id = $data;

        } else if (!is_null($data)) {
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
     * @return \IvozProvider\Model\Raw\ChangeHistory
     */
    public function setUser($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_user != $data) {
            $this->_logChange('user');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_user = $data;

        } else if (!is_null($data)) {
            $this->_user = (string) $data;

        } else {
            $this->_user = $data;
        }
        return $this;
    }

    /**
     * Gets column user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\ChangeHistory
     */
    public function setDate($data)
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

        if ($this->_date != $data) {
            $this->_logChange('date');
        }

        $this->_date = $data;
        return $this;
    }

    /**
     * Gets column date
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getDate($returnZendDate = false)
    {
        if (is_null($this->_date)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_date->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_date->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ChangeHistory
     */
    public function setAction($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_action != $data) {
            $this->_logChange('action');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_action = $data;

        } else if (!is_null($data)) {
            $this->_action = (string) $data;

        } else {
            $this->_action = $data;
        }
        return $this;
    }

    /**
     * Gets column action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ChangeHistory
     */
    public function setTable($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_table != $data) {
            $this->_logChange('table');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_table = $data;

        } else if (!is_null($data)) {
            $this->_table = (string) $data;

        } else {
            $this->_table = $data;
        }
        return $this;
    }

    /**
     * Gets column table
     *
     * @return string
     */
    public function getTable()
    {
        return $this->_table;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ChangeHistory
     */
    public function setObjid($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_objid != $data) {
            $this->_logChange('objid');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_objid = $data;

        } else if (!is_null($data)) {
            $this->_objid = (int) $data;

        } else {
            $this->_objid = $data;
        }
        return $this;
    }

    /**
     * Gets column objid
     *
     * @return int
     */
    public function getObjid()
    {
        return $this->_objid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ChangeHistory
     */
    public function setField($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_field != $data) {
            $this->_logChange('field');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_field = $data;

        } else if (!is_null($data)) {
            $this->_field = (string) $data;

        } else {
            $this->_field = $data;
        }
        return $this;
    }

    /**
     * Gets column field
     *
     * @return string
     */
    public function getField()
    {
        return $this->_field;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ChangeHistory
     */
    public function setOldValue($data)
    {

        if ($this->_oldValue != $data) {
            $this->_logChange('oldValue');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_oldValue = $data;

        } else if (!is_null($data)) {
            $this->_oldValue = (string) $data;

        } else {
            $this->_oldValue = $data;
        }
        return $this;
    }

    /**
     * Gets column old_value
     *
     * @return string
     */
    public function getOldValue()
    {
        return $this->_oldValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ChangeHistory
     */
    public function setNewValue($data)
    {

        if ($this->_newValue != $data) {
            $this->_logChange('newValue');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_newValue = $data;

        } else if (!is_null($data)) {
            $this->_newValue = (string) $data;

        } else {
            $this->_newValue = $data;
        }
        return $this;
    }

    /**
     * Gets column new_value
     *
     * @return string
     */
    public function getNewValue()
    {
        return $this->_newValue;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\ChangeHistory
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\ChangeHistory')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\ChangeHistory);

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
     * @return null | \IvozProvider\Model\Validator\ChangeHistory
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\ChangeHistory')) {

                $this->setValidator(new \IvozProvider\Validator\ChangeHistory);
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
     * @see \Mapper\Sql\ChangeHistory::delete
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

    public function mustUpdateEtag()
    {
        return true;
    }

}