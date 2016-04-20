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
class ExternalCallFilterRelSchedules extends ModelAbstract
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
    protected $_filterId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_scheduleId;


    /**
     * Parent relation ExternalCallFilterRelSchedules_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilters
     */
    protected $_Filter;

    /**
     * Parent relation ExternalCallFilterRelSchedules_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Schedules
     */
    protected $_Schedule;


    protected $_columnsList = array(
        'id'=>'id',
        'filterId'=>'filterId',
        'scheduleId'=>'scheduleId',
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
            'ExternalCallFilterRelSchedulesIbfk1'=> array(
                    'property' => 'Filter',
                    'table_name' => 'ExternalCallFilters',
                ),
            'ExternalCallFilterRelSchedulesIbfk2'=> array(
                    'property' => 'Schedule',
                    'table_name' => 'Schedules',
                ),
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
     * @return \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules
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
     * @return \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules
     */
    public function setFilterId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_filterId != $data) {
            $this->_logChange('filterId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_filterId = $data;

        } else if (!is_null($data)) {
            $this->_filterId = (int) $data;

        } else {
            $this->_filterId = $data;
        }
        return $this;
    }

    /**
     * Gets column filterId
     *
     * @return int
     */
    public function getFilterId()
    {
        return $this->_filterId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules
     */
    public function setScheduleId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_scheduleId != $data) {
            $this->_logChange('scheduleId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_scheduleId = $data;

        } else if (!is_null($data)) {
            $this->_scheduleId = (int) $data;

        } else {
            $this->_scheduleId = $data;
        }
        return $this;
    }

    /**
     * Gets column scheduleId
     *
     * @return int
     */
    public function getScheduleId()
    {
        return $this->_scheduleId;
    }

    /**
     * Sets parent relation Filter
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilters $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules
     */
    public function setFilter(\IvozProvider\Model\Raw\ExternalCallFilters $data)
    {
        $this->_Filter = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setFilterId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFilterRelSchedulesIbfk1');
        return $this;
    }

    /**
     * Gets parent Filter
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function getFilter($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFilterRelSchedulesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Filter = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Filter;
    }

    /**
     * Sets parent relation Schedule
     *
     * @param \IvozProvider\Model\Raw\Schedules $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules
     */
    public function setSchedule(\IvozProvider\Model\Raw\Schedules $data)
    {
        $this->_Schedule = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setScheduleId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFilterRelSchedulesIbfk2');
        return $this;
    }

    /**
     * Gets parent Schedule
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Schedules
     */
    public function getSchedule($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFilterRelSchedulesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Schedule = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Schedule;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\ExternalCallFilterRelSchedules
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\ExternalCallFilterRelSchedules')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\ExternalCallFilterRelSchedules);

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
     * @return null | \IvozProvider\Model\Validator\ExternalCallFilterRelSchedules
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\ExternalCallFilterRelSchedules')) {

                $this->setValidator(new \IvozProvider\Validator\ExternalCallFilterRelSchedules);
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
     * @see \Mapper\Sql\ExternalCallFilterRelSchedules::delete
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