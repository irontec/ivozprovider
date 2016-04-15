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
class HolidayDates extends ModelAbstract
{


    /**
     * [uuid:php]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_calendarId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * Database var type date
     *
     * @var string
     */
    protected $_eventDate;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_locutionId;


    /**
     * Parent relation HolidayDates_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Calendars
     */
    protected $_Calendar;

    /**
     * Parent relation HolidayDates_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_Locution;


    protected $_columnsList = array(
        'id'=>'id',
        'calendarId'=>'calendarId',
        'name'=>'name',
        'eventDate'=>'eventDate',
        'locutionId'=>'locutionId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid:php'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'HolidayDatesIbfk1'=> array(
                    'property' => 'Calendar',
                    'table_name' => 'Calendars',
                ),
            'HolidayDatesIbfk2'=> array(
                    'property' => 'Locution',
                    'table_name' => 'Locutions',
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
     * @param binary $data
     * @return \IvozProvider\Model\Raw\HolidayDates
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        $this->_id = $data;
        return $this;
    }

    /**
     * Gets column id
     *
     * @return binary
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\HolidayDates
     */
    public function setCalendarId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_calendarId != $data) {
            $this->_logChange('calendarId');
        }

        $this->_calendarId = $data;
        return $this;
    }

    /**
     * Gets column calendarId
     *
     * @return binary
     */
    public function getCalendarId()
    {
        return $this->_calendarId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\HolidayDates
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
     * @return \IvozProvider\Model\Raw\HolidayDates
     */
    public function setEventDate($data)
    {
        if ($data == '0000-00-00') {
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

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_eventDate != $data) {
            $this->_logChange('eventDate');
        }

        $this->_eventDate = $data;
        return $this;
    }

    /**
     * Gets column eventDate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getEventDate($returnZendDate = false)
    {
        if (is_null($this->_eventDate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_eventDate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_eventDate->format('Y-m-d');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\HolidayDates
     */
    public function setLocutionId($data)
    {

        if ($this->_locutionId != $data) {
            $this->_logChange('locutionId');
        }

        $this->_locutionId = $data;
        return $this;
    }

    /**
     * Gets column locutionId
     *
     * @return binary
     */
    public function getLocutionId()
    {
        return $this->_locutionId;
    }

    /**
     * Sets parent relation Calendar
     *
     * @param \IvozProvider\Model\Raw\Calendars $data
     * @return \IvozProvider\Model\Raw\HolidayDates
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

        $this->_setLoaded('HolidayDatesIbfk1');
        return $this;
    }

    /**
     * Gets parent Calendar
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Calendars
     */
    public function getCalendar($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HolidayDatesIbfk1';

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
     * Sets parent relation Locution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\HolidayDates
     */
    public function setLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_Locution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setLocutionId($primaryKey);
        }

        $this->_setLoaded('HolidayDatesIbfk2');
        return $this;
    }

    /**
     * Gets parent Locution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HolidayDatesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Locution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Locution;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\HolidayDates
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\HolidayDates')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\HolidayDates);

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
     * @return null | \IvozProvider\Model\Validator\HolidayDates
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\HolidayDates')) {

                $this->setValidator(new \IvozProvider\Validator\HolidayDates);
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
     * @see \Mapper\Sql\HolidayDates::delete
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