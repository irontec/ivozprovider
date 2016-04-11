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
 * [entity]
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model\Raw;
class KamTrunksLcrRuleTarget extends ModelAbstract
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
    protected $_lcrId;

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
     * Parent relation kam_trunks_lcr_rule_target_ibfk_1
     *
     * @var \Oasis\Model\Raw\Brands
     */
    protected $_Lcr;



    protected $_columnsList = array(
        'id'=>'id',
        'lcr_id'=>'lcrId',
        'rule_id'=>'ruleId',
        'gw_id'=>'gwId',
        'priority'=>'priority',
        'weight'=>'weight',
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
            'KamTrunksLcrRuleTargetIbfk1'=> array(
                    'property' => 'Lcr',
                    'table_name' => 'Brands',
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
     * @return \Oasis\Model\Raw\KamTrunksLcrRuleTarget
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\KamTrunksLcrRuleTarget
     */
    public function setLcrId($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_lcrId != $data) {
            $this->_logChange('lcrId');
        }

        if (!is_null($data)) {
            $this->_lcrId = (int) $data;
        } else {
            $this->_lcrId = $data;
        }
        return $this;
    }

    /**
     * Gets column lcr_id
     *
     * @return int
     */
    public function getLcrId()
    {
            return $this->_lcrId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLcrRuleTarget
     */
    public function setRuleId($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_ruleId != $data) {
            $this->_logChange('ruleId');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\KamTrunksLcrRuleTarget
     */
    public function setGwId($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_gwId != $data) {
            $this->_logChange('gwId');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\KamTrunksLcrRuleTarget
     */
    public function setPriority($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_priority != $data) {
            $this->_logChange('priority');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\KamTrunksLcrRuleTarget
     */
    public function setWeight($data)
    {

        if ($this->_weight != $data) {
            $this->_logChange('weight');
        }

        if (!is_null($data)) {
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
     * Sets parent relation Lcr
     *
     * @param \Oasis\Model\Raw\Brands $data
     * @return \Oasis\Model\Raw\KamTrunksLcrRuleTarget
     */
    public function setLcr(\Oasis\Model\Raw\Brands $data)
    {
        $this->_Lcr = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['iden'];
        }

        if (!is_null($primaryKey)) {
            $this->setLcrId($primaryKey);
        }

        $this->_setLoaded('KamTrunksLcrRuleTargetIbfk1');
        return $this;
    }

    /**
     * Gets parent Lcr
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Brands
     */
    public function getLcr($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamTrunksLcrRuleTargetIbfk1';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Lcr = array_shift($related);
            $this->_setLoaded($fkName);
        }

        return $this->_Lcr;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamTrunksLcrRuleTarget
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamTrunksLcrRuleTarget')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamTrunksLcrRuleTarget);

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
     * @return null | \Oasis\Model\Validator\KamTrunksLcrRuleTarget
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamTrunksLcrRuleTarget')) {

                $this->setValidator(new \Oasis\Validator\KamTrunksLcrRuleTarget);
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
     * @see \Mapper\Sql\KamTrunksLcrRuleTarget::delete
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
}
