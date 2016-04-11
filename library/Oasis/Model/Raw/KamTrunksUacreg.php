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
class KamTrunksUacreg extends ModelAbstract
{


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
    protected $_lUuid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_lUsername;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_lDomain;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_rUsername;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_rDomain;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_realm;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_authUsername;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_authPassword;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_authProxy;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_expires;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_peeringContractId;


    /**
     * Parent relation kam_trunks_uacreg_ibfk_1
     *
     * @var \Oasis\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation kam_trunks_uacreg_ibfk_2
     *
     * @var \Oasis\Model\Raw\PeeringContracts
     */
    protected $_PeeringContract;


    protected $_columnsList = array(
        'id'=>'id',
        'l_uuid'=>'lUuid',
        'l_username'=>'lUsername',
        'l_domain'=>'lDomain',
        'r_username'=>'rUsername',
        'r_domain'=>'rDomain',
        'realm'=>'realm',
        'auth_username'=>'authUsername',
        'auth_password'=>'authPassword',
        'auth_proxy'=>'authProxy',
        'expires'=>'expires',
        'brandId'=>'brandId',
        'peeringContractId'=>'peeringContractId',
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
            'KamTrunksUacregIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'KamTrunksUacregIbfk2'=> array(
                    'property' => 'PeeringContract',
                    'table_name' => 'PeeringContracts',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'lUuid' => '',
            'lUsername' => 'unused',
            'lDomain' => 'unused',
            'rUsername' => '',
            'rDomain' => '',
            'realm' => '',
            'authUsername' => '',
            'authPassword' => '',
            'authProxy' => '',
            'expires' => '0',
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
     * @return \Oasis\Model\Raw\KamTrunksUacreg
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
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setLUuid($data)
    {

        if ($this->_lUuid != $data) {
            $this->_logChange('lUuid');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_lUuid = $data;

        } else if (!is_null($data)) {
            $this->_lUuid = (string) $data;

        } else {
            $this->_lUuid = $data;
        }
        return $this;
    }

    /**
     * Gets column l_uuid
     *
     * @return string
     */
    public function getLUuid()
    {
        return $this->_lUuid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setLUsername($data)
    {

        if ($this->_lUsername != $data) {
            $this->_logChange('lUsername');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_lUsername = $data;

        } else if (!is_null($data)) {
            $this->_lUsername = (string) $data;

        } else {
            $this->_lUsername = $data;
        }
        return $this;
    }

    /**
     * Gets column l_username
     *
     * @return string
     */
    public function getLUsername()
    {
        return $this->_lUsername;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setLDomain($data)
    {

        if ($this->_lDomain != $data) {
            $this->_logChange('lDomain');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_lDomain = $data;

        } else if (!is_null($data)) {
            $this->_lDomain = (string) $data;

        } else {
            $this->_lDomain = $data;
        }
        return $this;
    }

    /**
     * Gets column l_domain
     *
     * @return string
     */
    public function getLDomain()
    {
        return $this->_lDomain;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setRUsername($data)
    {

        if ($this->_rUsername != $data) {
            $this->_logChange('rUsername');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_rUsername = $data;

        } else if (!is_null($data)) {
            $this->_rUsername = (string) $data;

        } else {
            $this->_rUsername = $data;
        }
        return $this;
    }

    /**
     * Gets column r_username
     *
     * @return string
     */
    public function getRUsername()
    {
        return $this->_rUsername;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setRDomain($data)
    {

        if ($this->_rDomain != $data) {
            $this->_logChange('rDomain');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_rDomain = $data;

        } else if (!is_null($data)) {
            $this->_rDomain = (string) $data;

        } else {
            $this->_rDomain = $data;
        }
        return $this;
    }

    /**
     * Gets column r_domain
     *
     * @return string
     */
    public function getRDomain()
    {
        return $this->_rDomain;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setRealm($data)
    {

        if ($this->_realm != $data) {
            $this->_logChange('realm');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_realm = $data;

        } else if (!is_null($data)) {
            $this->_realm = (string) $data;

        } else {
            $this->_realm = $data;
        }
        return $this;
    }

    /**
     * Gets column realm
     *
     * @return string
     */
    public function getRealm()
    {
        return $this->_realm;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setAuthUsername($data)
    {

        if ($this->_authUsername != $data) {
            $this->_logChange('authUsername');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_authUsername = $data;

        } else if (!is_null($data)) {
            $this->_authUsername = (string) $data;

        } else {
            $this->_authUsername = $data;
        }
        return $this;
    }

    /**
     * Gets column auth_username
     *
     * @return string
     */
    public function getAuthUsername()
    {
        return $this->_authUsername;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setAuthPassword($data)
    {

        if ($this->_authPassword != $data) {
            $this->_logChange('authPassword');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_authPassword = $data;

        } else if (!is_null($data)) {
            $this->_authPassword = (string) $data;

        } else {
            $this->_authPassword = $data;
        }
        return $this;
    }

    /**
     * Gets column auth_password
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->_authPassword;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setAuthProxy($data)
    {

        if ($this->_authProxy != $data) {
            $this->_logChange('authProxy');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_authProxy = $data;

        } else if (!is_null($data)) {
            $this->_authProxy = (string) $data;

        } else {
            $this->_authProxy = $data;
        }
        return $this;
    }

    /**
     * Gets column auth_proxy
     *
     * @return string
     */
    public function getAuthProxy()
    {
        return $this->_authProxy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setExpires($data)
    {

        if ($this->_expires != $data) {
            $this->_logChange('expires');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_expires = $data;

        } else if (!is_null($data)) {
            $this->_expires = (int) $data;

        } else {
            $this->_expires = $data;
        }
        return $this;
    }

    /**
     * Gets column expires
     *
     * @return int
     */
    public function getExpires()
    {
        return $this->_expires;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
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
     * @param binary $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setPeeringContractId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_peeringContractId != $data) {
            $this->_logChange('peeringContractId');
        }

        $this->_peeringContractId = $data;
        return $this;
    }

    /**
     * Gets column peeringContractId
     *
     * @return binary
     */
    public function getPeeringContractId()
    {
        return $this->_peeringContractId;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \Oasis\Model\Raw\Brands $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
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

        $this->_setLoaded('KamTrunksUacregIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamTrunksUacregIbfk1';

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
     * Sets parent relation PeeringContract
     *
     * @param \Oasis\Model\Raw\PeeringContracts $data
     * @return \Oasis\Model\Raw\KamTrunksUacreg
     */
    public function setPeeringContract(\Oasis\Model\Raw\PeeringContracts $data)
    {
        $this->_PeeringContract = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPeeringContractId($primaryKey);
        }

        $this->_setLoaded('KamTrunksUacregIbfk2');
        return $this;
    }

    /**
     * Gets parent PeeringContract
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\PeeringContracts
     */
    public function getPeeringContract($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamTrunksUacregIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PeeringContract = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PeeringContract;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamTrunksUacreg
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamTrunksUacreg')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamTrunksUacreg);

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
     * @return null | \Oasis\Model\Validator\KamTrunksUacreg
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamTrunksUacreg')) {

                $this->setValidator(new \Oasis\Validator\KamTrunksUacreg);
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
     * @see \Mapper\Sql\KamTrunksUacreg::delete
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