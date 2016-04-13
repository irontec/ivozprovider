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
class PeerServers extends ModelAbstract
{


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_peeringContractId;

    /**
     * Database var type varbinary(16)
     *
     * @var binary
     */
    protected $_ip;

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
     * Database var type varchar
     *
     * @var string
     */
    protected $_tag;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_flags;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_defunct;

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
     * Database var type tinyint
     *
     * @var int
     */
    protected $_useAuthUserAsFromUser;


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
     * Dependent relation LcrRuleTarget_ibfk_4
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\LcrRuleTarget[]
     */
    protected $_LcrRuleTarget;

    /**
     * Dependent relation kam_address_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\KamAddress[]
     */
    protected $_KamAddress;

    protected $_columnsList = array(
        'id'=>'id',
        'peeringContractId'=>'peeringContractId',
        'ip'=>'ip',
        'name'=>'name',
        'description'=>'description',
        'brandId'=>'brandId',
        'hostname'=>'hostname',
        'port'=>'port',
        'params'=>'params',
        'uri_scheme'=>'uriScheme',
        'transport'=>'transport',
        'strip'=>'strip',
        'prefix'=>'prefix',
        'tag'=>'tag',
        'flags'=>'flags',
        'defunct'=>'defunct',
        'sendPAI'=>'sendPAI',
        'sendRPID'=>'sendRPID',
        'useAuthUserAsFromUser'=>'useAuthUserAsFromUser',
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
            'LcrRuleTargetIbfk4' => array(
                    'property' => 'LcrRuleTarget',
                    'table_name' => 'LcrRuleTarget',
                ),
            'KamAddressIbfk1' => array(
                    'property' => 'KamAddress',
                    'table_name' => 'kam_address',
                ),
        ));




        $this->_defaultValues = array(
            'description' => '',
            'flags' => '0',
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
     * @param binary $data
     * @return \IvozProvider\Model\Raw\PeerServers
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
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setIp($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_ip != $data) {
            $this->_logChange('ip');
        }

        $this->_ip = $data;
        return $this;
    }

    /**
     * Gets column ip
     *
     * @return binary
     */
    public function getIp()
    {
        return $this->_ip;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\PeerServers
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
     * @return \IvozProvider\Model\Raw\PeerServers
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
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
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setHostname($data)
    {

        if ($this->_hostname != $data) {
            $this->_logChange('hostname');
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
            $this->_logChange('port');
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
            $this->_logChange('params');
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
            $this->_logChange('uriScheme');
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
            $this->_logChange('transport');
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
            $this->_logChange('strip');
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
            $this->_logChange('prefix');
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setTag($data)
    {

        if ($this->_tag != $data) {
            $this->_logChange('tag');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tag = $data;

        } else if (!is_null($data)) {
            $this->_tag = (string) $data;

        } else {
            $this->_tag = $data;
        }
        return $this;
    }

    /**
     * Gets column tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->_tag;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setFlags($data)
    {

        if ($this->_flags != $data) {
            $this->_logChange('flags');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_flags = $data;

        } else if (!is_null($data)) {
            $this->_flags = (int) $data;

        } else {
            $this->_flags = $data;
        }
        return $this;
    }

    /**
     * Gets column flags
     *
     * @return int
     */
    public function getFlags()
    {
        return $this->_flags;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setDefunct($data)
    {

        if ($this->_defunct != $data) {
            $this->_logChange('defunct');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_defunct = $data;

        } else if (!is_null($data)) {
            $this->_defunct = (int) $data;

        } else {
            $this->_defunct = $data;
        }
        return $this;
    }

    /**
     * Gets column defunct
     *
     * @return int
     */
    public function getDefunct()
    {
        return $this->_defunct;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setSendPAI($data)
    {

        if ($this->_sendPAI != $data) {
            $this->_logChange('sendPAI');
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
            $this->_logChange('sendRPID');
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setUseAuthUserAsFromUser($data)
    {

        if ($this->_useAuthUserAsFromUser != $data) {
            $this->_logChange('useAuthUserAsFromUser');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_useAuthUserAsFromUser = $data;

        } else if (!is_null($data)) {
            $this->_useAuthUserAsFromUser = (int) $data;

        } else {
            $this->_useAuthUserAsFromUser = $data;
        }
        return $this;
    }

    /**
     * Gets column useAuthUserAsFromUser
     *
     * @return int
     */
    public function getUseAuthUserAsFromUser()
    {
        return $this->_useAuthUserAsFromUser;
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
     * Sets dependent relations LcrRuleTarget_ibfk_4
     *
     * @param array $data An array of \IvozProvider\Model\Raw\LcrRuleTarget
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setLcrRuleTarget(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_LcrRuleTarget === null) {

                $this->getLcrRuleTarget();
            }

            $oldRelations = $this->_LcrRuleTarget;

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

        $this->_LcrRuleTarget = array();

        foreach ($data as $object) {
            $this->addLcrRuleTarget($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations LcrRuleTarget_ibfk_4
     *
     * @param \IvozProvider\Model\Raw\LcrRuleTarget $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function addLcrRuleTarget(\IvozProvider\Model\Raw\LcrRuleTarget $data)
    {
        $this->_LcrRuleTarget[] = $data;
        $this->_setLoaded('LcrRuleTargetIbfk4');
        return $this;
    }

    /**
     * Gets dependent LcrRuleTarget_ibfk_4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\LcrRuleTarget
     */
    public function getLcrRuleTarget($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_LcrRuleTarget = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_LcrRuleTarget;
    }

    /**
     * Sets dependent relations kam_address_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\KamAddress
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function setKamAddress(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KamAddress === null) {

                $this->getKamAddress();
            }

            $oldRelations = $this->_KamAddress;

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

        $this->_KamAddress = array();

        foreach ($data as $object) {
            $this->addKamAddress($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations kam_address_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\KamAddress $data
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function addKamAddress(\IvozProvider\Model\Raw\KamAddress $data)
    {
        $this->_KamAddress[] = $data;
        $this->_setLoaded('KamAddressIbfk1');
        return $this;
    }

    /**
     * Gets dependent kam_address_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\KamAddress
     */
    public function getKamAddress($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamAddressIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KamAddress = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KamAddress;
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