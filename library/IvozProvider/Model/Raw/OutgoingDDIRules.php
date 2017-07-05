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
class OutgoingDDIRules extends ModelAbstract
{

    protected $_defaultActionAcceptedValues = array(
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
    protected $_companyId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * [enum:keep|force]
     * Database var type varchar
     *
     * @var string
     */
    protected $_defaultAction;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_forcedDDIId;


    /**
     * Parent relation OutgoingDDIRules_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation OutgoingDDIRules_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\DDIs
     */
    protected $_ForcedDDI;


    /**
     * Dependent relation Companies_ibfk_14
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Companies[]
     */
    protected $_Companies;

    /**
     * Dependent relation OutgoingDDIRulesPatterns_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns[]
     */
    protected $_OutgoingDDIRulesPatterns;

    /**
     * Dependent relation Users_ibfk_14
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Users[]
     */
    protected $_Users;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'defaultAction'=>'defaultAction',
        'forcedDDIId'=>'forcedDDIId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'defaultAction'=> array('enum:keep|force'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'OutgoingDDIRulesIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'OutgoingDDIRulesIbfk2'=> array(
                    'property' => 'ForcedDDI',
                    'table_name' => 'DDIs',
                ),
        ));

        $this->setDependentList(array(
            'CompaniesIbfk14' => array(
                    'property' => 'Companies',
                    'table_name' => 'Companies',
                ),
            'OutgoingDDIRulesPatternsIbfk1' => array(
                    'property' => 'OutgoingDDIRulesPatterns',
                    'table_name' => 'OutgoingDDIRulesPatterns',
                ),
            'UsersIbfk14' => array(
                    'property' => 'Users',
                    'table_name' => 'Users',
                ),
        ));


        $this->setOnDeleteSetNullRelationships(array(
            'Companies_ibfk_14'
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
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
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
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
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
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function setDefaultAction($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_defaultAction != $data) {
            $this->_logChange('defaultAction', $this->_defaultAction, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_defaultAction = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_defaultActionAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for defaultAction'));
            }
            $this->_defaultAction = (string) $data;

        } else {
            $this->_defaultAction = $data;
        }
        return $this;
    }

    /**
     * Gets column defaultAction
     *
     * @return string
     */
    public function getDefaultAction()
    {
        return $this->_defaultAction;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
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
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
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

        $this->_setLoaded('OutgoingDDIRulesIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingDDIRulesIbfk1';

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
     * Sets parent relation ForcedDDI
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
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

        $this->_setLoaded('OutgoingDDIRulesIbfk2');
        return $this;
    }

    /**
     * Gets parent ForcedDDI
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function getForcedDDI($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingDDIRulesIbfk2';

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
     * Sets dependent relations Companies_ibfk_14
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Companies
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function setCompanies(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Companies === null) {

                $this->getCompanies();
            }

            $oldRelations = $this->_Companies;

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

        $this->_Companies = array();

        foreach ($data as $object) {
            $this->addCompanies($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Companies_ibfk_14
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function addCompanies(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_Companies[] = $data;
        $this->_setLoaded('CompaniesIbfk14');
        return $this;
    }

    /**
     * Gets dependent Companies_ibfk_14
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Companies
     */
    public function getCompanies($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk14';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Companies = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Companies;
    }

    /**
     * Sets dependent relations OutgoingDDIRulesPatterns_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
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
     * Sets dependent relations OutgoingDDIRulesPatterns_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function addOutgoingDDIRulesPatterns(\IvozProvider\Model\Raw\OutgoingDDIRulesPatterns $data)
    {
        $this->_OutgoingDDIRulesPatterns[] = $data;
        $this->_setLoaded('OutgoingDDIRulesPatternsIbfk1');
        return $this;
    }

    /**
     * Gets dependent OutgoingDDIRulesPatterns_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\OutgoingDDIRulesPatterns
     */
    public function getOutgoingDDIRulesPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingDDIRulesPatternsIbfk1';

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
     * Sets dependent relations Users_ibfk_14
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Users
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function setUsers(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Users === null) {

                $this->getUsers();
            }

            $oldRelations = $this->_Users;

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

        $this->_Users = array();

        foreach ($data as $object) {
            $this->addUsers($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Users_ibfk_14
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\OutgoingDDIRules
     */
    public function addUsers(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_Users[] = $data;
        $this->_setLoaded('UsersIbfk14');
        return $this;
    }

    /**
     * Gets dependent Users_ibfk_14
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Users
     */
    public function getUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk14';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Users = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Users;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\OutgoingDDIRules
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\OutgoingDDIRules')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\OutgoingDDIRules);

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
     * @return null | \IvozProvider\Model\Validator\OutgoingDDIRules
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\OutgoingDDIRules')) {

                $this->setValidator(new \IvozProvider\Validator\OutgoingDDIRules);
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
     * @see \Mapper\Sql\OutgoingDDIRules::delete
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