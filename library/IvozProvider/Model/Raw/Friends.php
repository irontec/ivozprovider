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
class Friends extends ModelAbstract
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
    protected $_callACLId;

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
     * Database var type smallint
     *
     * @var int
     */
    protected $_priority;

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
     * Parent relation Friends_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation Friends_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Countries
     */
    protected $_Country;

    /**
     * Parent relation Friends_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\CallACL
     */
    protected $_CallACL;

    /**
     * Parent relation Friends_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\DDIs
     */
    protected $_OutgoingDDI;

    /**
     * Parent relation Friends_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\Languages
     */
    protected $_Language;


    /**
     * Dependent relation FriendsPatterns_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\FriendsPatterns[]
     */
    protected $_FriendsPatterns;

    /**
     * Dependent relation ast_ps_endpoints_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\AstPsEndpoints[]
     */
    protected $_AstPsEndpoints;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'domain'=>'domain',
        'description'=>'description',
        'transport'=>'transport',
        'ip'=>'ip',
        'port'=>'port',
        'auth_needed'=>'authNeeded',
        'password'=>'password',
        'callACLId'=>'callACLId',
        'countryId'=>'countryId',
        'areaCode'=>'areaCode',
        'outgoingDDIId'=>'outgoingDDIId',
        'priority'=>'priority',
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
            'FriendsIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'FriendsIbfk2'=> array(
                    'property' => 'Country',
                    'table_name' => 'Countries',
                ),
            'FriendsIbfk3'=> array(
                    'property' => 'CallACL',
                    'table_name' => 'CallACL',
                ),
            'FriendsIbfk4'=> array(
                    'property' => 'OutgoingDDI',
                    'table_name' => 'DDIs',
                ),
            'FriendsIbfk5'=> array(
                    'property' => 'Language',
                    'table_name' => 'Languages',
                ),
        ));

        $this->setDependentList(array(
            'FriendsPatternsIbfk1' => array(
                    'property' => 'FriendsPatterns',
                    'table_name' => 'FriendsPatterns',
                ),
            'AstPsEndpointsIbfk2' => array(
                    'property' => 'AstPsEndpoints',
                    'table_name' => 'ast_ps_endpoints',
                ),
        ));




        $this->_defaultValues = array(
            'description' => '',
            'authNeeded' => 'yes',
            'priority' => '1',
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
     */
    public function setCallACLId($data)
    {

        if ($this->_callACLId != $data) {
            $this->_logChange('callACLId', $this->_callACLId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callACLId = $data;

        } else if (!is_null($data)) {
            $this->_callACLId = (int) $data;

        } else {
            $this->_callACLId = $data;
        }
        return $this;
    }

    /**
     * Gets column callACLId
     *
     * @return int
     */
    public function getCallACLId()
    {
        return $this->_callACLId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\Friends
     */
    public function setPriority($data)
    {

        if ($this->_priority != $data) {
            $this->_logChange('priority', $this->_priority, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_priority = $data;

        } else if (!is_null($data)) {
            $this->_priority = (int) $data;

        } else {
            $this->_priority = $data;
        }
        return $this;
    }

    /**
     * Gets column priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->_priority;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * @return \IvozProvider\Model\Raw\Friends
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
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Friends
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

        $this->_setLoaded('FriendsIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FriendsIbfk1';

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
     * @return \IvozProvider\Model\Raw\Friends
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

        $this->_setLoaded('FriendsIbfk2');
        return $this;
    }

    /**
     * Gets parent Country
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function getCountry($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FriendsIbfk2';

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
     * Sets parent relation CallACL
     *
     * @param \IvozProvider\Model\Raw\CallACL $data
     * @return \IvozProvider\Model\Raw\Friends
     */
    public function setCallACL(\IvozProvider\Model\Raw\CallACL $data)
    {
        $this->_CallACL = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCallACLId($primaryKey);
        }

        $this->_setLoaded('FriendsIbfk3');
        return $this;
    }

    /**
     * Gets parent CallACL
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\CallACL
     */
    public function getCallACL($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FriendsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_CallACL = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_CallACL;
    }

    /**
     * Sets parent relation OutgoingDDI
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\Friends
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

        $this->_setLoaded('FriendsIbfk4');
        return $this;
    }

    /**
     * Gets parent OutgoingDDI
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function getOutgoingDDI($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FriendsIbfk4';

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
     * @return \IvozProvider\Model\Raw\Friends
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

        $this->_setLoaded('FriendsIbfk5');
        return $this;
    }

    /**
     * Gets parent Language
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Languages
     */
    public function getLanguage($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FriendsIbfk5';

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
     * Sets dependent relations FriendsPatterns_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\FriendsPatterns
     * @return \IvozProvider\Model\Raw\Friends
     */
    public function setFriendsPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_FriendsPatterns === null) {

                $this->getFriendsPatterns();
            }

            $oldRelations = $this->_FriendsPatterns;

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

        $this->_FriendsPatterns = array();

        foreach ($data as $object) {
            $this->addFriendsPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations FriendsPatterns_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\FriendsPatterns $data
     * @return \IvozProvider\Model\Raw\Friends
     */
    public function addFriendsPatterns(\IvozProvider\Model\Raw\FriendsPatterns $data)
    {
        $this->_FriendsPatterns[] = $data;
        $this->_setLoaded('FriendsPatternsIbfk1');
        return $this;
    }

    /**
     * Gets dependent FriendsPatterns_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\FriendsPatterns
     */
    public function getFriendsPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FriendsPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_FriendsPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_FriendsPatterns;
    }

    /**
     * Sets dependent relations ast_ps_endpoints_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\AstPsEndpoints
     * @return \IvozProvider\Model\Raw\Friends
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
     * Sets dependent relations ast_ps_endpoints_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\AstPsEndpoints $data
     * @return \IvozProvider\Model\Raw\Friends
     */
    public function addAstPsEndpoints(\IvozProvider\Model\Raw\AstPsEndpoints $data)
    {
        $this->_AstPsEndpoints[] = $data;
        $this->_setLoaded('AstPsEndpointsIbfk2');
        return $this;
    }

    /**
     * Gets dependent ast_ps_endpoints_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function getAstPsEndpoints($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstPsEndpointsIbfk2';

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
     * @return IvozProvider\Mapper\Sql\Friends
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Friends')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Friends);

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
     * @return null | \IvozProvider\Model\Validator\Friends
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Friends')) {

                $this->setValidator(new \IvozProvider\Validator\Friends);
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
     * @see \Mapper\Sql\Friends::delete
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