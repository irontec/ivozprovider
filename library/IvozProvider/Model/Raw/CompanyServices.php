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
class CompanyServices extends ModelAbstract
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
    protected $_serviceId;

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
    protected $_code;


    /**
     * Parent relation CompanyServices_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation CompanyServices_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Services
     */
    protected $_Service;


    protected $_columnsList = array(
        'id'=>'id',
        'serviceId'=>'serviceId',
        'companyId'=>'companyId',
        'code'=>'code',
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
            'CompanyServicesIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'CompanyServicesIbfk2'=> array(
                    'property' => 'Service',
                    'table_name' => 'Services',
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
     * @return \IvozProvider\Model\Raw\CompanyServices
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
     * @return \IvozProvider\Model\Raw\CompanyServices
     */
    public function setServiceId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_serviceId != $data) {
            $this->_logChange('serviceId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_serviceId = $data;

        } else if (!is_null($data)) {
            $this->_serviceId = (int) $data;

        } else {
            $this->_serviceId = $data;
        }
        return $this;
    }

    /**
     * Gets column serviceId
     *
     * @return int
     */
    public function getServiceId()
    {
        return $this->_serviceId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\CompanyServices
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
     * @return \IvozProvider\Model\Raw\CompanyServices
     */
    public function setCode($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_code != $data) {
            $this->_logChange('code');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_code = $data;

        } else if (!is_null($data)) {
            $this->_code = (string) $data;

        } else {
            $this->_code = $data;
        }
        return $this;
    }

    /**
     * Gets column code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\CompanyServices
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

        $this->_setLoaded('CompanyServicesIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompanyServicesIbfk1';

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
     * Sets parent relation Service
     *
     * @param \IvozProvider\Model\Raw\Services $data
     * @return \IvozProvider\Model\Raw\CompanyServices
     */
    public function setService(\IvozProvider\Model\Raw\Services $data)
    {
        $this->_Service = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setServiceId($primaryKey);
        }

        $this->_setLoaded('CompanyServicesIbfk2');
        return $this;
    }

    /**
     * Gets parent Service
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Services
     */
    public function getService($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompanyServicesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Service = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Service;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\CompanyServices
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\CompanyServices')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\CompanyServices);

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
     * @return null | \IvozProvider\Model\Validator\CompanyServices
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\CompanyServices')) {

                $this->setValidator(new \IvozProvider\Validator\CompanyServices);
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
     * @see \Mapper\Sql\CompanyServices::delete
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