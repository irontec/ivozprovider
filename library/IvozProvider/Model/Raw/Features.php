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
class Features extends ModelAbstract
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
     * Dependent relation FeaturesRelBrands_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\FeaturesRelBrands[]
     */
    protected $_FeaturesRelBrands;

    /**
     * Dependent relation FeaturesRelCompanies_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\FeaturesRelCompanies[]
     */
    protected $_FeaturesRelCompanies;

    protected $_columnsList = array(
        'id'=>'id',
        'iden'=>'iden',
        'name'=>'name',
        'name_en'=>'nameEn',
        'name_es'=>'nameEs',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'name'=> array('ml'),
        ));

        $this->setMultiLangColumnsList(array(
            'name'=>'Name',
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'FeaturesRelBrandsIbfk2' => array(
                    'property' => 'FeaturesRelBrands',
                    'table_name' => 'FeaturesRelBrands',
                ),
            'FeaturesRelCompaniesIbfk2' => array(
                    'property' => 'FeaturesRelCompanies',
                    'table_name' => 'FeaturesRelCompanies',
                ),
        ));




        $this->_defaultValues = array(
            'name' => '',
            'nameEn' => '',
            'nameEs' => '',
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
     * @return \IvozProvider\Model\Raw\Features
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
     * @return \IvozProvider\Model\Raw\Features
     */
    public function setIden($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \IvozProvider\Model\Raw\Features
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
     * @return \IvozProvider\Model\Raw\Features
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
     * @return \IvozProvider\Model\Raw\Features
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
     * Sets dependent relations FeaturesRelBrands_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\FeaturesRelBrands
     * @return \IvozProvider\Model\Raw\Features
     */
    public function setFeaturesRelBrands(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_FeaturesRelBrands === null) {

                $this->getFeaturesRelBrands();
            }

            $oldRelations = $this->_FeaturesRelBrands;

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

        $this->_FeaturesRelBrands = array();

        foreach ($data as $object) {
            $this->addFeaturesRelBrands($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations FeaturesRelBrands_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\FeaturesRelBrands $data
     * @return \IvozProvider\Model\Raw\Features
     */
    public function addFeaturesRelBrands(\IvozProvider\Model\Raw\FeaturesRelBrands $data)
    {
        $this->_FeaturesRelBrands[] = $data;
        $this->_setLoaded('FeaturesRelBrandsIbfk2');
        return $this;
    }

    /**
     * Gets dependent FeaturesRelBrands_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\FeaturesRelBrands
     */
    public function getFeaturesRelBrands($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FeaturesRelBrandsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_FeaturesRelBrands = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_FeaturesRelBrands;
    }

    /**
     * Sets dependent relations FeaturesRelCompanies_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\FeaturesRelCompanies
     * @return \IvozProvider\Model\Raw\Features
     */
    public function setFeaturesRelCompanies(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_FeaturesRelCompanies === null) {

                $this->getFeaturesRelCompanies();
            }

            $oldRelations = $this->_FeaturesRelCompanies;

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

        $this->_FeaturesRelCompanies = array();

        foreach ($data as $object) {
            $this->addFeaturesRelCompanies($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations FeaturesRelCompanies_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\FeaturesRelCompanies $data
     * @return \IvozProvider\Model\Raw\Features
     */
    public function addFeaturesRelCompanies(\IvozProvider\Model\Raw\FeaturesRelCompanies $data)
    {
        $this->_FeaturesRelCompanies[] = $data;
        $this->_setLoaded('FeaturesRelCompaniesIbfk2');
        return $this;
    }

    /**
     * Gets dependent FeaturesRelCompanies_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\FeaturesRelCompanies
     */
    public function getFeaturesRelCompanies($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FeaturesRelCompaniesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_FeaturesRelCompanies = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_FeaturesRelCompanies;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Features
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Features')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Features);

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
     * @return null | \IvozProvider\Model\Validator\Features
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Features')) {

                $this->setValidator(new \IvozProvider\Validator\Features);
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
     * @see \Mapper\Sql\Features::delete
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