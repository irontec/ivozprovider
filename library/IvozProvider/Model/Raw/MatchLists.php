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
class MatchLists extends ModelAbstract
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
    protected $_name;


    /**
     * Parent relation MatchList_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;


    /**
     * Dependent relation ConditionalRoutesConditionsRelMatchLists_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelMatchLists[]
     */
    protected $_ConditionalRoutesConditionsRelMatchLists;

    /**
     * Dependent relation ExternalCallFilterBlackLists_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilterBlackLists[]
     */
    protected $_ExternalCallFilterBlackLists;

    /**
     * Dependent relation ExternalCallFilterWhiteLists_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilterWhiteLists[]
     */
    protected $_ExternalCallFilterWhiteLists;

    /**
     * Dependent relation MatchListPatterns_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\MatchListPatterns[]
     */
    protected $_MatchListPatterns;

    /**
     * Dependent relation OutgoingDDIRulesPatterns_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns[]
     */
    protected $_OutgoingDDIRulesPatterns;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
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
            'MatchListIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
        ));

        $this->setDependentList(array(
            'ConditionalRoutesConditionsRelMatchListsIbfk2' => array(
                    'property' => 'ConditionalRoutesConditionsRelMatchLists',
                    'table_name' => 'ConditionalRoutesConditionsRelMatchLists',
                ),
            'ExternalCallFilterBlackListsIbfk2' => array(
                    'property' => 'ExternalCallFilterBlackLists',
                    'table_name' => 'ExternalCallFilterBlackLists',
                ),
            'ExternalCallFilterWhiteListsIbfk2' => array(
                    'property' => 'ExternalCallFilterWhiteLists',
                    'table_name' => 'ExternalCallFilterWhiteLists',
                ),
            'MatchListPatternsIbfk1' => array(
                    'property' => 'MatchListPatterns',
                    'table_name' => 'MatchListPatterns',
                ),
            'OutgoingDDIRulesPatternsIbfk2' => array(
                    'property' => 'OutgoingDDIRulesPatterns',
                    'table_name' => 'OutgoingDDIRulesPatterns',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'ConditionalRoutesConditionsRelMatchLists_ibfk_2',
            'ExternalCallFilterBlackLists_ibfk_2',
            'ExternalCallFilterWhiteLists_ibfk_2',
            'MatchListPatterns_ibfk_1'
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
     * @return \IvozProvider\Model\Raw\MatchLists
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
     * @return \IvozProvider\Model\Raw\MatchLists
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
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function setName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_name != $data) {
            $this->_logChange('name', $this->_name, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_name = $data;

        } else if (!is_null($data)) {
            $this->_name = (string) $data;

        } else {
            $this->_name = $data;
        }
        return $this;
    }

    /**
     * Gets column name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\MatchLists
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

        $this->_setLoaded('MatchListIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'MatchListIbfk1';

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
     * Sets dependent relations ConditionalRoutesConditionsRelMatchLists_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelMatchLists
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function setConditionalRoutesConditionsRelMatchLists(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ConditionalRoutesConditionsRelMatchLists === null) {

                $this->getConditionalRoutesConditionsRelMatchLists();
            }

            $oldRelations = $this->_ConditionalRoutesConditionsRelMatchLists;

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

        $this->_ConditionalRoutesConditionsRelMatchLists = array();

        foreach ($data as $object) {
            $this->addConditionalRoutesConditionsRelMatchLists($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ConditionalRoutesConditionsRelMatchLists_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelMatchLists $data
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function addConditionalRoutesConditionsRelMatchLists(\IvozProvider\Model\Raw\ConditionalRoutesConditionsRelMatchLists $data)
    {
        $this->_ConditionalRoutesConditionsRelMatchLists[] = $data;
        $this->_setLoaded('ConditionalRoutesConditionsRelMatchListsIbfk2');
        return $this;
    }

    /**
     * Gets dependent ConditionalRoutesConditionsRelMatchLists_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ConditionalRoutesConditionsRelMatchLists
     */
    public function getConditionalRoutesConditionsRelMatchLists($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ConditionalRoutesConditionsRelMatchListsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ConditionalRoutesConditionsRelMatchLists = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ConditionalRoutesConditionsRelMatchLists;
    }

    /**
     * Sets dependent relations ExternalCallFilterBlackLists_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ExternalCallFilterBlackLists
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function setExternalCallFilterBlackLists(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ExternalCallFilterBlackLists === null) {

                $this->getExternalCallFilterBlackLists();
            }

            $oldRelations = $this->_ExternalCallFilterBlackLists;

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

        $this->_ExternalCallFilterBlackLists = array();

        foreach ($data as $object) {
            $this->addExternalCallFilterBlackLists($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ExternalCallFilterBlackLists_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilterBlackLists $data
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function addExternalCallFilterBlackLists(\IvozProvider\Model\Raw\ExternalCallFilterBlackLists $data)
    {
        $this->_ExternalCallFilterBlackLists[] = $data;
        $this->_setLoaded('ExternalCallFilterBlackListsIbfk2');
        return $this;
    }

    /**
     * Gets dependent ExternalCallFilterBlackLists_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ExternalCallFilterBlackLists
     */
    public function getExternalCallFilterBlackLists($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFilterBlackListsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ExternalCallFilterBlackLists = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ExternalCallFilterBlackLists;
    }

    /**
     * Sets dependent relations ExternalCallFilterWhiteLists_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ExternalCallFilterWhiteLists
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function setExternalCallFilterWhiteLists(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ExternalCallFilterWhiteLists === null) {

                $this->getExternalCallFilterWhiteLists();
            }

            $oldRelations = $this->_ExternalCallFilterWhiteLists;

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

        $this->_ExternalCallFilterWhiteLists = array();

        foreach ($data as $object) {
            $this->addExternalCallFilterWhiteLists($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ExternalCallFilterWhiteLists_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilterWhiteLists $data
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function addExternalCallFilterWhiteLists(\IvozProvider\Model\Raw\ExternalCallFilterWhiteLists $data)
    {
        $this->_ExternalCallFilterWhiteLists[] = $data;
        $this->_setLoaded('ExternalCallFilterWhiteListsIbfk2');
        return $this;
    }

    /**
     * Gets dependent ExternalCallFilterWhiteLists_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ExternalCallFilterWhiteLists
     */
    public function getExternalCallFilterWhiteLists($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFilterWhiteListsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ExternalCallFilterWhiteLists = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ExternalCallFilterWhiteLists;
    }

    /**
     * Sets dependent relations MatchListPatterns_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\MatchListPatterns
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function setMatchListPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_MatchListPatterns === null) {

                $this->getMatchListPatterns();
            }

            $oldRelations = $this->_MatchListPatterns;

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

        $this->_MatchListPatterns = array();

        foreach ($data as $object) {
            $this->addMatchListPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations MatchListPatterns_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\MatchListPatterns $data
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function addMatchListPatterns(\IvozProvider\Model\Raw\MatchListPatterns $data)
    {
        $this->_MatchListPatterns[] = $data;
        $this->_setLoaded('MatchListPatternsIbfk1');
        return $this;
    }

    /**
     * Gets dependent MatchListPatterns_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function getMatchListPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'MatchListPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_MatchListPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_MatchListPatterns;
    }

    /**
     * Sets dependent relations OutgoingDDIRulesPatterns_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function setOutgoingDDIRulesPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_OutgoingDDIRulesPatterns === null) {

                $this->getOutgoingDDIRulesPatterns();
            }

            $oldRelations = $this->_OutgoingDDIRulesPatterns;

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

        $this->_OutgoingDDIRulesPatterns = array();

        foreach ($data as $object) {
            $this->addOutgoingDDIRulesPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations OutgoingDDIRulesPatterns_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns $data
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function addOutgoingDDIRulesPatterns(\IvozProvider\Model\Raw\OutgoingDDIRulesPatterns $data)
    {
        $this->_OutgoingDDIRulesPatterns[] = $data;
        $this->_setLoaded('OutgoingDDIRulesPatternsIbfk2');
        return $this;
    }

    /**
     * Gets dependent OutgoingDDIRulesPatterns_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function getOutgoingDDIRulesPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingDDIRulesPatternsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingDDIRulesPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_OutgoingDDIRulesPatterns;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\MatchLists
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\MatchLists')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\MatchLists);

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
     * @return null | \IvozProvider\Model\Validator\MatchLists
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\MatchLists')) {

                $this->setValidator(new \IvozProvider\Validator\MatchLists);
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
     * @see \Mapper\Sql\MatchLists::delete
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