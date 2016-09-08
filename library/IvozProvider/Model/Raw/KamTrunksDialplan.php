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
class KamTrunksDialplan extends ModelAbstract
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
    protected $_dpid;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_pr;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_matchOp;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_matchExp;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_matchLen;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_substExp;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_replExp;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_attrs;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_transformationRulesetGroupsTrunksId;


    /**
     * Parent relation kam_trunks_dialplan_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    protected $_TransformationRulesetGroupsTrunks;


    protected $_columnsList = array(
        'id'=>'id',
        'dpid'=>'dpid',
        'pr'=>'pr',
        'match_op'=>'matchOp',
        'match_exp'=>'matchExp',
        'match_len'=>'matchLen',
        'subst_exp'=>'substExp',
        'repl_exp'=>'replExp',
        'attrs'=>'attrs',
        'transformationRulesetGroupsTrunksId'=>'transformationRulesetGroupsTrunksId',
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
            'KamTrunksDialplanIbfk2'=> array(
                    'property' => 'TransformationRulesetGroupsTrunks',
                    'table_name' => 'TransformationRulesetGroupsTrunks',
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
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
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
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function setDpid($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_dpid != $data) {
            $this->_logChange('dpid', $this->_dpid, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_dpid = $data;

        } else if (!is_null($data)) {
            $this->_dpid = (int) $data;

        } else {
            $this->_dpid = $data;
        }
        return $this;
    }

    /**
     * Gets column dpid
     *
     * @return int
     */
    public function getDpid()
    {
        return $this->_dpid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function setPr($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_pr != $data) {
            $this->_logChange('pr', $this->_pr, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pr = $data;

        } else if (!is_null($data)) {
            $this->_pr = (int) $data;

        } else {
            $this->_pr = $data;
        }
        return $this;
    }

    /**
     * Gets column pr
     *
     * @return int
     */
    public function getPr()
    {
        return $this->_pr;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function setMatchOp($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_matchOp != $data) {
            $this->_logChange('matchOp', $this->_matchOp, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_matchOp = $data;

        } else if (!is_null($data)) {
            $this->_matchOp = (int) $data;

        } else {
            $this->_matchOp = $data;
        }
        return $this;
    }

    /**
     * Gets column match_op
     *
     * @return int
     */
    public function getMatchOp()
    {
        return $this->_matchOp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function setMatchExp($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_matchExp != $data) {
            $this->_logChange('matchExp', $this->_matchExp, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_matchExp = $data;

        } else if (!is_null($data)) {
            $this->_matchExp = (string) $data;

        } else {
            $this->_matchExp = $data;
        }
        return $this;
    }

    /**
     * Gets column match_exp
     *
     * @return string
     */
    public function getMatchExp()
    {
        return $this->_matchExp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function setMatchLen($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_matchLen != $data) {
            $this->_logChange('matchLen', $this->_matchLen, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_matchLen = $data;

        } else if (!is_null($data)) {
            $this->_matchLen = (int) $data;

        } else {
            $this->_matchLen = $data;
        }
        return $this;
    }

    /**
     * Gets column match_len
     *
     * @return int
     */
    public function getMatchLen()
    {
        return $this->_matchLen;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function setSubstExp($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_substExp != $data) {
            $this->_logChange('substExp', $this->_substExp, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_substExp = $data;

        } else if (!is_null($data)) {
            $this->_substExp = (string) $data;

        } else {
            $this->_substExp = $data;
        }
        return $this;
    }

    /**
     * Gets column subst_exp
     *
     * @return string
     */
    public function getSubstExp()
    {
        return $this->_substExp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function setReplExp($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_replExp != $data) {
            $this->_logChange('replExp', $this->_replExp, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_replExp = $data;

        } else if (!is_null($data)) {
            $this->_replExp = (string) $data;

        } else {
            $this->_replExp = $data;
        }
        return $this;
    }

    /**
     * Gets column repl_exp
     *
     * @return string
     */
    public function getReplExp()
    {
        return $this->_replExp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function setAttrs($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_attrs != $data) {
            $this->_logChange('attrs', $this->_attrs, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_attrs = $data;

        } else if (!is_null($data)) {
            $this->_attrs = (string) $data;

        } else {
            $this->_attrs = $data;
        }
        return $this;
    }

    /**
     * Gets column attrs
     *
     * @return string
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function setTransformationRulesetGroupsTrunksId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_transformationRulesetGroupsTrunksId != $data) {
            $this->_logChange('transformationRulesetGroupsTrunksId', $this->_transformationRulesetGroupsTrunksId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_transformationRulesetGroupsTrunksId = $data;

        } else if (!is_null($data)) {
            $this->_transformationRulesetGroupsTrunksId = (int) $data;

        } else {
            $this->_transformationRulesetGroupsTrunksId = $data;
        }
        return $this;
    }

    /**
     * Gets column transformationRulesetGroupsTrunksId
     *
     * @return int
     */
    public function getTransformationRulesetGroupsTrunksId()
    {
        return $this->_transformationRulesetGroupsTrunksId;
    }

    /**
     * Sets parent relation TransformationRulesetGroupsTrunks
     *
     * @param \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks $data
     * @return \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function setTransformationRulesetGroupsTrunks(\IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks $data)
    {
        $this->_TransformationRulesetGroupsTrunks = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTransformationRulesetGroupsTrunksId($primaryKey);
        }

        $this->_setLoaded('KamTrunksDialplanIbfk2');
        return $this;
    }

    /**
     * Gets parent TransformationRulesetGroupsTrunks
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function getTransformationRulesetGroupsTrunks($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamTrunksDialplanIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TransformationRulesetGroupsTrunks = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TransformationRulesetGroupsTrunks;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\KamTrunksDialplan
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\KamTrunksDialplan')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\KamTrunksDialplan);

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
     * @return null | \IvozProvider\Model\Validator\KamTrunksDialplan
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\KamTrunksDialplan')) {

                $this->setValidator(new \IvozProvider\Validator\KamTrunksDialplan);
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
     * @see \Mapper\Sql\KamTrunksDialplan::delete
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