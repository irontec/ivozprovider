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
class TargetPatterns extends ModelAbstract
{


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

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
    protected $_regExp;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;


    /**
     * Parent relation TargetPatterns_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;


    /**
     * Dependent relation PricingPlansRelTargetPatterns_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns[]
     */
    protected $_PricingPlansRelTargetPatterns;

    /**
     * Dependent relation kam_acc_cdrs_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\KamAccCdrs[]
     */
    protected $_KamAccCdrs;

    protected $_columnsList = array(
        'id'=>'id',
        'name'=>'name',
        'name_en'=>'nameEn',
        'name_es'=>'nameEs',
        'description'=>'description',
        'description_en'=>'descriptionEn',
        'description_es'=>'descriptionEs',
        'regExp'=>'regExp',
        'brandId'=>'brandId',
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
            'TargetPatternsIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
        ));

        $this->setDependentList(array(
            'PricingPlansRelTargetPatternsIbfk2' => array(
                    'property' => 'PricingPlansRelTargetPatterns',
                    'table_name' => 'PricingPlansRelTargetPatterns',
                ),
            'KamAccCdrsIbfk2' => array(
                    'property' => 'KamAccCdrs',
                    'table_name' => 'kam_acc_cdrs',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'PricingPlansRelTargetPatterns_ibfk_2'
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
     * @return \IvozProvider\Model\Raw\TargetPatterns
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
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function setName($data, $language = '')
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function setNameEn($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_nameEn != $data) {
            $this->_logChange('nameEn');
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
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function setNameEs($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_nameEs != $data) {
            $this->_logChange('nameEs');
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
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function setDescription($data, $language = '')
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function setDescriptionEn($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_descriptionEn != $data) {
            $this->_logChange('descriptionEn');
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
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function setDescriptionEs($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_descriptionEs != $data) {
            $this->_logChange('descriptionEs');
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
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function setRegExp($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_regExp != $data) {
            $this->_logChange('regExp');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_regExp = $data;

        } else if (!is_null($data)) {
            $this->_regExp = (string) $data;

        } else {
            $this->_regExp = $data;
        }
        return $this;
    }

    /**
     * Gets column regExp
     *
     * @return string
     */
    public function getRegExp()
    {
        return $this->_regExp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\TargetPatterns
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
     * @return \IvozProvider\Model\Raw\TargetPatterns
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

        $this->_setLoaded('TargetPatternsIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TargetPatternsIbfk1';

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
     * Sets dependent relations PricingPlansRelTargetPatterns_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function setPricingPlansRelTargetPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PricingPlansRelTargetPatterns === null) {

                $this->getPricingPlansRelTargetPatterns();
            }

            $oldRelations = $this->_PricingPlansRelTargetPatterns;

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

        $this->_PricingPlansRelTargetPatterns = array();

        foreach ($data as $object) {
            $this->addPricingPlansRelTargetPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PricingPlansRelTargetPatterns_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns $data
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function addPricingPlansRelTargetPatterns(\IvozProvider\Model\Raw\PricingPlansRelTargetPatterns $data)
    {
        $this->_PricingPlansRelTargetPatterns[] = $data;
        $this->_setLoaded('PricingPlansRelTargetPatternsIbfk2');
        return $this;
    }

    /**
     * Gets dependent PricingPlansRelTargetPatterns_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     */
    public function getPricingPlansRelTargetPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PricingPlansRelTargetPatternsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PricingPlansRelTargetPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PricingPlansRelTargetPatterns;
    }

    /**
     * Sets dependent relations kam_acc_cdrs_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\KamAccCdrs
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function setKamAccCdrs(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KamAccCdrs === null) {

                $this->getKamAccCdrs();
            }

            $oldRelations = $this->_KamAccCdrs;

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

        $this->_KamAccCdrs = array();

        foreach ($data as $object) {
            $this->addKamAccCdrs($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations kam_acc_cdrs_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\KamAccCdrs $data
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function addKamAccCdrs(\IvozProvider\Model\Raw\KamAccCdrs $data)
    {
        $this->_KamAccCdrs[] = $data;
        $this->_setLoaded('KamAccCdrsIbfk2');
        return $this;
    }

    /**
     * Gets dependent kam_acc_cdrs_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function getKamAccCdrs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamAccCdrsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KamAccCdrs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KamAccCdrs;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\TargetPatterns
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\TargetPatterns')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\TargetPatterns);

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
     * @return null | \IvozProvider\Model\Validator\TargetPatterns
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\TargetPatterns')) {

                $this->setValidator(new \IvozProvider\Validator\TargetPatterns);
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
     * @see \Mapper\Sql\TargetPatterns::delete
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