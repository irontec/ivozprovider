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
class HuntGroups extends ModelAbstract
{

    protected $_strategyAcceptedValues = array(
        'ringAll',
        'linear',
        'roundRobin',
        'random',
    );

    /**
     * [uuid:php]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_description;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_companyId;

    /**
     * [enum:ringAll|linear|roundRobin|random]
     * Database var type varchar
     *
     * @var string
     */
    protected $_strategy;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_ringAllTimeout;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_nextUserPosition;


    /**
     * Parent relation HuntGroups_ibfk_1
     *
     * @var \Oasis\Model\Raw\Companies
     */
    protected $_Company;


    /**
     * Dependent relation DDIs_ibfk_6
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation Extensions_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\Extensions[]
     */
    protected $_Extensions;

    /**
     * Dependent relation HuntGroupCallForwardSettings_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\HuntGroupCallForwardSettings[]
     */
    protected $_HuntGroupCallForwardSettings;

    /**
     * Dependent relation HuntGroupsRelUsers_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\HuntGroupsRelUsers[]
     */
    protected $_HuntGroupsRelUsers;

    protected $_columnsList = array(
        'id'=>'id',
        'name'=>'name',
        'description'=>'description',
        'companyId'=>'companyId',
        'strategy'=>'strategy',
        'ringAllTimeout'=>'ringAllTimeout',
        'nextUserPosition'=>'nextUserPosition',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid:php'),
            'strategy'=> array('enum:ringAll|linear|roundRobin|random'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'HuntGroupsIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
        ));

        $this->setDependentList(array(
            'DDIsIbfk6' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'ExtensionsIbfk4' => array(
                    'property' => 'Extensions',
                    'table_name' => 'Extensions',
                ),
            'HuntGroupCallForwardSettingsIbfk1' => array(
                    'property' => 'HuntGroupCallForwardSettings',
                    'table_name' => 'HuntGroupCallForwardSettings',
                ),
            'HuntGroupsRelUsersIbfk1' => array(
                    'property' => 'HuntGroupsRelUsers',
                    'table_name' => 'HuntGroupsRelUsers',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'HuntGroupCallForwardSettings_ibfk_1'
        ));

        $this->setOnDeleteSetNullRelationships(array(
            'DDIs_ibfk_6',
            'Extensions_ibfk_4'
        ));


        $this->_defaultValues = array(
            'name' => '',
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
     * @return \Oasis\Model\Raw\HuntGroups
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
     * @param string $data
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function setName($data)
    {

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
     * @return \Oasis\Model\Raw\HuntGroups
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
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_companyId != $data) {
            $this->_logChange('companyId');
        }

        $this->_companyId = $data;
        return $this;
    }

    /**
     * Gets column companyId
     *
     * @return binary
     */
    public function getCompanyId()
    {
        return $this->_companyId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function setStrategy($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_strategy != $data) {
            $this->_logChange('strategy');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_strategy = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_strategyAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for strategy'));
            }
            $this->_strategy = (string) $data;

        } else {
            $this->_strategy = $data;
        }
        return $this;
    }

    /**
     * Gets column strategy
     *
     * @return string
     */
    public function getStrategy()
    {
        return $this->_strategy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function setRingAllTimeout($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_ringAllTimeout != $data) {
            $this->_logChange('ringAllTimeout');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ringAllTimeout = $data;

        } else if (!is_null($data)) {
            $this->_ringAllTimeout = (int) $data;

        } else {
            $this->_ringAllTimeout = $data;
        }
        return $this;
    }

    /**
     * Gets column ringAllTimeout
     *
     * @return int
     */
    public function getRingAllTimeout()
    {
        return $this->_ringAllTimeout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function setNextUserPosition($data)
    {

        if ($this->_nextUserPosition != $data) {
            $this->_logChange('nextUserPosition');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nextUserPosition = $data;

        } else if (!is_null($data)) {
            $this->_nextUserPosition = (int) $data;

        } else {
            $this->_nextUserPosition = $data;
        }
        return $this;
    }

    /**
     * Gets column nextUserPosition
     *
     * @return int
     */
    public function getNextUserPosition()
    {
        return $this->_nextUserPosition;
    }

    /**
     * Sets parent relation Company
     *
     * @param \Oasis\Model\Raw\Companies $data
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function setCompany(\Oasis\Model\Raw\Companies $data)
    {
        $this->_Company = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCompanyId($primaryKey);
        }

        $this->_setLoaded('HuntGroupsIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupsIbfk1';

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
     * Sets dependent relations DDIs_ibfk_6
     *
     * @param array $data An array of \Oasis\Model\Raw\DDIs
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function setDDIs(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_DDIs === null) {

                $this->getDDIs();
            }

            $oldRelations = $this->_DDIs;

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

        $this->_DDIs = array();

        foreach ($data as $object) {
            $this->addDDIs($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations DDIs_ibfk_6
     *
     * @param \Oasis\Model\Raw\DDIs $data
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function addDDIs(\Oasis\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk6');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_6
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk6';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_DDIs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_DDIs;
    }

    /**
     * Sets dependent relations Extensions_ibfk_4
     *
     * @param array $data An array of \Oasis\Model\Raw\Extensions
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function setExtensions(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Extensions === null) {

                $this->getExtensions();
            }

            $oldRelations = $this->_Extensions;

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

        $this->_Extensions = array();

        foreach ($data as $object) {
            $this->addExtensions($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Extensions_ibfk_4
     *
     * @param \Oasis\Model\Raw\Extensions $data
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function addExtensions(\Oasis\Model\Raw\Extensions $data)
    {
        $this->_Extensions[] = $data;
        $this->_setLoaded('ExtensionsIbfk4');
        return $this;
    }

    /**
     * Gets dependent Extensions_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\Extensions
     */
    public function getExtensions($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExtensionsIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Extensions = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Extensions;
    }

    /**
     * Sets dependent relations HuntGroupCallForwardSettings_ibfk_1
     *
     * @param array $data An array of \Oasis\Model\Raw\HuntGroupCallForwardSettings
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function setHuntGroupCallForwardSettings(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_HuntGroupCallForwardSettings === null) {

                $this->getHuntGroupCallForwardSettings();
            }

            $oldRelations = $this->_HuntGroupCallForwardSettings;

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

        $this->_HuntGroupCallForwardSettings = array();

        foreach ($data as $object) {
            $this->addHuntGroupCallForwardSettings($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations HuntGroupCallForwardSettings_ibfk_1
     *
     * @param \Oasis\Model\Raw\HuntGroupCallForwardSettings $data
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function addHuntGroupCallForwardSettings(\Oasis\Model\Raw\HuntGroupCallForwardSettings $data)
    {
        $this->_HuntGroupCallForwardSettings[] = $data;
        $this->_setLoaded('HuntGroupCallForwardSettingsIbfk1');
        return $this;
    }

    /**
     * Gets dependent HuntGroupCallForwardSettings_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\HuntGroupCallForwardSettings
     */
    public function getHuntGroupCallForwardSettings($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupCallForwardSettingsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_HuntGroupCallForwardSettings = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_HuntGroupCallForwardSettings;
    }

    /**
     * Sets dependent relations HuntGroupsRelUsers_ibfk_1
     *
     * @param array $data An array of \Oasis\Model\Raw\HuntGroupsRelUsers
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function setHuntGroupsRelUsers(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_HuntGroupsRelUsers === null) {

                $this->getHuntGroupsRelUsers();
            }

            $oldRelations = $this->_HuntGroupsRelUsers;

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

        $this->_HuntGroupsRelUsers = array();

        foreach ($data as $object) {
            $this->addHuntGroupsRelUsers($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations HuntGroupsRelUsers_ibfk_1
     *
     * @param \Oasis\Model\Raw\HuntGroupsRelUsers $data
     * @return \Oasis\Model\Raw\HuntGroups
     */
    public function addHuntGroupsRelUsers(\Oasis\Model\Raw\HuntGroupsRelUsers $data)
    {
        $this->_HuntGroupsRelUsers[] = $data;
        $this->_setLoaded('HuntGroupsRelUsersIbfk1');
        return $this;
    }

    /**
     * Gets dependent HuntGroupsRelUsers_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\HuntGroupsRelUsers
     */
    public function getHuntGroupsRelUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HuntGroupsRelUsersIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_HuntGroupsRelUsers = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_HuntGroupsRelUsers;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\HuntGroups
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\HuntGroups')) {

                $this->setMapper(new \Oasis\Mapper\Sql\HuntGroups);

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
     * @return null | \Oasis\Model\Validator\HuntGroups
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\HuntGroups')) {

                $this->setValidator(new \Oasis\Validator\HuntGroups);
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
     * @see \Mapper\Sql\HuntGroups::delete
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