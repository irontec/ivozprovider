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
class AstMusiconhold extends ModelAbstract
{

    protected $_modeAcceptedValues = array(
        'custom',
        'files',
        'mp3nb',
        'quietmp3nb',
        'quietmp3',
    );

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
    protected $_name;

    /**
     * Database var type enum('custom','files','mp3nb','quietmp3nb','quietmp3')
     *
     * @var string
     */
    protected $_mode;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_directory;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_application;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_digit;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_sort;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_format;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_stamp;



    protected $_columnsList = array(
        'id'=>'id',
        'name'=>'name',
        'mode'=>'mode',
        'directory'=>'directory',
        'application'=>'application',
        'digit'=>'digit',
        'sort'=>'sort',
        'format'=>'format',
        'stamp'=>'stamp',
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
     * @return \IvozProvider\Model\Raw\AstMusiconhold
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
     * @return \IvozProvider\Model\Raw\AstMusiconhold
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstMusiconhold
     */
    public function setMode($data)
    {

        if ($this->_mode != $data) {
            $this->_logChange('mode', $this->_mode, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mode = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_modeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for mode'));
            }
            $this->_mode = (string) $data;

        } else {
            $this->_mode = $data;
        }
        return $this;
    }

    /**
     * Gets column mode
     *
     * @return string
     */
    public function getMode()
    {
        return $this->_mode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstMusiconhold
     */
    public function setDirectory($data)
    {

        if ($this->_directory != $data) {
            $this->_logChange('directory', $this->_directory, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_directory = $data;

        } else if (!is_null($data)) {
            $this->_directory = (string) $data;

        } else {
            $this->_directory = $data;
        }
        return $this;
    }

    /**
     * Gets column directory
     *
     * @return string
     */
    public function getDirectory()
    {
        return $this->_directory;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstMusiconhold
     */
    public function setApplication($data)
    {

        if ($this->_application != $data) {
            $this->_logChange('application', $this->_application, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_application = $data;

        } else if (!is_null($data)) {
            $this->_application = (string) $data;

        } else {
            $this->_application = $data;
        }
        return $this;
    }

    /**
     * Gets column application
     *
     * @return string
     */
    public function getApplication()
    {
        return $this->_application;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstMusiconhold
     */
    public function setDigit($data)
    {

        if ($this->_digit != $data) {
            $this->_logChange('digit', $this->_digit, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_digit = $data;

        } else if (!is_null($data)) {
            $this->_digit = (string) $data;

        } else {
            $this->_digit = $data;
        }
        return $this;
    }

    /**
     * Gets column digit
     *
     * @return string
     */
    public function getDigit()
    {
        return $this->_digit;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstMusiconhold
     */
    public function setSort($data)
    {

        if ($this->_sort != $data) {
            $this->_logChange('sort', $this->_sort, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sort = $data;

        } else if (!is_null($data)) {
            $this->_sort = (string) $data;

        } else {
            $this->_sort = $data;
        }
        return $this;
    }

    /**
     * Gets column sort
     *
     * @return string
     */
    public function getSort()
    {
        return $this->_sort;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstMusiconhold
     */
    public function setFormat($data)
    {

        if ($this->_format != $data) {
            $this->_logChange('format', $this->_format, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_format = $data;

        } else if (!is_null($data)) {
            $this->_format = (string) $data;

        } else {
            $this->_format = $data;
        }
        return $this;
    }

    /**
     * Gets column format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->_format;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\AstMusiconhold
     */
    public function setStamp($data)
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

        if ($this->_stamp != $data) {
            $this->_logChange('stamp', $this->_stamp, $data);
        }

        $this->_stamp = $data;
        return $this;
    }

    /**
     * Gets column stamp
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getStamp($returnZendDate = false)
    {
        if (is_null($this->_stamp)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_stamp->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_stamp->format('Y-m-d H:i:s');
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\AstMusiconhold
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\AstMusiconhold')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\AstMusiconhold);

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
     * @return null | \IvozProvider\Model\Validator\AstMusiconhold
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\AstMusiconhold')) {

                $this->setValidator(new \IvozProvider\Validator\AstMusiconhold);
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
     * @see \Mapper\Sql\AstMusiconhold::delete
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