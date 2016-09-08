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
 * [entity][rest]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model\Raw;
class KamUsersDomainAttrs extends ModelAbstract
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
    protected $_did;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

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


    /**
     * Parent relation kam_users_domain_attrs_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_D;


    protected $_columnsList = array(
        'id'=>'id',
        'did'=>'did',
        'name'=>'name',
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
            'KamUsersDomainAttrsIbfk1'=> array(
                    'property' => 'D',
                    'table_name' => 'Companies',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
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
     * @return \IvozProvider\Model\Raw\KamUsersDomainAttrs
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id', $this->_id, $data);
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
     * @return \IvozProvider\Model\Raw\KamUsersDomainAttrs
     */
    public function setDid($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_did != $data) {
            $this->_logChange('did', $this->_did, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_did = $data;

        } else if (!is_null($data)) {
            $this->_did = (string) $data;

        } else {
            $this->_did = $data;
        }
        return $this;
    }

    /**
     * Gets column did
     *
     * @return string
     */
    public function getDid()
    {
        return $this->_did;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamUsersDomainAttrs
     */
    public function setName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_name != $data) {
            $this->_logChange('name', $this->_name, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_name = $data;

        } else if (!is_null($data)) {
            $this->_name = (string) $data;

        } else {
            $this->_name = $data;
        }
        return $this;
    }

    /**
     * Gets column name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamUsersDomainAttrs
     */
    public function setType($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_type != $data) {
            $this->_logChange('type', $this->_type, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_type = $data;

        } else if (!is_null($data)) {
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
     * @return \IvozProvider\Model\Raw\KamUsersDomainAttrs
     */
    public function setValue($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_value != $data) {
            $this->_logChange('value', $this->_value, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_value = $data;

        } else if (!is_null($data)) {
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
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\KamUsersDomainAttrs
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
            $this->_logChange('lastModified', $this->_lastModified, $data);
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
     * Sets parent relation D
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\KamUsersDomainAttrs
     */
    public function setD(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_D = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['domain_users'];
        }

        if (!is_null($primaryKey)) {
            $this->setDid($primaryKey);
        }

        $this->_setLoaded('KamUsersDomainAttrsIbfk1');
        return $this;
    }

    /**
     * Gets parent D
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getD($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamUsersDomainAttrsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_D = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_D;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\KamUsersDomainAttrs
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\KamUsersDomainAttrs')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\KamUsersDomainAttrs);

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
     * @return null | \IvozProvider\Model\Validator\KamUsersDomainAttrs
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\KamUsersDomainAttrs')) {

                $this->setValidator(new \IvozProvider\Validator\KamUsersDomainAttrs);
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
     * @see \Mapper\Sql\KamUsersDomainAttrs::delete
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