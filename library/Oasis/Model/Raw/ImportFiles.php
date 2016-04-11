<?php

/**
 * Application Model
 *
 * @package Oasis\Model\Raw
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model\Raw;
class ImportFiles extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_fileFso;


    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_id;

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
     * Database var type varchar
     *
     * @var string
     */
    protected $_type;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_nunRows;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_nunCols;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_uploadedOn;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_importedOn;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;


    /**
     * Parent relation ImportFiles_ibfk_1
     *
     * @var \Oasis\Model\Raw\Brands
     */
    protected $_Brand;


    /**
     * Dependent relation ImportPatterns_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\ImportPatterns[]
     */
    protected $_ImportPatterns;

    /**
     * Dependent relation ImportPlans_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\ImportPlans[]
     */
    protected $_ImportPlans;

    /**
     * Dependent relation ImportPrices_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\ImportPrices[]
     */
    protected $_ImportPrices;

    protected $_columnsList = array(
        'id'=>'id',
        'fileFileSize'=>'fileFileSize',
        'fileMimeType'=>'fileMimeType',
        'fileBaseName'=>'fileBaseName',
        'type'=>'type',
        'nunRows'=>'nunRows',
        'nunCols'=>'nunCols',
        'uploadedOn'=>'uploadedOn',
        'importedOn'=>'importedOn',
        'brandId'=>'brandId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'fileFileSize'=> array('FSO'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'ImportFilesIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
        ));

        $this->setDependentList(array(
            'ImportPatternsIbfk1' => array(
                    'property' => 'ImportPatterns',
                    'table_name' => 'ImportPatterns',
                ),
            'ImportPlansIbfk1' => array(
                    'property' => 'ImportPlans',
                    'table_name' => 'ImportPlans',
                ),
            'ImportPricesIbfk1' => array(
                    'property' => 'ImportPrices',
                    'table_name' => 'ImportPrices',
                ),
        ));




        $this->_defaultValues = array(
            'uploadedOn' => 'CURRENT_TIMESTAMP',
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

        $route = array(
            'profile' => $profile,
            'routeMap' => $this->getId() . '-' . $this->getFileBaseName()
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
     * @return \Oasis\Model\Raw\ImportFiles
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
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setFileFileSize($data)
    {

        if ($this->_fileFileSize != $data) {
            $this->_logChange('fileFileSize');
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
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setFileMimeType($data)
    {

        if ($this->_fileMimeType != $data) {
            $this->_logChange('fileMimeType');
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
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setFileBaseName($data)
    {

        if ($this->_fileBaseName != $data) {
            $this->_logChange('fileBaseName');
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setType($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_type != $data) {
            $this->_logChange('type');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_type = $data;
        } else if (!is_null($data)) {
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
     * @param int $data
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setNunRows($data)
    {

        if ($this->_nunRows != $data) {
            $this->_logChange('nunRows');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nunRows = $data;
        } else if (!is_null($data)) {
            $this->_nunRows = (int) $data;
        } else {
            $this->_nunRows = $data;
        }
        return $this;
    }

    /**
     * Gets column nunRows
     *
     * @return int
     */
    public function getNunRows()
    {
            return $this->_nunRows;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setNunCols($data)
    {

        if ($this->_nunCols != $data) {
            $this->_logChange('nunCols');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nunCols = $data;
        } else if (!is_null($data)) {
            $this->_nunCols = (int) $data;
        } else {
            $this->_nunCols = $data;
        }
        return $this;
    }

    /**
     * Gets column nunCols
     *
     * @return int
     */
    public function getNunCols()
    {
            return $this->_nunCols;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setUploadedOn($data)
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


        if ($this->_uploadedOn != $data) {
            $this->_logChange('uploadedOn');
        }


        $this->_uploadedOn = $data;
        return $this;
    }

    /**
     * Gets column uploadedOn
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getUploadedOn($returnZendDate = false)
    {
    
        if (is_null($this->_uploadedOn)) {

            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_uploadedOn->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }


        return $this->_uploadedOn->format('Y-m-d H:i:s');

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setImportedOn($data)
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


        if ($this->_importedOn != $data) {
            $this->_logChange('importedOn');
        }


        $this->_importedOn = $data;
        return $this;
    }

    /**
     * Gets column importedOn
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getImportedOn($returnZendDate = false)
    {
    
        if (is_null($this->_importedOn)) {

            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_importedOn->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }


        return $this->_importedOn->format('Y-m-d H:i:s');

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\ImportFiles
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
     * @param \Oasis\Model\Raw\Brands $data
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setBrand(\Oasis\Model\Raw\Brands $data)
    {
        $this->_Brand = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setBrandId($primaryKey);
        }

        $this->_setLoaded('ImportFilesIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ImportFilesIbfk1';

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
     * Sets dependent relations ImportPatterns_ibfk_1
     *
     * @param array $data An array of \Oasis\Model\Raw\ImportPatterns
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setImportPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ImportPatterns === null) {

                $this->getImportPatterns();
            }

            $oldRelations = $this->_ImportPatterns;

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

        $this->_ImportPatterns = array();

        foreach ($data as $object) {
            $this->addImportPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ImportPatterns_ibfk_1
     *
     * @param \Oasis\Model\Raw\ImportPatterns $data
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function addImportPatterns(\Oasis\Model\Raw\ImportPatterns $data)
    {
        $this->_ImportPatterns[] = $data;
        $this->_setLoaded('ImportPatternsIbfk1');
        return $this;
    }

    /**
     * Gets dependent ImportPatterns_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\ImportPatterns
     */
    public function getImportPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ImportPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ImportPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ImportPatterns;
    }

    /**
     * Sets dependent relations ImportPlans_ibfk_1
     *
     * @param array $data An array of \Oasis\Model\Raw\ImportPlans
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setImportPlans(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ImportPlans === null) {

                $this->getImportPlans();
            }

            $oldRelations = $this->_ImportPlans;

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

        $this->_ImportPlans = array();

        foreach ($data as $object) {
            $this->addImportPlans($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ImportPlans_ibfk_1
     *
     * @param \Oasis\Model\Raw\ImportPlans $data
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function addImportPlans(\Oasis\Model\Raw\ImportPlans $data)
    {
        $this->_ImportPlans[] = $data;
        $this->_setLoaded('ImportPlansIbfk1');
        return $this;
    }

    /**
     * Gets dependent ImportPlans_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\ImportPlans
     */
    public function getImportPlans($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ImportPlansIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ImportPlans = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ImportPlans;
    }

    /**
     * Sets dependent relations ImportPrices_ibfk_1
     *
     * @param array $data An array of \Oasis\Model\Raw\ImportPrices
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function setImportPrices(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ImportPrices === null) {

                $this->getImportPrices();
            }

            $oldRelations = $this->_ImportPrices;

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

        $this->_ImportPrices = array();

        foreach ($data as $object) {
            $this->addImportPrices($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ImportPrices_ibfk_1
     *
     * @param \Oasis\Model\Raw\ImportPrices $data
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function addImportPrices(\Oasis\Model\Raw\ImportPrices $data)
    {
        $this->_ImportPrices[] = $data;
        $this->_setLoaded('ImportPricesIbfk1');
        return $this;
    }

    /**
     * Gets dependent ImportPrices_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\ImportPrices
     */
    public function getImportPrices($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ImportPricesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ImportPrices = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ImportPrices;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\ImportFiles
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\ImportFiles')) {

                $this->setMapper(new \Oasis\Mapper\Sql\ImportFiles);

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
     * @return null | \Oasis\Model\Validator\ImportFiles
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\ImportFiles')) {

                $this->setValidator(new \Oasis\Validator\ImportFiles);
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
     * @see \Mapper\Sql\ImportFiles::delete
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
}
