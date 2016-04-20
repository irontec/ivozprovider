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
class Schedules extends ModelAbstract
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
    protected $_companyId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * Database var type time
     *
     * @var string
     */
    protected $_timeIn;

    /**
     * Database var type time
     *
     * @var string
     */
    protected $_timeout;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_monday;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_tuesday;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_wednesday;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_thursday;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_friday;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_saturday;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_sunday;


    /**
     * Parent relation Schedules_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;


    /**
     * Dependent relation ExternalCallFilterRelSchedules_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules[]
     */
    protected $_ExternalCallFilterRelSchedules;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'timeIn'=>'timeIn',
        'timeout'=>'timeout',
        'monday'=>'monday',
        'tuesday'=>'tuesday',
        'wednesday'=>'wednesday',
        'thursday'=>'thursday',
        'friday'=>'friday',
        'saturday'=>'saturday',
        'sunday'=>'sunday',
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
            'SchedulesIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
        ));

        $this->setDependentList(array(
            'ExternalCallFilterRelSchedulesIbfk2' => array(
                    'property' => 'ExternalCallFilterRelSchedules',
                    'table_name' => 'ExternalCallFilterRelSchedules',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'ExternalCallFilterRelSchedules_ibfk_2'
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
     * @return \IvozProvider\Model\Raw\Schedules
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_companyId != $data) {
            $this->_logChange('companyId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_companyId = $data;

        } else if (!is_null($data)) {
            $this->_companyId = (int) $data;

        } else {
            $this->_companyId = $data;
        }
        return $this;
    }

    /**
     * Gets column companyId
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->_companyId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_name != $data) {
            $this->_logChange('name');
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
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setTimeIn($data)
    {
        if ($data === 'CURRENT_TIMESTAMP' || is_null($data)) {
            $data = \Zend_Date::now()->setTimezone('UTC');
        }

        if ($data instanceof \Zend_Date) {

            $data = new \DateTime($data->toString('yyyy-MM-dd HH:mm:ss'), new \DateTimeZone($data->getTimezone()));

        } elseif (!is_null($data) && !$data instanceof \DateTime) {

            $data = new \DateTime($data, new \DateTimeZone('UTC'));
        }

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_timeIn != $data) {
            $this->_logChange('timeIn');
        }

        $this->_timeIn = $data;
        return $this;
    }

    /**
     * Gets column timeIn
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getTimeIn($returnZendDate = false)
    {
        if (is_null($this->_timeIn)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_timeIn->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_timeIn->format('H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setTimeout($data)
    {
        if ($data === 'CURRENT_TIMESTAMP' || is_null($data)) {
            $data = \Zend_Date::now()->setTimezone('UTC');
        }

        if ($data instanceof \Zend_Date) {

            $data = new \DateTime($data->toString('yyyy-MM-dd HH:mm:ss'), new \DateTimeZone($data->getTimezone()));

        } elseif (!is_null($data) && !$data instanceof \DateTime) {

            $data = new \DateTime($data, new \DateTimeZone('UTC'));
        }

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_timeout != $data) {
            $this->_logChange('timeout');
        }

        $this->_timeout = $data;
        return $this;
    }

    /**
     * Gets column timeout
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getTimeout($returnZendDate = false)
    {
        if (is_null($this->_timeout)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_timeout->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_timeout->format('H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setMonday($data)
    {

        if ($this->_monday != $data) {
            $this->_logChange('monday');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_monday = $data;

        } else if (!is_null($data)) {
            $this->_monday = (int) $data;

        } else {
            $this->_monday = $data;
        }
        return $this;
    }

    /**
     * Gets column monday
     *
     * @return int
     */
    public function getMonday()
    {
        return $this->_monday;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setTuesday($data)
    {

        if ($this->_tuesday != $data) {
            $this->_logChange('tuesday');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tuesday = $data;

        } else if (!is_null($data)) {
            $this->_tuesday = (int) $data;

        } else {
            $this->_tuesday = $data;
        }
        return $this;
    }

    /**
     * Gets column tuesday
     *
     * @return int
     */
    public function getTuesday()
    {
        return $this->_tuesday;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setWednesday($data)
    {

        if ($this->_wednesday != $data) {
            $this->_logChange('wednesday');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_wednesday = $data;

        } else if (!is_null($data)) {
            $this->_wednesday = (int) $data;

        } else {
            $this->_wednesday = $data;
        }
        return $this;
    }

    /**
     * Gets column wednesday
     *
     * @return int
     */
    public function getWednesday()
    {
        return $this->_wednesday;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setThursday($data)
    {

        if ($this->_thursday != $data) {
            $this->_logChange('thursday');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_thursday = $data;

        } else if (!is_null($data)) {
            $this->_thursday = (int) $data;

        } else {
            $this->_thursday = $data;
        }
        return $this;
    }

    /**
     * Gets column thursday
     *
     * @return int
     */
    public function getThursday()
    {
        return $this->_thursday;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setFriday($data)
    {

        if ($this->_friday != $data) {
            $this->_logChange('friday');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_friday = $data;

        } else if (!is_null($data)) {
            $this->_friday = (int) $data;

        } else {
            $this->_friday = $data;
        }
        return $this;
    }

    /**
     * Gets column friday
     *
     * @return int
     */
    public function getFriday()
    {
        return $this->_friday;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setSaturday($data)
    {

        if ($this->_saturday != $data) {
            $this->_logChange('saturday');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_saturday = $data;

        } else if (!is_null($data)) {
            $this->_saturday = (int) $data;

        } else {
            $this->_saturday = $data;
        }
        return $this;
    }

    /**
     * Gets column saturday
     *
     * @return int
     */
    public function getSaturday()
    {
        return $this->_saturday;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setSunday($data)
    {

        if ($this->_sunday != $data) {
            $this->_logChange('sunday');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sunday = $data;

        } else if (!is_null($data)) {
            $this->_sunday = (int) $data;

        } else {
            $this->_sunday = $data;
        }
        return $this;
    }

    /**
     * Gets column sunday
     *
     * @return int
     */
    public function getSunday()
    {
        return $this->_sunday;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setCompany(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_Company = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCompanyId($primaryKey);
        }

        $this->_setLoaded('SchedulesIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'SchedulesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Company = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Company;
    }

    /**
     * Sets dependent relations ExternalCallFilterRelSchedules_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function setExternalCallFilterRelSchedules(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ExternalCallFilterRelSchedules === null) {

                $this->getExternalCallFilterRelSchedules();
            }

            $oldRelations = $this->_ExternalCallFilterRelSchedules;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_ExternalCallFilterRelSchedules = array();

        foreach ($data as $object) {
            $this->addExternalCallFilterRelSchedules($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ExternalCallFilterRelSchedules_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules $data
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function addExternalCallFilterRelSchedules(\IvozProvider\Model\Raw\ExternalCallFilterRelSchedules $data)
    {
        $this->_ExternalCallFilterRelSchedules[] = $data;
        $this->_setLoaded('ExternalCallFilterRelSchedulesIbfk2');
        return $this;
    }

    /**
     * Gets dependent ExternalCallFilterRelSchedules_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules
     */
    public function getExternalCallFilterRelSchedules($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFilterRelSchedulesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ExternalCallFilterRelSchedules = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ExternalCallFilterRelSchedules;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Schedules
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Schedules')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Schedules);

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
     * @return null | \IvozProvider\Model\Validator\Schedules
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Schedules')) {

                $this->setValidator(new \IvozProvider\Validator\Schedules);
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
     * @see \Mapper\Sql\Schedules::delete
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