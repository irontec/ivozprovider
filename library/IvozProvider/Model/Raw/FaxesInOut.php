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
class FaxesInOut extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_fileFso;

    protected $_typeAcceptedValues = array(
        'In',
        'Out',
    );
    protected $_statusAcceptedValues = array(
        'error',
        'pending',
        'inprogress',
        'completed',
    );

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Hora de recepcion del fax
     * Database var type timestamp
     *
     * @var string
     */
    protected $_calldate;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_faxId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_src;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dst;

    /**
     * [enum:In|Out]
     * Database var type varchar
     *
     * @var string
     */
    protected $_type;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pages;

    /**
     * Database var type enum('error','pending','inprogress','completed')
     *
     * @var string
     */
    protected $_status;

    /**
     * [FSO]
     * Database var type int
     *
     * @var int
     */
    protected $_fileFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fileMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fileBaseName;


    /**
     * Parent relation FaxesInOut_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Faxes
     */
    protected $_Fax;


    protected $_columnsList = array(
        'id'=>'id',
        'calldate'=>'calldate',
        'faxId'=>'faxId',
        'src'=>'src',
        'dst'=>'dst',
        'type'=>'type',
        'pages'=>'pages',
        'status'=>'status',
        'fileFileSize'=>'fileFileSize',
        'fileMimeType'=>'fileMimeType',
        'fileBaseName'=>'fileBaseName',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'calldate'=> array(''),
            'type'=> array('enum:In|Out'),
            'fileFileSize'=> array('FSO'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'FaxesInOutIbfk2'=> array(
                    'property' => 'Fax',
                    'table_name' => 'Faxes',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'calldate' => '0000-00-00 00:00:00',
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
        $this->_fileFso = new \Iron_Model_Fso($this, $this->getFileSpecs());

        return $this;
    }

    public function getFileObjects()
    {

        return array('file');
    }

    public function getFileSpecs()
    {
        return array(
            'basePath' => 'file',
            'sizeName' => 'fileFileSize',
            'mimeName' => 'fileMimeType',
            'baseNameName' => 'fileBaseName',
        );
    }

    public function putFile($filePath = '',$baseName = '')
    {
        $this->_fileFso->put($filePath);

        if (!empty($baseName)) {

            $this->_fileFso->setBaseName($baseName);
        }
    }

    public function fetchFile($autoload = true)
    {
        if ($autoload === true && $this->getfileFileSize() > 0) {

            $this->_fileFso->fetch();
        }

        return $this->_fileFso;
    }

    public function removeFile()
    {
        $this->_fileFso->remove();
        $this->_fileFso = null;

        return true;
    }

    public function getFileUrl($profile)
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
     * @return \IvozProvider\Model\Raw\FaxesInOut
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
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\FaxesInOut
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\FaxesInOut
     */
    public function setFaxId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_faxId != $data) {
            $this->_logChange('faxId', $this->_faxId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_faxId = $data;

        } else if (!is_null($data)) {
            $this->_faxId = (int) $data;

        } else {
            $this->_faxId = $data;
        }
        return $this;
    }

    /**
     * Gets column faxId
     *
     * @return int
     */
    public function getFaxId()
    {
        return $this->_faxId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\FaxesInOut
     */
    public function setSrc($data)
    {

        if ($this->_src != $data) {
            $this->_logChange('src', $this->_src, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_src = $data;

        } else if (!is_null($data)) {
            $this->_src = (string) $data;

        } else {
            $this->_src = $data;
        }
        return $this;
    }

    /**
     * Gets column src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->_src;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\FaxesInOut
     */
    public function setDst($data)
    {

        if ($this->_dst != $data) {
            $this->_logChange('dst', $this->_dst, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_dst = $data;

        } else if (!is_null($data)) {
            $this->_dst = (string) $data;

        } else {
            $this->_dst = $data;
        }
        return $this;
    }

    /**
     * Gets column dst
     *
     * @return string
     */
    public function getDst()
    {
        return $this->_dst;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\FaxesInOut
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\FaxesInOut
     */
    public function setPages($data)
    {

        if ($this->_pages != $data) {
            $this->_logChange('pages', $this->_pages, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pages = $data;

        } else if (!is_null($data)) {
            $this->_pages = (string) $data;

        } else {
            $this->_pages = $data;
        }
        return $this;
    }

    /**
     * Gets column pages
     *
     * @return string
     */
    public function getPages()
    {
        return $this->_pages;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\FaxesInOut
     */
    public function setStatus($data)
    {

        if ($this->_status != $data) {
            $this->_logChange('status', $this->_status, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_status = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_statusAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for status'));
            }
            $this->_status = (string) $data;

        } else {
            $this->_status = $data;
        }
        return $this;
    }

    /**
     * Gets column status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\FaxesInOut
     */
    public function setFileFileSize($data)
    {

        if ($this->_fileFileSize != $data) {
            $this->_logChange('fileFileSize', $this->_fileFileSize, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fileFileSize = $data;

        } else if (!is_null($data)) {
            $this->_fileFileSize = (int) $data;

        } else {
            $this->_fileFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column fileFileSize
     *
     * @return int
     */
    public function getFileFileSize()
    {
        return $this->_fileFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\FaxesInOut
     */
    public function setFileMimeType($data)
    {

        if ($this->_fileMimeType != $data) {
            $this->_logChange('fileMimeType', $this->_fileMimeType, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fileMimeType = $data;

        } else if (!is_null($data)) {
            $this->_fileMimeType = (string) $data;

        } else {
            $this->_fileMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column fileMimeType
     *
     * @return string
     */
    public function getFileMimeType()
    {
        return $this->_fileMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\FaxesInOut
     */
    public function setFileBaseName($data)
    {

        if ($this->_fileBaseName != $data) {
            $this->_logChange('fileBaseName', $this->_fileBaseName, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fileBaseName = $data;

        } else if (!is_null($data)) {
            $this->_fileBaseName = (string) $data;

        } else {
            $this->_fileBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column fileBaseName
     *
     * @return string
     */
    public function getFileBaseName()
    {
        return $this->_fileBaseName;
    }

    /**
     * Sets parent relation Fax
     *
     * @param \IvozProvider\Model\Raw\Faxes $data
     * @return \IvozProvider\Model\Raw\FaxesInOut
     */
    public function setFax(\IvozProvider\Model\Raw\Faxes $data)
    {
        $this->_Fax = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setFaxId($primaryKey);
        }

        $this->_setLoaded('FaxesInOutIbfk2');
        return $this;
    }

    /**
     * Gets parent Fax
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Faxes
     */
    public function getFax($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FaxesInOutIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Fax = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Fax;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\FaxesInOut
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\FaxesInOut')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\FaxesInOut);

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
     * @return null | \IvozProvider\Model\Validator\FaxesInOut
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\FaxesInOut')) {

                $this->setValidator(new \IvozProvider\Validator\FaxesInOut);
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
     * @see \Mapper\Sql\FaxesInOut::delete
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