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
class RetailAccounts extends ModelAbstract
{

    protected $_transportAcceptedValues = array(
        'udp',
        'tcp',
        'tls',
    );
    protected $_authNeededAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_directMediaMethodAcceptedValues = array(
        'invite',
        'update',
    );
    protected $_calleridUpdateHeaderAcceptedValues = array(
        'pai',
        'rpid',
    );
    protected $_updateCalleridAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_directConnectivityAcceptedValues = array(
        'yes',
        'no',
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
    protected $_name;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_domain;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_description;

    /**
     * [enum:udp|tcp|tls]
     * Database var type varchar
     *
     * @var string
     */
    protected $_transport;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ip;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_port;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_authNeeded;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_password;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_countryId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_areaCode;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_outgoingDDIId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_disallow;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_allow;

    /**
     * [enum:invite|update]
     * Database var type enum('invite','update')
     *
     * @var string
     */
    protected $_directMediaMethod;

    /**
     * [enum:pai|rpid]
     * Database var type enum('pai','rpid')
     *
     * @var string
     */
    protected $_calleridUpdateHeader;

    /**
     * [enum:yes|no]
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_updateCallerid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromDomain;

    /**
     * [enum:yes|no]
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_directConnectivity;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_languageId;


    /**
     * Parent relation RetailAccounts_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation RetailAccounts_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation RetailAccounts_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Countries
     */
    protected $_Country;

    /**
     * Parent relation RetailAccounts_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\DDIs
     */
    protected $_OutgoingDDI;

    /**
     * Parent relation RetailAccounts_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\Languages
     */
    protected $_Language;


    /**
     * Dependent relation DDIs_ibfk_14
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation ast_ps_endpoints_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\AstPsEndpoints[]
     */
    protected $_AstPsEndpoints;

    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
        'companyId'=>'companyId',
        'name'=>'name',
        'domain'=>'domain',
        'description'=>'description',
        'transport'=>'transport',
        'ip'=>'ip',
        'port'=>'port',
        'auth_needed'=>'authNeeded',
        'password'=>'password',
        'countryId'=>'countryId',
        'areaCode'=>'areaCode',
        'outgoingDDIId'=>'outgoingDDIId',
        'disallow'=>'disallow',
        'allow'=>'allow',
        'direct_media_method'=>'directMediaMethod',
        'callerid_update_header'=>'calleridUpdateHeader',
        'update_callerid'=>'updateCallerid',
        'from_domain'=>'fromDomain',
        'directConnectivity'=>'directConnectivity',
        'languageId'=>'languageId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'transport'=> array('enum:udp|tcp|tls'),
            'direct_media_method'=> array('enum:invite|update'),
            'callerid_update_header'=> array('enum:pai|rpid'),
            'update_callerid'=> array('enum:yes|no'),
            'directConnectivity'=> array('enum:yes|no'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'RetailAccountsIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'RetailAccountsIbfk2'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'RetailAccountsIbfk3'=> array(
                    'property' => 'Country',
                    'table_name' => 'Countries',
                ),
            'RetailAccountsIbfk4'=> array(
                    'property' => 'OutgoingDDI',
                    'table_name' => 'DDIs',
                ),
            'RetailAccountsIbfk5'=> array(
                    'property' => 'Language',
                    'table_name' => 'Languages',
                ),
        ));

        $this->setDependentList(array(
            'DDIsIbfk14' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'AstPsEndpointsIbfk3' => array(
                    'property' => 'AstPsEndpoints',
                    'table_name' => 'ast_ps_endpoints',
                ),
        ));


        $this->setOnDeleteSetNullRelationships(array(
            'DDIs_ibfk_14'
        ));


        $this->_defaultValues = array(
            'description' => '',
            'authNeeded' => 'yes',
            'disallow' => 'all',
            'allow' => 'alaw',
            'directMediaMethod' => 'update',
            'calleridUpdateHeader' => 'pai',
            'updateCallerid' => 'yes',
            'directConnectivity' => 'yes',
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
     * @return \IvozProvider\Model\Raw\RetailAccounts
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
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setBrandId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \IvozProvider\Model\Raw\RetailAccounts
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
     * @return \IvozProvider\Model\Raw\RetailAccounts
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
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setDomain($data)
    {

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
     * @return \IvozProvider\Model\Raw\RetailAccounts
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setTransport($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_transport != $data) {
            $this->_logChange('transport', $this->_transport, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_transport = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_transportAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(sprintf(_('Invalid value for %s'), 'transport'));
            }
            $this->_transport = (string) $data;

        } else {
            $this->_transport = $data;
        }
        return $this;
    }

    /**
     * Gets column transport
     *
     * @return string
     */
    public function getTransport()
    {
        return $this->_transport;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setIp($data)
    {

        if ($this->_ip != $data) {
            $this->_logChange('ip', $this->_ip, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ip = $data;

        } else if (!is_null($data)) {
            $this->_ip = (string) $data;

        } else {
            $this->_ip = $data;
        }
        return $this;
    }

    /**
     * Gets column ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->_ip;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setPort($data)
    {

        if ($this->_port != $data) {
            $this->_logChange('port', $this->_port, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_port = $data;

        } else if (!is_null($data)) {
            $this->_port = (int) $data;

        } else {
            $this->_port = $data;
        }
        return $this;
    }

    /**
     * Gets column port
     *
     * @return int
     */
    public function getPort()
    {
        return $this->_port;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setAuthNeeded($data)
    {

        if ($this->_authNeeded != $data) {
            $this->_logChange('authNeeded', $this->_authNeeded, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_authNeeded = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_authNeededAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(sprintf(_('Invalid value for %s'), 'authNeeded'));
            }
            $this->_authNeeded = (string) $data;

        } else {
            $this->_authNeeded = $data;
        }
        return $this;
    }

    /**
     * Gets column auth_needed
     *
     * @return string
     */
    public function getAuthNeeded()
    {
        return $this->_authNeeded;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setPassword($data)
    {

        if ($this->_password != $data) {
            $this->_logChange('password', $this->_password, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_password = $data;

        } else if (!is_null($data)) {
            $this->_password = (string) $data;

        } else {
            $this->_password = $data;
        }
        return $this;
    }

    /**
     * Gets column password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setCountryId($data)
    {

        if ($this->_countryId != $data) {
            $this->_logChange('countryId', $this->_countryId, $data);
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setAreaCode($data)
    {

        if ($this->_areaCode != $data) {
            $this->_logChange('areaCode', $this->_areaCode, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_areaCode = $data;

        } else if (!is_null($data)) {
            $this->_areaCode = (string) $data;

        } else {
            $this->_areaCode = $data;
        }
        return $this;
    }

    /**
     * Gets column areaCode
     *
     * @return string
     */
    public function getAreaCode()
    {
        return $this->_areaCode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setOutgoingDDIId($data)
    {

        if ($this->_outgoingDDIId != $data) {
            $this->_logChange('outgoingDDIId', $this->_outgoingDDIId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outgoingDDIId = $data;

        } else if (!is_null($data)) {
            $this->_outgoingDDIId = (int) $data;

        } else {
            $this->_outgoingDDIId = $data;
        }
        return $this;
    }

    /**
     * Gets column outgoingDDIId
     *
     * @return int
     */
    public function getOutgoingDDIId()
    {
        return $this->_outgoingDDIId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setDisallow($data)
    {

        if ($this->_disallow != $data) {
            $this->_logChange('disallow', $this->_disallow, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_disallow = $data;

        } else if (!is_null($data)) {
            $this->_disallow = (string) $data;

        } else {
            $this->_disallow = $data;
        }
        return $this;
    }

    /**
     * Gets column disallow
     *
     * @return string
     */
    public function getDisallow()
    {
        return $this->_disallow;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setAllow($data)
    {

        if ($this->_allow != $data) {
            $this->_logChange('allow', $this->_allow, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_allow = $data;

        } else if (!is_null($data)) {
            $this->_allow = (string) $data;

        } else {
            $this->_allow = $data;
        }
        return $this;
    }

    /**
     * Gets column allow
     *
     * @return string
     */
    public function getAllow()
    {
        return $this->_allow;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setDirectMediaMethod($data)
    {

        if ($this->_directMediaMethod != $data) {
            $this->_logChange('directMediaMethod', $this->_directMediaMethod, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_directMediaMethod = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_directMediaMethodAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(sprintf(_('Invalid value for %s'), 'directMediaMethod'));
            }
            $this->_directMediaMethod = (string) $data;

        } else {
            $this->_directMediaMethod = $data;
        }
        return $this;
    }

    /**
     * Gets column direct_media_method
     *
     * @return string
     */
    public function getDirectMediaMethod()
    {
        return $this->_directMediaMethod;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setCalleridUpdateHeader($data)
    {

        if ($this->_calleridUpdateHeader != $data) {
            $this->_logChange('calleridUpdateHeader', $this->_calleridUpdateHeader, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_calleridUpdateHeader = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_calleridUpdateHeaderAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(sprintf(_('Invalid value for %s'), 'calleridUpdateHeader'));
            }
            $this->_calleridUpdateHeader = (string) $data;

        } else {
            $this->_calleridUpdateHeader = $data;
        }
        return $this;
    }

    /**
     * Gets column callerid_update_header
     *
     * @return string
     */
    public function getCalleridUpdateHeader()
    {
        return $this->_calleridUpdateHeader;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setUpdateCallerid($data)
    {

        if ($this->_updateCallerid != $data) {
            $this->_logChange('updateCallerid', $this->_updateCallerid, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_updateCallerid = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_updateCalleridAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(sprintf(_('Invalid value for %s'), 'updateCallerid'));
            }
            $this->_updateCallerid = (string) $data;

        } else {
            $this->_updateCallerid = $data;
        }
        return $this;
    }

    /**
     * Gets column update_callerid
     *
     * @return string
     */
    public function getUpdateCallerid()
    {
        return $this->_updateCallerid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setFromDomain($data)
    {

        if ($this->_fromDomain != $data) {
            $this->_logChange('fromDomain', $this->_fromDomain, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fromDomain = $data;

        } else if (!is_null($data)) {
            $this->_fromDomain = (string) $data;

        } else {
            $this->_fromDomain = $data;
        }
        return $this;
    }

    /**
     * Gets column from_domain
     *
     * @return string
     */
    public function getFromDomain()
    {
        return $this->_fromDomain;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setDirectConnectivity($data)
    {

        if ($this->_directConnectivity != $data) {
            $this->_logChange('directConnectivity', $this->_directConnectivity, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_directConnectivity = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_directConnectivityAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(sprintf(_('Invalid value for %s'), 'directConnectivity'));
            }
            $this->_directConnectivity = (string) $data;

        } else {
            $this->_directConnectivity = $data;
        }
        return $this;
    }

    /**
     * Gets column directConnectivity
     *
     * @return string
     */
    public function getDirectConnectivity()
    {
        return $this->_directConnectivity;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setLanguageId($data)
    {

        if ($this->_languageId != $data) {
            $this->_logChange('languageId', $this->_languageId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_languageId = $data;

        } else if (!is_null($data)) {
            $this->_languageId = (int) $data;

        } else {
            $this->_languageId = $data;
        }
        return $this;
    }

    /**
     * Gets column languageId
     *
     * @return int
     */
    public function getLanguageId()
    {
        return $this->_languageId;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
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

        $this->_setLoaded('RetailAccountsIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RetailAccountsIbfk1';

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
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
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

        $this->_setLoaded('RetailAccountsIbfk2');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RetailAccountsIbfk2';

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
     * Sets parent relation Country
     *
     * @param \IvozProvider\Model\Raw\Countries $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
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

        $this->_setLoaded('RetailAccountsIbfk3');
        return $this;
    }

    /**
     * Gets parent Country
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function getCountry($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RetailAccountsIbfk3';

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
     * Sets parent relation OutgoingDDI
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setOutgoingDDI(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_OutgoingDDI = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutgoingDDIId($primaryKey);
        }

        $this->_setLoaded('RetailAccountsIbfk4');
        return $this;
    }

    /**
     * Gets parent OutgoingDDI
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function getOutgoingDDI($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RetailAccountsIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingDDI = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_OutgoingDDI;
    }

    /**
     * Sets parent relation Language
     *
     * @param \IvozProvider\Model\Raw\Languages $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setLanguage(\IvozProvider\Model\Raw\Languages $data)
    {
        $this->_Language = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setLanguageId($primaryKey);
        }

        $this->_setLoaded('RetailAccountsIbfk5');
        return $this;
    }

    /**
     * Gets parent Language
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Languages
     */
    public function getLanguage($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RetailAccountsIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Language = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Language;
    }

    /**
     * Sets dependent relations DDIs_ibfk_14
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\RetailAccounts
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
     * Sets dependent relations DDIs_ibfk_14
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk14');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_14
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk14';

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
     * Sets dependent relations ast_ps_endpoints_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\AstPsEndpoints
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function setAstPsEndpoints(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_AstPsEndpoints === null) {

                $this->getAstPsEndpoints();
            }

            $oldRelations = $this->_AstPsEndpoints;

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

        $this->_AstPsEndpoints = array();

        foreach ($data as $object) {
            $this->addAstPsEndpoints($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ast_ps_endpoints_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\AstPsEndpoints $data
     * @return \IvozProvider\Model\Raw\RetailAccounts
     */
    public function addAstPsEndpoints(\IvozProvider\Model\Raw\AstPsEndpoints $data)
    {
        $this->_AstPsEndpoints[] = $data;
        $this->_setLoaded('AstPsEndpointsIbfk3');
        return $this;
    }

    /**
     * Gets dependent ast_ps_endpoints_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function getAstPsEndpoints($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstPsEndpointsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_AstPsEndpoints = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_AstPsEndpoints;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\RetailAccounts
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\RetailAccounts')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\RetailAccounts);

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
     * @return null | \IvozProvider\Model\Validator\RetailAccounts
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\RetailAccounts')) {

                $this->setValidator(new \IvozProvider\Validator\RetailAccounts);
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
     * @see \Mapper\Sql\RetailAccounts::delete
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