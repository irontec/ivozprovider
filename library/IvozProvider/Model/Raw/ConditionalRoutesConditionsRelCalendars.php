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
class ConditionalRoutesConditionsRelCalendars extends ModelAbstract
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
    protected $_conditionId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_calendarId;


    /**
     * Parent relation ConditionalRoutesConditionsRelCalendars_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    protected $_Condition;

    /**
     * Parent relation ConditionalRoutesConditionsRelCalendars_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Calendars
     */
    protected $_Calendar;


    protected $_columnsList = array(
        'id'=>'id',
        'conditionId'=>'conditionId',
        'calendarId'=>'calendarId',
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
            'ConditionalRoutesConditionsRelCalendarsIbfk1'=> array(
                    'property' => 'Condition',
                    'table_name' => 'ConditionalRoutesConditions',
                ),
            'ConditionalRoutesConditionsRelCalendarsIbfk2'=> array(
                    'property' => 'Calendar',
                    'table_name' => 'Calendars',
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
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelCalendars
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelCalendars
     */
    public function setConditionId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_conditionId != $data) {
            $this->_logChange('conditionId', $this->_conditionId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_conditionId = $data;

        } else if (!is_null($data)) {
            $this->_conditionId = (int) $data;

        } else {
            $this->_conditionId = $data;
        }
        return $this;
    }

    /**
     * Gets column conditionId
     *
     * @return int
     */
    public function getConditionId()
    {
        return $this->_conditionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelCalendars
     */
    public function setCalendarId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_calendarId != $data) {
            $this->_logChange('calendarId', $this->_calendarId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_calendarId = $data;

        } else if (!is_null($data)) {
            $this->_calendarId = (int) $data;

        } else {
            $this->_calendarId = $data;
        }
        return $this;
    }

    /**
     * Gets column calendarId
     *
     * @return int
     */
    public function getCalendarId()
    {
        return $this->_calendarId;
    }

    /**
     * Sets parent relation Condition
     *
     * @param \IvozProvider\Model\Raw\ConditionalRoutesConditions $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelCalendars
     */
    public function setCondition(\IvozProvider\Model\Raw\ConditionalRoutesConditions $data)
    {
        $this->_Condition = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setConditionId($primaryKey);
        }

        $this->_setLoaded('ConditionalRoutesConditionsRelCalendarsIbfk1');
        return $this;
    }

    /**
     * Gets parent Condition
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditions
     */
    public function getCondition($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsRelCalendarsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Condition = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Condition;
    }

    /**
     * Sets parent relation Calendar
     *
     * @param \IvozProvider\Model\Raw\Calendars $data
     * @return \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelCalendars
     */
    public function setCalendar(\IvozProvider\Model\Raw\Calendars $data)
    {
        $this->_Calendar = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCalendarId($primaryKey);
        }

        $this->_setLoaded('ConditionalRoutesConditionsRelCalendarsIbfk2');
        return $this;
    }

    /**
     * Gets parent Calendar
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Calendars
     */
    public function getCalendar($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsRelCalendarsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Calendar = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Calendar;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\ConditionalRoutesConditionsRelCalendars
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\ConditionalRoutesConditionsRelCalendars')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\ConditionalRoutesConditionsRelCalendars);

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
     * @return null | \IvozProvider\Model\Validator\ConditionalRoutesConditionsRelCalendars
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\ConditionalRoutesConditionsRelCalendars')) {

                $this->setValidator(new \IvozProvider\Validator\ConditionalRoutesConditionsRelCalendars);
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
     * @see \Mapper\Sql\ConditionalRoutesConditionsRelCalendars::delete
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