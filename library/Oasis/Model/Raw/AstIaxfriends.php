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
 * 
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model\Raw;
class AstIaxfriends extends ModelAbstract
{

    protected $_typeAcceptedValues = array(
        'friend',
        'user',
        'peer',
    );
    protected $_sendaniAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_trunkAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_requirecalltokenAcceptedValues = array(
        'yes',
        'no',
        'auto',
    );
    protected $_encryptionAcceptedValues = array(
        'yes',
        'no',
        'aes128',
    );
    protected $_transferAcceptedValues = array(
        'yes',
        'no',
        'mediaonly',
    );
    protected $_jitterbufferAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_forcejitterbufferAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_qualifysmoothingAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_adsiAcceptedValues = array(
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
    protected $_name;

    /**
     * Database var type enum('friend','user','peer')
     *
     * @var string
     */
    protected $_type;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_username;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mailbox;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_secret;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dbsecret;

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
    protected $_regcontext;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_host;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ipaddr;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_port;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_defaultip;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_sourceaddress;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mask;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_regexten;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_regseconds;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_accountcode;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mohinterpret;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mohsuggest;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_inkeys;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_outkeys;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_language;

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
    protected $_cidNumber;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_sendani;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fullname;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_trunk;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_auth;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxauthreq;

    /**
     * Database var type enum('yes','no','auto')
     *
     * @var string
     */
    protected $_requirecalltoken;

    /**
     * Database var type enum('yes','no','aes128')
     *
     * @var string
     */
    protected $_encryption;

    /**
     * Database var type enum('yes','no','mediaonly')
     *
     * @var string
     */
    protected $_transfer;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_jitterbuffer;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_forcejitterbuffer;

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
     * Database var type varchar
     *
     * @var string
     */
    protected $_codecpriority;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_qualify;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_qualifysmoothing;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_qualifyfreqok;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_qualifyfreqnotok;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_timezone;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_adsi;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_amaflags;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_setvar;




    protected $_columnsList = array(
        'id'=>'id',
        'name'=>'name',
        'type'=>'type',
        'username'=>'username',
        'mailbox'=>'mailbox',
        'secret'=>'secret',
        'dbsecret'=>'dbsecret',
        'context'=>'context',
        'regcontext'=>'regcontext',
        'host'=>'host',
        'ipaddr'=>'ipaddr',
        'port'=>'port',
        'defaultip'=>'defaultip',
        'sourceaddress'=>'sourceaddress',
        'mask'=>'mask',
        'regexten'=>'regexten',
        'regseconds'=>'regseconds',
        'accountcode'=>'accountcode',
        'mohinterpret'=>'mohinterpret',
        'mohsuggest'=>'mohsuggest',
        'inkeys'=>'inkeys',
        'outkeys'=>'outkeys',
        'language'=>'language',
        'callerid'=>'callerid',
        'cid_number'=>'cidNumber',
        'sendani'=>'sendani',
        'fullname'=>'fullname',
        'trunk'=>'trunk',
        'auth'=>'auth',
        'maxauthreq'=>'maxauthreq',
        'requirecalltoken'=>'requirecalltoken',
        'encryption'=>'encryption',
        'transfer'=>'transfer',
        'jitterbuffer'=>'jitterbuffer',
        'forcejitterbuffer'=>'forcejitterbuffer',
        'disallow'=>'disallow',
        'allow'=>'allow',
        'codecpriority'=>'codecpriority',
        'qualify'=>'qualify',
        'qualifysmoothing'=>'qualifysmoothing',
        'qualifyfreqok'=>'qualifyfreqok',
        'qualifyfreqnotok'=>'qualifyfreqnotok',
        'timezone'=>'timezone',
        'adsi'=>'adsi',
        'amaflags'=>'amaflags',
        'setvar'=>'setvar',
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
        ));

        $this->setDependentList(array(
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
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setName($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_name != $data) {
            $this->_logChange('name');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setType($data)
    {

        if ($this->_type != $data) {
            $this->_logChange('type');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_typeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for type'));
            }
            $this->_type = (string) $data;
        } else {
            $this->_type = $data;
        }
        return $this;
    }

    /**
     * Gets column type
     *
     * @return string
     */
    public function getType()
    {
            return $this->_type;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setUsername($data)
    {

        if ($this->_username != $data) {
            $this->_logChange('username');
        }

        if (!is_null($data)) {
            $this->_username = (string) $data;
        } else {
            $this->_username = $data;
        }
        return $this;
    }

    /**
     * Gets column username
     *
     * @return string
     */
    public function getUsername()
    {
            return $this->_username;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setMailbox($data)
    {

        if ($this->_mailbox != $data) {
            $this->_logChange('mailbox');
        }

        if (!is_null($data)) {
            $this->_mailbox = (string) $data;
        } else {
            $this->_mailbox = $data;
        }
        return $this;
    }

    /**
     * Gets column mailbox
     *
     * @return string
     */
    public function getMailbox()
    {
            return $this->_mailbox;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setSecret($data)
    {

        if ($this->_secret != $data) {
            $this->_logChange('secret');
        }

        if (!is_null($data)) {
            $this->_secret = (string) $data;
        } else {
            $this->_secret = $data;
        }
        return $this;
    }

    /**
     * Gets column secret
     *
     * @return string
     */
    public function getSecret()
    {
            return $this->_secret;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setDbsecret($data)
    {

        if ($this->_dbsecret != $data) {
            $this->_logChange('dbsecret');
        }

        if (!is_null($data)) {
            $this->_dbsecret = (string) $data;
        } else {
            $this->_dbsecret = $data;
        }
        return $this;
    }

    /**
     * Gets column dbsecret
     *
     * @return string
     */
    public function getDbsecret()
    {
            return $this->_dbsecret;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setContext($data)
    {

        if ($this->_context != $data) {
            $this->_logChange('context');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setRegcontext($data)
    {

        if ($this->_regcontext != $data) {
            $this->_logChange('regcontext');
        }

        if (!is_null($data)) {
            $this->_regcontext = (string) $data;
        } else {
            $this->_regcontext = $data;
        }
        return $this;
    }

    /**
     * Gets column regcontext
     *
     * @return string
     */
    public function getRegcontext()
    {
            return $this->_regcontext;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setHost($data)
    {

        if ($this->_host != $data) {
            $this->_logChange('host');
        }

        if (!is_null($data)) {
            $this->_host = (string) $data;
        } else {
            $this->_host = $data;
        }
        return $this;
    }

    /**
     * Gets column host
     *
     * @return string
     */
    public function getHost()
    {
            return $this->_host;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setIpaddr($data)
    {

        if ($this->_ipaddr != $data) {
            $this->_logChange('ipaddr');
        }

        if (!is_null($data)) {
            $this->_ipaddr = (string) $data;
        } else {
            $this->_ipaddr = $data;
        }
        return $this;
    }

    /**
     * Gets column ipaddr
     *
     * @return string
     */
    public function getIpaddr()
    {
            return $this->_ipaddr;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setPort($data)
    {

        if ($this->_port != $data) {
            $this->_logChange('port');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setDefaultip($data)
    {

        if ($this->_defaultip != $data) {
            $this->_logChange('defaultip');
        }

        if (!is_null($data)) {
            $this->_defaultip = (string) $data;
        } else {
            $this->_defaultip = $data;
        }
        return $this;
    }

    /**
     * Gets column defaultip
     *
     * @return string
     */
    public function getDefaultip()
    {
            return $this->_defaultip;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setSourceaddress($data)
    {

        if ($this->_sourceaddress != $data) {
            $this->_logChange('sourceaddress');
        }

        if (!is_null($data)) {
            $this->_sourceaddress = (string) $data;
        } else {
            $this->_sourceaddress = $data;
        }
        return $this;
    }

    /**
     * Gets column sourceaddress
     *
     * @return string
     */
    public function getSourceaddress()
    {
            return $this->_sourceaddress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setMask($data)
    {

        if ($this->_mask != $data) {
            $this->_logChange('mask');
        }

        if (!is_null($data)) {
            $this->_mask = (string) $data;
        } else {
            $this->_mask = $data;
        }
        return $this;
    }

    /**
     * Gets column mask
     *
     * @return string
     */
    public function getMask()
    {
            return $this->_mask;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setRegexten($data)
    {

        if ($this->_regexten != $data) {
            $this->_logChange('regexten');
        }

        if (!is_null($data)) {
            $this->_regexten = (string) $data;
        } else {
            $this->_regexten = $data;
        }
        return $this;
    }

    /**
     * Gets column regexten
     *
     * @return string
     */
    public function getRegexten()
    {
            return $this->_regexten;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setRegseconds($data)
    {

        if ($this->_regseconds != $data) {
            $this->_logChange('regseconds');
        }

        if (!is_null($data)) {
            $this->_regseconds = (int) $data;
        } else {
            $this->_regseconds = $data;
        }
        return $this;
    }

    /**
     * Gets column regseconds
     *
     * @return int
     */
    public function getRegseconds()
    {
            return $this->_regseconds;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setAccountcode($data)
    {

        if ($this->_accountcode != $data) {
            $this->_logChange('accountcode');
        }

        if (!is_null($data)) {
            $this->_accountcode = (string) $data;
        } else {
            $this->_accountcode = $data;
        }
        return $this;
    }

    /**
     * Gets column accountcode
     *
     * @return string
     */
    public function getAccountcode()
    {
            return $this->_accountcode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setMohinterpret($data)
    {

        if ($this->_mohinterpret != $data) {
            $this->_logChange('mohinterpret');
        }

        if (!is_null($data)) {
            $this->_mohinterpret = (string) $data;
        } else {
            $this->_mohinterpret = $data;
        }
        return $this;
    }

    /**
     * Gets column mohinterpret
     *
     * @return string
     */
    public function getMohinterpret()
    {
            return $this->_mohinterpret;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setMohsuggest($data)
    {

        if ($this->_mohsuggest != $data) {
            $this->_logChange('mohsuggest');
        }

        if (!is_null($data)) {
            $this->_mohsuggest = (string) $data;
        } else {
            $this->_mohsuggest = $data;
        }
        return $this;
    }

    /**
     * Gets column mohsuggest
     *
     * @return string
     */
    public function getMohsuggest()
    {
            return $this->_mohsuggest;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setInkeys($data)
    {

        if ($this->_inkeys != $data) {
            $this->_logChange('inkeys');
        }

        if (!is_null($data)) {
            $this->_inkeys = (string) $data;
        } else {
            $this->_inkeys = $data;
        }
        return $this;
    }

    /**
     * Gets column inkeys
     *
     * @return string
     */
    public function getInkeys()
    {
            return $this->_inkeys;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setOutkeys($data)
    {

        if ($this->_outkeys != $data) {
            $this->_logChange('outkeys');
        }

        if (!is_null($data)) {
            $this->_outkeys = (string) $data;
        } else {
            $this->_outkeys = $data;
        }
        return $this;
    }

    /**
     * Gets column outkeys
     *
     * @return string
     */
    public function getOutkeys()
    {
            return $this->_outkeys;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setLanguage($data)
    {

        if ($this->_language != $data) {
            $this->_logChange('language');
        }

        if (!is_null($data)) {
            $this->_language = (string) $data;
        } else {
            $this->_language = $data;
        }
        return $this;
    }

    /**
     * Gets column language
     *
     * @return string
     */
    public function getLanguage()
    {
            return $this->_language;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setCallerid($data)
    {

        if ($this->_callerid != $data) {
            $this->_logChange('callerid');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setCidNumber($data)
    {

        if ($this->_cidNumber != $data) {
            $this->_logChange('cidNumber');
        }

        if (!is_null($data)) {
            $this->_cidNumber = (string) $data;
        } else {
            $this->_cidNumber = $data;
        }
        return $this;
    }

    /**
     * Gets column cid_number
     *
     * @return string
     */
    public function getCidNumber()
    {
            return $this->_cidNumber;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setSendani($data)
    {

        if ($this->_sendani != $data) {
            $this->_logChange('sendani');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_sendaniAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for sendani'));
            }
            $this->_sendani = (string) $data;
        } else {
            $this->_sendani = $data;
        }
        return $this;
    }

    /**
     * Gets column sendani
     *
     * @return string
     */
    public function getSendani()
    {
            return $this->_sendani;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setFullname($data)
    {

        if ($this->_fullname != $data) {
            $this->_logChange('fullname');
        }

        if (!is_null($data)) {
            $this->_fullname = (string) $data;
        } else {
            $this->_fullname = $data;
        }
        return $this;
    }

    /**
     * Gets column fullname
     *
     * @return string
     */
    public function getFullname()
    {
            return $this->_fullname;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setTrunk($data)
    {

        if ($this->_trunk != $data) {
            $this->_logChange('trunk');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_trunkAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for trunk'));
            }
            $this->_trunk = (string) $data;
        } else {
            $this->_trunk = $data;
        }
        return $this;
    }

    /**
     * Gets column trunk
     *
     * @return string
     */
    public function getTrunk()
    {
            return $this->_trunk;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setAuth($data)
    {

        if ($this->_auth != $data) {
            $this->_logChange('auth');
        }

        if (!is_null($data)) {
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
     * @param int $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setMaxauthreq($data)
    {

        if ($this->_maxauthreq != $data) {
            $this->_logChange('maxauthreq');
        }

        if (!is_null($data)) {
            $this->_maxauthreq = (int) $data;
        } else {
            $this->_maxauthreq = $data;
        }
        return $this;
    }

    /**
     * Gets column maxauthreq
     *
     * @return int
     */
    public function getMaxauthreq()
    {
            return $this->_maxauthreq;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setRequirecalltoken($data)
    {

        if ($this->_requirecalltoken != $data) {
            $this->_logChange('requirecalltoken');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_requirecalltokenAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for requirecalltoken'));
            }
            $this->_requirecalltoken = (string) $data;
        } else {
            $this->_requirecalltoken = $data;
        }
        return $this;
    }

    /**
     * Gets column requirecalltoken
     *
     * @return string
     */
    public function getRequirecalltoken()
    {
            return $this->_requirecalltoken;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setEncryption($data)
    {

        if ($this->_encryption != $data) {
            $this->_logChange('encryption');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_encryptionAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for encryption'));
            }
            $this->_encryption = (string) $data;
        } else {
            $this->_encryption = $data;
        }
        return $this;
    }

    /**
     * Gets column encryption
     *
     * @return string
     */
    public function getEncryption()
    {
            return $this->_encryption;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setTransfer($data)
    {

        if ($this->_transfer != $data) {
            $this->_logChange('transfer');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_transferAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for transfer'));
            }
            $this->_transfer = (string) $data;
        } else {
            $this->_transfer = $data;
        }
        return $this;
    }

    /**
     * Gets column transfer
     *
     * @return string
     */
    public function getTransfer()
    {
            return $this->_transfer;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setJitterbuffer($data)
    {

        if ($this->_jitterbuffer != $data) {
            $this->_logChange('jitterbuffer');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_jitterbufferAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for jitterbuffer'));
            }
            $this->_jitterbuffer = (string) $data;
        } else {
            $this->_jitterbuffer = $data;
        }
        return $this;
    }

    /**
     * Gets column jitterbuffer
     *
     * @return string
     */
    public function getJitterbuffer()
    {
            return $this->_jitterbuffer;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setForcejitterbuffer($data)
    {

        if ($this->_forcejitterbuffer != $data) {
            $this->_logChange('forcejitterbuffer');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_forcejitterbufferAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for forcejitterbuffer'));
            }
            $this->_forcejitterbuffer = (string) $data;
        } else {
            $this->_forcejitterbuffer = $data;
        }
        return $this;
    }

    /**
     * Gets column forcejitterbuffer
     *
     * @return string
     */
    public function getForcejitterbuffer()
    {
            return $this->_forcejitterbuffer;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setDisallow($data)
    {

        if ($this->_disallow != $data) {
            $this->_logChange('disallow');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setAllow($data)
    {

        if ($this->_allow != $data) {
            $this->_logChange('allow');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setCodecpriority($data)
    {

        if ($this->_codecpriority != $data) {
            $this->_logChange('codecpriority');
        }

        if (!is_null($data)) {
            $this->_codecpriority = (string) $data;
        } else {
            $this->_codecpriority = $data;
        }
        return $this;
    }

    /**
     * Gets column codecpriority
     *
     * @return string
     */
    public function getCodecpriority()
    {
            return $this->_codecpriority;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setQualify($data)
    {

        if ($this->_qualify != $data) {
            $this->_logChange('qualify');
        }

        if (!is_null($data)) {
            $this->_qualify = (string) $data;
        } else {
            $this->_qualify = $data;
        }
        return $this;
    }

    /**
     * Gets column qualify
     *
     * @return string
     */
    public function getQualify()
    {
            return $this->_qualify;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setQualifysmoothing($data)
    {

        if ($this->_qualifysmoothing != $data) {
            $this->_logChange('qualifysmoothing');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_qualifysmoothingAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for qualifysmoothing'));
            }
            $this->_qualifysmoothing = (string) $data;
        } else {
            $this->_qualifysmoothing = $data;
        }
        return $this;
    }

    /**
     * Gets column qualifysmoothing
     *
     * @return string
     */
    public function getQualifysmoothing()
    {
            return $this->_qualifysmoothing;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setQualifyfreqok($data)
    {

        if ($this->_qualifyfreqok != $data) {
            $this->_logChange('qualifyfreqok');
        }

        if (!is_null($data)) {
            $this->_qualifyfreqok = (string) $data;
        } else {
            $this->_qualifyfreqok = $data;
        }
        return $this;
    }

    /**
     * Gets column qualifyfreqok
     *
     * @return string
     */
    public function getQualifyfreqok()
    {
            return $this->_qualifyfreqok;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setQualifyfreqnotok($data)
    {

        if ($this->_qualifyfreqnotok != $data) {
            $this->_logChange('qualifyfreqnotok');
        }

        if (!is_null($data)) {
            $this->_qualifyfreqnotok = (string) $data;
        } else {
            $this->_qualifyfreqnotok = $data;
        }
        return $this;
    }

    /**
     * Gets column qualifyfreqnotok
     *
     * @return string
     */
    public function getQualifyfreqnotok()
    {
            return $this->_qualifyfreqnotok;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setTimezone($data)
    {

        if ($this->_timezone != $data) {
            $this->_logChange('timezone');
        }

        if (!is_null($data)) {
            $this->_timezone = (string) $data;
        } else {
            $this->_timezone = $data;
        }
        return $this;
    }

    /**
     * Gets column timezone
     *
     * @return string
     */
    public function getTimezone()
    {
            return $this->_timezone;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setAdsi($data)
    {

        if ($this->_adsi != $data) {
            $this->_logChange('adsi');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_adsiAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for adsi'));
            }
            $this->_adsi = (string) $data;
        } else {
            $this->_adsi = $data;
        }
        return $this;
    }

    /**
     * Gets column adsi
     *
     * @return string
     */
    public function getAdsi()
    {
            return $this->_adsi;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setAmaflags($data)
    {

        if ($this->_amaflags != $data) {
            $this->_logChange('amaflags');
        }

        if (!is_null($data)) {
            $this->_amaflags = (string) $data;
        } else {
            $this->_amaflags = $data;
        }
        return $this;
    }

    /**
     * Gets column amaflags
     *
     * @return string
     */
    public function getAmaflags()
    {
            return $this->_amaflags;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstIaxfriends
     */
    public function setSetvar($data)
    {

        if ($this->_setvar != $data) {
            $this->_logChange('setvar');
        }

        if (!is_null($data)) {
            $this->_setvar = (string) $data;
        } else {
            $this->_setvar = $data;
        }
        return $this;
    }

    /**
     * Gets column setvar
     *
     * @return string
     */
    public function getSetvar()
    {
            return $this->_setvar;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstIaxfriends
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstIaxfriends')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstIaxfriends);

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
     * @return null | \Oasis\Model\Validator\AstIaxfriends
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstIaxfriends')) {

                $this->setValidator(new \Oasis\Validator\AstIaxfriends);
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
     * @see \Mapper\Sql\AstIaxfriends::delete
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
}
