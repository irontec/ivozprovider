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
class Services extends ModelAbstract
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
    protected $_iden;

    /**
     * [ml]
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_nameEn;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_nameEs;

    /**
     * [ml]
     * Database var type varchar
     *
     * @var string
     */
    protected $_description;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_descriptionEn;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_descriptionEs;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_defaultCode;



    /**
     * Dependent relation BrandServices_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\BrandServices[]
     */
    protected $_BrandServices;

    /**
     * Dependent relation CompanyServices_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\CompanyServices[]
     */
    protected $_CompanyServices;

    protected $_columnsList = array(
        'id'=>'id',
        'iden'=>'iden',
        'name'=>'name',
        'name_en'=>'nameEn',
        'name_es'=>'nameEs',
        'description'=>'description',
        'description_en'=>'descriptionEn',
        'description_es'=>'descriptionEs',
        'defaultCode'=>'defaultCode',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'name'=> array('ml'),
            'description'=> array('ml'),
        ));

        $this->setMultiLangColumnsList(array(
            'name'=>'Name',
            'description'=>'Description',
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'BrandServicesIbfk2' => array(
                    'property' => 'BrandServices',
                    'table_name' => 'BrandServices',
                ),
            'CompanyServicesIbfk2' => array(
                    'property' => 'CompanyServices',
                    'table_name' => 'CompanyServices',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'BrandServices_ibfk_2',
            'CompanyServices_ibfk_2'
        ));



        $this->_defaultValues = array(
            'iden' => '',
            'name' => '',
            'nameEn' => '',
            'nameEs' => '',
            'description' => '',
            'descriptionEn' => '',
            'descriptionEs' => '',
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
     * @return \IvozProvider\Model\Raw\Services
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
     * @return \IvozProvider\Model\Raw\Services
     */
    public function setIden($data)
    {

        if ($this->_iden != $data) {
            $this->_logChange('iden', $this->_iden, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_iden = $data;

        } else if (!is_null($data)) {
            $this->_iden = (string) $data;

        } else {
            $this->_iden = $data;
        }
        return $this;
    }

    /**
     * Gets column iden
     *
     * @return string
     */
    public function getIden()
    {
        return $this->_iden;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Services
     */
    public function setName($data, $language = '')
    {

        $language = $this->_getCurrentLanguage($language);

        $methodName = "setName". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            $this->_name = $data;
            return $this;
        }
        $this->$methodName($data);
        return $this;
    }

    /**
     * Gets column name
     *
     * @return string
     */
    public function getName($language = '')
    {
        $language = $this->_getCurrentLanguage($language);

        $methodName = "getName". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            return $this->_name;
        }

        return $this->$methodName();
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Services
     */
    public function setNameEn($data)
    {

        if ($this->_nameEn != $data) {
            $this->_logChange('nameEn', $this->_nameEn, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nameEn = $data;

        } else if (!is_null($data)) {
            $this->_nameEn = (string) $data;

        } else {
            $this->_nameEn = $data;
        }
        return $this;
    }

    /**
     * Gets column name_en
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->_nameEn;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Services
     */
    public function setNameEs($data)
    {

        if ($this->_nameEs != $data) {
            $this->_logChange('nameEs', $this->_nameEs, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nameEs = $data;

        } else if (!is_null($data)) {
            $this->_nameEs = (string) $data;

        } else {
            $this->_nameEs = $data;
        }
        return $this;
    }

    /**
     * Gets column name_es
     *
     * @return string
     */
    public function getNameEs()
    {
        return $this->_nameEs;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Services
     */
    public function setDescription($data, $language = '')
    {

        $language = $this->_getCurrentLanguage($language);

        $methodName = "setDescription". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            $this->_description = $data;
            return $this;
        }
        $this->$methodName($data);
        return $this;
    }

    /**
     * Gets column description
     *
     * @return string
     */
    public function getDescription($language = '')
    {
        $language = $this->_getCurrentLanguage($language);

        $methodName = "getDescription". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            return $this->_description;
        }

        return $this->$methodName();
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Services
     */
    public function setDescriptionEn($data)
    {

        if ($this->_descriptionEn != $data) {
            $this->_logChange('descriptionEn', $this->_descriptionEn, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_descriptionEn = $data;

        } else if (!is_null($data)) {
            $this->_descriptionEn = (string) $data;

        } else {
            $this->_descriptionEn = $data;
        }
        return $this;
    }

    /**
     * Gets column description_en
     *
     * @return string
     */
    public function getDescriptionEn()
    {
        return $this->_descriptionEn;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Services
     */
    public function setDescriptionEs($data)
    {

        if ($this->_descriptionEs != $data) {
            $this->_logChange('descriptionEs', $this->_descriptionEs, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_descriptionEs = $data;

        } else if (!is_null($data)) {
            $this->_descriptionEs = (string) $data;

        } else {
            $this->_descriptionEs = $data;
        }
        return $this;
    }

    /**
     * Gets column description_es
     *
     * @return string
     */
    public function getDescriptionEs()
    {
        return $this->_descriptionEs;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Services
     */
    public function setDefaultCode($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_defaultCode != $data) {
            $this->_logChange('defaultCode', $this->_defaultCode, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_defaultCode = $data;

        } else if (!is_null($data)) {
            $this->_defaultCode = (string) $data;

        } else {
            $this->_defaultCode = $data;
        }
        return $this;
    }

    /**
     * Gets column defaultCode
     *
     * @return string
     */
    public function getDefaultCode()
    {
        return $this->_defaultCode;
    }

    /**
     * Sets dependent relations BrandServices_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\BrandServices
     * @return \IvozProvider\Model\Raw\Services
     */
    public function setBrandServices(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_BrandServices === null) {

                $this->getBrandServices();
            }

            $oldRelations = $this->_BrandServices;

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

        $this->_BrandServices = array();

        foreach ($data as $object) {
            $this->addBrandServices($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations BrandServices_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\BrandServices $data
     * @return \IvozProvider\Model\Raw\Services
     */
    public function addBrandServices(\IvozProvider\Model\Raw\BrandServices $data)
    {
        $this->_BrandServices[] = $data;
        $this->_setLoaded('BrandServicesIbfk2');
        return $this;
    }

    /**
     * Gets dependent BrandServices_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\BrandServices
     */
    public function getBrandServices($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandServicesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_BrandServices = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_BrandServices;
    }

    /**
     * Sets dependent relations CompanyServices_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\CompanyServices
     * @return \IvozProvider\Model\Raw\Services
     */
    public function setCompanyServices(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_CompanyServices === null) {

                $this->getCompanyServices();
            }

            $oldRelations = $this->_CompanyServices;

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

        $this->_CompanyServices = array();

        foreach ($data as $object) {
            $this->addCompanyServices($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations CompanyServices_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\CompanyServices $data
     * @return \IvozProvider\Model\Raw\Services
     */
    public function addCompanyServices(\IvozProvider\Model\Raw\CompanyServices $data)
    {
        $this->_CompanyServices[] = $data;
        $this->_setLoaded('CompanyServicesIbfk2');
        return $this;
    }

    /**
     * Gets dependent CompanyServices_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\CompanyServices
     */
    public function getCompanyServices($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompanyServicesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_CompanyServices = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_CompanyServices;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Services
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Services')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Services);

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
     * @return null | \IvozProvider\Model\Validator\Services
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Services')) {

                $this->setValidator(new \IvozProvider\Validator\Services);
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
     * @see \Mapper\Sql\Services::delete
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