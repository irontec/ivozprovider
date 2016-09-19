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
class PricingPlansRelTargetPatterns extends ModelAbstract
{


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type decimal
     *
     * @var float
     */
    protected $_connectionCharge;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_periodTime;

    /**
     * Database var type decimal
     *
     * @var float
     */
    protected $_perPeriodCharge;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_pricingPlanId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_targetPatternId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;


    /**
     * Parent relation PricingPlansRelTargetPatterns_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\PricingPlans
     */
    protected $_PricingPlan;

    /**
     * Parent relation PricingPlansRelTargetPatterns_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\TargetPatterns
     */
    protected $_TargetPattern;

    /**
     * Parent relation PricingPlansRelTargetPatterns_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;


    protected $_columnsList = array(
        'id'=>'id',
        'connectionCharge'=>'connectionCharge',
        'periodTime'=>'periodTime',
        'perPeriodCharge'=>'perPeriodCharge',
        'pricingPlanId'=>'pricingPlanId',
        'targetPatternId'=>'targetPatternId',
        'brandId'=>'brandId',
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
            'PricingPlansRelTargetPatternsIbfk1'=> array(
                    'property' => 'PricingPlan',
                    'table_name' => 'PricingPlans',
                ),
            'PricingPlansRelTargetPatternsIbfk2'=> array(
                    'property' => 'TargetPattern',
                    'table_name' => 'TargetPatterns',
                ),
            'PricingPlansRelTargetPatternsIbfk3'=> array(
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
     * @return \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
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
     * @param float $data
     * @return \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     */
    public function setConnectionCharge($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_connectionCharge != $data) {
            $this->_logChange('connectionCharge');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_connectionCharge = $data;

        } else if (!is_null($data)) {
            $this->_connectionCharge = (float) $data;

        } else {
            $this->_connectionCharge = $data;
        }
        return $this;
    }

    /**
     * Gets column connectionCharge
     *
     * @return float
     */
    public function getConnectionCharge()
    {
        return $this->_connectionCharge;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     */
    public function setPeriodTime($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_periodTime != $data) {
            $this->_logChange('periodTime');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_periodTime = $data;

        } else if (!is_null($data)) {
            $this->_periodTime = (int) $data;

        } else {
            $this->_periodTime = $data;
        }
        return $this;
    }

    /**
     * Gets column periodTime
     *
     * @return int
     */
    public function getPeriodTime()
    {
        return $this->_periodTime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     */
    public function setPerPeriodCharge($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_perPeriodCharge != $data) {
            $this->_logChange('perPeriodCharge');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_perPeriodCharge = $data;

        } else if (!is_null($data)) {
            $this->_perPeriodCharge = (float) $data;

        } else {
            $this->_perPeriodCharge = $data;
        }
        return $this;
    }

    /**
     * Gets column perPeriodCharge
     *
     * @return float
     */
    public function getPerPeriodCharge()
    {
        return $this->_perPeriodCharge;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     */
    public function setPricingPlanId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_pricingPlanId != $data) {
            $this->_logChange('pricingPlanId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pricingPlanId = $data;

        } else if (!is_null($data)) {
            $this->_pricingPlanId = (int) $data;

        } else {
            $this->_pricingPlanId = $data;
        }
        return $this;
    }

    /**
     * Gets column pricingPlanId
     *
     * @return int
     */
    public function getPricingPlanId()
    {
        return $this->_pricingPlanId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     */
    public function setTargetPatternId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_targetPatternId != $data) {
            $this->_logChange('targetPatternId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_targetPatternId = $data;

        } else if (!is_null($data)) {
            $this->_targetPatternId = (int) $data;

        } else {
            $this->_targetPatternId = $data;
        }
        return $this;
    }

    /**
     * Gets column targetPatternId
     *
     * @return int
     */
    public function getTargetPatternId()
    {
        return $this->_targetPatternId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
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
     * Sets parent relation PricingPlan
     *
     * @param \IvozProvider\Model\Raw\PricingPlans $data
     * @return \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     */
    public function setPricingPlan(\IvozProvider\Model\Raw\PricingPlans $data)
    {
        $this->_PricingPlan = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPricingPlanId($primaryKey);
        }

        $this->_setLoaded('PricingPlansRelTargetPatternsIbfk1');
        return $this;
    }

    /**
     * Gets parent PricingPlan
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\PricingPlans
     */
    public function getPricingPlan($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PricingPlansRelTargetPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PricingPlan = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PricingPlan;
    }

    /**
     * Sets parent relation TargetPattern
     *
     * @param \IvozProvider\Model\Raw\TargetPatterns $data
     * @return \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
     */
    public function setTargetPattern(\IvozProvider\Model\Raw\TargetPatterns $data)
    {
        $this->_TargetPattern = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTargetPatternId($primaryKey);
        }

        $this->_setLoaded('PricingPlansRelTargetPatternsIbfk2');
        return $this;
    }

    /**
     * Gets parent TargetPattern
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function getTargetPattern($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PricingPlansRelTargetPatternsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TargetPattern = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TargetPattern;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\PricingPlansRelTargetPatterns
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

        $this->_setLoaded('PricingPlansRelTargetPatternsIbfk3');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PricingPlansRelTargetPatternsIbfk3';

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
     * @return IvozProvider\Mapper\Sql\PricingPlansRelTargetPatterns
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\PricingPlansRelTargetPatterns')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\PricingPlansRelTargetPatterns);

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
     * @return null | \IvozProvider\Model\Validator\PricingPlansRelTargetPatterns
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\PricingPlansRelTargetPatterns')) {

                $this->setValidator(new \IvozProvider\Validator\PricingPlansRelTargetPatterns);
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
     * @see \Mapper\Sql\PricingPlansRelTargetPatterns::delete
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