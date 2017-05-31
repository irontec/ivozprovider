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
class PeerServers extends ModelAbstract
{

    protected $_authNeededAcceptedValues = array(
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
    protected $_peeringContractId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ip;

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
    protected $_hostname;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_port;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_params;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_uriScheme;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_transport;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_strip;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_prefix;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_sendPAI;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_sendRPID;

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
    protected $_authUser;

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
    protected $_sipProxy;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_outboundProxy;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromUser;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromDomain;


    /**
     * Parent relation PeerServers_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\PeeringContracts
     */
    protected $_PeeringContract;

    /**
     * Parent relation PeerServers_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;


    /**
     * Dependent relation LcrGateways_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\LcrGateways[]
     */
    protected $_LcrGateways;

    protected $_columnsList = array(
        'id'=>'id',
        'peeringContractId'=>'peeringContractId',
        'ip'=>'ip',
        'brandId'=>'brandId',
        'hostname'=>'hostname',
        'port'=>'port',
        'params'=>'params',
        'uri_scheme'=>'uriScheme',
        'transport'=>'transport',
        'strip'=>'strip',
        'prefix'=>'prefix',
        'sendPAI'=>'sendPAI',
        'sendRPID'=>'sendRPID',
        'auth_needed'=>'authNeeded',
        'auth_user'=>'authUser',
        'auth_password'=>'authPassword',
        'sip_proxy'=>'sipProxy',
        'outbound_proxy'=>'outboundProxy',
        'from_user'=>'fromUser',
        'from_domain'=>'fromDomain',
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
            'PeerServersIbfk1'=> array(
                    'property' => 'PeeringContract',
                    'table_name' => 'PeeringContracts',
                ),
            'PeerServersIbfk2'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
        ));

        $this->setDependentList(array(
            'LcrGatewaysIbfk2' => array(
                    'property' => 'LcrGateways',
                    'table_name' => 'LcrGateways',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'LcrGateways_ibfk_2'
        ));



        $this->_defaultValues = array(
            'authNeeded' => 'no',
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
     * @return \IvozProvider\Model\Raw\PeerServers
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
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setPeeringContractId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_peeringContractId != $data) {
            $this->_logChange('peeringContractId', $this->_peeringContractId, $data);
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\PeerServers
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
     * @return \IvozProvider\Model\Raw\PeerServers
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setHostname($data)
    {

        if ($this->_hostname != $data) {
            $this->_logChange('hostname', $this->_hostname, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_hostname = $data;

        } else if (!is_null($data)) {
            $this->_hostname = (string) $data;

        } else {
            $this->_hostname = $data;
        }
        return $this;
    }

    /**
     * Gets column hostname
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->_hostname;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
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
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setParams($data)
    {

        if ($this->_params != $data) {
            $this->_logChange('params', $this->_params, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_params = $data;

        } else if (!is_null($data)) {
            $this->_params = (string) $data;

        } else {
            $this->_params = $data;
        }
        return $this;
    }

    /**
     * Gets column params
     *
     * @return string
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setUriScheme($data)
    {

        if ($this->_uriScheme != $data) {
            $this->_logChange('uriScheme', $this->_uriScheme, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_uriScheme = $data;

        } else if (!is_null($data)) {
            $this->_uriScheme = (int) $data;

        } else {
            $this->_uriScheme = $data;
        }
        return $this;
    }

    /**
     * Gets column uri_scheme
     *
     * @return int
     */
    public function getUriScheme()
    {
        return $this->_uriScheme;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setTransport($data)
    {

        if ($this->_transport != $data) {
            $this->_logChange('transport', $this->_transport, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_transport = $data;

        } else if (!is_null($data)) {
            $this->_transport = (int) $data;

        } else {
            $this->_transport = $data;
        }
        return $this;
    }

    /**
     * Gets column transport
     *
     * @return int
     */
    public function getTransport()
    {
        return $this->_transport;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setStrip($data)
    {

        if ($this->_strip != $data) {
            $this->_logChange('strip', $this->_strip, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_strip = $data;

        } else if (!is_null($data)) {
            $this->_strip = (int) $data;

        } else {
            $this->_strip = $data;
        }
        return $this;
    }

    /**
     * Gets column strip
     *
     * @return int
     */
    public function getStrip()
    {
        return $this->_strip;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setPrefix($data)
    {

        if ($this->_prefix != $data) {
            $this->_logChange('prefix', $this->_prefix, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_prefix = $data;

        } else if (!is_null($data)) {
            $this->_prefix = (string) $data;

        } else {
            $this->_prefix = $data;
        }
        return $this;
    }

    /**
     * Gets column prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->_prefix;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setSendPAI($data)
    {

        if ($this->_sendPAI != $data) {
            $this->_logChange('sendPAI', $this->_sendPAI, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sendPAI = $data;

        } else if (!is_null($data)) {
            $this->_sendPAI = (int) $data;

        } else {
            $this->_sendPAI = $data;
        }
        return $this;
    }

    /**
     * Gets column sendPAI
     *
     * @return int
     */
    public function getSendPAI()
    {
        return $this->_sendPAI;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setSendRPID($data)
    {

        if ($this->_sendRPID != $data) {
            $this->_logChange('sendRPID', $this->_sendRPID, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sendRPID = $data;

        } else if (!is_null($data)) {
            $this->_sendRPID = (int) $data;

        } else {
            $this->_sendRPID = $data;
        }
        return $this;
    }

    /**
     * Gets column sendRPID
     *
     * @return int
     */
    public function getSendRPID()
    {
        return $this->_sendRPID;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\PeerServers
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
                throw new \InvalidArgumentException(_('Invalid value for authNeeded'));
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
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setAuthUser($data)
    {

        if ($this->_authUser != $data) {
            $this->_logChange('authUser', $this->_authUser, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_authUser = $data;

        } else if (!is_null($data)) {
            $this->_authUser = (string) $data;

        } else {
            $this->_authUser = $data;
        }
        return $this;
    }

    /**
     * Gets column auth_user
     *
     * @return string
     */
    public function getAuthUser()
    {
        return $this->_authUser;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setAuthPassword($data)
    {

        if ($this->_authPassword != $data) {
            $this->_logChange('authPassword', $this->_authPassword, $data);
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
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setSipProxy($data)
    {

        if ($this->_sipProxy != $data) {
            $this->_logChange('sipProxy', $this->_sipProxy, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sipProxy = $data;

        } else if (!is_null($data)) {
            $this->_sipProxy = (string) $data;

        } else {
            $this->_sipProxy = $data;
        }
        return $this;
    }

    /**
     * Gets column sip_proxy
     *
     * @return string
     */
    public function getSipProxy()
    {
        return $this->_sipProxy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setOutboundProxy($data)
    {

        if ($this->_outboundProxy != $data) {
            $this->_logChange('outboundProxy', $this->_outboundProxy, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outboundProxy = $data;

        } else if (!is_null($data)) {
            $this->_outboundProxy = (string) $data;

        } else {
            $this->_outboundProxy = $data;
        }
        return $this;
    }

    /**
     * Gets column outbound_proxy
     *
     * @return string
     */
    public function getOutboundProxy()
    {
        return $this->_outboundProxy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setFromUser($data)
    {

        if ($this->_fromUser != $data) {
            $this->_logChange('fromUser', $this->_fromUser, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fromUser = $data;

        } else if (!is_null($data)) {
            $this->_fromUser = (string) $data;

        } else {
            $this->_fromUser = $data;
        }
        return $this;
    }

    /**
     * Gets column from_user
     *
     * @return string
     */
    public function getFromUser()
    {
        return $this->_fromUser;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\PeerServers
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
     * Sets parent relation PeeringContract
     *
     * @param \IvozProvider\Model\Raw\PeeringContracts $data
     * @return \IvozProvider\Model\Raw\PeerServers
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

        $this->_setLoaded('PeerServersIbfk1');
        return $this;
    }

    /**
     * Gets parent PeeringContract
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function getPeeringContract($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeerServersIbfk1';

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
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\PeerServers
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

        $this->_setLoaded('PeerServersIbfk2');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeerServersIbfk2';

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
     * Sets dependent relations LcrGateways_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\LcrGateways
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setLcrGateways(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_LcrGateways === null) {

                $this->getLcrGateways();
            }

            $oldRelations = $this->_LcrGateways;

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

        $this->_LcrGateways = array();

        foreach ($data as $object) {
            $this->addLcrGateways($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations LcrGateways_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\LcrGateways $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function addLcrGateways(\IvozProvider\Model\Raw\LcrGateways $data)
    {
        $this->_LcrGateways[] = $data;
        $this->_setLoaded('LcrGatewaysIbfk2');
        return $this;
    }

    /**
     * Gets dependent LcrGateways_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\LcrGateways
     */
    public function getLcrGateways($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrGatewaysIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_LcrGateways = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_LcrGateways;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\PeerServers
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\PeerServers')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\PeerServers);

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
     * @return null | \IvozProvider\Model\Validator\PeerServers
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\PeerServers')) {

                $this->setValidator(new \IvozProvider\Validator\PeerServers);
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
     * @see \Mapper\Sql\PeerServers::delete
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