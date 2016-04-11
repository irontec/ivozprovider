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
class AstSippeers extends ModelAbstract
{

    protected $_typeAcceptedValues = array(
        'friend',
        'user',
        'peer',
    );
    protected $_transportAcceptedValues = array(
        'udp',
        'tcp',
        'tls',
        'ws',
        'wss',
        'udp',
        'tcp',
        'tcp',
        'udp',
    );
    protected $_dtmfmodeAcceptedValues = array(
        'rfc2833',
        'info',
        'shortinfo',
        'inband',
        'auto',
    );
    protected $_directmediaAcceptedValues = array(
        'yes',
        'no',
        'nonat',
        'update',
        'outgoing',
    );
    protected $_trustrpidAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_progressinbandAcceptedValues = array(
        'yes',
        'no',
        'never',
    );
    protected $_promiscredirAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_useclientcodeAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_callcounterAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_allowoverlapAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_allowsubscribeAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_videosupportAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_rfc2833compensateAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_sessionTimersAcceptedValues = array(
        'accept',
        'refuse',
        'originate',
    );
    protected $_sessionRefresherAcceptedValues = array(
        'uac',
        'uas',
    );
    protected $_sendrpidAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_constantssrcAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_usereqphoneAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_textsupportAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_faxdetectAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_buggymwiAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_callingpresAcceptedValues = array(
        'allowed_not_screened',
        'allowed_passed_screen',
        'allowed_failed_screen',
        'allowed',
        'prohib_not_screened',
        'prohib_passed_screen',
        'prohib_failed_screen',
        'prohib',
    );
    protected $_hasastVoicemailAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_subscribemwiAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_autoframingAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_g726nonstandardAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_ignoresdpversionAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_allowtransferAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_dynamicAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_supportpathAcceptedValues = array(
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
    protected $_defaultuser;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fullcontact;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_regserver;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_useragent;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_lastms;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_host;

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
    protected $_context;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_permit;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_deny;

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
    protected $_md5secret;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_remotesecret;

    /**
     * Database var type enum('udp','tcp','tls','ws','wss','udp,tcp','tcp,udp')
     *
     * @var string
     */
    protected $_transport;

    /**
     * Database var type enum('rfc2833','info','shortinfo','inband','auto')
     *
     * @var string
     */
    protected $_dtmfmode;

    /**
     * Database var type enum('yes','no','nonat','update','outgoing')
     *
     * @var string
     */
    protected $_directmedia;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_nat;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callgroup;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pickupgroup;

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
    protected $_insecure;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_trustrpid;

    /**
     * Database var type enum('yes','no','never')
     *
     * @var string
     */
    protected $_progressinband;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_promiscredir;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_useclientcode;

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
    protected $_setvar;

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
    protected $_amaflags;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_callcounter;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_busylevel;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_allowoverlap;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_allowsubscribe;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_videosupport;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxcallbitrate;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_rfc2833compensate;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mailbox;

    /**
     * Database var type enum('accept','refuse','originate')
     *
     * @var string
     */
    protected $_sessionTimers;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_sessionExpires;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_sessionMinse;

    /**
     * Database var type enum('uac','uas')
     *
     * @var string
     */
    protected $_sessionRefresher;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_t38ptUsertpsource;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_regexten;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromdomain;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromuser;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_qualify;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_defaultip;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_rtptimeout;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_rtpholdtimeout;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_sendrpid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_outboundproxy;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callbackextension;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timert1;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timerb;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_qualifyfreq;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_constantssrc;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_contactpermit;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_contactdeny;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_usereqphone;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_textsupport;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_faxdetect;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_buggymwi;

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
    protected $_fullname;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_trunkname;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_cidNumber;

    /**
     * Database var type enum('allowed_not_screened','allowed_passed_screen','allowed_failed_screen','allowed','prohib_not_screened','prohib_passed_screen','prohib_failed_screen','prohib')
     *
     * @var string
     */
    protected $_callingpres;

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
    protected $_parkinglot;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_hasastVoicemail;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_subscribemwi;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_vmexten;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_autoframing;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_rtpkeepalive;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_callLimit;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_g726nonstandard;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_ignoresdpversion;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_allowtransfer;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_dynamic;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_path;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_supportpath;




    protected $_columnsList = array(
        'id'=>'id',
        'name'=>'name',
        'ipaddr'=>'ipaddr',
        'port'=>'port',
        'regseconds'=>'regseconds',
        'defaultuser'=>'defaultuser',
        'fullcontact'=>'fullcontact',
        'regserver'=>'regserver',
        'useragent'=>'useragent',
        'lastms'=>'lastms',
        'host'=>'host',
        'type'=>'type',
        'context'=>'context',
        'permit'=>'permit',
        'deny'=>'deny',
        'secret'=>'secret',
        'md5secret'=>'md5secret',
        'remotesecret'=>'remotesecret',
        'transport'=>'transport',
        'dtmfmode'=>'dtmfmode',
        'directmedia'=>'directmedia',
        'nat'=>'nat',
        'callgroup'=>'callgroup',
        'pickupgroup'=>'pickupgroup',
        'language'=>'language',
        'disallow'=>'disallow',
        'allow'=>'allow',
        'insecure'=>'insecure',
        'trustrpid'=>'trustrpid',
        'progressinband'=>'progressinband',
        'promiscredir'=>'promiscredir',
        'useclientcode'=>'useclientcode',
        'accountcode'=>'accountcode',
        'setvar'=>'setvar',
        'callerid'=>'callerid',
        'amaflags'=>'amaflags',
        'callcounter'=>'callcounter',
        'busylevel'=>'busylevel',
        'allowoverlap'=>'allowoverlap',
        'allowsubscribe'=>'allowsubscribe',
        'videosupport'=>'videosupport',
        'maxcallbitrate'=>'maxcallbitrate',
        'rfc2833compensate'=>'rfc2833compensate',
        'mailbox'=>'mailbox',
        'session-timers'=>'sessionTimers',
        'session-expires'=>'sessionExpires',
        'session-minse'=>'sessionMinse',
        'session-refresher'=>'sessionRefresher',
        't38pt_usertpsource'=>'t38ptUsertpsource',
        'regexten'=>'regexten',
        'fromdomain'=>'fromdomain',
        'fromuser'=>'fromuser',
        'qualify'=>'qualify',
        'defaultip'=>'defaultip',
        'rtptimeout'=>'rtptimeout',
        'rtpholdtimeout'=>'rtpholdtimeout',
        'sendrpid'=>'sendrpid',
        'outboundproxy'=>'outboundproxy',
        'callbackextension'=>'callbackextension',
        'timert1'=>'timert1',
        'timerb'=>'timerb',
        'qualifyfreq'=>'qualifyfreq',
        'constantssrc'=>'constantssrc',
        'contactpermit'=>'contactpermit',
        'contactdeny'=>'contactdeny',
        'usereqphone'=>'usereqphone',
        'textsupport'=>'textsupport',
        'faxdetect'=>'faxdetect',
        'buggymwi'=>'buggymwi',
        'auth'=>'auth',
        'fullname'=>'fullname',
        'trunkname'=>'trunkname',
        'cid_number'=>'cidNumber',
        'callingpres'=>'callingpres',
        'mohinterpret'=>'mohinterpret',
        'mohsuggest'=>'mohsuggest',
        'parkinglot'=>'parkinglot',
        'hasast_voicemail'=>'hasastVoicemail',
        'subscribemwi'=>'subscribemwi',
        'vmexten'=>'vmexten',
        'autoframing'=>'autoframing',
        'rtpkeepalive'=>'rtpkeepalive',
        'call-limit'=>'callLimit',
        'g726nonstandard'=>'g726nonstandard',
        'ignoresdpversion'=>'ignoresdpversion',
        'allowtransfer'=>'allowtransfer',
        'dynamic'=>'dynamic',
        'path'=>'path',
        'supportpath'=>'supportpath',
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setDefaultuser($data)
    {

        if ($this->_defaultuser != $data) {
            $this->_logChange('defaultuser');
        }

        if (!is_null($data)) {
            $this->_defaultuser = (string) $data;
        } else {
            $this->_defaultuser = $data;
        }
        return $this;
    }

    /**
     * Gets column defaultuser
     *
     * @return string
     */
    public function getDefaultuser()
    {
            return $this->_defaultuser;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setFullcontact($data)
    {

        if ($this->_fullcontact != $data) {
            $this->_logChange('fullcontact');
        }

        if (!is_null($data)) {
            $this->_fullcontact = (string) $data;
        } else {
            $this->_fullcontact = $data;
        }
        return $this;
    }

    /**
     * Gets column fullcontact
     *
     * @return string
     */
    public function getFullcontact()
    {
            return $this->_fullcontact;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setRegserver($data)
    {

        if ($this->_regserver != $data) {
            $this->_logChange('regserver');
        }

        if (!is_null($data)) {
            $this->_regserver = (string) $data;
        } else {
            $this->_regserver = $data;
        }
        return $this;
    }

    /**
     * Gets column regserver
     *
     * @return string
     */
    public function getRegserver()
    {
            return $this->_regserver;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setUseragent($data)
    {

        if ($this->_useragent != $data) {
            $this->_logChange('useragent');
        }

        if (!is_null($data)) {
            $this->_useragent = (string) $data;
        } else {
            $this->_useragent = $data;
        }
        return $this;
    }

    /**
     * Gets column useragent
     *
     * @return string
     */
    public function getUseragent()
    {
            return $this->_useragent;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setLastms($data)
    {

        if ($this->_lastms != $data) {
            $this->_logChange('lastms');
        }

        if (!is_null($data)) {
            $this->_lastms = (int) $data;
        } else {
            $this->_lastms = $data;
        }
        return $this;
    }

    /**
     * Gets column lastms
     *
     * @return int
     */
    public function getLastms()
    {
            return $this->_lastms;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setPermit($data)
    {

        if ($this->_permit != $data) {
            $this->_logChange('permit');
        }

        if (!is_null($data)) {
            $this->_permit = (string) $data;
        } else {
            $this->_permit = $data;
        }
        return $this;
    }

    /**
     * Gets column permit
     *
     * @return string
     */
    public function getPermit()
    {
            return $this->_permit;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setDeny($data)
    {

        if ($this->_deny != $data) {
            $this->_logChange('deny');
        }

        if (!is_null($data)) {
            $this->_deny = (string) $data;
        } else {
            $this->_deny = $data;
        }
        return $this;
    }

    /**
     * Gets column deny
     *
     * @return string
     */
    public function getDeny()
    {
            return $this->_deny;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setMd5secret($data)
    {

        if ($this->_md5secret != $data) {
            $this->_logChange('md5secret');
        }

        if (!is_null($data)) {
            $this->_md5secret = (string) $data;
        } else {
            $this->_md5secret = $data;
        }
        return $this;
    }

    /**
     * Gets column md5secret
     *
     * @return string
     */
    public function getMd5secret()
    {
            return $this->_md5secret;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setRemotesecret($data)
    {

        if ($this->_remotesecret != $data) {
            $this->_logChange('remotesecret');
        }

        if (!is_null($data)) {
            $this->_remotesecret = (string) $data;
        } else {
            $this->_remotesecret = $data;
        }
        return $this;
    }

    /**
     * Gets column remotesecret
     *
     * @return string
     */
    public function getRemotesecret()
    {
            return $this->_remotesecret;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setTransport($data)
    {

        if ($this->_transport != $data) {
            $this->_logChange('transport');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_transportAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for transport'));
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
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setDtmfmode($data)
    {

        if ($this->_dtmfmode != $data) {
            $this->_logChange('dtmfmode');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_dtmfmodeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for dtmfmode'));
            }
            $this->_dtmfmode = (string) $data;
        } else {
            $this->_dtmfmode = $data;
        }
        return $this;
    }

    /**
     * Gets column dtmfmode
     *
     * @return string
     */
    public function getDtmfmode()
    {
            return $this->_dtmfmode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setDirectmedia($data)
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


        if ($this->_directmedia != $data) {
            $this->_logChange('directmedia');
        }

        $this->_directmedia = $data;
        return $this;
    }

    /**
     * Gets column directmedia
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getDirectmedia($returnZendDate = false)
    {
    
        if (is_null($this->_directmedia)) {

            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_directmedia->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }


        return $this->_directmedia->format('Y-m-d H:i:s');

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setNat($data)
    {

        if ($this->_nat != $data) {
            $this->_logChange('nat');
        }

        if (!is_null($data)) {
            $this->_nat = (string) $data;
        } else {
            $this->_nat = $data;
        }
        return $this;
    }

    /**
     * Gets column nat
     *
     * @return string
     */
    public function getNat()
    {
            return $this->_nat;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setCallgroup($data)
    {

        if ($this->_callgroup != $data) {
            $this->_logChange('callgroup');
        }

        if (!is_null($data)) {
            $this->_callgroup = (string) $data;
        } else {
            $this->_callgroup = $data;
        }
        return $this;
    }

    /**
     * Gets column callgroup
     *
     * @return string
     */
    public function getCallgroup()
    {
            return $this->_callgroup;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setPickupgroup($data)
    {

        if ($this->_pickupgroup != $data) {
            $this->_logChange('pickupgroup');
        }

        if (!is_null($data)) {
            $this->_pickupgroup = (string) $data;
        } else {
            $this->_pickupgroup = $data;
        }
        return $this;
    }

    /**
     * Gets column pickupgroup
     *
     * @return string
     */
    public function getPickupgroup()
    {
            return $this->_pickupgroup;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setInsecure($data)
    {

        if ($this->_insecure != $data) {
            $this->_logChange('insecure');
        }

        if (!is_null($data)) {
            $this->_insecure = (string) $data;
        } else {
            $this->_insecure = $data;
        }
        return $this;
    }

    /**
     * Gets column insecure
     *
     * @return string
     */
    public function getInsecure()
    {
            return $this->_insecure;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setTrustrpid($data)
    {

        if ($this->_trustrpid != $data) {
            $this->_logChange('trustrpid');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_trustrpidAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for trustrpid'));
            }
            $this->_trustrpid = (string) $data;
        } else {
            $this->_trustrpid = $data;
        }
        return $this;
    }

    /**
     * Gets column trustrpid
     *
     * @return string
     */
    public function getTrustrpid()
    {
            return $this->_trustrpid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setProgressinband($data)
    {

        if ($this->_progressinband != $data) {
            $this->_logChange('progressinband');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_progressinbandAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for progressinband'));
            }
            $this->_progressinband = (string) $data;
        } else {
            $this->_progressinband = $data;
        }
        return $this;
    }

    /**
     * Gets column progressinband
     *
     * @return string
     */
    public function getProgressinband()
    {
            return $this->_progressinband;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setPromiscredir($data)
    {

        if ($this->_promiscredir != $data) {
            $this->_logChange('promiscredir');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_promiscredirAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for promiscredir'));
            }
            $this->_promiscredir = (string) $data;
        } else {
            $this->_promiscredir = $data;
        }
        return $this;
    }

    /**
     * Gets column promiscredir
     *
     * @return string
     */
    public function getPromiscredir()
    {
            return $this->_promiscredir;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setUseclientcode($data)
    {

        if ($this->_useclientcode != $data) {
            $this->_logChange('useclientcode');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_useclientcodeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for useclientcode'));
            }
            $this->_useclientcode = (string) $data;
        } else {
            $this->_useclientcode = $data;
        }
        return $this;
    }

    /**
     * Gets column useclientcode
     *
     * @return string
     */
    public function getUseclientcode()
    {
            return $this->_useclientcode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setCallcounter($data)
    {

        if ($this->_callcounter != $data) {
            $this->_logChange('callcounter');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_callcounterAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for callcounter'));
            }
            $this->_callcounter = (string) $data;
        } else {
            $this->_callcounter = $data;
        }
        return $this;
    }

    /**
     * Gets column callcounter
     *
     * @return string
     */
    public function getCallcounter()
    {
            return $this->_callcounter;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setBusylevel($data)
    {

        if ($this->_busylevel != $data) {
            $this->_logChange('busylevel');
        }

        if (!is_null($data)) {
            $this->_busylevel = (int) $data;
        } else {
            $this->_busylevel = $data;
        }
        return $this;
    }

    /**
     * Gets column busylevel
     *
     * @return int
     */
    public function getBusylevel()
    {
            return $this->_busylevel;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setAllowoverlap($data)
    {

        if ($this->_allowoverlap != $data) {
            $this->_logChange('allowoverlap');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_allowoverlapAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for allowoverlap'));
            }
            $this->_allowoverlap = (string) $data;
        } else {
            $this->_allowoverlap = $data;
        }
        return $this;
    }

    /**
     * Gets column allowoverlap
     *
     * @return string
     */
    public function getAllowoverlap()
    {
            return $this->_allowoverlap;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setAllowsubscribe($data)
    {

        if ($this->_allowsubscribe != $data) {
            $this->_logChange('allowsubscribe');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_allowsubscribeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for allowsubscribe'));
            }
            $this->_allowsubscribe = (string) $data;
        } else {
            $this->_allowsubscribe = $data;
        }
        return $this;
    }

    /**
     * Gets column allowsubscribe
     *
     * @return string
     */
    public function getAllowsubscribe()
    {
            return $this->_allowsubscribe;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setVideosupport($data)
    {

        if ($this->_videosupport != $data) {
            $this->_logChange('videosupport');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_videosupportAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for videosupport'));
            }
            $this->_videosupport = (string) $data;
        } else {
            $this->_videosupport = $data;
        }
        return $this;
    }

    /**
     * Gets column videosupport
     *
     * @return string
     */
    public function getVideosupport()
    {
            return $this->_videosupport;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setMaxcallbitrate($data)
    {

        if ($this->_maxcallbitrate != $data) {
            $this->_logChange('maxcallbitrate');
        }

        if (!is_null($data)) {
            $this->_maxcallbitrate = (int) $data;
        } else {
            $this->_maxcallbitrate = $data;
        }
        return $this;
    }

    /**
     * Gets column maxcallbitrate
     *
     * @return int
     */
    public function getMaxcallbitrate()
    {
            return $this->_maxcallbitrate;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setRfc2833compensate($data)
    {

        if ($this->_rfc2833compensate != $data) {
            $this->_logChange('rfc2833compensate');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_rfc2833compensateAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for rfc2833compensate'));
            }
            $this->_rfc2833compensate = (string) $data;
        } else {
            $this->_rfc2833compensate = $data;
        }
        return $this;
    }

    /**
     * Gets column rfc2833compensate
     *
     * @return string
     */
    public function getRfc2833compensate()
    {
            return $this->_rfc2833compensate;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setSessionTimers($data)
    {

        if ($this->_sessionTimers != $data) {
            $this->_logChange('sessionTimers');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_sessionTimersAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for sessionTimers'));
            }
            $this->_sessionTimers = (string) $data;
        } else {
            $this->_sessionTimers = $data;
        }
        return $this;
    }

    /**
     * Gets column session-timers
     *
     * @return string
     */
    public function getSessionTimers()
    {
            return $this->_sessionTimers;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setSessionExpires($data)
    {

        if ($this->_sessionExpires != $data) {
            $this->_logChange('sessionExpires');
        }

        if (!is_null($data)) {
            $this->_sessionExpires = (int) $data;
        } else {
            $this->_sessionExpires = $data;
        }
        return $this;
    }

    /**
     * Gets column session-expires
     *
     * @return int
     */
    public function getSessionExpires()
    {
            return $this->_sessionExpires;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setSessionMinse($data)
    {

        if ($this->_sessionMinse != $data) {
            $this->_logChange('sessionMinse');
        }

        if (!is_null($data)) {
            $this->_sessionMinse = (int) $data;
        } else {
            $this->_sessionMinse = $data;
        }
        return $this;
    }

    /**
     * Gets column session-minse
     *
     * @return int
     */
    public function getSessionMinse()
    {
            return $this->_sessionMinse;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setSessionRefresher($data)
    {

        if ($this->_sessionRefresher != $data) {
            $this->_logChange('sessionRefresher');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_sessionRefresherAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for sessionRefresher'));
            }
            $this->_sessionRefresher = (string) $data;
        } else {
            $this->_sessionRefresher = $data;
        }
        return $this;
    }

    /**
     * Gets column session-refresher
     *
     * @return string
     */
    public function getSessionRefresher()
    {
            return $this->_sessionRefresher;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setT38ptUsertpsource($data)
    {

        if ($this->_t38ptUsertpsource != $data) {
            $this->_logChange('t38ptUsertpsource');
        }

        if (!is_null($data)) {
            $this->_t38ptUsertpsource = (string) $data;
        } else {
            $this->_t38ptUsertpsource = $data;
        }
        return $this;
    }

    /**
     * Gets column t38pt_usertpsource
     *
     * @return string
     */
    public function getT38ptUsertpsource()
    {
            return $this->_t38ptUsertpsource;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setFromdomain($data)
    {

        if ($this->_fromdomain != $data) {
            $this->_logChange('fromdomain');
        }

        if (!is_null($data)) {
            $this->_fromdomain = (string) $data;
        } else {
            $this->_fromdomain = $data;
        }
        return $this;
    }

    /**
     * Gets column fromdomain
     *
     * @return string
     */
    public function getFromdomain()
    {
            return $this->_fromdomain;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setFromuser($data)
    {

        if ($this->_fromuser != $data) {
            $this->_logChange('fromuser');
        }

        if (!is_null($data)) {
            $this->_fromuser = (string) $data;
        } else {
            $this->_fromuser = $data;
        }
        return $this;
    }

    /**
     * Gets column fromuser
     *
     * @return string
     */
    public function getFromuser()
    {
            return $this->_fromuser;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setRtptimeout($data)
    {

        if ($this->_rtptimeout != $data) {
            $this->_logChange('rtptimeout');
        }

        if (!is_null($data)) {
            $this->_rtptimeout = (int) $data;
        } else {
            $this->_rtptimeout = $data;
        }
        return $this;
    }

    /**
     * Gets column rtptimeout
     *
     * @return int
     */
    public function getRtptimeout()
    {
            return $this->_rtptimeout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setRtpholdtimeout($data)
    {

        if ($this->_rtpholdtimeout != $data) {
            $this->_logChange('rtpholdtimeout');
        }

        if (!is_null($data)) {
            $this->_rtpholdtimeout = (int) $data;
        } else {
            $this->_rtpholdtimeout = $data;
        }
        return $this;
    }

    /**
     * Gets column rtpholdtimeout
     *
     * @return int
     */
    public function getRtpholdtimeout()
    {
            return $this->_rtpholdtimeout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setSendrpid($data)
    {

        if ($this->_sendrpid != $data) {
            $this->_logChange('sendrpid');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_sendrpidAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for sendrpid'));
            }
            $this->_sendrpid = (string) $data;
        } else {
            $this->_sendrpid = $data;
        }
        return $this;
    }

    /**
     * Gets column sendrpid
     *
     * @return string
     */
    public function getSendrpid()
    {
            return $this->_sendrpid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setOutboundproxy($data)
    {

        if ($this->_outboundproxy != $data) {
            $this->_logChange('outboundproxy');
        }

        if (!is_null($data)) {
            $this->_outboundproxy = (string) $data;
        } else {
            $this->_outboundproxy = $data;
        }
        return $this;
    }

    /**
     * Gets column outboundproxy
     *
     * @return string
     */
    public function getOutboundproxy()
    {
            return $this->_outboundproxy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setCallbackextension($data)
    {

        if ($this->_callbackextension != $data) {
            $this->_logChange('callbackextension');
        }

        if (!is_null($data)) {
            $this->_callbackextension = (string) $data;
        } else {
            $this->_callbackextension = $data;
        }
        return $this;
    }

    /**
     * Gets column callbackextension
     *
     * @return string
     */
    public function getCallbackextension()
    {
            return $this->_callbackextension;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setTimert1($data)
    {

        if ($this->_timert1 != $data) {
            $this->_logChange('timert1');
        }

        if (!is_null($data)) {
            $this->_timert1 = (int) $data;
        } else {
            $this->_timert1 = $data;
        }
        return $this;
    }

    /**
     * Gets column timert1
     *
     * @return int
     */
    public function getTimert1()
    {
            return $this->_timert1;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setTimerb($data)
    {

        if ($this->_timerb != $data) {
            $this->_logChange('timerb');
        }

        if (!is_null($data)) {
            $this->_timerb = (int) $data;
        } else {
            $this->_timerb = $data;
        }
        return $this;
    }

    /**
     * Gets column timerb
     *
     * @return int
     */
    public function getTimerb()
    {
            return $this->_timerb;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setQualifyfreq($data)
    {

        if ($this->_qualifyfreq != $data) {
            $this->_logChange('qualifyfreq');
        }

        if (!is_null($data)) {
            $this->_qualifyfreq = (int) $data;
        } else {
            $this->_qualifyfreq = $data;
        }
        return $this;
    }

    /**
     * Gets column qualifyfreq
     *
     * @return int
     */
    public function getQualifyfreq()
    {
            return $this->_qualifyfreq;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setConstantssrc($data)
    {

        if ($this->_constantssrc != $data) {
            $this->_logChange('constantssrc');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_constantssrcAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for constantssrc'));
            }
            $this->_constantssrc = (string) $data;
        } else {
            $this->_constantssrc = $data;
        }
        return $this;
    }

    /**
     * Gets column constantssrc
     *
     * @return string
     */
    public function getConstantssrc()
    {
            return $this->_constantssrc;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setContactpermit($data)
    {

        if ($this->_contactpermit != $data) {
            $this->_logChange('contactpermit');
        }

        if (!is_null($data)) {
            $this->_contactpermit = (string) $data;
        } else {
            $this->_contactpermit = $data;
        }
        return $this;
    }

    /**
     * Gets column contactpermit
     *
     * @return string
     */
    public function getContactpermit()
    {
            return $this->_contactpermit;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setContactdeny($data)
    {

        if ($this->_contactdeny != $data) {
            $this->_logChange('contactdeny');
        }

        if (!is_null($data)) {
            $this->_contactdeny = (string) $data;
        } else {
            $this->_contactdeny = $data;
        }
        return $this;
    }

    /**
     * Gets column contactdeny
     *
     * @return string
     */
    public function getContactdeny()
    {
            return $this->_contactdeny;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setUsereqphone($data)
    {

        if ($this->_usereqphone != $data) {
            $this->_logChange('usereqphone');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_usereqphoneAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for usereqphone'));
            }
            $this->_usereqphone = (string) $data;
        } else {
            $this->_usereqphone = $data;
        }
        return $this;
    }

    /**
     * Gets column usereqphone
     *
     * @return string
     */
    public function getUsereqphone()
    {
            return $this->_usereqphone;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setTextsupport($data)
    {

        if ($this->_textsupport != $data) {
            $this->_logChange('textsupport');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_textsupportAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for textsupport'));
            }
            $this->_textsupport = (string) $data;
        } else {
            $this->_textsupport = $data;
        }
        return $this;
    }

    /**
     * Gets column textsupport
     *
     * @return string
     */
    public function getTextsupport()
    {
            return $this->_textsupport;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setFaxdetect($data)
    {

        if ($this->_faxdetect != $data) {
            $this->_logChange('faxdetect');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_faxdetectAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for faxdetect'));
            }
            $this->_faxdetect = (string) $data;
        } else {
            $this->_faxdetect = $data;
        }
        return $this;
    }

    /**
     * Gets column faxdetect
     *
     * @return string
     */
    public function getFaxdetect()
    {
            return $this->_faxdetect;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setBuggymwi($data)
    {

        if ($this->_buggymwi != $data) {
            $this->_logChange('buggymwi');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_buggymwiAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for buggymwi'));
            }
            $this->_buggymwi = (string) $data;
        } else {
            $this->_buggymwi = $data;
        }
        return $this;
    }

    /**
     * Gets column buggymwi
     *
     * @return string
     */
    public function getBuggymwi()
    {
            return $this->_buggymwi;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setTrunkname($data)
    {

        if ($this->_trunkname != $data) {
            $this->_logChange('trunkname');
        }

        if (!is_null($data)) {
            $this->_trunkname = (string) $data;
        } else {
            $this->_trunkname = $data;
        }
        return $this;
    }

    /**
     * Gets column trunkname
     *
     * @return string
     */
    public function getTrunkname()
    {
            return $this->_trunkname;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setCallingpres($data)
    {

        if ($this->_callingpres != $data) {
            $this->_logChange('callingpres');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_callingpresAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for callingpres'));
            }
            $this->_callingpres = (string) $data;
        } else {
            $this->_callingpres = $data;
        }
        return $this;
    }

    /**
     * Gets column callingpres
     *
     * @return string
     */
    public function getCallingpres()
    {
            return $this->_callingpres;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
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
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setParkinglot($data)
    {

        if ($this->_parkinglot != $data) {
            $this->_logChange('parkinglot');
        }

        if (!is_null($data)) {
            $this->_parkinglot = (string) $data;
        } else {
            $this->_parkinglot = $data;
        }
        return $this;
    }

    /**
     * Gets column parkinglot
     *
     * @return string
     */
    public function getParkinglot()
    {
            return $this->_parkinglot;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setHasastVoicemail($data)
    {

        if ($this->_hasastVoicemail != $data) {
            $this->_logChange('hasastVoicemail');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_hasastVoicemailAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for hasastVoicemail'));
            }
            $this->_hasastVoicemail = (string) $data;
        } else {
            $this->_hasastVoicemail = $data;
        }
        return $this;
    }

    /**
     * Gets column hasast_voicemail
     *
     * @return string
     */
    public function getHasastVoicemail()
    {
            return $this->_hasastVoicemail;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setSubscribemwi($data)
    {

        if ($this->_subscribemwi != $data) {
            $this->_logChange('subscribemwi');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_subscribemwiAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for subscribemwi'));
            }
            $this->_subscribemwi = (string) $data;
        } else {
            $this->_subscribemwi = $data;
        }
        return $this;
    }

    /**
     * Gets column subscribemwi
     *
     * @return string
     */
    public function getSubscribemwi()
    {
            return $this->_subscribemwi;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setVmexten($data)
    {

        if ($this->_vmexten != $data) {
            $this->_logChange('vmexten');
        }

        if (!is_null($data)) {
            $this->_vmexten = (string) $data;
        } else {
            $this->_vmexten = $data;
        }
        return $this;
    }

    /**
     * Gets column vmexten
     *
     * @return string
     */
    public function getVmexten()
    {
            return $this->_vmexten;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setAutoframing($data)
    {

        if ($this->_autoframing != $data) {
            $this->_logChange('autoframing');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_autoframingAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for autoframing'));
            }
            $this->_autoframing = (string) $data;
        } else {
            $this->_autoframing = $data;
        }
        return $this;
    }

    /**
     * Gets column autoframing
     *
     * @return string
     */
    public function getAutoframing()
    {
            return $this->_autoframing;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setRtpkeepalive($data)
    {

        if ($this->_rtpkeepalive != $data) {
            $this->_logChange('rtpkeepalive');
        }

        if (!is_null($data)) {
            $this->_rtpkeepalive = (int) $data;
        } else {
            $this->_rtpkeepalive = $data;
        }
        return $this;
    }

    /**
     * Gets column rtpkeepalive
     *
     * @return int
     */
    public function getRtpkeepalive()
    {
            return $this->_rtpkeepalive;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setCallLimit($data)
    {

        if ($this->_callLimit != $data) {
            $this->_logChange('callLimit');
        }

        if (!is_null($data)) {
            $this->_callLimit = (int) $data;
        } else {
            $this->_callLimit = $data;
        }
        return $this;
    }

    /**
     * Gets column call-limit
     *
     * @return int
     */
    public function getCallLimit()
    {
            return $this->_callLimit;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setG726nonstandard($data)
    {

        if ($this->_g726nonstandard != $data) {
            $this->_logChange('g726nonstandard');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_g726nonstandardAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for g726nonstandard'));
            }
            $this->_g726nonstandard = (string) $data;
        } else {
            $this->_g726nonstandard = $data;
        }
        return $this;
    }

    /**
     * Gets column g726nonstandard
     *
     * @return string
     */
    public function getG726nonstandard()
    {
            return $this->_g726nonstandard;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setIgnoresdpversion($data)
    {

        if ($this->_ignoresdpversion != $data) {
            $this->_logChange('ignoresdpversion');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_ignoresdpversionAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for ignoresdpversion'));
            }
            $this->_ignoresdpversion = (string) $data;
        } else {
            $this->_ignoresdpversion = $data;
        }
        return $this;
    }

    /**
     * Gets column ignoresdpversion
     *
     * @return string
     */
    public function getIgnoresdpversion()
    {
            return $this->_ignoresdpversion;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setAllowtransfer($data)
    {

        if ($this->_allowtransfer != $data) {
            $this->_logChange('allowtransfer');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_allowtransferAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for allowtransfer'));
            }
            $this->_allowtransfer = (string) $data;
        } else {
            $this->_allowtransfer = $data;
        }
        return $this;
    }

    /**
     * Gets column allowtransfer
     *
     * @return string
     */
    public function getAllowtransfer()
    {
            return $this->_allowtransfer;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setDynamic($data)
    {

        if ($this->_dynamic != $data) {
            $this->_logChange('dynamic');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_dynamicAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for dynamic'));
            }
            $this->_dynamic = (string) $data;
        } else {
            $this->_dynamic = $data;
        }
        return $this;
    }

    /**
     * Gets column dynamic
     *
     * @return string
     */
    public function getDynamic()
    {
            return $this->_dynamic;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setPath($data)
    {

        if ($this->_path != $data) {
            $this->_logChange('path');
        }

        if (!is_null($data)) {
            $this->_path = (string) $data;
        } else {
            $this->_path = $data;
        }
        return $this;
    }

    /**
     * Gets column path
     *
     * @return string
     */
    public function getPath()
    {
            return $this->_path;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstSippeers
     */
    public function setSupportpath($data)
    {

        if ($this->_supportpath != $data) {
            $this->_logChange('supportpath');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_supportpathAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for supportpath'));
            }
            $this->_supportpath = (string) $data;
        } else {
            $this->_supportpath = $data;
        }
        return $this;
    }

    /**
     * Gets column supportpath
     *
     * @return string
     */
    public function getSupportpath()
    {
            return $this->_supportpath;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstSippeers
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstSippeers')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstSippeers);

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
     * @return null | \Oasis\Model\Validator\AstSippeers
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstSippeers')) {

                $this->setValidator(new \Oasis\Validator\AstSippeers);
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
     * @see \Mapper\Sql\AstSippeers::delete
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
