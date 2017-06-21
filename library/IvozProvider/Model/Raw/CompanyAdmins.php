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
class CompanyAdmins extends ModelAbstract
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
    protected $_username;

    /**
     * [password]
     * Database var type varchar
     *
     * @var string
     */
    protected $_pass;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_email;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_active;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timezoneId;

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
    protected $_lastname;


    /**
     * Parent relation CompanyAdmins_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation CompanyAdmins_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Timezones
     */
    protected $_Timezone;


    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'username'=>'username',
        'pass'=>'pass',
        'email'=>'email',
        'active'=>'active',
        'timezoneId'=>'timezoneId',
        'name'=>'name',
        'lastname'=>'lastname',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'pass'=> array('password'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'CompanyAdminsIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'CompanyAdminsIbfk2'=> array(
                    'property' => 'Timezone',
                    'table_name' => 'Timezones',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'email' => '',
            'active' => '1',
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
     * @return \IvozProvider\Model\Raw\CompanyAdmins
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
     * @return \IvozProvider\Model\Raw\CompanyAdmins
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
     * @return \IvozProvider\Model\Raw\CompanyAdmins
     */
    public function setUsername($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_username != $data) {
            $this->_logChange('username', $this->_username, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_username = $data;

        } else if (!is_null($data)) {
            $this->_username = (string) $data;

        } else {
            $this->_username = $data;
        }
        return $this;
    }

    /**
     * Gets column username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\CompanyAdmins
     */
    public function setPass($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_pass != $data) {
            $this->_logChange('pass', $this->_pass, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pass = $data;

        } else if (!is_null($data)) {
            $this->_pass = (string) $data;

        } else {
            $this->_pass = $data;
        }
        return $this;
    }

    /**
     * Gets column pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->_pass;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\CompanyAdmins
     */
    public function setEmail($data)
    {

        if ($this->_email != $data) {
            $this->_logChange('email', $this->_email, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_email = $data;

        } else if (!is_null($data)) {
            $this->_email = (string) $data;

        } else {
            $this->_email = $data;
        }
        return $this;
    }

    /**
     * Gets column email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\CompanyAdmins
     */
    public function setActive($data)
    {

        if ($this->_active != $data) {
            $this->_logChange('active', $this->_active, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_active = $data;

        } else if (!is_null($data)) {
            $this->_active = (int) $data;

        } else {
            $this->_active = $data;
        }
        return $this;
    }

    /**
     * Gets column active
     *
     * @return int
     */
    public function getActive()
    {
        return $this->_active;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\CompanyAdmins
     */
    public function setTimezoneId($data)
    {

        if ($this->_timezoneId != $data) {
            $this->_logChange('timezoneId', $this->_timezoneId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_timezoneId = $data;

        } else if (!is_null($data)) {
            $this->_timezoneId = (int) $data;

        } else {
            $this->_timezoneId = $data;
        }
        return $this;
    }

    /**
     * Gets column timezoneId
     *
     * @return int
     */
    public function getTimezoneId()
    {
        return $this->_timezoneId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\CompanyAdmins
     */
    public function setName($data)
    {

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
     * @return \IvozProvider\Model\Raw\CompanyAdmins
     */
    public function setLastname($data)
    {

        if ($this->_lastname != $data) {
            $this->_logChange('lastname', $this->_lastname, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_lastname = $data;

        } else if (!is_null($data)) {
            $this->_lastname = (string) $data;

        } else {
            $this->_lastname = $data;
        }
        return $this;
    }

    /**
     * Gets column lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->_lastname;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\CompanyAdmins
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

        $this->_setLoaded('CompanyAdminsIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompanyAdminsIbfk1';

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
     * Sets parent relation Timezone
     *
     * @param \IvozProvider\Model\Raw\Timezones $data
     * @return \IvozProvider\Model\Raw\CompanyAdmins
     */
    public function setTimezone(\IvozProvider\Model\Raw\Timezones $data)
    {
        $this->_Timezone = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTimezoneId($primaryKey);
        }

        $this->_setLoaded('CompanyAdminsIbfk2');
        return $this;
    }

    /**
     * Gets parent Timezone
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function getTimezone($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompanyAdminsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Timezone = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Timezone;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\CompanyAdmins
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\CompanyAdmins')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\CompanyAdmins);

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
     * @return null | \IvozProvider\Model\Validator\CompanyAdmins
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\CompanyAdmins')) {

                $this->setValidator(new \IvozProvider\Validator\CompanyAdmins);
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
     * @see \Mapper\Sql\CompanyAdmins::delete
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