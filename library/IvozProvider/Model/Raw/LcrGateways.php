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
class LcrGateways extends ModelAbstract
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
    protected $_gwName;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ip;

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
     * Database var type int
     *
     * @var int
     */
    protected $_peerServerId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_outgoingRoutingId;


    /**
     * Parent relation LcrGateways_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation LcrGateways_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\PeerServers
     */
    protected $_PeerServer;

    /**
     * Parent relation LcrGateways_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\OutgoingRouting
     */
    protected $_OutgoingRouting;


    /**
     * Dependent relation LcrRuleTargets_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\LcrRuleTargets[]
     */
    protected $_LcrRuleTargets;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'gw_name'=>'gwName',
        'ip'=>'ip',
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
        'peerServerId'=>'peerServerId',
        'outgoingRoutingId'=>'outgoingRoutingId',
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
            'LcrGatewaysIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'LcrGatewaysIbfk2'=> array(
                    'property' => 'PeerServer',
                    'table_name' => 'PeerServers',
                ),
            'LcrGatewaysIbfk3'=> array(
                    'property' => 'OutgoingRouting',
                    'table_name' => 'OutgoingRouting',
                ),
        ));

        $this->setDependentList(array(
            'LcrRuleTargetsIbfk3' => array(
                    'property' => 'LcrRuleTargets',
                    'table_name' => 'LcrRuleTargets',
                ),
        ));




        $this->_defaultValues = array(
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
     */
    public function setGwName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_gwName != $data) {
            $this->_logChange('gwName');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_gwName = $data;

        } else if (!is_null($data)) {
            $this->_gwName = (string) $data;

        } else {
            $this->_gwName = $data;
        }
        return $this;
    }

    /**
     * Gets column gw_name
     *
     * @return string
     */
    public function getGwName()
    {
        return $this->_gwName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\LcrGateways
     */
    public function setIp($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_ip != $data) {
            $this->_logChange('ip');
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
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
     * @return \IvozProvider\Model\Raw\LcrGateways
     */
    public function setPeerServerId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_peerServerId != $data) {
            $this->_logChange('peerServerId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_peerServerId = $data;

        } else if (!is_null($data)) {
            $this->_peerServerId = (int) $data;

        } else {
            $this->_peerServerId = $data;
        }
        return $this;
    }

    /**
     * Gets column peerServerId
     *
     * @return int
     */
    public function getPeerServerId()
    {
        return $this->_peerServerId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\LcrGateways
     */
    public function setOutgoingRoutingId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_outgoingRoutingId != $data) {
            $this->_logChange('outgoingRoutingId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outgoingRoutingId = $data;

        } else if (!is_null($data)) {
            $this->_outgoingRoutingId = (int) $data;

        } else {
            $this->_outgoingRoutingId = $data;
        }
        return $this;
    }

    /**
     * Gets column outgoingRoutingId
     *
     * @return int
     */
    public function getOutgoingRoutingId()
    {
        return $this->_outgoingRoutingId;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\LcrGateways
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

        $this->_setLoaded('LcrGatewaysIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrGatewaysIbfk1';

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
     * Sets parent relation PeerServer
     *
     * @param \IvozProvider\Model\Raw\PeerServers $data
     * @return \IvozProvider\Model\Raw\LcrGateways
     */
    public function setPeerServer(\IvozProvider\Model\Raw\PeerServers $data)
    {
        $this->_PeerServer = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPeerServerId($primaryKey);
        }

        $this->_setLoaded('LcrGatewaysIbfk2');
        return $this;
    }

    /**
     * Gets parent PeerServer
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function getPeerServer($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrGatewaysIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PeerServer = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PeerServer;
    }

    /**
     * Sets parent relation OutgoingRouting
     *
     * @param \IvozProvider\Model\Raw\OutgoingRouting $data
     * @return \IvozProvider\Model\Raw\LcrGateways
     */
    public function setOutgoingRouting(\IvozProvider\Model\Raw\OutgoingRouting $data)
    {
        $this->_OutgoingRouting = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutgoingRoutingId($primaryKey);
        }

        $this->_setLoaded('LcrGatewaysIbfk3');
        return $this;
    }

    /**
     * Gets parent OutgoingRouting
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\OutgoingRouting
     */
    public function getOutgoingRouting($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrGatewaysIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingRouting = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_OutgoingRouting;
    }

    /**
     * Sets dependent relations LcrRuleTargets_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\LcrRuleTargets
     * @return \IvozProvider\Model\Raw\LcrGateways
     */
    public function setLcrRuleTargets(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_LcrRuleTargets === null) {

                $this->getLcrRuleTargets();
            }

            $oldRelations = $this->_LcrRuleTargets;

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

        $this->_LcrRuleTargets = array();

        foreach ($data as $object) {
            $this->addLcrRuleTargets($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations LcrRuleTargets_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\LcrRuleTargets $data
     * @return \IvozProvider\Model\Raw\LcrGateways
     */
    public function addLcrRuleTargets(\IvozProvider\Model\Raw\LcrRuleTargets $data)
    {
        $this->_LcrRuleTargets[] = $data;
        $this->_setLoaded('LcrRuleTargetsIbfk3');
        return $this;
    }

    /**
     * Gets dependent LcrRuleTargets_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\LcrRuleTargets
     */
    public function getLcrRuleTargets($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'LcrRuleTargetsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_LcrRuleTargets = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_LcrRuleTargets;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\LcrGateways
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\LcrGateways')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\LcrGateways);

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
     * @return null | \IvozProvider\Model\Validator\LcrGateways
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\LcrGateways')) {

                $this->setValidator(new \IvozProvider\Validator\LcrGateways);
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
     * @see \Mapper\Sql\LcrGateways::delete
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