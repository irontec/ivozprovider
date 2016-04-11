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
 * 
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model\Raw;
class LcrRuleTarget extends ModelAbstract
{


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
    protected $_brandId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_ruleId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_gwId;

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
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_peeringContractsRelLcrRulesId;


    /**
     * Parent relation LcrRuleTarget_ibfk_2
     *
     * @var \Oasis\Model\Raw\LcrRules
     */
    protected $_Rule;

    /**
     * Parent relation LcrRuleTarget_ibfk_3
     *
     * @var \Oasis\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation LcrRuleTarget_ibfk_4
     *
     * @var \Oasis\Model\Raw\PeerServers
     */
    protected $_Gw;

    /**
     * Parent relation LcrRuleTarget_ibfk_5
     *
     * @var \Oasis\Model\Raw\PeeringContractsRelLcrRules
     */
    protected $_PeeringContractsRelLcrRules;


    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
        'rule_id'=>'ruleId',
        'gw_id'=>'gwId',
        'priority'=>'priority',
        'weight'=>'weight',
        'peeringContractsRelLcrRulesId'=>'peeringContractsRelLcrRulesId',
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
            'LcrRuleTargetIbfk2'=> array(
                    'property' => 'Rule',
                    'table_name' => 'LcrRules',
                ),
            'LcrRuleTargetIbfk3'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'LcrRuleTargetIbfk4'=> array(
                    'property' => 'Gw',
                    'table_name' => 'PeerServers',
                ),
            'LcrRuleTargetIbfk5'=> array(
                    'property' => 'PeeringContractsRelLcrRules',
                    'table_name' => 'PeeringContractsRelLcrRules',
                ),
        ));

        $this->setDependentList(array(
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
     * @param int $data
     * @return \Oasis\Model\Raw\LcrRuleTarget
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
     * @return \Oasis\Model\Raw\LcrRuleTarget
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
     * @return \Oasis\Model\Raw\LcrRuleTarget
     */
    public function setRuleId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_ruleId != $data) {
            $this->_logChange('ruleId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ruleId = $data;

        } else if (!is_null($data)) {
            $this->_ruleId = (int) $data;

        } else {
            $this->_ruleId = $data;
        }
        return $this;
    }

    /**
     * Gets column rule_id
     *
     * @return int
     */
    public function getRuleId()
    {
        return $this->_ruleId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\LcrRuleTarget
     */
    public function setGwId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_gwId != $data) {
            $this->_logChange('gwId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_gwId = $data;

        } else if (!is_null($data)) {
            $this->_gwId = (int) $data;

        } else {
            $this->_gwId = $data;
        }
        return $this;
    }

    /**
     * Gets column gw_id
     *
     * @return int
     */
    public function getGwId()
    {
        return $this->_gwId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\LcrRuleTarget
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
     * @return \Oasis\Model\Raw\LcrRuleTarget
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
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \Oasis\Model\Raw\LcrRuleTarget
     */
    public function setPeeringContractsRelLcrRulesId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_peeringContractsRelLcrRulesId != $data) {
            $this->_logChange('peeringContractsRelLcrRulesId');
        }

        $this->_peeringContractsRelLcrRulesId = $data;
        return $this;
    }

    /**
     * Gets column peeringContractsRelLcrRulesId
     *
     * @return binary
     */
    public function getPeeringContractsRelLcrRulesId()
    {
        return $this->_peeringContractsRelLcrRulesId;
    }

    /**
     * Sets parent relation Rule
     *
     * @param \Oasis\Model\Raw\LcrRules $data
     * @return \Oasis\Model\Raw\LcrRuleTarget
     */
    public function setRule(\Oasis\Model\Raw\LcrRules $data)
    {
        $this->_Rule = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setRuleId($primaryKey);
        }

        $this->_setLoaded('LcrRuleTargetIbfk2');
        return $this;
    }

    /**
     * Gets parent Rule
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\LcrRules
     */
    public function getRule($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Rule = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Rule;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \Oasis\Model\Raw\Brands $data
     * @return \Oasis\Model\Raw\LcrRuleTarget
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

        $this->_setLoaded('LcrRuleTargetIbfk3');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetIbfk3';

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
     * Sets parent relation Gw
     *
     * @param \Oasis\Model\Raw\PeerServers $data
     * @return \Oasis\Model\Raw\LcrRuleTarget
     */
    public function setGw(\Oasis\Model\Raw\PeerServers $data)
    {
        $this->_Gw = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setGwId($primaryKey);
        }

        $this->_setLoaded('LcrRuleTargetIbfk4');
        return $this;
    }

    /**
     * Gets parent Gw
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\PeerServers
     */
    public function getGw($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Gw = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Gw;
    }

    /**
     * Sets parent relation PeeringContractsRelLcrRules
     *
     * @param \Oasis\Model\Raw\PeeringContractsRelLcrRules $data
     * @return \Oasis\Model\Raw\LcrRuleTarget
     */
    public function setPeeringContractsRelLcrRules(\Oasis\Model\Raw\PeeringContractsRelLcrRules $data)
    {
        $this->_PeeringContractsRelLcrRules = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPeeringContractsRelLcrRulesId($primaryKey);
        }

        $this->_setLoaded('LcrRuleTargetIbfk5');
        return $this;
    }

    /**
     * Gets parent PeeringContractsRelLcrRules
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\PeeringContractsRelLcrRules
     */
    public function getPeeringContractsRelLcrRules($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PeeringContractsRelLcrRules = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PeeringContractsRelLcrRules;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\LcrRuleTarget
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\LcrRuleTarget')) {

                $this->setMapper(new \Oasis\Mapper\Sql\LcrRuleTarget);

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
     * @return null | \Oasis\Model\Validator\LcrRuleTarget
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\LcrRuleTarget')) {

                $this->setValidator(new \Oasis\Validator\LcrRuleTarget);
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
     * @see \Mapper\Sql\LcrRuleTarget::delete
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