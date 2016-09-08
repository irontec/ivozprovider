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
class RoutingPatterns extends ModelAbstract
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
     * Parent relation RoutingPatterns_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;


    /**
     * Dependent relation LcrRules_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\LcrRules[]
     */
    protected $_LcrRules;

    /**
     * Dependent relation OutgoingRouting_ibfk_6
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\OutgoingRouting[]
     */
    protected $_OutgoingRouting;

    /**
     * Dependent relation RoutingPatternGroupsRelPatterns_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\RoutingPatternGroupsRelPatterns[]
     */
    protected $_RoutingPatternGroupsRelPatterns;

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
            'RoutingPatternsIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
        ));

        $this->setDependentList(array(
            'LcrRulesIbfk4' => array(
                    'property' => 'LcrRules',
                    'table_name' => 'LcrRules',
                ),
            'OutgoingRoutingIbfk6' => array(
                    'property' => 'OutgoingRouting',
                    'table_name' => 'OutgoingRouting',
                ),
            'RoutingPatternGroupsRelPatternsIbfk1' => array(
                    'property' => 'RoutingPatternGroupsRelPatterns',
                    'table_name' => 'RoutingPatternGroupsRelPatterns',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'LcrRules_ibfk_4',
            'OutgoingRouting_ibfk_6',
            'RoutingPatternGroupsRelPatterns_ibfk_1'
        ));



        $this->_defaultValues = array(
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
     * @return \IvozProvider\Model\Raw\RoutingPatterns
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
     * @return \IvozProvider\Model\Raw\RoutingPatterns
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
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function setNameEn($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function setNameEs($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \IvozProvider\Model\Raw\RoutingPatterns
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
     * @return \IvozProvider\Model\Raw\RoutingPatterns
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
     * @return \IvozProvider\Model\Raw\RoutingPatterns
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
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function setRegExp($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_regExp != $data) {
            $this->_logChange('regExp', $this->_regExp, $data);
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
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function setBrandId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_brandId != $data) {
            $this->_logChange('brandId', $this->_brandId, $data);
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
     * @return \IvozProvider\Model\Raw\RoutingPatterns
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

        $this->_setLoaded('RoutingPatternsIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RoutingPatternsIbfk1';

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
     * Sets dependent relations LcrRules_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\LcrRules
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function setLcrRules(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_LcrRules === null) {

                $this->getLcrRules();
            }

            $oldRelations = $this->_LcrRules;

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

        $this->_LcrRules = array();

        foreach ($data as $object) {
            $this->addLcrRules($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations LcrRules_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\LcrRules $data
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function addLcrRules(\IvozProvider\Model\Raw\LcrRules $data)
    {
        $this->_LcrRules[] = $data;
        $this->_setLoaded('LcrRulesIbfk4');
        return $this;
    }

    /**
     * Gets dependent LcrRules_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\LcrRules
     */
    public function getLcrRules($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRulesIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_LcrRules = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_LcrRules;
    }

    /**
     * Sets dependent relations OutgoingRouting_ibfk_6
     *
     * @param array $data An array of \IvozProvider\Model\Raw\OutgoingRouting
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function setOutgoingRouting(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_OutgoingRouting === null) {

                $this->getOutgoingRouting();
            }

            $oldRelations = $this->_OutgoingRouting;

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

        $this->_OutgoingRouting = array();

        foreach ($data as $object) {
            $this->addOutgoingRouting($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations OutgoingRouting_ibfk_6
     *
     * @param \IvozProvider\Model\Raw\OutgoingRouting $data
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function addOutgoingRouting(\IvozProvider\Model\Raw\OutgoingRouting $data)
    {
        $this->_OutgoingRouting[] = $data;
        $this->_setLoaded('OutgoingRoutingIbfk6');
        return $this;
    }

    /**
     * Gets dependent OutgoingRouting_ibfk_6
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\OutgoingRouting
     */
    public function getOutgoingRouting($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingRoutingIbfk6';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingRouting = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_OutgoingRouting;
    }

    /**
     * Sets dependent relations RoutingPatternGroupsRelPatterns_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\RoutingPatternGroupsRelPatterns
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function setRoutingPatternGroupsRelPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_RoutingPatternGroupsRelPatterns === null) {

                $this->getRoutingPatternGroupsRelPatterns();
            }

            $oldRelations = $this->_RoutingPatternGroupsRelPatterns;

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

        $this->_RoutingPatternGroupsRelPatterns = array();

        foreach ($data as $object) {
            $this->addRoutingPatternGroupsRelPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations RoutingPatternGroupsRelPatterns_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\RoutingPatternGroupsRelPatterns $data
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function addRoutingPatternGroupsRelPatterns(\IvozProvider\Model\Raw\RoutingPatternGroupsRelPatterns $data)
    {
        $this->_RoutingPatternGroupsRelPatterns[] = $data;
        $this->_setLoaded('RoutingPatternGroupsRelPatternsIbfk1');
        return $this;
    }

    /**
     * Gets dependent RoutingPatternGroupsRelPatterns_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\RoutingPatternGroupsRelPatterns
     */
    public function getRoutingPatternGroupsRelPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RoutingPatternGroupsRelPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_RoutingPatternGroupsRelPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_RoutingPatternGroupsRelPatterns;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\RoutingPatterns
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\RoutingPatterns')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\RoutingPatterns);

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
     * @return null | \IvozProvider\Model\Validator\RoutingPatterns
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\RoutingPatterns')) {

                $this->setValidator(new \IvozProvider\Validator\RoutingPatterns);
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
     * @see \Mapper\Sql\RoutingPatterns::delete
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