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
class GenericMusicOnHold extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_originalFileFso;
    /*
     * @var \Iron_Model_Fso
     */
    protected $_encodedFileFso;

    protected $_statusAcceptedValues = array(
        'pending',
        'encoding',
        'ready',
        'error',
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
     * [FSO:keepExtension]
     * Database var type int
     *
     * @var int
     */
    protected $_originalFileFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_originalFileMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_originalFileBaseName;

    /**
     * [FSO:keepExtension|storeInBaseFolder]
     * Database var type int
     *
     * @var int
     */
    protected $_encodedFileFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_encodedFileMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_encodedFileBaseName;

    /**
     * [enum:pending|encoding|ready|error]
     * Database var type varchar
     *
     * @var string
     */
    protected $_status;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;


    /**
     * Parent relation fGenericMusicOnHold_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;


    protected $_columnsList = array(
        'id'=>'id',
        'name'=>'name',
        'originalFileFileSize'=>'originalFileFileSize',
        'originalFileMimeType'=>'originalFileMimeType',
        'originalFileBaseName'=>'originalFileBaseName',
        'encodedFileFileSize'=>'encodedFileFileSize',
        'encodedFileMimeType'=>'encodedFileMimeType',
        'encodedFileBaseName'=>'encodedFileBaseName',
        'status'=>'status',
        'brandId'=>'brandId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'originalFileFileSize'=> array('FSO:keepExtension'),
            'encodedFileFileSize'=> array('FSO:keepExtension|storeInBaseFolder'),
            'status'=> array('enum:pending|encoding|ready|error'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'FGenericMusicOnHoldIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
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
        $this->_originalFileFso = new \Iron_Model_Fso($this, $this->getOriginalFileSpecs());
        $this->_originalFileFso->getPathResolver()->setModifiers(array('keepExtension' => true));
        $this->_encodedFileFso = new \Iron_Model_Fso($this, $this->getEncodedFileSpecs());
        $this->_encodedFileFso->getPathResolver()->setModifiers(array('keepExtension' => true,'storeInBaseFolder' => true));

        return $this;
    }

    public function getFileObjects()
    {

        return array('originalFile','encodedFile');
    }

    public function getOriginalFileSpecs()
    {
        return array(
            'basePath' => 'originalFile',
            'sizeName' => 'originalFileFileSize',
            'mimeName' => 'originalFileMimeType',
            'baseNameName' => 'originalFileBaseName',
        );
    }

    public function putOriginalFile($filePath = '',$baseName = '')
    {
        $this->_originalFileFso->put($filePath);

        if (!empty($baseName)) {

            $this->_originalFileFso->setBaseName($baseName);
        }
    }

    public function fetchOriginalFile($autoload = true)
    {
        if ($autoload === true && $this->getoriginalFileFileSize() > 0) {

            $this->_originalFileFso->fetch();
        }

        return $this->_originalFileFso;
    }

    public function removeOriginalFile()
    {
        $this->_originalFileFso->remove();
        $this->_originalFileFso = null;

        return true;
    }

    public function getOriginalFileUrl($profile)
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

    public function getEncodedFileSpecs()
    {
        return array(
            'basePath' => 'encodedFile',
            'sizeName' => 'encodedFileFileSize',
            'mimeName' => 'encodedFileMimeType',
            'baseNameName' => 'encodedFileBaseName',
        );
    }

    public function putEncodedFile($filePath = '',$baseName = '')
    {
        $this->_encodedFileFso->put($filePath);

        if (!empty($baseName)) {

            $this->_encodedFileFso->setBaseName($baseName);
        }
    }

    public function fetchEncodedFile($autoload = true)
    {
        if ($autoload === true && $this->getencodedFileFileSize() > 0) {

            $this->_encodedFileFso->fetch();
        }

        return $this->_encodedFileFso;
    }

    public function removeEncodedFile()
    {
        $this->_encodedFileFso->remove();
        $this->_encodedFileFso = null;

        return true;
    }

    public function getEncodedFileUrl($profile)
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
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
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
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
     */
    public function setOriginalFileFileSize($data)
    {

        if ($this->_originalFileFileSize != $data) {
            $this->_logChange('originalFileFileSize');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_originalFileFileSize = $data;

        } else if (!is_null($data)) {
            $this->_originalFileFileSize = (int) $data;

        } else {
            $this->_originalFileFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column originalFileFileSize
     *
     * @return int
     */
    public function getOriginalFileFileSize()
    {
        return $this->_originalFileFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
     */
    public function setOriginalFileMimeType($data)
    {

        if ($this->_originalFileMimeType != $data) {
            $this->_logChange('originalFileMimeType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_originalFileMimeType = $data;

        } else if (!is_null($data)) {
            $this->_originalFileMimeType = (string) $data;

        } else {
            $this->_originalFileMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column originalFileMimeType
     *
     * @return string
     */
    public function getOriginalFileMimeType()
    {
        return $this->_originalFileMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
     */
    public function setOriginalFileBaseName($data)
    {

        if ($this->_originalFileBaseName != $data) {
            $this->_logChange('originalFileBaseName');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_originalFileBaseName = $data;

        } else if (!is_null($data)) {
            $this->_originalFileBaseName = (string) $data;

        } else {
            $this->_originalFileBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column originalFileBaseName
     *
     * @return string
     */
    public function getOriginalFileBaseName()
    {
        return $this->_originalFileBaseName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
     */
    public function setEncodedFileFileSize($data)
    {

        if ($this->_encodedFileFileSize != $data) {
            $this->_logChange('encodedFileFileSize');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_encodedFileFileSize = $data;

        } else if (!is_null($data)) {
            $this->_encodedFileFileSize = (int) $data;

        } else {
            $this->_encodedFileFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column encodedFileFileSize
     *
     * @return int
     */
    public function getEncodedFileFileSize()
    {
        return $this->_encodedFileFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
     */
    public function setEncodedFileMimeType($data)
    {

        if ($this->_encodedFileMimeType != $data) {
            $this->_logChange('encodedFileMimeType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_encodedFileMimeType = $data;

        } else if (!is_null($data)) {
            $this->_encodedFileMimeType = (string) $data;

        } else {
            $this->_encodedFileMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column encodedFileMimeType
     *
     * @return string
     */
    public function getEncodedFileMimeType()
    {
        return $this->_encodedFileMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
     */
    public function setEncodedFileBaseName($data)
    {

        if ($this->_encodedFileBaseName != $data) {
            $this->_logChange('encodedFileBaseName');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_encodedFileBaseName = $data;

        } else if (!is_null($data)) {
            $this->_encodedFileBaseName = (string) $data;

        } else {
            $this->_encodedFileBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column encodedFileBaseName
     *
     * @return string
     */
    public function getEncodedFileBaseName()
    {
        return $this->_encodedFileBaseName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
     */
    public function setStatus($data)
    {

        if ($this->_status != $data) {
            $this->_logChange('status');
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
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
     */
    public function setBrandId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_brandId != $data) {
            $this->_logChange('brandId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_brandId = $data;

        } else if (!is_null($data)) {
            $this->_brandId = (int) $data;

        } else {
            $this->_brandId = $data;
        }
        return $this;
    }

    /**
     * Gets column brandId
     *
     * @return int
     */
    public function getBrandId()
    {
        return $this->_brandId;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\GenericMusicOnHold
     */
    public function setBrand(\IvozProvider\Model\Raw\Brands $data)
    {
        $this->_Brand = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setBrandId($primaryKey);
        }

        $this->_setLoaded('FGenericMusicOnHoldIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FGenericMusicOnHoldIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Brand = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Brand;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\GenericMusicOnHold
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\GenericMusicOnHold')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\GenericMusicOnHold);

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
     * @return null | \IvozProvider\Model\Validator\GenericMusicOnHold
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\GenericMusicOnHold')) {

                $this->setValidator(new \IvozProvider\Validator\GenericMusicOnHold);
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
     * @see \Mapper\Sql\GenericMusicOnHold::delete
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