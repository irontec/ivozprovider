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
class DDIs extends ModelAbstract
{

    protected $_routeTypeAcceptedValues = array(
        'user',
        'IVRCommon',
        'IVRCustom',
        'huntGroup',
        'fax',
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
    protected $_DDI;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_DDIE164;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_externalCallFilterId;

    /**
     * [enum:user|IVRCommon|IVRCustom|huntGroup|fax]
     * Database var type varchar
     *
     * @var string
     */
    protected $_routeType;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_userId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_IVRCommonId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_IVRCustomId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_huntGroupId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_faxId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_peeringContractId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_countryId;


    /**
     * Parent relation DDIs_ibfk_9
     *
     * @var \IvozProvider\Model\Raw\Countries
     */
    protected $_Country;

    /**
     * Parent relation DDIs_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation DDIs_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilters
     */
    protected $_ExternalCallFilter;

    /**
     * Parent relation DDIs_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_User;

    /**
     * Parent relation DDIs_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\IVRCommon
     */
    protected $_IVRCommon;

    /**
     * Parent relation DDIs_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\IVRCustom
     */
    protected $_IVRCustom;

    /**
     * Parent relation DDIs_ibfk_6
     *
     * @var \IvozProvider\Model\Raw\HuntGroups
     */
    protected $_HuntGroup;

    /**
     * Parent relation DDIs_ibfk_7
     *
     * @var \IvozProvider\Model\Raw\Faxes
     */
    protected $_Fax;

    /**
     * Parent relation DDIs_ibfk_8
     *
     * @var \IvozProvider\Model\Raw\PeeringContracts
     */
    protected $_PeeringContract;


    /**
     * Dependent relation Faxes_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Faxes[]
     */
    protected $_Faxes;

    /**
     * Dependent relation Users_ibfk_9
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Users[]
     */
    protected $_Users;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'DDI'=>'DDI',
        'DDIE164'=>'DDIE164',
        'externalCallFilterId'=>'externalCallFilterId',
        'routeType'=>'routeType',
        'userId'=>'userId',
        'IVRCommonId'=>'IVRCommonId',
        'IVRCustomId'=>'IVRCustomId',
        'huntGroupId'=>'huntGroupId',
        'faxId'=>'faxId',
        'peeringContractId'=>'peeringContractId',
        'countryId'=>'countryId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'routeType'=> array('enum:user|IVRCommon|IVRCustom|huntGroup|fax'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'DDIsIbfk9'=> array(
                    'property' => 'Country',
                    'table_name' => 'Countries',
                ),
            'DDIsIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'DDIsIbfk2'=> array(
                    'property' => 'ExternalCallFilter',
                    'table_name' => 'ExternalCallFilters',
                ),
            'DDIsIbfk3'=> array(
                    'property' => 'User',
                    'table_name' => 'Users',
                ),
            'DDIsIbfk4'=> array(
                    'property' => 'IVRCommon',
                    'table_name' => 'IVRCommon',
                ),
            'DDIsIbfk5'=> array(
                    'property' => 'IVRCustom',
                    'table_name' => 'IVRCustom',
                ),
            'DDIsIbfk6'=> array(
                    'property' => 'HuntGroup',
                    'table_name' => 'HuntGroups',
                ),
            'DDIsIbfk7'=> array(
                    'property' => 'Fax',
                    'table_name' => 'Faxes',
                ),
            'DDIsIbfk8'=> array(
                    'property' => 'PeeringContract',
                    'table_name' => 'PeeringContracts',
                ),
        ));

        $this->setDependentList(array(
            'FaxesIbfk2' => array(
                    'property' => 'Faxes',
                    'table_name' => 'Faxes',
                ),
            'UsersIbfk9' => array(
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
     * @return \IvozProvider\Model\Raw\DDIs
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
     * @return \IvozProvider\Model\Raw\DDIs
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
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setDDI($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_DDI != $data) {
            $this->_logChange('DDI');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_DDI = $data;

        } else if (!is_null($data)) {
            $this->_DDI = (string) $data;

        } else {
            $this->_DDI = $data;
        }
        return $this;
    }

    /**
     * Gets column DDI
     *
     * @return string
     */
    public function getDDI()
    {
        return $this->_DDI;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setDDIE164($data)
    {

        if ($this->_DDIE164 != $data) {
            $this->_logChange('DDIE164');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_DDIE164 = $data;

        } else if (!is_null($data)) {
            $this->_DDIE164 = (string) $data;

        } else {
            $this->_DDIE164 = $data;
        }
        return $this;
    }

    /**
     * Gets column DDIE164
     *
     * @return string
     */
    public function getDDIE164()
    {
        return $this->_DDIE164;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setExternalCallFilterId($data)
    {

        if ($this->_externalCallFilterId != $data) {
            $this->_logChange('externalCallFilterId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_externalCallFilterId = $data;

        } else if (!is_null($data)) {
            $this->_externalCallFilterId = (int) $data;

        } else {
            $this->_externalCallFilterId = $data;
        }
        return $this;
    }

    /**
     * Gets column externalCallFilterId
     *
     * @return int
     */
    public function getExternalCallFilterId()
    {
        return $this->_externalCallFilterId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setRouteType($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_routeType != $data) {
            $this->_logChange('routeType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_routeType = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_routeTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for routeType'));
            }
            $this->_routeType = (string) $data;

        } else {
            $this->_routeType = $data;
        }
        return $this;
    }

    /**
     * Gets column routeType
     *
     * @return string
     */
    public function getRouteType()
    {
        return $this->_routeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setUserId($data)
    {

        if ($this->_userId != $data) {
            $this->_logChange('userId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_userId = $data;

        } else if (!is_null($data)) {
            $this->_userId = (int) $data;

        } else {
            $this->_userId = $data;
        }
        return $this;
    }

    /**
     * Gets column userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setIVRCommonId($data)
    {

        if ($this->_IVRCommonId != $data) {
            $this->_logChange('IVRCommonId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_IVRCommonId = $data;

        } else if (!is_null($data)) {
            $this->_IVRCommonId = (int) $data;

        } else {
            $this->_IVRCommonId = $data;
        }
        return $this;
    }

    /**
     * Gets column IVRCommonId
     *
     * @return int
     */
    public function getIVRCommonId()
    {
        return $this->_IVRCommonId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setIVRCustomId($data)
    {

        if ($this->_IVRCustomId != $data) {
            $this->_logChange('IVRCustomId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_IVRCustomId = $data;

        } else if (!is_null($data)) {
            $this->_IVRCustomId = (int) $data;

        } else {
            $this->_IVRCustomId = $data;
        }
        return $this;
    }

    /**
     * Gets column IVRCustomId
     *
     * @return int
     */
    public function getIVRCustomId()
    {
        return $this->_IVRCustomId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setHuntGroupId($data)
    {

        if ($this->_huntGroupId != $data) {
            $this->_logChange('huntGroupId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_huntGroupId = $data;

        } else if (!is_null($data)) {
            $this->_huntGroupId = (int) $data;

        } else {
            $this->_huntGroupId = $data;
        }
        return $this;
    }

    /**
     * Gets column huntGroupId
     *
     * @return int
     */
    public function getHuntGroupId()
    {
        return $this->_huntGroupId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setFaxId($data)
    {

        if ($this->_faxId != $data) {
            $this->_logChange('faxId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_faxId = $data;

        } else if (!is_null($data)) {
            $this->_faxId = (int) $data;

        } else {
            $this->_faxId = $data;
        }
        return $this;
    }

    /**
     * Gets column faxId
     *
     * @return int
     */
    public function getFaxId()
    {
        return $this->_faxId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setPeeringContractId($data)
    {

        if ($this->_peeringContractId != $data) {
            $this->_logChange('peeringContractId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_peeringContractId = $data;

        } else if (!is_null($data)) {
            $this->_peeringContractId = (int) $data;

        } else {
            $this->_peeringContractId = $data;
        }
        return $this;
    }

    /**
     * Gets column peeringContractId
     *
     * @return int
     */
    public function getPeeringContractId()
    {
        return $this->_peeringContractId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setCountryId($data)
    {

        if ($this->_countryId != $data) {
            $this->_logChange('countryId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_countryId = $data;

        } else if (!is_null($data)) {
            $this->_countryId = (int) $data;

        } else {
            $this->_countryId = $data;
        }
        return $this;
    }

    /**
     * Gets column countryId
     *
     * @return int
     */
    public function getCountryId()
    {
        return $this->_countryId;
    }

    /**
     * Sets parent relation Country
     *
     * @param \IvozProvider\Model\Raw\Countries $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setCountry(\IvozProvider\Model\Raw\Countries $data)
    {
        $this->_Country = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCountryId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk9');
        return $this;
    }

    /**
     * Gets parent Country
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function getCountry($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk9';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Country = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Country;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\DDIs
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

        $this->_setLoaded('DDIsIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk1';

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
     * Sets parent relation ExternalCallFilter
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilters $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setExternalCallFilter(\IvozProvider\Model\Raw\ExternalCallFilters $data)
    {
        $this->_ExternalCallFilter = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setExternalCallFilterId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk2');
        return $this;
    }

    /**
     * Gets parent ExternalCallFilter
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function getExternalCallFilter($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ExternalCallFilter = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ExternalCallFilter;
    }

    /**
     * Sets parent relation User
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_User = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setUserId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk3');
        return $this;
    }

    /**
     * Gets parent User
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_User = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_User;
    }

    /**
     * Sets parent relation IVRCommon
     *
     * @param \IvozProvider\Model\Raw\IVRCommon $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setIVRCommon(\IvozProvider\Model\Raw\IVRCommon $data)
    {
        $this->_IVRCommon = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setIVRCommonId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk4');
        return $this;
    }

    /**
     * Gets parent IVRCommon
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\IVRCommon
     */
    public function getIVRCommon($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_IVRCommon = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_IVRCommon;
    }

    /**
     * Sets parent relation IVRCustom
     *
     * @param \IvozProvider\Model\Raw\IVRCustom $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setIVRCustom(\IvozProvider\Model\Raw\IVRCustom $data)
    {
        $this->_IVRCustom = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setIVRCustomId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk5');
        return $this;
    }

    /**
     * Gets parent IVRCustom
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\IVRCustom
     */
    public function getIVRCustom($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_IVRCustom = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_IVRCustom;
    }

    /**
     * Sets parent relation HuntGroup
     *
     * @param \IvozProvider\Model\Raw\HuntGroups $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setHuntGroup(\IvozProvider\Model\Raw\HuntGroups $data)
    {
        $this->_HuntGroup = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setHuntGroupId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk6');
        return $this;
    }

    /**
     * Gets parent HuntGroup
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\HuntGroups
     */
    public function getHuntGroup($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk6';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_HuntGroup = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_HuntGroup;
    }

    /**
     * Sets parent relation Fax
     *
     * @param \IvozProvider\Model\Raw\Faxes $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setFax(\IvozProvider\Model\Raw\Faxes $data)
    {
        $this->_Fax = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setFaxId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk7');
        return $this;
    }

    /**
     * Gets parent Fax
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Faxes
     */
    public function getFax($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk7';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Fax = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Fax;
    }

    /**
     * Sets parent relation PeeringContract
     *
     * @param \IvozProvider\Model\Raw\PeeringContracts $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setPeeringContract(\IvozProvider\Model\Raw\PeeringContracts $data)
    {
        $this->_PeeringContract = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPeeringContractId($primaryKey);
        }

        $this->_setLoaded('DDIsIbfk8');
        return $this;
    }

    /**
     * Gets parent PeeringContract
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function getPeeringContract($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk8';

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
     * Sets dependent relations Faxes_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Faxes
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function setFaxes(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Faxes === null) {

                $this->getFaxes();
            }

            $oldRelations = $this->_Faxes;

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

        $this->_Faxes = array();

        foreach ($data as $object) {
            $this->addFaxes($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Faxes_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\Faxes $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function addFaxes(\IvozProvider\Model\Raw\Faxes $data)
    {
        $this->_Faxes[] = $data;
        $this->_setLoaded('FaxesIbfk2');
        return $this;
    }

    /**
     * Gets dependent Faxes_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Faxes
     */
    public function getFaxes($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FaxesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Faxes = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Faxes;
    }

    /**
     * Sets dependent relations Users_ibfk_9
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Users
     * @return \IvozProvider\Model\Raw\DDIs
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
     * Sets dependent relations Users_ibfk_9
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function addUsers(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_Users[] = $data;
        $this->_setLoaded('UsersIbfk9');
        return $this;
    }

    /**
     * Gets dependent Users_ibfk_9
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Users
     */
    public function getUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk9';

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
     * @return IvozProvider\Mapper\Sql\DDIs
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\DDIs')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\DDIs);

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
     * @return null | \IvozProvider\Model\Validator\DDIs
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\DDIs')) {

                $this->setValidator(new \IvozProvider\Validator\DDIs);
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
     * @see \Mapper\Sql\DDIs::delete
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