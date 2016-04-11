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
class Terminals extends ModelAbstract
{

    protected $_directMediaAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_directMediaMethodAcceptedValues = array(
        'update',
        'invite',
        'reinvite',
    );
    protected $_sendPaiAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_sendRpidAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_removeExistingAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_authenticateQualifyAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_supportPathAcceptedValues = array(
        'yes',
        'no',
    );

    /**
     * [uuid:php]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_TerminalModelId;

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
    protected $_sorceryId;

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
    protected $_auth;

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
     * Database var type varchar
     *
     * @var string
     */
    protected $_directMediaMethod;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mailboxesAors;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_outboundProxy;

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
    protected $_contact;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_defaultExpiration;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxContacts;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_minimumExpiration;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_removeExisting;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_qualifyFrequency;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_authenticateQualify;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maximumExpiration;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_supportPath;

    /**
     * [password]
     * Database var type varchar
     *
     * @var string
     */
    protected $_password;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_subscribecontext;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_companyId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mac;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_lastProvisionDate;


    /**
     * Parent relation Terminals_CompanyId_ibfk_2
     *
     * @var \Oasis\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation Terminals_ibfk_1
     *
     * @var \Oasis\Model\Raw\TerminalModels
     */
    protected $_TerminalModel;


    /**
     * Dependent relation Users_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\Users[]
     */
    protected $_Users;

    protected $_columnsList = array(
        'id'=>'id',
        'TerminalModelId'=>'TerminalModelId',
        'name'=>'name',
        'sorcery_id'=>'sorceryId',
        'aors'=>'aors',
        'auth'=>'auth',
        'context'=>'context',
        'disallow'=>'disallow',
        'allow'=>'allow',
        'direct_media'=>'directMedia',
        'direct_media_method'=>'directMediaMethod',
        'mailboxes_aors'=>'mailboxesAors',
        'outbound_proxy'=>'outboundProxy',
        'send_pai'=>'sendPai',
        'send_rpid'=>'sendRpid',
        'contact'=>'contact',
        'default_expiration'=>'defaultExpiration',
        'max_contacts'=>'maxContacts',
        'minimum_expiration'=>'minimumExpiration',
        'remove_existing'=>'removeExisting',
        'qualify_frequency'=>'qualifyFrequency',
        'authenticate_qualify'=>'authenticateQualify',
        'maximum_expiration'=>'maximumExpiration',
        'support_path'=>'supportPath',
        'password'=>'password',
        'subscribecontext'=>'subscribecontext',
        'companyId'=>'companyId',
        'mac'=>'mac',
        'lastProvisionDate'=>'lastProvisionDate',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid:php'),
            'direct_media_method'=> array('enum:update|invite|reinvite'),
            'password'=> array('password'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'TerminalsCompanyIdIbfk2'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'TerminalsIbfk1'=> array(
                    'property' => 'TerminalModel',
                    'table_name' => 'TerminalModels',
                ),
        ));

        $this->setDependentList(array(
            'UsersIbfk3' => array(
                    'property' => 'Users',
                    'table_name' => 'Users',
                ),
        ));




        $this->_defaultValues = array(
            'disallow' => 'all',
            'allow' => 'alaw',
            'directMedia' => 'yes',
            'maxContacts' => '5',
            'supportPath' => 'yes',
            'password' => '',
            'subscribecontext' => 'default',
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
     * @param binary $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        $this->_id = $data;
        return $this;
    }

    /**
     * Gets column id
     *
     * @return binary
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setTerminalModelId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_TerminalModelId != $data) {
            $this->_logChange('TerminalModelId');
        }

        $this->_TerminalModelId = $data;
        return $this;
    }

    /**
     * Gets column TerminalModelId
     *
     * @return binary
     */
    public function getTerminalModelId()
    {
        return $this->_TerminalModelId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setName($data)
    {

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
     * @return \Oasis\Model\Raw\Terminals
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
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
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
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setAuth($data)
    {

        if ($this->_auth != $data) {
            $this->_logChange('auth');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_auth = $data;

        } else if (!is_null($data)) {
            $this->_auth = (string) $data;

        } else {
            $this->_auth = $data;
        }
        return $this;
    }

    /**
     * Gets column auth
     *
     * @return string
     */
    public function getAuth()
    {
        return $this->_auth;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
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
     * @return \Oasis\Model\Raw\Terminals
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
     * @return \Oasis\Model\Raw\Terminals
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
     * @return \Oasis\Model\Raw\Terminals
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
     * @return \Oasis\Model\Raw\Terminals
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
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setMailboxesAors($data)
    {

        if ($this->_mailboxesAors != $data) {
            $this->_logChange('mailboxesAors');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mailboxesAors = $data;

        } else if (!is_null($data)) {
            $this->_mailboxesAors = (string) $data;

        } else {
            $this->_mailboxesAors = $data;
        }
        return $this;
    }

    /**
     * Gets column mailboxes_aors
     *
     * @return string
     */
    public function getMailboxesAors()
    {
        return $this->_mailboxesAors;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setOutboundProxy($data)
    {

        if ($this->_outboundProxy != $data) {
            $this->_logChange('outboundProxy');
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
     * @return \Oasis\Model\Raw\Terminals
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
     * @return \Oasis\Model\Raw\Terminals
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
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setContact($data)
    {

        if ($this->_contact != $data) {
            $this->_logChange('contact');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_contact = $data;

        } else if (!is_null($data)) {
            $this->_contact = (string) $data;

        } else {
            $this->_contact = $data;
        }
        return $this;
    }

    /**
     * Gets column contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->_contact;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setDefaultExpiration($data)
    {

        if ($this->_defaultExpiration != $data) {
            $this->_logChange('defaultExpiration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_defaultExpiration = $data;

        } else if (!is_null($data)) {
            $this->_defaultExpiration = (int) $data;

        } else {
            $this->_defaultExpiration = $data;
        }
        return $this;
    }

    /**
     * Gets column default_expiration
     *
     * @return int
     */
    public function getDefaultExpiration()
    {
        return $this->_defaultExpiration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setMaxContacts($data)
    {

        if ($this->_maxContacts != $data) {
            $this->_logChange('maxContacts');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_maxContacts = $data;

        } else if (!is_null($data)) {
            $this->_maxContacts = (int) $data;

        } else {
            $this->_maxContacts = $data;
        }
        return $this;
    }

    /**
     * Gets column max_contacts
     *
     * @return int
     */
    public function getMaxContacts()
    {
        return $this->_maxContacts;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setMinimumExpiration($data)
    {

        if ($this->_minimumExpiration != $data) {
            $this->_logChange('minimumExpiration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_minimumExpiration = $data;

        } else if (!is_null($data)) {
            $this->_minimumExpiration = (int) $data;

        } else {
            $this->_minimumExpiration = $data;
        }
        return $this;
    }

    /**
     * Gets column minimum_expiration
     *
     * @return int
     */
    public function getMinimumExpiration()
    {
        return $this->_minimumExpiration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setRemoveExisting($data)
    {

        if ($this->_removeExisting != $data) {
            $this->_logChange('removeExisting');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_removeExisting = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_removeExistingAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for removeExisting'));
            }
            $this->_removeExisting = (string) $data;

        } else {
            $this->_removeExisting = $data;
        }
        return $this;
    }

    /**
     * Gets column remove_existing
     *
     * @return string
     */
    public function getRemoveExisting()
    {
        return $this->_removeExisting;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setQualifyFrequency($data)
    {

        if ($this->_qualifyFrequency != $data) {
            $this->_logChange('qualifyFrequency');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_qualifyFrequency = $data;

        } else if (!is_null($data)) {
            $this->_qualifyFrequency = (int) $data;

        } else {
            $this->_qualifyFrequency = $data;
        }
        return $this;
    }

    /**
     * Gets column qualify_frequency
     *
     * @return int
     */
    public function getQualifyFrequency()
    {
        return $this->_qualifyFrequency;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setAuthenticateQualify($data)
    {

        if ($this->_authenticateQualify != $data) {
            $this->_logChange('authenticateQualify');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_authenticateQualify = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_authenticateQualifyAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for authenticateQualify'));
            }
            $this->_authenticateQualify = (string) $data;

        } else {
            $this->_authenticateQualify = $data;
        }
        return $this;
    }

    /**
     * Gets column authenticate_qualify
     *
     * @return string
     */
    public function getAuthenticateQualify()
    {
        return $this->_authenticateQualify;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setMaximumExpiration($data)
    {

        if ($this->_maximumExpiration != $data) {
            $this->_logChange('maximumExpiration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_maximumExpiration = $data;

        } else if (!is_null($data)) {
            $this->_maximumExpiration = (int) $data;

        } else {
            $this->_maximumExpiration = $data;
        }
        return $this;
    }

    /**
     * Gets column maximum_expiration
     *
     * @return int
     */
    public function getMaximumExpiration()
    {
        return $this->_maximumExpiration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setSupportPath($data)
    {

        if ($this->_supportPath != $data) {
            $this->_logChange('supportPath');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_supportPath = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_supportPathAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for supportPath'));
            }
            $this->_supportPath = (string) $data;

        } else {
            $this->_supportPath = $data;
        }
        return $this;
    }

    /**
     * Gets column support_path
     *
     * @return string
     */
    public function getSupportPath()
    {
        return $this->_supportPath;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setPassword($data)
    {

        if ($this->_password != $data) {
            $this->_logChange('password');
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
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
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
     * @param binary $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_companyId != $data) {
            $this->_logChange('companyId');
        }

        $this->_companyId = $data;
        return $this;
    }

    /**
     * Gets column companyId
     *
     * @return binary
     */
    public function getCompanyId()
    {
        return $this->_companyId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setMac($data)
    {

        if ($this->_mac != $data) {
            $this->_logChange('mac');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mac = $data;

        } else if (!is_null($data)) {
            $this->_mac = (string) $data;

        } else {
            $this->_mac = $data;
        }
        return $this;
    }

    /**
     * Gets column mac
     *
     * @return string
     */
    public function getMac()
    {
        return $this->_mac;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setLastProvisionDate($data)
    {
        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }
        if ($data === 'CURRENT_TIMESTAMP') {
            $data = \Zend_Date::now()->setTimezone('UTC');
        }

        if ($data instanceof \Zend_Date) {

            $data = new \DateTime($data->toString('yyyy-MM-dd HH:mm:ss'), new \DateTimeZone($data->getTimezone()));

        } elseif (!is_null($data) && !$data instanceof \DateTime) {

            $data = new \DateTime($data, new \DateTimeZone('UTC'));
        }
        if ($data instanceof \DateTime && $data->getTimezone()->getName() != 'UTC') {

            $data->setTimezone(new \DateTimeZone('UTC'));
        }

        if ($this->_lastProvisionDate != $data) {
            $this->_logChange('lastProvisionDate');
        }

        $this->_lastProvisionDate = $data;
        return $this;
    }

    /**
     * Gets column lastProvisionDate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getLastProvisionDate($returnZendDate = false)
    {
        if (is_null($this->_lastProvisionDate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_lastProvisionDate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_lastProvisionDate->format('Y-m-d H:i:s');
    }

    /**
     * Sets parent relation Company
     *
     * @param \Oasis\Model\Raw\Companies $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setCompany(\Oasis\Model\Raw\Companies $data)
    {
        $this->_Company = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCompanyId($primaryKey);
        }

        $this->_setLoaded('TerminalsCompanyIdIbfk2');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TerminalsCompanyIdIbfk2';

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
     * Sets parent relation TerminalModel
     *
     * @param \Oasis\Model\Raw\TerminalModels $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function setTerminalModel(\Oasis\Model\Raw\TerminalModels $data)
    {
        $this->_TerminalModel = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTerminalModelId($primaryKey);
        }

        $this->_setLoaded('TerminalsIbfk1');
        return $this;
    }

    /**
     * Gets parent TerminalModel
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\TerminalModels
     */
    public function getTerminalModel($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TerminalsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TerminalModel = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TerminalModel;
    }

    /**
     * Sets dependent relations Users_ibfk_3
     *
     * @param array $data An array of \Oasis\Model\Raw\Users
     * @return \Oasis\Model\Raw\Terminals
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
     * Sets dependent relations Users_ibfk_3
     *
     * @param \Oasis\Model\Raw\Users $data
     * @return \Oasis\Model\Raw\Terminals
     */
    public function addUsers(\Oasis\Model\Raw\Users $data)
    {
        $this->_Users[] = $data;
        $this->_setLoaded('UsersIbfk3');
        return $this;
    }

    /**
     * Gets dependent Users_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\Users
     */
    public function getUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk3';

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
     * @return Oasis\Mapper\Sql\Terminals
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\Terminals')) {

                $this->setMapper(new \Oasis\Mapper\Sql\Terminals);

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
     * @return null | \Oasis\Model\Validator\Terminals
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\Terminals')) {

                $this->setValidator(new \Oasis\Validator\Terminals);
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
     * @see \Mapper\Sql\Terminals::delete
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