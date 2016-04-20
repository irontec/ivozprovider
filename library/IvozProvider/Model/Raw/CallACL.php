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
class CallACL extends ModelAbstract
{

    protected $_defaultPolicyAcceptedValues = array(
        'allow',
        'deny',
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
     * [enum:allow|deny]
     * Database var type varchar
     *
     * @var string
     */
    protected $_defaultPolicy;


    /**
     * Parent relation CallAcl_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;


    /**
     * Dependent relation CallACLRelPatterns_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\CallACLRelPatterns[]
     */
    protected $_CallACLRelPatterns;

    /**
     * Dependent relation Users_ibfk_10
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Users[]
     */
    protected $_Users;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'defaultPolicy'=>'defaultPolicy',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'defaultPolicy'=> array('enum:allow|deny'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'CallAclIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
        ));

        $this->setDependentList(array(
            'CallACLRelPatternsIbfk1' => array(
                    'property' => 'CallACLRelPatterns',
                    'table_name' => 'CallACLRelPatterns',
                ),
            'UsersIbfk10' => array(
                    'property' => 'Users',
                    'table_name' => 'Users',
                ),
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
     * @return \IvozProvider\Model\Raw\CallACL
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
     * @return \IvozProvider\Model\Raw\CallACL
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\CallACL
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\CallACL
     */
    public function setDefaultPolicy($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_defaultPolicy != $data) {
            $this->_logChange('defaultPolicy');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_defaultPolicy = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_defaultPolicyAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for defaultPolicy'));
            }
            $this->_defaultPolicy = (string) $data;

        } else {
            $this->_defaultPolicy = $data;
        }
        return $this;
    }

    /**
     * Gets column defaultPolicy
     *
     * @return string
     */
    public function getDefaultPolicy()
    {
        return $this->_defaultPolicy;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\CallACL
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

        $this->_setLoaded('CallAclIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CallAclIbfk1';

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
     * Sets dependent relations CallACLRelPatterns_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\CallACLRelPatterns
     * @return \IvozProvider\Model\Raw\CallACL
     */
    public function setCallACLRelPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_CallACLRelPatterns === null) {

                $this->getCallACLRelPatterns();
            }

            $oldRelations = $this->_CallACLRelPatterns;

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

        $this->_CallACLRelPatterns = array();

        foreach ($data as $object) {
            $this->addCallACLRelPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations CallACLRelPatterns_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\CallACLRelPatterns $data
     * @return \IvozProvider\Model\Raw\CallACL
     */
    public function addCallACLRelPatterns(\IvozProvider\Model\Raw\CallACLRelPatterns $data)
    {
        $this->_CallACLRelPatterns[] = $data;
        $this->_setLoaded('CallACLRelPatternsIbfk1');
        return $this;
    }

    /**
     * Gets dependent CallACLRelPatterns_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\CallACLRelPatterns
     */
    public function getCallACLRelPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CallACLRelPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_CallACLRelPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_CallACLRelPatterns;
    }

    /**
     * Sets dependent relations Users_ibfk_10
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Users
     * @return \IvozProvider\Model\Raw\CallACL
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
     * Sets dependent relations Users_ibfk_10
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\CallACL
     */
    public function addUsers(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_Users[] = $data;
        $this->_setLoaded('UsersIbfk10');
        return $this;
    }

    /**
     * Gets dependent Users_ibfk_10
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Users
     */
    public function getUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk10';

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
     * @return IvozProvider\Mapper\Sql\CallACL
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\CallACL')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\CallACL);

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
     * @return null | \IvozProvider\Model\Validator\CallACL
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\CallACL')) {

                $this->setValidator(new \IvozProvider\Validator\CallACL);
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
     * @see \Mapper\Sql\CallACL::delete
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