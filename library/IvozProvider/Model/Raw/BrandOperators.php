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
class BrandOperators extends ModelAbstract
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
     * Database var type mediumint
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
     * Parent relation BrandOperators_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Timezones
     */
    protected $_Timezone;

    /**
     * Parent relation BrandOperators_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;


    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
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
            'id'=> array('uuid:php'),
            'pass'=> array('password'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'BrandOperatorsIbfk2'=> array(
                    'property' => 'Timezone',
                    'table_name' => 'Timezones',
                ),
            'BrandOperatorsIbfk3'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'email' => '',
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
     * @return \IvozProvider\Model\Raw\BrandOperators
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
     * @return \IvozProvider\Model\Raw\BrandOperators
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
     * @return \IvozProvider\Model\Raw\BrandOperators
     */
    public function setUsername($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_username != $data) {
            $this->_logChange('username');
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
     * @return \IvozProvider\Model\Raw\BrandOperators
     */
    public function setPass($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_pass != $data) {
            $this->_logChange('pass');
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
     * @return \IvozProvider\Model\Raw\BrandOperators
     */
    public function setEmail($data)
    {

        if ($this->_email != $data) {
            $this->_logChange('email');
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
     * @return \IvozProvider\Model\Raw\BrandOperators
     */
    public function setActive($data)
    {

        if ($this->_active != $data) {
            $this->_logChange('active');
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
     * @return \IvozProvider\Model\Raw\BrandOperators
     */
    public function setTimezoneId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_timezoneId != $data) {
            $this->_logChange('timezoneId');
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
     * @return \IvozProvider\Model\Raw\BrandOperators
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
     * @return \IvozProvider\Model\Raw\BrandOperators
     */
    public function setLastname($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_lastname != $data) {
            $this->_logChange('lastname');
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
     * Sets parent relation Timezone
     *
     * @param \IvozProvider\Model\Raw\Timezones $data
     * @return \IvozProvider\Model\Raw\BrandOperators
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

        $this->_setLoaded('BrandOperatorsIbfk2');
        return $this;
    }

    /**
     * Gets parent Timezone
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function getTimezone($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandOperatorsIbfk2';

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
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\BrandOperators
     */
    public function setBrand(\IvozProvider\Model\Raw\Brands $data)
    {
        $this->_Brand = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setBrandId($primaryKey);
        }

        $this->_setLoaded('BrandOperatorsIbfk3');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandOperatorsIbfk3';

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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\BrandOperators
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\BrandOperators')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\BrandOperators);

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
     * @return null | \IvozProvider\Model\Validator\BrandOperators
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\BrandOperators')) {

                $this->setValidator(new \IvozProvider\Validator\BrandOperators);
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
     * @see \Mapper\Sql\BrandOperators::delete
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