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
class PeeringContractsRelLcrRules extends ModelAbstract
{


    /**
     * [uuid:php]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_lcrRuleId;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_peeringContractId;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_priority;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_weight;


    /**
     * Parent relation PeeringContractsRelLcrRules_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\LcrRules
     */
    protected $_LcrRule;

    /**
     * Parent relation PeeringContractsRelLcrRules_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\PeeringContracts
     */
    protected $_PeeringContract;

    /**
     * Parent relation PeeringContractsRelLcrRules_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;


    /**
     * Dependent relation LcrRuleTarget_ibfk_5
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\LcrRuleTarget[]
     */
    protected $_LcrRuleTarget;

    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
        'lcrRuleId'=>'lcrRuleId',
        'peeringContractId'=>'peeringContractId',
        'priority'=>'priority',
        'weight'=>'weight',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid:php'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'PeeringContractsRelLcrRulesIbfk1'=> array(
                    'property' => 'LcrRule',
                    'table_name' => 'LcrRules',
                ),
            'PeeringContractsRelLcrRulesIbfk2'=> array(
                    'property' => 'PeeringContract',
                    'table_name' => 'PeeringContracts',
                ),
            'PeeringContractsRelLcrRulesIbfk3'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
        ));

        $this->setDependentList(array(
            'LcrRuleTargetIbfk5' => array(
                    'property' => 'LcrRuleTarget',
                    'table_name' => 'LcrRuleTarget',
                ),
        ));




        $this->_defaultValues = array(
            'weight' => '1',
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
     * @param binary $data
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        $this->_id = $data;
        return $this;
    }

    /**
     * Gets column id
     *
     * @return binary
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
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
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     */
    public function setLcrRuleId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_lcrRuleId != $data) {
            $this->_logChange('lcrRuleId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_lcrRuleId = $data;

        } else if (!is_null($data)) {
            $this->_lcrRuleId = (int) $data;

        } else {
            $this->_lcrRuleId = $data;
        }
        return $this;
    }

    /**
     * Gets column lcrRuleId
     *
     * @return int
     */
    public function getLcrRuleId()
    {
        return $this->_lcrRuleId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     */
    public function setPeeringContractId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_peeringContractId != $data) {
            $this->_logChange('peeringContractId');
        }

        $this->_peeringContractId = $data;
        return $this;
    }

    /**
     * Gets column peeringContractId
     *
     * @return binary
     */
    public function getPeeringContractId()
    {
        return $this->_peeringContractId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     */
    public function setPriority($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_priority != $data) {
            $this->_logChange('priority');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_priority = $data;

        } else if (!is_null($data)) {
            $this->_priority = (int) $data;

        } else {
            $this->_priority = $data;
        }
        return $this;
    }

    /**
     * Gets column priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->_priority;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     */
    public function setWeight($data)
    {

        if ($this->_weight != $data) {
            $this->_logChange('weight');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_weight = $data;

        } else if (!is_null($data)) {
            $this->_weight = (int) $data;

        } else {
            $this->_weight = $data;
        }
        return $this;
    }

    /**
     * Gets column weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->_weight;
    }

    /**
     * Sets parent relation LcrRule
     *
     * @param \IvozProvider\Model\Raw\LcrRules $data
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     */
    public function setLcrRule(\IvozProvider\Model\Raw\LcrRules $data)
    {
        $this->_LcrRule = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setLcrRuleId($primaryKey);
        }

        $this->_setLoaded('PeeringContractsRelLcrRulesIbfk1');
        return $this;
    }

    /**
     * Gets parent LcrRule
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function getLcrRule($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeeringContractsRelLcrRulesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_LcrRule = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_LcrRule;
    }

    /**
     * Sets parent relation PeeringContract
     *
     * @param \IvozProvider\Model\Raw\PeeringContracts $data
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     */
    public function setPeeringContract(\IvozProvider\Model\Raw\PeeringContracts $data)
    {
        $this->_PeeringContract = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPeeringContractId($primaryKey);
        }

        $this->_setLoaded('PeeringContractsRelLcrRulesIbfk2');
        return $this;
    }

    /**
     * Gets parent PeeringContract
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function getPeeringContract($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeeringContractsRelLcrRulesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PeeringContract = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PeeringContract;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
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

        $this->_setLoaded('PeeringContractsRelLcrRulesIbfk3');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeeringContractsRelLcrRulesIbfk3';

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
     * Sets dependent relations LcrRuleTarget_ibfk_5
     *
     * @param array $data An array of \IvozProvider\Model\Raw\LcrRuleTarget
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     */
    public function setLcrRuleTarget(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_LcrRuleTarget === null) {

                $this->getLcrRuleTarget();
            }

            $oldRelations = $this->_LcrRuleTarget;

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

        $this->_LcrRuleTarget = array();

        foreach ($data as $object) {
            $this->addLcrRuleTarget($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations LcrRuleTarget_ibfk_5
     *
     * @param \IvozProvider\Model\Raw\LcrRuleTarget $data
     * @return \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     */
    public function addLcrRuleTarget(\IvozProvider\Model\Raw\LcrRuleTarget $data)
    {
        $this->_LcrRuleTarget[] = $data;
        $this->_setLoaded('LcrRuleTargetIbfk5');
        return $this;
    }

    /**
     * Gets dependent LcrRuleTarget_ibfk_5
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\LcrRuleTarget
     */
    public function getLcrRuleTarget($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_LcrRuleTarget = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_LcrRuleTarget;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\PeeringContractsRelLcrRules
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\PeeringContractsRelLcrRules')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\PeeringContractsRelLcrRules);

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
     * @return null | \IvozProvider\Model\Validator\PeeringContractsRelLcrRules
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\PeeringContractsRelLcrRules')) {

                $this->setValidator(new \IvozProvider\Validator\PeeringContractsRelLcrRules);
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
     * @see \Mapper\Sql\PeeringContractsRelLcrRules::delete
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