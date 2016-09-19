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
class LcrRuleTargets extends ModelAbstract
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
    protected $_companyId;

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
     * Database var type int
     *
     * @var int
     */
    protected $_outgoingRoutingId;


    /**
     * Parent relation LcrRuleTargets_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation LcrRuleTargets_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\LcrRules
     */
    protected $_Rule;

    /**
     * Parent relation LcrRuleTargets_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\LcrGateways
     */
    protected $_Gw;

    /**
     * Parent relation LcrRuleTargets_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\OutgoingRouting
     */
    protected $_OutgoingRouting;


    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'rule_id'=>'ruleId',
        'gw_id'=>'gwId',
        'priority'=>'priority',
        'weight'=>'weight',
        'outgoingRoutingId'=>'outgoingRoutingId',
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
            'LcrRuleTargetsIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'LcrRuleTargetsIbfk2'=> array(
                    'property' => 'Rule',
                    'table_name' => 'LcrRules',
                ),
            'LcrRuleTargetsIbfk3'=> array(
                    'property' => 'Gw',
                    'table_name' => 'LcrGateways',
                ),
            'LcrRuleTargetsIbfk4'=> array(
                    'property' => 'OutgoingRouting',
                    'table_name' => 'OutgoingRouting',
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
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
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
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_companyId != $data) {
            $this->_logChange('companyId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_companyId = $data;

        } else if (!is_null($data)) {
            $this->_companyId = (int) $data;

        } else {
            $this->_companyId = $data;
        }
        return $this;
    }

    /**
     * Gets column companyId
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->_companyId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
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
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
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
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
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
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
     */
    public function setOutgoingRoutingId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_outgoingRoutingId != $data) {
            $this->_logChange('outgoingRoutingId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outgoingRoutingId = $data;

        } else if (!is_null($data)) {
            $this->_outgoingRoutingId = (int) $data;

        } else {
            $this->_outgoingRoutingId = $data;
        }
        return $this;
    }

    /**
     * Gets column outgoingRoutingId
     *
     * @return int
     */
    public function getOutgoingRoutingId()
    {
        return $this->_outgoingRoutingId;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
     */
    public function setCompany(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_Company = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCompanyId($primaryKey);
        }

        $this->_setLoaded('LcrRuleTargetsIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Company = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Company;
    }

    /**
     * Sets parent relation Rule
     *
     * @param \IvozProvider\Model\Raw\LcrRules $data
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
     */
    public function setRule(\IvozProvider\Model\Raw\LcrRules $data)
    {
        $this->_Rule = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setRuleId($primaryKey);
        }

        $this->_setLoaded('LcrRuleTargetsIbfk2');
        return $this;
    }

    /**
     * Gets parent Rule
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function getRule($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetsIbfk2';

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
     * Sets parent relation Gw
     *
     * @param \IvozProvider\Model\Raw\LcrGateways $data
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
     */
    public function setGw(\IvozProvider\Model\Raw\LcrGateways $data)
    {
        $this->_Gw = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setGwId($primaryKey);
        }

        $this->_setLoaded('LcrRuleTargetsIbfk3');
        return $this;
    }

    /**
     * Gets parent Gw
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\LcrGateways
     */
    public function getGw($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetsIbfk3';

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
     * Sets parent relation OutgoingRouting
     *
     * @param \IvozProvider\Model\Raw\OutgoingRouting $data
     * @return \IvozProvider\Model\Raw\LcrRuleTargets
     */
    public function setOutgoingRouting(\IvozProvider\Model\Raw\OutgoingRouting $data)
    {
        $this->_OutgoingRouting = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutgoingRoutingId($primaryKey);
        }

        $this->_setLoaded('LcrRuleTargetsIbfk4');
        return $this;
    }

    /**
     * Gets parent OutgoingRouting
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\OutgoingRouting
     */
    public function getOutgoingRouting($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetsIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingRouting = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_OutgoingRouting;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\LcrRuleTargets
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\LcrRuleTargets')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\LcrRuleTargets);

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
     * @return null | \IvozProvider\Model\Validator\LcrRuleTargets
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\LcrRuleTargets')) {

                $this->setValidator(new \IvozProvider\Validator\LcrRuleTargets);
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
     * @see \Mapper\Sql\LcrRuleTargets::delete
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