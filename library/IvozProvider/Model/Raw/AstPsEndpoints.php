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
class AstPsEndpoints extends ModelAbstract
{

    protected $_directMediaAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_directMediaMethodAcceptedValues = array(
        'invite',
        'reinvite',
        'update',
    );
    protected $_dtmfModeAcceptedValues = array(
        'rfc4733',
        'inband',
        'info',
    );
    protected $_sendDiversionAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_sendPaiAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_sendRpidAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_100relAcceptedValues = array(
        'no',
        'required',
        'yes',
    );
    protected $_trustIdInboundAcceptedValues = array(
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
     * Database var type varchar
     *
     * @var string
     */
    protected $_sorceryId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_terminalId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_proxyTrunkId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_aors;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callerid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_context;

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
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_directMedia;

    /**
     * [enum:update|invite|reinvite]
     * Database var type enum('invite','reinvite','update')
     *
     * @var string
     */
    protected $_directMediaMethod;

    /**
     * Database var type enum('rfc4733','inband','info')
     *
     * @var string
     */
    protected $_dtmfMode;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mailboxes;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_sendDiversion;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_sendPai;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_sendRpid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_subscribecontext;

    /**
     * Database var type enum('no','required','yes')
     *
     * @var string
     */
    protected $_100rel;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_trustIdInbound;


    /**
     * Parent relation ast_ps_endpoints_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Terminals
     */
    protected $_Terminal;

    /**
     * Parent relation ast_ps_endpoints_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\ProxyTrunks
     */
    protected $_ProxyTrunk;


    /**
     * Dependent relation ast_ps_aors_ibfk_1
     * Type: One-to-One relationship
     *
     * @var \IvozProvider\Model\Raw\AstPsAors
     */
    protected $_AstPsAors;

    protected $_columnsList = array(
        'id'=>'id',
        'sorcery_id'=>'sorceryId',
        'terminalId'=>'terminalId',
        'proxyTrunkId'=>'proxyTrunkId',
        'aors'=>'aors',
        'callerid'=>'callerid',
        'context'=>'context',
        'disallow'=>'disallow',
        'allow'=>'allow',
        'direct_media'=>'directMedia',
        'direct_media_method'=>'directMediaMethod',
        'dtmf_mode'=>'dtmfMode',
        'mailboxes'=>'mailboxes',
        'send_diversion'=>'sendDiversion',
        'send_pai'=>'sendPai',
        'send_rpid'=>'sendRpid',
        'subscribecontext'=>'subscribecontext',
        '100rel'=>'100rel',
        'trust_id_inbound'=>'trustIdInbound',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'direct_media_method'=> array('enum:update|invite|reinvite'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'AstPsEndpointsIbfk1'=> array(
                    'property' => 'Terminal',
                    'table_name' => 'Terminals',
                ),
            'AstPsEndpointsIbfk2'=> array(
                    'property' => 'ProxyTrunk',
                    'table_name' => 'ProxyTrunks',
                ),
        ));

        $this->setDependentList(array(
            'AstPsAorsIbfk1' => array(
                    'property' => 'AstPsAors',
                    'table_name' => 'ast_ps_aors',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'ast_ps_aors_ibfk_1'
        ));



        $this->_defaultValues = array(
            'context' => 'outgoing',
            'disallow' => 'all',
            'allow' => 'all',
            'dtmfMode' => 'rfc4733',
            'subscribecontext' => 'default',
            '100rel' => 'no',
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
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
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
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setSorceryId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_sorceryId != $data) {
            $this->_logChange('sorceryId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sorceryId = $data;

        } else if (!is_null($data)) {
            $this->_sorceryId = (string) $data;

        } else {
            $this->_sorceryId = $data;
        }
        return $this;
    }

    /**
     * Gets column sorcery_id
     *
     * @return string
     */
    public function getSorceryId()
    {
        return $this->_sorceryId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setTerminalId($data)
    {

        if ($this->_terminalId != $data) {
            $this->_logChange('terminalId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_terminalId = $data;

        } else if (!is_null($data)) {
            $this->_terminalId = (int) $data;

        } else {
            $this->_terminalId = $data;
        }
        return $this;
    }

    /**
     * Gets column terminalId
     *
     * @return int
     */
    public function getTerminalId()
    {
        return $this->_terminalId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setProxyTrunkId($data)
    {

        if ($this->_proxyTrunkId != $data) {
            $this->_logChange('proxyTrunkId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_proxyTrunkId = $data;

        } else if (!is_null($data)) {
            $this->_proxyTrunkId = (int) $data;

        } else {
            $this->_proxyTrunkId = $data;
        }
        return $this;
    }

    /**
     * Gets column proxyTrunkId
     *
     * @return int
     */
    public function getProxyTrunkId()
    {
        return $this->_proxyTrunkId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setAors($data)
    {

        if ($this->_aors != $data) {
            $this->_logChange('aors');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_aors = $data;

        } else if (!is_null($data)) {
            $this->_aors = (string) $data;

        } else {
            $this->_aors = $data;
        }
        return $this;
    }

    /**
     * Gets column aors
     *
     * @return string
     */
    public function getAors()
    {
        return $this->_aors;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setCallerid($data)
    {

        if ($this->_callerid != $data) {
            $this->_logChange('callerid');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callerid = $data;

        } else if (!is_null($data)) {
            $this->_callerid = (string) $data;

        } else {
            $this->_callerid = $data;
        }
        return $this;
    }

    /**
     * Gets column callerid
     *
     * @return string
     */
    public function getCallerid()
    {
        return $this->_callerid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setContext($data)
    {

        if ($this->_context != $data) {
            $this->_logChange('context');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_context = $data;

        } else if (!is_null($data)) {
            $this->_context = (string) $data;

        } else {
            $this->_context = $data;
        }
        return $this;
    }

    /**
     * Gets column context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->_context;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setDisallow($data)
    {

        if ($this->_disallow != $data) {
            $this->_logChange('disallow');
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
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setAllow($data)
    {

        if ($this->_allow != $data) {
            $this->_logChange('allow');
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
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setDirectMedia($data)
    {

        if ($this->_directMedia != $data) {
            $this->_logChange('directMedia');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_directMedia = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_directMediaAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for directMedia'));
            }
            $this->_directMedia = (string) $data;

        } else {
            $this->_directMedia = $data;
        }
        return $this;
    }

    /**
     * Gets column direct_media
     *
     * @return string
     */
    public function getDirectMedia()
    {
        return $this->_directMedia;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setDirectMediaMethod($data)
    {

        if ($this->_directMediaMethod != $data) {
            $this->_logChange('directMediaMethod');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_directMediaMethod = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_directMediaMethodAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for directMediaMethod'));
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
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setDtmfMode($data)
    {

        if ($this->_dtmfMode != $data) {
            $this->_logChange('dtmfMode');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_dtmfMode = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_dtmfModeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for dtmfMode'));
            }
            $this->_dtmfMode = (string) $data;

        } else {
            $this->_dtmfMode = $data;
        }
        return $this;
    }

    /**
     * Gets column dtmf_mode
     *
     * @return string
     */
    public function getDtmfMode()
    {
        return $this->_dtmfMode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setMailboxes($data)
    {

        if ($this->_mailboxes != $data) {
            $this->_logChange('mailboxes');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mailboxes = $data;

        } else if (!is_null($data)) {
            $this->_mailboxes = (string) $data;

        } else {
            $this->_mailboxes = $data;
        }
        return $this;
    }

    /**
     * Gets column mailboxes
     *
     * @return string
     */
    public function getMailboxes()
    {
        return $this->_mailboxes;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setSendDiversion($data)
    {

        if ($this->_sendDiversion != $data) {
            $this->_logChange('sendDiversion');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sendDiversion = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_sendDiversionAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for sendDiversion'));
            }
            $this->_sendDiversion = (string) $data;

        } else {
            $this->_sendDiversion = $data;
        }
        return $this;
    }

    /**
     * Gets column send_diversion
     *
     * @return string
     */
    public function getSendDiversion()
    {
        return $this->_sendDiversion;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setSendPai($data)
    {

        if ($this->_sendPai != $data) {
            $this->_logChange('sendPai');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sendPai = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_sendPaiAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for sendPai'));
            }
            $this->_sendPai = (string) $data;

        } else {
            $this->_sendPai = $data;
        }
        return $this;
    }

    /**
     * Gets column send_pai
     *
     * @return string
     */
    public function getSendPai()
    {
        return $this->_sendPai;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setSendRpid($data)
    {

        if ($this->_sendRpid != $data) {
            $this->_logChange('sendRpid');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sendRpid = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_sendRpidAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for sendRpid'));
            }
            $this->_sendRpid = (string) $data;

        } else {
            $this->_sendRpid = $data;
        }
        return $this;
    }

    /**
     * Gets column send_rpid
     *
     * @return string
     */
    public function getSendRpid()
    {
        return $this->_sendRpid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setSubscribecontext($data)
    {

        if ($this->_subscribecontext != $data) {
            $this->_logChange('subscribecontext');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_subscribecontext = $data;

        } else if (!is_null($data)) {
            $this->_subscribecontext = (string) $data;

        } else {
            $this->_subscribecontext = $data;
        }
        return $this;
    }

    /**
     * Gets column subscribecontext
     *
     * @return string
     */
    public function getSubscribecontext()
    {
        return $this->_subscribecontext;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function set100rel($data)
    {

        if ($this->_100rel != $data) {
            $this->_logChange('100rel');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_100rel = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_100relAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for 100rel'));
            }
            $this->_100rel = (string) $data;

        } else {
            $this->_100rel = $data;
        }
        return $this;
    }

    /**
     * Gets column 100rel
     *
     * @return string
     */
    public function get100rel()
    {
        return $this->_100rel;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setTrustIdInbound($data)
    {

        if ($this->_trustIdInbound != $data) {
            $this->_logChange('trustIdInbound');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_trustIdInbound = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_trustIdInboundAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for trustIdInbound'));
            }
            $this->_trustIdInbound = (string) $data;

        } else {
            $this->_trustIdInbound = $data;
        }
        return $this;
    }

    /**
     * Gets column trust_id_inbound
     *
     * @return string
     */
    public function getTrustIdInbound()
    {
        return $this->_trustIdInbound;
    }

    /**
     * Sets parent relation Terminal
     *
     * @param \IvozProvider\Model\Raw\Terminals $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setTerminal(\IvozProvider\Model\Raw\Terminals $data)
    {
        $this->_Terminal = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTerminalId($primaryKey);
        }

        $this->_setLoaded('AstPsEndpointsIbfk1');
        return $this;
    }

    /**
     * Gets parent Terminal
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Terminals
     */
    public function getTerminal($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstPsEndpointsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Terminal = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Terminal;
    }

    /**
     * Sets parent relation ProxyTrunk
     *
     * @param \IvozProvider\Model\Raw\ProxyTrunks $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setProxyTrunk(\IvozProvider\Model\Raw\ProxyTrunks $data)
    {
        $this->_ProxyTrunk = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setProxyTrunkId($primaryKey);
        }

        $this->_setLoaded('AstPsEndpointsIbfk2');
        return $this;
    }

    /**
     * Gets parent ProxyTrunk
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ProxyTrunks
     */
    public function getProxyTrunk($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstPsEndpointsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ProxyTrunk = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ProxyTrunk;
    }

    /**
     * Sets dependent relation ast_ps_aors_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\AstPsAors $data
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function setAstPsAors(\IvozProvider\Model\Raw\AstPsAors $data)
    {
        $this->_AstPsAors = $data;
        $this->_setLoaded('AstPsAorsIbfk1');
        return $this;
    }

    /**
     * Gets dependent ast_ps_aors_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function getAstPsAors($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstPsAorsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_AstPsAors = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_AstPsAors;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\AstPsEndpoints
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\AstPsEndpoints')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\AstPsEndpoints);

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
     * @return null | \IvozProvider\Model\Validator\AstPsEndpoints
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\AstPsEndpoints')) {

                $this->setValidator(new \IvozProvider\Validator\AstPsEndpoints);
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
     * @see \Mapper\Sql\AstPsEndpoints::delete
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