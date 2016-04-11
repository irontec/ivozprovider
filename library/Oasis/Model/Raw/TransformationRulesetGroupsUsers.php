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
class TransformationRulesetGroupsUsers extends ModelAbstract
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
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_callerIn;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_calleeIn;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_callerOut;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_calleeOut;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_description;


    /**
     * Parent relation TransformationRulesetGroupsUsers_ibfk_1
     *
     * @var \Oasis\Model\Raw\Brands
     */
    protected $_Brand;


    /**
     * Dependent relation Companies_ibfk_7
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\Companies[]
     */
    protected $_Companies;

    /**
     * Dependent relation kam_users_dialplan_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\KamUsersDialplan[]
     */
    protected $_KamUsersDialplan;

    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
        'name'=>'name',
        'caller_in'=>'callerIn',
        'callee_in'=>'calleeIn',
        'caller_out'=>'callerOut',
        'callee_out'=>'calleeOut',
        'description'=>'description',
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
            'TransformationRulesetGroupsUsersIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
        ));

        $this->setDependentList(array(
            'CompaniesIbfk7' => array(
                    'property' => 'Companies',
                    'table_name' => 'Companies',
                ),
            'KamUsersDialplanIbfk2' => array(
                    'property' => 'KamUsersDialplan',
                    'table_name' => 'kam_users_dialplan',
                ),
        ));


        $this->setOnDeleteSetNullRelationships(array(
            'Companies_ibfk_7'
        ));


        $this->_defaultValues = array(
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
     * @param binary $data
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
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
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
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
     * @param string $data
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
     */
    public function setName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_name != $data) {
            $this->_logChange('name');
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
     * @param int $data
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
     */
    public function setCallerIn($data)
    {

        if ($this->_callerIn != $data) {
            $this->_logChange('callerIn');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callerIn = $data;

        } else if (!is_null($data)) {
            $this->_callerIn = (int) $data;

        } else {
            $this->_callerIn = $data;
        }
        return $this;
    }

    /**
     * Gets column caller_in
     *
     * @return int
     */
    public function getCallerIn()
    {
        return $this->_callerIn;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
     */
    public function setCalleeIn($data)
    {

        if ($this->_calleeIn != $data) {
            $this->_logChange('calleeIn');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_calleeIn = $data;

        } else if (!is_null($data)) {
            $this->_calleeIn = (int) $data;

        } else {
            $this->_calleeIn = $data;
        }
        return $this;
    }

    /**
     * Gets column callee_in
     *
     * @return int
     */
    public function getCalleeIn()
    {
        return $this->_calleeIn;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
     */
    public function setCallerOut($data)
    {

        if ($this->_callerOut != $data) {
            $this->_logChange('callerOut');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callerOut = $data;

        } else if (!is_null($data)) {
            $this->_callerOut = (int) $data;

        } else {
            $this->_callerOut = $data;
        }
        return $this;
    }

    /**
     * Gets column caller_out
     *
     * @return int
     */
    public function getCallerOut()
    {
        return $this->_callerOut;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
     */
    public function setCalleeOut($data)
    {

        if ($this->_calleeOut != $data) {
            $this->_logChange('calleeOut');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_calleeOut = $data;

        } else if (!is_null($data)) {
            $this->_calleeOut = (int) $data;

        } else {
            $this->_calleeOut = $data;
        }
        return $this;
    }

    /**
     * Gets column callee_out
     *
     * @return int
     */
    public function getCalleeOut()
    {
        return $this->_calleeOut;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
     */
    public function setDescription($data)
    {

        if ($this->_description != $data) {
            $this->_logChange('description');
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
     * Sets parent relation Brand
     *
     * @param \Oasis\Model\Raw\Brands $data
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
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

        $this->_setLoaded('TransformationRulesetGroupsUsersIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TransformationRulesetGroupsUsersIbfk1';

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
     * Sets dependent relations Companies_ibfk_7
     *
     * @param array $data An array of \Oasis\Model\Raw\Companies
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
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
     * Sets dependent relations Companies_ibfk_7
     *
     * @param \Oasis\Model\Raw\Companies $data
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
     */
    public function addCompanies(\Oasis\Model\Raw\Companies $data)
    {
        $this->_Companies[] = $data;
        $this->_setLoaded('CompaniesIbfk7');
        return $this;
    }

    /**
     * Gets dependent Companies_ibfk_7
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\Companies
     */
    public function getCompanies($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk7';

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
     * Sets dependent relations kam_users_dialplan_ibfk_2
     *
     * @param array $data An array of \Oasis\Model\Raw\KamUsersDialplan
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
     */
    public function setKamUsersDialplan(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KamUsersDialplan === null) {

                $this->getKamUsersDialplan();
            }

            $oldRelations = $this->_KamUsersDialplan;

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

        $this->_KamUsersDialplan = array();

        foreach ($data as $object) {
            $this->addKamUsersDialplan($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations kam_users_dialplan_ibfk_2
     *
     * @param \Oasis\Model\Raw\KamUsersDialplan $data
     * @return \Oasis\Model\Raw\TransformationRulesetGroupsUsers
     */
    public function addKamUsersDialplan(\Oasis\Model\Raw\KamUsersDialplan $data)
    {
        $this->_KamUsersDialplan[] = $data;
        $this->_setLoaded('KamUsersDialplanIbfk2');
        return $this;
    }

    /**
     * Gets dependent kam_users_dialplan_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\KamUsersDialplan
     */
    public function getKamUsersDialplan($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamUsersDialplanIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KamUsersDialplan = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KamUsersDialplan;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\TransformationRulesetGroupsUsers
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\TransformationRulesetGroupsUsers')) {

                $this->setMapper(new \Oasis\Mapper\Sql\TransformationRulesetGroupsUsers);

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
     * @return null | \Oasis\Model\Validator\TransformationRulesetGroupsUsers
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\TransformationRulesetGroupsUsers')) {

                $this->setValidator(new \Oasis\Validator\TransformationRulesetGroupsUsers);
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
     * @see \Mapper\Sql\TransformationRulesetGroupsUsers::delete
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