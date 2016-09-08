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
class LcrRules extends ModelAbstract
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
     * Database var type varchar
     *
     * @var string
     */
    protected $_prefix;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromUri;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_requestUri;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_stopper;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_enabled;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tag;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_description;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_routingPatternId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_outgoingRoutingId;


    /**
     * Parent relation LcrRules_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation LcrRules_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\OutgoingRouting
     */
    protected $_OutgoingRouting;

    /**
     * Parent relation LcrRules_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\RoutingPatterns
     */
    protected $_RoutingPattern;


    /**
     * Dependent relation LcrRuleTargets_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\LcrRuleTargets[]
     */
    protected $_LcrRuleTargets;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'prefix'=>'prefix',
        'from_uri'=>'fromUri',
        'request_uri'=>'requestUri',
        'stopper'=>'stopper',
        'enabled'=>'enabled',
        'tag'=>'tag',
        'description'=>'description',
        'routingPatternId'=>'routingPatternId',
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
            'LcrRulesIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'LcrRulesIbfk3'=> array(
                    'property' => 'OutgoingRouting',
                    'table_name' => 'OutgoingRouting',
                ),
            'LcrRulesIbfk4'=> array(
                    'property' => 'RoutingPattern',
                    'table_name' => 'RoutingPatterns',
                ),
        ));

        $this->setDependentList(array(
            'LcrRuleTargetsIbfk2' => array(
                    'property' => 'LcrRuleTargets',
                    'table_name' => 'LcrRuleTargets',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'LcrRuleTargets_ibfk_2'
        ));



        $this->_defaultValues = array(
            'stopper' => '0',
            'enabled' => '1',
            'description' => '',
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
     * @return \IvozProvider\Model\Raw\LcrRules
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
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_companyId != $data) {
            $this->_logChange('companyId', $this->_companyId, $data);
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setPrefix($data)
    {

        if ($this->_prefix != $data) {
            $this->_logChange('prefix', $this->_prefix, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_prefix = $data;

        } else if (!is_null($data)) {
            $this->_prefix = (string) $data;

        } else {
            $this->_prefix = $data;
        }
        return $this;
    }

    /**
     * Gets column prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->_prefix;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setFromUri($data)
    {

        if ($this->_fromUri != $data) {
            $this->_logChange('fromUri', $this->_fromUri, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fromUri = $data;

        } else if (!is_null($data)) {
            $this->_fromUri = (string) $data;

        } else {
            $this->_fromUri = $data;
        }
        return $this;
    }

    /**
     * Gets column from_uri
     *
     * @return string
     */
    public function getFromUri()
    {
        return $this->_fromUri;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setRequestUri($data)
    {

        if ($this->_requestUri != $data) {
            $this->_logChange('requestUri', $this->_requestUri, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_requestUri = $data;

        } else if (!is_null($data)) {
            $this->_requestUri = (string) $data;

        } else {
            $this->_requestUri = $data;
        }
        return $this;
    }

    /**
     * Gets column request_uri
     *
     * @return string
     */
    public function getRequestUri()
    {
        return $this->_requestUri;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setStopper($data)
    {

        if ($this->_stopper != $data) {
            $this->_logChange('stopper', $this->_stopper, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_stopper = $data;

        } else if (!is_null($data)) {
            $this->_stopper = (int) $data;

        } else {
            $this->_stopper = $data;
        }
        return $this;
    }

    /**
     * Gets column stopper
     *
     * @return int
     */
    public function getStopper()
    {
        return $this->_stopper;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setEnabled($data)
    {

        if ($this->_enabled != $data) {
            $this->_logChange('enabled', $this->_enabled, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_enabled = $data;

        } else if (!is_null($data)) {
            $this->_enabled = (int) $data;

        } else {
            $this->_enabled = $data;
        }
        return $this;
    }

    /**
     * Gets column enabled
     *
     * @return int
     */
    public function getEnabled()
    {
        return $this->_enabled;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setTag($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_tag != $data) {
            $this->_logChange('tag', $this->_tag, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tag = $data;

        } else if (!is_null($data)) {
            $this->_tag = (string) $data;

        } else {
            $this->_tag = $data;
        }
        return $this;
    }

    /**
     * Gets column tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->_tag;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setDescription($data)
    {

        if ($this->_description != $data) {
            $this->_logChange('description', $this->_description, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_description = $data;

        } else if (!is_null($data)) {
            $this->_description = (string) $data;

        } else {
            $this->_description = $data;
        }
        return $this;
    }

    /**
     * Gets column description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setRoutingPatternId($data)
    {

        if ($this->_routingPatternId != $data) {
            $this->_logChange('routingPatternId', $this->_routingPatternId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_routingPatternId = $data;

        } else if (!is_null($data)) {
            $this->_routingPatternId = (int) $data;

        } else {
            $this->_routingPatternId = $data;
        }
        return $this;
    }

    /**
     * Gets column routingPatternId
     *
     * @return int
     */
    public function getRoutingPatternId()
    {
        return $this->_routingPatternId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setOutgoingRoutingId($data)
    {

        if ($this->_outgoingRoutingId != $data) {
            $this->_logChange('outgoingRoutingId', $this->_outgoingRoutingId, $data);
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
     * @return \IvozProvider\Model\Raw\LcrRules
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

        $this->_setLoaded('LcrRulesIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRulesIbfk1';

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
     * Sets parent relation OutgoingRouting
     *
     * @param \IvozProvider\Model\Raw\OutgoingRouting $data
     * @return \IvozProvider\Model\Raw\LcrRules
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

        $this->_setLoaded('LcrRulesIbfk3');
        return $this;
    }

    /**
     * Gets parent OutgoingRouting
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\OutgoingRouting
     */
    public function getOutgoingRouting($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRulesIbfk3';

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
     * Sets parent relation RoutingPattern
     *
     * @param \IvozProvider\Model\Raw\RoutingPatterns $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setRoutingPattern(\IvozProvider\Model\Raw\RoutingPatterns $data)
    {
        $this->_RoutingPattern = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setRoutingPatternId($primaryKey);
        }

        $this->_setLoaded('LcrRulesIbfk4');
        return $this;
    }

    /**
     * Gets parent RoutingPattern
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function getRoutingPattern($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRulesIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_RoutingPattern = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_RoutingPattern;
    }

    /**
     * Sets dependent relations LcrRuleTargets_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\LcrRuleTargets
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function setLcrRuleTargets(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_LcrRuleTargets === null) {

                $this->getLcrRuleTargets();
            }

            $oldRelations = $this->_LcrRuleTargets;

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

        $this->_LcrRuleTargets = array();

        foreach ($data as $object) {
            $this->addLcrRuleTargets($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations LcrRuleTargets_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\LcrRuleTargets $data
     * @return \IvozProvider\Model\Raw\LcrRules
     */
    public function addLcrRuleTargets(\IvozProvider\Model\Raw\LcrRuleTargets $data)
    {
        $this->_LcrRuleTargets[] = $data;
        $this->_setLoaded('LcrRuleTargetsIbfk2');
        return $this;
    }

    /**
     * Gets dependent LcrRuleTargets_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\LcrRuleTargets
     */
    public function getLcrRuleTargets($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_LcrRuleTargets = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_LcrRuleTargets;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\LcrRules
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\LcrRules')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\LcrRules);

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
     * @return null | \IvozProvider\Model\Validator\LcrRules
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\LcrRules')) {

                $this->setValidator(new \IvozProvider\Validator\LcrRules);
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
     * @see \Mapper\Sql\LcrRules::delete
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