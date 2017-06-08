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
class Domains extends ModelAbstract
{

    protected $_scopeAcceptedValues = array(
        'global',
        'company',
        'brand',
    );
    protected $_pointsToAcceptedValues = array(
        'proxyusers',
        'proxytrunks',
    );

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_domain;

    /**
     * Database var type enum('global','company','brand')
     *
     * @var string
     */
    protected $_scope;

    /**
     * Database var type enum('proxyusers','proxytrunks')
     *
     * @var string
     */
    protected $_pointsTo;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;

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
    protected $_description;


    /**
     * Parent relation Domains_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation Domains_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;


    /**
     * Dependent relation kam_users_domain_attrs_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\KamUsersDomainAttrs[]
     */
    protected $_KamUsersDomainAttrs;

    protected $_columnsList = array(
        'id'=>'id',
        'domain'=>'domain',
        'scope'=>'scope',
        'pointsTo'=>'pointsTo',
        'brandId'=>'brandId',
        'companyId'=>'companyId',
        'description'=>'description',
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
            'DomainsIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'DomainsIbfk2'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
        ));

        $this->setDependentList(array(
            'KamUsersDomainAttrsIbfk1' => array(
                    'property' => 'KamUsersDomainAttrs',
                    'table_name' => 'kam_users_domain_attrs',
                ),
        ));




        $this->_defaultValues = array(
            'scope' => 'global',
            'pointsTo' => 'proxyusers',
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
     * @return \IvozProvider\Model\Raw\Domains
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\Domains
     */
    public function setDomain($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_domain != $data) {
            $this->_logChange('domain', $this->_domain, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_domain = $data;

        } else if (!is_null($data)) {
            $this->_domain = (string) $data;

        } else {
            $this->_domain = $data;
        }
        return $this;
    }

    /**
     * Gets column domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->_domain;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Domains
     */
    public function setScope($data)
    {

        if ($this->_scope != $data) {
            $this->_logChange('scope', $this->_scope, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_scope = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_scopeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for scope'));
            }
            $this->_scope = (string) $data;

        } else {
            $this->_scope = $data;
        }
        return $this;
    }

    /**
     * Gets column scope
     *
     * @return string
     */
    public function getScope()
    {
        return $this->_scope;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Domains
     */
    public function setPointsTo($data)
    {

        if ($this->_pointsTo != $data) {
            $this->_logChange('pointsTo', $this->_pointsTo, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pointsTo = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_pointsToAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for pointsTo'));
            }
            $this->_pointsTo = (string) $data;

        } else {
            $this->_pointsTo = $data;
        }
        return $this;
    }

    /**
     * Gets column pointsTo
     *
     * @return string
     */
    public function getPointsTo()
    {
        return $this->_pointsTo;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Domains
     */
    public function setBrandId($data)
    {

        if ($this->_brandId != $data) {
            $this->_logChange('brandId', $this->_brandId, $data);
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\Domains
     */
    public function setCompanyId($data)
    {

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
     * @return \IvozProvider\Model\Raw\Domains
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
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Domains
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

        $this->_setLoaded('DomainsIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DomainsIbfk1';

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
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\Domains
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

        $this->_setLoaded('DomainsIbfk2');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DomainsIbfk2';

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
     * Sets dependent relations kam_users_domain_attrs_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\KamUsersDomainAttrs
     * @return \IvozProvider\Model\Raw\Domains
     */
    public function setKamUsersDomainAttrs(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KamUsersDomainAttrs === null) {

                $this->getKamUsersDomainAttrs();
            }

            $oldRelations = $this->_KamUsersDomainAttrs;

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

        $this->_KamUsersDomainAttrs = array();

        foreach ($data as $object) {
            $this->addKamUsersDomainAttrs($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations kam_users_domain_attrs_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\KamUsersDomainAttrs $data
     * @return \IvozProvider\Model\Raw\Domains
     */
    public function addKamUsersDomainAttrs(\IvozProvider\Model\Raw\KamUsersDomainAttrs $data)
    {
        $this->_KamUsersDomainAttrs[] = $data;
        $this->_setLoaded('KamUsersDomainAttrsIbfk1');
        return $this;
    }

    /**
     * Gets dependent kam_users_domain_attrs_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\KamUsersDomainAttrs
     */
    public function getKamUsersDomainAttrs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamUsersDomainAttrsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KamUsersDomainAttrs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KamUsersDomainAttrs;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Domains
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Domains')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Domains);

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
     * @return null | \IvozProvider\Model\Validator\Domains
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Domains')) {

                $this->setValidator(new \IvozProvider\Validator\Domains);
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
     * @see \Mapper\Sql\Domains::delete
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