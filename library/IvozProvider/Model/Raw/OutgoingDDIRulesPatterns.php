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
class OutgoingDDIRulesPatterns extends ModelAbstract
{

    protected $_actionAcceptedValues = array(
        'keep',
        'force',
    );

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
    protected $_outgoingDDIRuleId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_matchListId;

    /**
     * [enum:keep|force]
     * Database var type varchar
     *
     * @var string
     */
    protected $_action;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_forcedDDIId;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_priority;


    /**
     * Parent relation OutgoingDDIRulesPatterns_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    protected $_OutgoingDDIRule;

    /**
     * Parent relation OutgoingDDIRulesPatterns_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\MatchLists
     */
    protected $_MatchList;

    /**
     * Parent relation OutgoingDDIRulesPatterns_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\DDIs
     */
    protected $_ForcedDDI;


    protected $_columnsList = array(
        'id'=>'id',
        'outgoingDDIRuleId'=>'outgoingDDIRuleId',
        'matchListId'=>'matchListId',
        'action'=>'action',
        'forcedDDIId'=>'forcedDDIId',
        'priority'=>'priority',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'action'=> array('enum:keep|force'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'OutgoingDDIRulesPatternsIbfk1'=> array(
                    'property' => 'OutgoingDDIRule',
                    'table_name' => 'OutgoingDDIRules',
                ),
            'OutgoingDDIRulesPatternsIbfk2'=> array(
                    'property' => 'MatchList',
                    'table_name' => 'MatchLists',
                ),
            'OutgoingDDIRulesPatternsIbfk3'=> array(
                    'property' => 'ForcedDDI',
                    'table_name' => 'DDIs',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'priority' => '1',
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
     * @return \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function setOutgoingDDIRuleId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_outgoingDDIRuleId != $data) {
            $this->_logChange('outgoingDDIRuleId', $this->_outgoingDDIRuleId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outgoingDDIRuleId = $data;

        } else if (!is_null($data)) {
            $this->_outgoingDDIRuleId = (int) $data;

        } else {
            $this->_outgoingDDIRuleId = $data;
        }
        return $this;
    }

    /**
     * Gets column outgoingDDIRuleId
     *
     * @return int
     */
    public function getOutgoingDDIRuleId()
    {
        return $this->_outgoingDDIRuleId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function setMatchListId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_matchListId != $data) {
            $this->_logChange('matchListId', $this->_matchListId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_matchListId = $data;

        } else if (!is_null($data)) {
            $this->_matchListId = (int) $data;

        } else {
            $this->_matchListId = $data;
        }
        return $this;
    }

    /**
     * Gets column matchListId
     *
     * @return int
     */
    public function getMatchListId()
    {
        return $this->_matchListId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function setAction($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_action != $data) {
            $this->_logChange('action', $this->_action, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_action = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_actionAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for action'));
            }
            $this->_action = (string) $data;

        } else {
            $this->_action = $data;
        }
        return $this;
    }

    /**
     * Gets column action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function setForcedDDIId($data)
    {

        if ($this->_forcedDDIId != $data) {
            $this->_logChange('forcedDDIId', $this->_forcedDDIId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_forcedDDIId = $data;

        } else if (!is_null($data)) {
            $this->_forcedDDIId = (int) $data;

        } else {
            $this->_forcedDDIId = $data;
        }
        return $this;
    }

    /**
     * Gets column forcedDDIId
     *
     * @return int
     */
    public function getForcedDDIId()
    {
        return $this->_forcedDDIId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function setPriority($data)
    {

        if ($this->_priority != $data) {
            $this->_logChange('priority', $this->_priority, $data);
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
     * Sets parent relation OutgoingDDIRule
     *
     * @param \IvozProvider\Model\Raw\OutgoingDDIRules $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function setOutgoingDDIRule(\IvozProvider\Model\Raw\OutgoingDDIRules $data)
    {
        $this->_OutgoingDDIRule = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutgoingDDIRuleId($primaryKey);
        }

        $this->_setLoaded('OutgoingDDIRulesPatternsIbfk1');
        return $this;
    }

    /**
     * Gets parent OutgoingDDIRule
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function getOutgoingDDIRule($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingDDIRulesPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingDDIRule = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_OutgoingDDIRule;
    }

    /**
     * Sets parent relation MatchList
     *
     * @param \IvozProvider\Model\Raw\MatchLists $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function setMatchList(\IvozProvider\Model\Raw\MatchLists $data)
    {
        $this->_MatchList = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setMatchListId($primaryKey);
        }

        $this->_setLoaded('OutgoingDDIRulesPatternsIbfk2');
        return $this;
    }

    /**
     * Gets parent MatchList
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function getMatchList($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingDDIRulesPatternsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_MatchList = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_MatchList;
    }

    /**
     * Sets parent relation ForcedDDI
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function setForcedDDI(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_ForcedDDI = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setForcedDDIId($primaryKey);
        }

        $this->_setLoaded('OutgoingDDIRulesPatternsIbfk3');
        return $this;
    }

    /**
     * Gets parent ForcedDDI
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function getForcedDDI($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingDDIRulesPatternsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ForcedDDI = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ForcedDDI;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\OutgoingDDIRulesPatterns
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\OutgoingDDIRulesPatterns')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\OutgoingDDIRulesPatterns);

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
     * @return null | \IvozProvider\Model\Validator\OutgoingDDIRulesPatterns
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\OutgoingDDIRulesPatterns')) {

                $this->setValidator(new \IvozProvider\Validator\OutgoingDDIRulesPatterns);
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
     * @see \Mapper\Sql\OutgoingDDIRulesPatterns::delete
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