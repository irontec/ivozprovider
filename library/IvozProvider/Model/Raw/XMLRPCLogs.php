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
class XMLRPCLogs extends ModelAbstract
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
    protected $_proxy;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_module;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_method;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mapperName;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_startDate;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_execDate;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_finishDate;



    protected $_columnsList = array(
        'id'=>'id',
        'proxy'=>'proxy',
        'module'=>'module',
        'method'=>'method',
        'mapperName'=>'mapperName',
        'startDate'=>'startDate',
        'execDate'=>'execDate',
        'finishDate'=>'finishDate',
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
            'startDate' => 'CURRENT_TIMESTAMP',
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
     * @return \IvozProvider\Model\Raw\XMLRPCLogs
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
     * @return \IvozProvider\Model\Raw\XMLRPCLogs
     */
    public function setProxy($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_proxy != $data) {
            $this->_logChange('proxy');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_proxy = $data;

        } else if (!is_null($data)) {
            $this->_proxy = (string) $data;

        } else {
            $this->_proxy = $data;
        }
        return $this;
    }

    /**
     * Gets column proxy
     *
     * @return string
     */
    public function getProxy()
    {
        return $this->_proxy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\XMLRPCLogs
     */
    public function setModule($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_module != $data) {
            $this->_logChange('module');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_module = $data;

        } else if (!is_null($data)) {
            $this->_module = (string) $data;

        } else {
            $this->_module = $data;
        }
        return $this;
    }

    /**
     * Gets column module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->_module;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\XMLRPCLogs
     */
    public function setMethod($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_method != $data) {
            $this->_logChange('method');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_method = $data;

        } else if (!is_null($data)) {
            $this->_method = (string) $data;

        } else {
            $this->_method = $data;
        }
        return $this;
    }

    /**
     * Gets column method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\XMLRPCLogs
     */
    public function setMapperName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_mapperName != $data) {
            $this->_logChange('mapperName');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mapperName = $data;

        } else if (!is_null($data)) {
            $this->_mapperName = (string) $data;

        } else {
            $this->_mapperName = $data;
        }
        return $this;
    }

    /**
     * Gets column mapperName
     *
     * @return string
     */
    public function getMapperName()
    {
        return $this->_mapperName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\XMLRPCLogs
     */
    public function setStartDate($data)
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

        if ($this->_startDate != $data) {
            $this->_logChange('startDate');
        }

        $this->_startDate = $data;
        return $this;
    }

    /**
     * Gets column startDate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getStartDate($returnZendDate = false)
    {
        if (is_null($this->_startDate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_startDate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_startDate->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\XMLRPCLogs
     */
    public function setExecDate($data)
    {
        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }
        if ($data === 'CURRENT_TIMESTAMP') {
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

        if ($this->_execDate != $data) {
            $this->_logChange('execDate');
        }

        $this->_execDate = $data;
        return $this;
    }

    /**
     * Gets column execDate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getExecDate($returnZendDate = false)
    {
        if (is_null($this->_execDate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_execDate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_execDate->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\XMLRPCLogs
     */
    public function setFinishDate($data)
    {
        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }
        if ($data === 'CURRENT_TIMESTAMP') {
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

        if ($this->_finishDate != $data) {
            $this->_logChange('finishDate');
        }

        $this->_finishDate = $data;
        return $this;
    }

    /**
     * Gets column finishDate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getFinishDate($returnZendDate = false)
    {
        if (is_null($this->_finishDate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_finishDate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_finishDate->format('Y-m-d H:i:s');
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\XMLRPCLogs
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\XMLRPCLogs')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\XMLRPCLogs);

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
     * @return null | \IvozProvider\Model\Validator\XMLRPCLogs
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\XMLRPCLogs')) {

                $this->setValidator(new \IvozProvider\Validator\XMLRPCLogs);
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
     * @see \Mapper\Sql\XMLRPCLogs::delete
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