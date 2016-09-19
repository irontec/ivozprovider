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
class Recordings extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_recordedFileFso;

    protected $_typeAcceptedValues = array(
        'ondemand',
        'ddi',
    );

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
    protected $_callid;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_calldate;

    /**
     * [enum:ondemand|ddi]
     * Database var type enum('ondemand','ddi')
     *
     * @var string
     */
    protected $_type;

    /**
     * Database var type float
     *
     * @var float
     */
    protected $_duration;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_caller;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callee;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_recorder;

    /**
     * [FSO:keepExtension|storeInBaseFolder]
     * Database var type int
     *
     * @var int
     */
    protected $_recordedFileFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_recordedFileMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_recordedFileBaseName;


    /**
     * Parent relation Recordings_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;


    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'callid'=>'callid',
        'calldate'=>'calldate',
        'type'=>'type',
        'duration'=>'duration',
        'caller'=>'caller',
        'callee'=>'callee',
        'recorder'=>'recorder',
        'recordedFileFileSize'=>'recordedFileFileSize',
        'recordedFileMimeType'=>'recordedFileMimeType',
        'recordedFileBaseName'=>'recordedFileBaseName',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'type'=> array('enum:ondemand|ddi'),
            'recordedFileFileSize'=> array('FSO:keepExtension|storeInBaseFolder'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'RecordingsIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'calldate' => 'CURRENT_TIMESTAMP',
            'type' => 'ddi',
            'duration' => '0.000',
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
        $this->_recordedFileFso = new \Iron_Model_Fso($this, $this->getRecordedFileSpecs());
        $this->_recordedFileFso->getPathResolver()->setModifiers(array('keepExtension' => true,'storeInBaseFolder' => true));

        return $this;
    }

    public function getFileObjects()
    {

        return array('recordedFile');
    }

    public function getRecordedFileSpecs()
    {
        return array(
            'basePath' => 'recordedFile',
            'sizeName' => 'recordedFileFileSize',
            'mimeName' => 'recordedFileMimeType',
            'baseNameName' => 'recordedFileBaseName',
        );
    }

    public function putRecordedFile($filePath = '',$baseName = '')
    {
        $this->_recordedFileFso->put($filePath);

        if (!empty($baseName)) {

            $this->_recordedFileFso->setBaseName($baseName);
        }
    }

    public function fetchRecordedFile($autoload = true)
    {
        if ($autoload === true && $this->getrecordedFileFileSize() > 0) {

            $this->_recordedFileFso->fetch();
        }

        return $this->_recordedFileFso;
    }

    public function removeRecordedFile()
    {
        $this->_recordedFileFso->remove();
        $this->_recordedFileFso = null;

        return true;
    }

    public function getRecordedFileUrl($profile)
    {
        $fsoConfig = \Zend_Registry::get('fsoConfig');
        $profileConf = $fsoConfig->$profile;

        if (is_null($profileConf)) {
            throw new \Exception('Profile invalid. not exist in fso.ini');
        }
        $routeMap = isset($profileConf->routeMap) ? $profileConf->routeMap : $fsoConfig->config->routeMap;

        $fsoColumn = $profileConf->fso;
        $fsoSkipColumns = array(
                $fsoColumn."FileSize",
                $fsoColumn."MimeType",
        );
        $fsoBaseNameColum = $fsoColumn."BaseName";

        foreach ($this->_columnsList as $column) {
            if (in_array($column, $fsoSkipColumns)) {
                continue;
            }
            $getter = "get".ucfirst($column);
            $search = "{".$column."}";
            if ($column == $fsoBaseNameColum) {
                $search = "{basename}";
            }
            $routeMap = str_replace($search, $this->$getter(), $routeMap);
        }

        if (!$routeMap) {
            return null;
        }
        $route = array(
            'profile' => $profile,
            'routeMap' => $routeMap
        );

        $view = new \Zend_View();
        $fsoUrl = $view->serverUrl($view->url($route, 'fso'));

        return $fsoUrl;

    }


    /**************************************************************************
    *********************************** /FSO ***********************************
    ***************************************************************************/

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Recordings
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
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_companyId != $data) {
            $this->_logChange('companyId', $this->_companyId, $data);
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
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setCallid($data)
    {

        if ($this->_callid != $data) {
            $this->_logChange('callid', $this->_callid, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callid = $data;

        } else if (!is_null($data)) {
            $this->_callid = (string) $data;

        } else {
            $this->_callid = $data;
        }
        return $this;
    }

    /**
     * Gets column callid
     *
     * @return string
     */
    public function getCallid()
    {
        return $this->_callid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setCalldate($data)
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

        if ($this->_calldate != $data) {
            $this->_logChange('calldate', $this->_calldate, $data);
        }

        $this->_calldate = $data;
        return $this;
    }

    /**
     * Gets column calldate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getCalldate($returnZendDate = false)
    {
        if (is_null($this->_calldate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_calldate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_calldate->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setType($data)
    {

        if ($this->_type != $data) {
            $this->_logChange('type', $this->_type, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_type = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_typeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for type'));
            }
            $this->_type = (string) $data;

        } else {
            $this->_type = $data;
        }
        return $this;
    }

    /**
     * Gets column type
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setDuration($data)
    {

        if ($this->_duration != $data) {
            $this->_logChange('duration', $this->_duration, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_duration = $data;

        } else if (!is_null($data)) {
            $this->_duration = (float) $data;

        } else {
            $this->_duration = $data;
        }
        return $this;
    }

    /**
     * Gets column duration
     *
     * @return float
     */
    public function getDuration()
    {
        return $this->_duration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setCaller($data)
    {

        if ($this->_caller != $data) {
            $this->_logChange('caller', $this->_caller, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_caller = $data;

        } else if (!is_null($data)) {
            $this->_caller = (string) $data;

        } else {
            $this->_caller = $data;
        }
        return $this;
    }

    /**
     * Gets column caller
     *
     * @return string
     */
    public function getCaller()
    {
        return $this->_caller;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setCallee($data)
    {

        if ($this->_callee != $data) {
            $this->_logChange('callee', $this->_callee, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callee = $data;

        } else if (!is_null($data)) {
            $this->_callee = (string) $data;

        } else {
            $this->_callee = $data;
        }
        return $this;
    }

    /**
     * Gets column callee
     *
     * @return string
     */
    public function getCallee()
    {
        return $this->_callee;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setRecorder($data)
    {

        if ($this->_recorder != $data) {
            $this->_logChange('recorder', $this->_recorder, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_recorder = $data;

        } else if (!is_null($data)) {
            $this->_recorder = (string) $data;

        } else {
            $this->_recorder = $data;
        }
        return $this;
    }

    /**
     * Gets column recorder
     *
     * @return string
     */
    public function getRecorder()
    {
        return $this->_recorder;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setRecordedFileFileSize($data)
    {

        if ($this->_recordedFileFileSize != $data) {
            $this->_logChange('recordedFileFileSize', $this->_recordedFileFileSize, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_recordedFileFileSize = $data;

        } else if (!is_null($data)) {
            $this->_recordedFileFileSize = (int) $data;

        } else {
            $this->_recordedFileFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column recordedFileFileSize
     *
     * @return int
     */
    public function getRecordedFileFileSize()
    {
        return $this->_recordedFileFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setRecordedFileMimeType($data)
    {

        if ($this->_recordedFileMimeType != $data) {
            $this->_logChange('recordedFileMimeType', $this->_recordedFileMimeType, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_recordedFileMimeType = $data;

        } else if (!is_null($data)) {
            $this->_recordedFileMimeType = (string) $data;

        } else {
            $this->_recordedFileMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column recordedFileMimeType
     *
     * @return string
     */
    public function getRecordedFileMimeType()
    {
        return $this->_recordedFileMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Recordings
     */
    public function setRecordedFileBaseName($data)
    {

        if ($this->_recordedFileBaseName != $data) {
            $this->_logChange('recordedFileBaseName', $this->_recordedFileBaseName, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_recordedFileBaseName = $data;

        } else if (!is_null($data)) {
            $this->_recordedFileBaseName = (string) $data;

        } else {
            $this->_recordedFileBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column recordedFileBaseName
     *
     * @return string
     */
    public function getRecordedFileBaseName()
    {
        return $this->_recordedFileBaseName;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Recordings
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

        $this->_setLoaded('RecordingsIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RecordingsIbfk1';

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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Recordings
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Recordings')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Recordings);

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
     * @return null | \IvozProvider\Model\Validator\Recordings
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Recordings')) {

                $this->setValidator(new \IvozProvider\Validator\Recordings);
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
     * @see \Mapper\Sql\Recordings::delete
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