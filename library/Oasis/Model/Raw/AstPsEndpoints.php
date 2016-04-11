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
class AstPsEndpoints extends ModelAbstract
{

    protected $_directMediaAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_connectedLineMethodAcceptedValues = array(
        'invite',
        'reinvite',
        'update',
    );
    protected $_directMediaMethodAcceptedValues = array(
        'invite',
        'reinvite',
        'update',
    );
    protected $_directMediaGlareMitigationAcceptedValues = array(
        'none',
        'outgoing',
        'incoming',
    );
    protected $_disableDirectMediaOnNatAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_dtmfModeAcceptedValues = array(
        'rfc4733',
        'inband',
        'info',
    );
    protected $_forceRportAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_iceSupportAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_identifyByAcceptedValues = array(
        'username',
    );
    protected $_rewriteContactAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_rtpIpv6AcceptedValues = array(
        'yes',
        'no',
    );
    protected $_rtpSymmetricAcceptedValues = array(
        'yes',
        'no',
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
    protected $_timersAcceptedValues = array(
        'forced',
        'no',
        'required',
        'yes',
    );
    protected $_calleridPrivacyAcceptedValues = array(
        'allowed_not_screened',
        'allowed_passed_screened',
        'allowed_failed_screened',
        'allowed',
        'prohib_not_screened',
        'prohib_passed_screened',
        'prohib_failed_screened',
        'prohib',
        'unavailable',
    );
    protected $_100relAcceptedValues = array(
        'no',
        'required',
        'yes',
    );
    protected $_aggregateMwiAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_trustIdInboundAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_trustIdOutboundAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_usePtimeAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_useAvpfAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_mediaEncryptionAcceptedValues = array(
        'no',
        'sdes',
        'dtls',
    );
    protected $_inbandProgressAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_faxDetectAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_t38UdptlAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_t38UdptlEcAcceptedValues = array(
        'none',
        'fec',
        'redundancy',
    );
    protected $_t38UdptlNatAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_t38UdptlIpv6AcceptedValues = array(
        'yes',
        'no',
    );
    protected $_oneTouchRecordingAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_allowTransferAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_allowSubscribeAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_dtlsSetupAcceptedValues = array(
        'active',
        'passive',
        'actpass',
    );
    protected $_srtpTag32AcceptedValues = array(
        'yes',
        'no',
    );
    protected $_redirectMethodAcceptedValues = array(
        'user',
        'uri_core',
        'uri_pjsip',
    );
    protected $_forceAvpAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_mediaUseReceivedTransportAcceptedValues = array(
        'yes',
        'no',
    );

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
    protected $_transport;

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
     * Database var type enum('invite','reinvite','update')
     *
     * @var string
     */
    protected $_connectedLineMethod;

    /**
     * Database var type enum('invite','reinvite','update')
     *
     * @var string
     */
    protected $_directMediaMethod;

    /**
     * Database var type enum('none','outgoing','incoming')
     *
     * @var string
     */
    protected $_directMediaGlareMitigation;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_disableDirectMediaOnNat;

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
    protected $_externalMediaAddress;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_forceRport;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_iceSupport;

    /**
     * Database var type enum('username')
     *
     * @var string
     */
    protected $_identifyBy;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mailboxes;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mohSuggest;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_outboundAuth;

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
    protected $_rewriteContact;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_rtpIpv6;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_rtpSymmetric;

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
     * Database var type int
     *
     * @var int
     */
    protected $_timersMinSe;

    /**
     * Database var type enum('forced','no','required','yes')
     *
     * @var string
     */
    protected $_timers;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timersSessExpires;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callerid;

    /**
     * Database var type enum('allowed_not_screened','allowed_passed_screened','allowed_failed_screened','allowed','prohib_not_screened','prohib_passed_screened','prohib_failed_screened','prohib','unavailable')
     *
     * @var string
     */
    protected $_calleridPrivacy;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_calleridTag;

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
    protected $_aggregateMwi;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_trustIdInbound;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_trustIdOutbound;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_usePtime;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_useAvpf;

    /**
     * Database var type enum('no','sdes','dtls')
     *
     * @var string
     */
    protected $_mediaEncryption;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_inbandProgress;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callGroup;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pickupGroup;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_namedCallGroup;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_namedPickupGroup;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_deviceStateBusyAt;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_faxDetect;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_t38Udptl;

    /**
     * Database var type enum('none','fec','redundancy')
     *
     * @var string
     */
    protected $_t38UdptlEc;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_t38UdptlMaxdatagram;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_t38UdptlNat;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_t38UdptlIpv6;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_toneZone;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_language;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_oneTouchRecording;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_recordOnFeature;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_recordOffFeature;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_rtpEngine;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_allowTransfer;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_allowSubscribe;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_sdpOwner;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_sdpSession;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tosAudio;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tosVideo;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_subMinExpiry;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromDomain;

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
    protected $_mwiFromUser;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dtlsVerify;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dtlsRekey;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dtlsCertFile;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dtlsPrivateKey;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dtlsCipher;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dtlsCaFile;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dtlsCaPath;

    /**
     * Database var type enum('active','passive','actpass')
     *
     * @var string
     */
    protected $_dtlsSetup;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_srtpTag32;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mediaAddress;

    /**
     * Database var type enum('user','uri_core','uri_pjsip')
     *
     * @var string
     */
    protected $_redirectMethod;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_setVar;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_cosAudio;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_cosVideo;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_messageContext;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_forceAvp;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_mediaUseReceivedTransport;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_accountcode;




    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'transport'=>'transport',
        'aors'=>'aors',
        'auth'=>'auth',
        'context'=>'context',
        'disallow'=>'disallow',
        'allow'=>'allow',
        'direct_media'=>'directMedia',
        'connected_line_method'=>'connectedLineMethod',
        'direct_media_method'=>'directMediaMethod',
        'direct_media_glare_mitigation'=>'directMediaGlareMitigation',
        'disable_direct_media_on_nat'=>'disableDirectMediaOnNat',
        'dtmf_mode'=>'dtmfMode',
        'external_media_address'=>'externalMediaAddress',
        'force_rport'=>'forceRport',
        'ice_support'=>'iceSupport',
        'identify_by'=>'identifyBy',
        'mailboxes'=>'mailboxes',
        'moh_suggest'=>'mohSuggest',
        'outbound_auth'=>'outboundAuth',
        'outbound_proxy'=>'outboundProxy',
        'rewrite_contact'=>'rewriteContact',
        'rtp_ipv6'=>'rtpIpv6',
        'rtp_symmetric'=>'rtpSymmetric',
        'send_diversion'=>'sendDiversion',
        'send_pai'=>'sendPai',
        'send_rpid'=>'sendRpid',
        'timers_min_se'=>'timersMinSe',
        'timers'=>'timers',
        'timers_sess_expires'=>'timersSessExpires',
        'callerid'=>'callerid',
        'callerid_privacy'=>'calleridPrivacy',
        'callerid_tag'=>'calleridTag',
        '100rel'=>'100rel',
        'aggregate_mwi'=>'aggregateMwi',
        'trust_id_inbound'=>'trustIdInbound',
        'trust_id_outbound'=>'trustIdOutbound',
        'use_ptime'=>'usePtime',
        'use_avpf'=>'useAvpf',
        'media_encryption'=>'mediaEncryption',
        'inband_progress'=>'inbandProgress',
        'call_group'=>'callGroup',
        'pickup_group'=>'pickupGroup',
        'named_call_group'=>'namedCallGroup',
        'named_pickup_group'=>'namedPickupGroup',
        'device_state_busy_at'=>'deviceStateBusyAt',
        'fax_detect'=>'faxDetect',
        't38_udptl'=>'t38Udptl',
        't38_udptl_ec'=>'t38UdptlEc',
        't38_udptl_maxdatagram'=>'t38UdptlMaxdatagram',
        't38_udptl_nat'=>'t38UdptlNat',
        't38_udptl_ipv6'=>'t38UdptlIpv6',
        'tone_zone'=>'toneZone',
        'language'=>'language',
        'one_touch_recording'=>'oneTouchRecording',
        'record_on_feature'=>'recordOnFeature',
        'record_off_feature'=>'recordOffFeature',
        'rtp_engine'=>'rtpEngine',
        'allow_transfer'=>'allowTransfer',
        'allow_subscribe'=>'allowSubscribe',
        'sdp_owner'=>'sdpOwner',
        'sdp_session'=>'sdpSession',
        'tos_audio'=>'tosAudio',
        'tos_video'=>'tosVideo',
        'sub_min_expiry'=>'subMinExpiry',
        'from_domain'=>'fromDomain',
        'from_user'=>'fromUser',
        'mwi_from_user'=>'mwiFromUser',
        'dtls_verify'=>'dtlsVerify',
        'dtls_rekey'=>'dtlsRekey',
        'dtls_cert_file'=>'dtlsCertFile',
        'dtls_private_key'=>'dtlsPrivateKey',
        'dtls_cipher'=>'dtlsCipher',
        'dtls_ca_file'=>'dtlsCaFile',
        'dtls_ca_path'=>'dtlsCaPath',
        'dtls_setup'=>'dtlsSetup',
        'srtp_tag_32'=>'srtpTag32',
        'media_address'=>'mediaAddress',
        'redirect_method'=>'redirectMethod',
        'set_var'=>'setVar',
        'cos_audio'=>'cosAudio',
        'cos_video'=>'cosVideo',
        'message_context'=>'messageContext',
        'force_avp'=>'forceAvp',
        'media_use_received_transport'=>'mediaUseReceivedTransport',
        'accountcode'=>'accountcode',
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
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setSorceryId($data)
    {

        if ($this->_sorceryId != $data) {
            $this->_logChange('sorceryId');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setTransport($data)
    {

        if ($this->_transport != $data) {
            $this->_logChange('transport');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setAors($data)
    {

        if ($this->_aors != $data) {
            $this->_logChange('aors');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDirectMedia($data)
    {

        if ($this->_directMedia != $data) {
            $this->_logChange('directMedia');
        }

        if (!is_null($data)) {
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
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setConnectedLineMethod($data)
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


        if ($this->_connectedLineMethod != $data) {
            $this->_logChange('connectedLineMethod');
        }

        $this->_connectedLineMethod = $data;
        return $this;
    }

    /**
     * Gets column connected_line_method
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getConnectedLineMethod($returnZendDate = false)
    {
    
        if (is_null($this->_connectedLineMethod)) {

            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_connectedLineMethod->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }


        return $this->_connectedLineMethod->format('Y-m-d H:i:s');

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDirectMediaMethod($data)
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


        if ($this->_directMediaMethod != $data) {
            $this->_logChange('directMediaMethod');
        }

        $this->_directMediaMethod = $data;
        return $this;
    }

    /**
     * Gets column direct_media_method
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getDirectMediaMethod($returnZendDate = false)
    {
    
        if (is_null($this->_directMediaMethod)) {

            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_directMediaMethod->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }


        return $this->_directMediaMethod->format('Y-m-d H:i:s');

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDirectMediaGlareMitigation($data)
    {

        if ($this->_directMediaGlareMitigation != $data) {
            $this->_logChange('directMediaGlareMitigation');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_directMediaGlareMitigationAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for directMediaGlareMitigation'));
            }
            $this->_directMediaGlareMitigation = (string) $data;
        } else {
            $this->_directMediaGlareMitigation = $data;
        }
        return $this;
    }

    /**
     * Gets column direct_media_glare_mitigation
     *
     * @return string
     */
    public function getDirectMediaGlareMitigation()
    {
            return $this->_directMediaGlareMitigation;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDisableDirectMediaOnNat($data)
    {

        if ($this->_disableDirectMediaOnNat != $data) {
            $this->_logChange('disableDirectMediaOnNat');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_disableDirectMediaOnNatAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for disableDirectMediaOnNat'));
            }
            $this->_disableDirectMediaOnNat = (string) $data;
        } else {
            $this->_disableDirectMediaOnNat = $data;
        }
        return $this;
    }

    /**
     * Gets column disable_direct_media_on_nat
     *
     * @return string
     */
    public function getDisableDirectMediaOnNat()
    {
            return $this->_disableDirectMediaOnNat;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDtmfMode($data)
    {

        if ($this->_dtmfMode != $data) {
            $this->_logChange('dtmfMode');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setExternalMediaAddress($data)
    {

        if ($this->_externalMediaAddress != $data) {
            $this->_logChange('externalMediaAddress');
        }

        if (!is_null($data)) {
            $this->_externalMediaAddress = (string) $data;
        } else {
            $this->_externalMediaAddress = $data;
        }
        return $this;
    }

    /**
     * Gets column external_media_address
     *
     * @return string
     */
    public function getExternalMediaAddress()
    {
            return $this->_externalMediaAddress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setForceRport($data)
    {

        if ($this->_forceRport != $data) {
            $this->_logChange('forceRport');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_forceRportAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for forceRport'));
            }
            $this->_forceRport = (string) $data;
        } else {
            $this->_forceRport = $data;
        }
        return $this;
    }

    /**
     * Gets column force_rport
     *
     * @return string
     */
    public function getForceRport()
    {
            return $this->_forceRport;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setIceSupport($data)
    {

        if ($this->_iceSupport != $data) {
            $this->_logChange('iceSupport');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_iceSupportAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for iceSupport'));
            }
            $this->_iceSupport = (string) $data;
        } else {
            $this->_iceSupport = $data;
        }
        return $this;
    }

    /**
     * Gets column ice_support
     *
     * @return string
     */
    public function getIceSupport()
    {
            return $this->_iceSupport;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setIdentifyBy($data)
    {

        if ($this->_identifyBy != $data) {
            $this->_logChange('identifyBy');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_identifyByAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for identifyBy'));
            }
            $this->_identifyBy = (string) $data;
        } else {
            $this->_identifyBy = $data;
        }
        return $this;
    }

    /**
     * Gets column identify_by
     *
     * @return string
     */
    public function getIdentifyBy()
    {
            return $this->_identifyBy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setMailboxes($data)
    {

        if ($this->_mailboxes != $data) {
            $this->_logChange('mailboxes');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setMohSuggest($data)
    {

        if ($this->_mohSuggest != $data) {
            $this->_logChange('mohSuggest');
        }

        if (!is_null($data)) {
            $this->_mohSuggest = (string) $data;
        } else {
            $this->_mohSuggest = $data;
        }
        return $this;
    }

    /**
     * Gets column moh_suggest
     *
     * @return string
     */
    public function getMohSuggest()
    {
            return $this->_mohSuggest;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setOutboundAuth($data)
    {

        if ($this->_outboundAuth != $data) {
            $this->_logChange('outboundAuth');
        }

        if (!is_null($data)) {
            $this->_outboundAuth = (string) $data;
        } else {
            $this->_outboundAuth = $data;
        }
        return $this;
    }

    /**
     * Gets column outbound_auth
     *
     * @return string
     */
    public function getOutboundAuth()
    {
            return $this->_outboundAuth;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setOutboundProxy($data)
    {

        if ($this->_outboundProxy != $data) {
            $this->_logChange('outboundProxy');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setRewriteContact($data)
    {

        if ($this->_rewriteContact != $data) {
            $this->_logChange('rewriteContact');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_rewriteContactAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for rewriteContact'));
            }
            $this->_rewriteContact = (string) $data;
        } else {
            $this->_rewriteContact = $data;
        }
        return $this;
    }

    /**
     * Gets column rewrite_contact
     *
     * @return string
     */
    public function getRewriteContact()
    {
            return $this->_rewriteContact;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setRtpIpv6($data)
    {

        if ($this->_rtpIpv6 != $data) {
            $this->_logChange('rtpIpv6');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_rtpIpv6AcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for rtpIpv6'));
            }
            $this->_rtpIpv6 = (string) $data;
        } else {
            $this->_rtpIpv6 = $data;
        }
        return $this;
    }

    /**
     * Gets column rtp_ipv6
     *
     * @return string
     */
    public function getRtpIpv6()
    {
            return $this->_rtpIpv6;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setRtpSymmetric($data)
    {

        if ($this->_rtpSymmetric != $data) {
            $this->_logChange('rtpSymmetric');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_rtpSymmetricAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for rtpSymmetric'));
            }
            $this->_rtpSymmetric = (string) $data;
        } else {
            $this->_rtpSymmetric = $data;
        }
        return $this;
    }

    /**
     * Gets column rtp_symmetric
     *
     * @return string
     */
    public function getRtpSymmetric()
    {
            return $this->_rtpSymmetric;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setSendDiversion($data)
    {

        if ($this->_sendDiversion != $data) {
            $this->_logChange('sendDiversion');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setSendPai($data)
    {

        if ($this->_sendPai != $data) {
            $this->_logChange('sendPai');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setSendRpid($data)
    {

        if ($this->_sendRpid != $data) {
            $this->_logChange('sendRpid');
        }

        if (!is_null($data)) {
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
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setTimersMinSe($data)
    {

        if ($this->_timersMinSe != $data) {
            $this->_logChange('timersMinSe');
        }

        if (!is_null($data)) {
            $this->_timersMinSe = (int) $data;
        } else {
            $this->_timersMinSe = $data;
        }
        return $this;
    }

    /**
     * Gets column timers_min_se
     *
     * @return int
     */
    public function getTimersMinSe()
    {
            return $this->_timersMinSe;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setTimers($data)
    {

        if ($this->_timers != $data) {
            $this->_logChange('timers');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_timersAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for timers'));
            }
            $this->_timers = (string) $data;
        } else {
            $this->_timers = $data;
        }
        return $this;
    }

    /**
     * Gets column timers
     *
     * @return string
     */
    public function getTimers()
    {
            return $this->_timers;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setTimersSessExpires($data)
    {

        if ($this->_timersSessExpires != $data) {
            $this->_logChange('timersSessExpires');
        }

        if (!is_null($data)) {
            $this->_timersSessExpires = (int) $data;
        } else {
            $this->_timersSessExpires = $data;
        }
        return $this;
    }

    /**
     * Gets column timers_sess_expires
     *
     * @return int
     */
    public function getTimersSessExpires()
    {
            return $this->_timersSessExpires;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setCalleridPrivacy($data)
    {

        if ($this->_calleridPrivacy != $data) {
            $this->_logChange('calleridPrivacy');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_calleridPrivacyAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for calleridPrivacy'));
            }
            $this->_calleridPrivacy = (string) $data;
        } else {
            $this->_calleridPrivacy = $data;
        }
        return $this;
    }

    /**
     * Gets column callerid_privacy
     *
     * @return string
     */
    public function getCalleridPrivacy()
    {
            return $this->_calleridPrivacy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setCalleridTag($data)
    {

        if ($this->_calleridTag != $data) {
            $this->_logChange('calleridTag');
        }

        if (!is_null($data)) {
            $this->_calleridTag = (string) $data;
        } else {
            $this->_calleridTag = $data;
        }
        return $this;
    }

    /**
     * Gets column callerid_tag
     *
     * @return string
     */
    public function getCalleridTag()
    {
            return $this->_calleridTag;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function set100rel($data)
    {

        if ($this->_100rel != $data) {
            $this->_logChange('100rel');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setAggregateMwi($data)
    {

        if ($this->_aggregateMwi != $data) {
            $this->_logChange('aggregateMwi');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_aggregateMwiAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for aggregateMwi'));
            }
            $this->_aggregateMwi = (string) $data;
        } else {
            $this->_aggregateMwi = $data;
        }
        return $this;
    }

    /**
     * Gets column aggregate_mwi
     *
     * @return string
     */
    public function getAggregateMwi()
    {
            return $this->_aggregateMwi;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setTrustIdInbound($data)
    {

        if ($this->_trustIdInbound != $data) {
            $this->_logChange('trustIdInbound');
        }

        if (!is_null($data)) {
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setTrustIdOutbound($data)
    {

        if ($this->_trustIdOutbound != $data) {
            $this->_logChange('trustIdOutbound');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_trustIdOutboundAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for trustIdOutbound'));
            }
            $this->_trustIdOutbound = (string) $data;
        } else {
            $this->_trustIdOutbound = $data;
        }
        return $this;
    }

    /**
     * Gets column trust_id_outbound
     *
     * @return string
     */
    public function getTrustIdOutbound()
    {
            return $this->_trustIdOutbound;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setUsePtime($data)
    {

        if ($this->_usePtime != $data) {
            $this->_logChange('usePtime');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_usePtimeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for usePtime'));
            }
            $this->_usePtime = (string) $data;
        } else {
            $this->_usePtime = $data;
        }
        return $this;
    }

    /**
     * Gets column use_ptime
     *
     * @return string
     */
    public function getUsePtime()
    {
            return $this->_usePtime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setUseAvpf($data)
    {

        if ($this->_useAvpf != $data) {
            $this->_logChange('useAvpf');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_useAvpfAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for useAvpf'));
            }
            $this->_useAvpf = (string) $data;
        } else {
            $this->_useAvpf = $data;
        }
        return $this;
    }

    /**
     * Gets column use_avpf
     *
     * @return string
     */
    public function getUseAvpf()
    {
            return $this->_useAvpf;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setMediaEncryption($data)
    {

        if ($this->_mediaEncryption != $data) {
            $this->_logChange('mediaEncryption');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_mediaEncryptionAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for mediaEncryption'));
            }
            $this->_mediaEncryption = (string) $data;
        } else {
            $this->_mediaEncryption = $data;
        }
        return $this;
    }

    /**
     * Gets column media_encryption
     *
     * @return string
     */
    public function getMediaEncryption()
    {
            return $this->_mediaEncryption;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setInbandProgress($data)
    {

        if ($this->_inbandProgress != $data) {
            $this->_logChange('inbandProgress');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_inbandProgressAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for inbandProgress'));
            }
            $this->_inbandProgress = (string) $data;
        } else {
            $this->_inbandProgress = $data;
        }
        return $this;
    }

    /**
     * Gets column inband_progress
     *
     * @return string
     */
    public function getInbandProgress()
    {
            return $this->_inbandProgress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setCallGroup($data)
    {

        if ($this->_callGroup != $data) {
            $this->_logChange('callGroup');
        }

        if (!is_null($data)) {
            $this->_callGroup = (string) $data;
        } else {
            $this->_callGroup = $data;
        }
        return $this;
    }

    /**
     * Gets column call_group
     *
     * @return string
     */
    public function getCallGroup()
    {
            return $this->_callGroup;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setPickupGroup($data)
    {

        if ($this->_pickupGroup != $data) {
            $this->_logChange('pickupGroup');
        }

        if (!is_null($data)) {
            $this->_pickupGroup = (string) $data;
        } else {
            $this->_pickupGroup = $data;
        }
        return $this;
    }

    /**
     * Gets column pickup_group
     *
     * @return string
     */
    public function getPickupGroup()
    {
            return $this->_pickupGroup;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setNamedCallGroup($data)
    {

        if ($this->_namedCallGroup != $data) {
            $this->_logChange('namedCallGroup');
        }

        if (!is_null($data)) {
            $this->_namedCallGroup = (string) $data;
        } else {
            $this->_namedCallGroup = $data;
        }
        return $this;
    }

    /**
     * Gets column named_call_group
     *
     * @return string
     */
    public function getNamedCallGroup()
    {
            return $this->_namedCallGroup;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setNamedPickupGroup($data)
    {

        if ($this->_namedPickupGroup != $data) {
            $this->_logChange('namedPickupGroup');
        }

        if (!is_null($data)) {
            $this->_namedPickupGroup = (string) $data;
        } else {
            $this->_namedPickupGroup = $data;
        }
        return $this;
    }

    /**
     * Gets column named_pickup_group
     *
     * @return string
     */
    public function getNamedPickupGroup()
    {
            return $this->_namedPickupGroup;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDeviceStateBusyAt($data)
    {

        if ($this->_deviceStateBusyAt != $data) {
            $this->_logChange('deviceStateBusyAt');
        }

        if (!is_null($data)) {
            $this->_deviceStateBusyAt = (int) $data;
        } else {
            $this->_deviceStateBusyAt = $data;
        }
        return $this;
    }

    /**
     * Gets column device_state_busy_at
     *
     * @return int
     */
    public function getDeviceStateBusyAt()
    {
            return $this->_deviceStateBusyAt;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setFaxDetect($data)
    {

        if ($this->_faxDetect != $data) {
            $this->_logChange('faxDetect');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_faxDetectAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for faxDetect'));
            }
            $this->_faxDetect = (string) $data;
        } else {
            $this->_faxDetect = $data;
        }
        return $this;
    }

    /**
     * Gets column fax_detect
     *
     * @return string
     */
    public function getFaxDetect()
    {
            return $this->_faxDetect;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setT38Udptl($data)
    {

        if ($this->_t38Udptl != $data) {
            $this->_logChange('t38Udptl');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_t38UdptlAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for t38Udptl'));
            }
            $this->_t38Udptl = (string) $data;
        } else {
            $this->_t38Udptl = $data;
        }
        return $this;
    }

    /**
     * Gets column t38_udptl
     *
     * @return string
     */
    public function getT38Udptl()
    {
            return $this->_t38Udptl;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setT38UdptlEc($data)
    {

        if ($this->_t38UdptlEc != $data) {
            $this->_logChange('t38UdptlEc');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_t38UdptlEcAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for t38UdptlEc'));
            }
            $this->_t38UdptlEc = (string) $data;
        } else {
            $this->_t38UdptlEc = $data;
        }
        return $this;
    }

    /**
     * Gets column t38_udptl_ec
     *
     * @return string
     */
    public function getT38UdptlEc()
    {
            return $this->_t38UdptlEc;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setT38UdptlMaxdatagram($data)
    {

        if ($this->_t38UdptlMaxdatagram != $data) {
            $this->_logChange('t38UdptlMaxdatagram');
        }

        if (!is_null($data)) {
            $this->_t38UdptlMaxdatagram = (int) $data;
        } else {
            $this->_t38UdptlMaxdatagram = $data;
        }
        return $this;
    }

    /**
     * Gets column t38_udptl_maxdatagram
     *
     * @return int
     */
    public function getT38UdptlMaxdatagram()
    {
            return $this->_t38UdptlMaxdatagram;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setT38UdptlNat($data)
    {

        if ($this->_t38UdptlNat != $data) {
            $this->_logChange('t38UdptlNat');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_t38UdptlNatAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for t38UdptlNat'));
            }
            $this->_t38UdptlNat = (string) $data;
        } else {
            $this->_t38UdptlNat = $data;
        }
        return $this;
    }

    /**
     * Gets column t38_udptl_nat
     *
     * @return string
     */
    public function getT38UdptlNat()
    {
            return $this->_t38UdptlNat;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setT38UdptlIpv6($data)
    {

        if ($this->_t38UdptlIpv6 != $data) {
            $this->_logChange('t38UdptlIpv6');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_t38UdptlIpv6AcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for t38UdptlIpv6'));
            }
            $this->_t38UdptlIpv6 = (string) $data;
        } else {
            $this->_t38UdptlIpv6 = $data;
        }
        return $this;
    }

    /**
     * Gets column t38_udptl_ipv6
     *
     * @return string
     */
    public function getT38UdptlIpv6()
    {
            return $this->_t38UdptlIpv6;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setToneZone($data)
    {

        if ($this->_toneZone != $data) {
            $this->_logChange('toneZone');
        }

        if (!is_null($data)) {
            $this->_toneZone = (string) $data;
        } else {
            $this->_toneZone = $data;
        }
        return $this;
    }

    /**
     * Gets column tone_zone
     *
     * @return string
     */
    public function getToneZone()
    {
            return $this->_toneZone;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setOneTouchRecording($data)
    {

        if ($this->_oneTouchRecording != $data) {
            $this->_logChange('oneTouchRecording');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_oneTouchRecordingAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for oneTouchRecording'));
            }
            $this->_oneTouchRecording = (string) $data;
        } else {
            $this->_oneTouchRecording = $data;
        }
        return $this;
    }

    /**
     * Gets column one_touch_recording
     *
     * @return string
     */
    public function getOneTouchRecording()
    {
            return $this->_oneTouchRecording;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setRecordOnFeature($data)
    {

        if ($this->_recordOnFeature != $data) {
            $this->_logChange('recordOnFeature');
        }

        if (!is_null($data)) {
            $this->_recordOnFeature = (string) $data;
        } else {
            $this->_recordOnFeature = $data;
        }
        return $this;
    }

    /**
     * Gets column record_on_feature
     *
     * @return string
     */
    public function getRecordOnFeature()
    {
            return $this->_recordOnFeature;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setRecordOffFeature($data)
    {

        if ($this->_recordOffFeature != $data) {
            $this->_logChange('recordOffFeature');
        }

        if (!is_null($data)) {
            $this->_recordOffFeature = (string) $data;
        } else {
            $this->_recordOffFeature = $data;
        }
        return $this;
    }

    /**
     * Gets column record_off_feature
     *
     * @return string
     */
    public function getRecordOffFeature()
    {
            return $this->_recordOffFeature;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setRtpEngine($data)
    {

        if ($this->_rtpEngine != $data) {
            $this->_logChange('rtpEngine');
        }

        if (!is_null($data)) {
            $this->_rtpEngine = (string) $data;
        } else {
            $this->_rtpEngine = $data;
        }
        return $this;
    }

    /**
     * Gets column rtp_engine
     *
     * @return string
     */
    public function getRtpEngine()
    {
            return $this->_rtpEngine;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setAllowTransfer($data)
    {

        if ($this->_allowTransfer != $data) {
            $this->_logChange('allowTransfer');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_allowTransferAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for allowTransfer'));
            }
            $this->_allowTransfer = (string) $data;
        } else {
            $this->_allowTransfer = $data;
        }
        return $this;
    }

    /**
     * Gets column allow_transfer
     *
     * @return string
     */
    public function getAllowTransfer()
    {
            return $this->_allowTransfer;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setAllowSubscribe($data)
    {

        if ($this->_allowSubscribe != $data) {
            $this->_logChange('allowSubscribe');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_allowSubscribeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for allowSubscribe'));
            }
            $this->_allowSubscribe = (string) $data;
        } else {
            $this->_allowSubscribe = $data;
        }
        return $this;
    }

    /**
     * Gets column allow_subscribe
     *
     * @return string
     */
    public function getAllowSubscribe()
    {
            return $this->_allowSubscribe;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setSdpOwner($data)
    {

        if ($this->_sdpOwner != $data) {
            $this->_logChange('sdpOwner');
        }

        if (!is_null($data)) {
            $this->_sdpOwner = (string) $data;
        } else {
            $this->_sdpOwner = $data;
        }
        return $this;
    }

    /**
     * Gets column sdp_owner
     *
     * @return string
     */
    public function getSdpOwner()
    {
            return $this->_sdpOwner;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setSdpSession($data)
    {

        if ($this->_sdpSession != $data) {
            $this->_logChange('sdpSession');
        }

        if (!is_null($data)) {
            $this->_sdpSession = (string) $data;
        } else {
            $this->_sdpSession = $data;
        }
        return $this;
    }

    /**
     * Gets column sdp_session
     *
     * @return string
     */
    public function getSdpSession()
    {
            return $this->_sdpSession;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setTosAudio($data)
    {

        if ($this->_tosAudio != $data) {
            $this->_logChange('tosAudio');
        }

        if (!is_null($data)) {
            $this->_tosAudio = (string) $data;
        } else {
            $this->_tosAudio = $data;
        }
        return $this;
    }

    /**
     * Gets column tos_audio
     *
     * @return string
     */
    public function getTosAudio()
    {
            return $this->_tosAudio;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setTosVideo($data)
    {

        if ($this->_tosVideo != $data) {
            $this->_logChange('tosVideo');
        }

        if (!is_null($data)) {
            $this->_tosVideo = (string) $data;
        } else {
            $this->_tosVideo = $data;
        }
        return $this;
    }

    /**
     * Gets column tos_video
     *
     * @return string
     */
    public function getTosVideo()
    {
            return $this->_tosVideo;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setSubMinExpiry($data)
    {

        if ($this->_subMinExpiry != $data) {
            $this->_logChange('subMinExpiry');
        }

        if (!is_null($data)) {
            $this->_subMinExpiry = (int) $data;
        } else {
            $this->_subMinExpiry = $data;
        }
        return $this;
    }

    /**
     * Gets column sub_min_expiry
     *
     * @return int
     */
    public function getSubMinExpiry()
    {
            return $this->_subMinExpiry;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setFromDomain($data)
    {

        if ($this->_fromDomain != $data) {
            $this->_logChange('fromDomain');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setFromUser($data)
    {

        if ($this->_fromUser != $data) {
            $this->_logChange('fromUser');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setMwiFromUser($data)
    {

        if ($this->_mwiFromUser != $data) {
            $this->_logChange('mwiFromUser');
        }

        if (!is_null($data)) {
            $this->_mwiFromUser = (string) $data;
        } else {
            $this->_mwiFromUser = $data;
        }
        return $this;
    }

    /**
     * Gets column mwi_from_user
     *
     * @return string
     */
    public function getMwiFromUser()
    {
            return $this->_mwiFromUser;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDtlsVerify($data)
    {

        if ($this->_dtlsVerify != $data) {
            $this->_logChange('dtlsVerify');
        }

        if (!is_null($data)) {
            $this->_dtlsVerify = (string) $data;
        } else {
            $this->_dtlsVerify = $data;
        }
        return $this;
    }

    /**
     * Gets column dtls_verify
     *
     * @return string
     */
    public function getDtlsVerify()
    {
            return $this->_dtlsVerify;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDtlsRekey($data)
    {

        if ($this->_dtlsRekey != $data) {
            $this->_logChange('dtlsRekey');
        }

        if (!is_null($data)) {
            $this->_dtlsRekey = (string) $data;
        } else {
            $this->_dtlsRekey = $data;
        }
        return $this;
    }

    /**
     * Gets column dtls_rekey
     *
     * @return string
     */
    public function getDtlsRekey()
    {
            return $this->_dtlsRekey;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDtlsCertFile($data)
    {

        if ($this->_dtlsCertFile != $data) {
            $this->_logChange('dtlsCertFile');
        }

        if (!is_null($data)) {
            $this->_dtlsCertFile = (string) $data;
        } else {
            $this->_dtlsCertFile = $data;
        }
        return $this;
    }

    /**
     * Gets column dtls_cert_file
     *
     * @return string
     */
    public function getDtlsCertFile()
    {
            return $this->_dtlsCertFile;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDtlsPrivateKey($data)
    {

        if ($this->_dtlsPrivateKey != $data) {
            $this->_logChange('dtlsPrivateKey');
        }

        if (!is_null($data)) {
            $this->_dtlsPrivateKey = (string) $data;
        } else {
            $this->_dtlsPrivateKey = $data;
        }
        return $this;
    }

    /**
     * Gets column dtls_private_key
     *
     * @return string
     */
    public function getDtlsPrivateKey()
    {
            return $this->_dtlsPrivateKey;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDtlsCipher($data)
    {

        if ($this->_dtlsCipher != $data) {
            $this->_logChange('dtlsCipher');
        }

        if (!is_null($data)) {
            $this->_dtlsCipher = (string) $data;
        } else {
            $this->_dtlsCipher = $data;
        }
        return $this;
    }

    /**
     * Gets column dtls_cipher
     *
     * @return string
     */
    public function getDtlsCipher()
    {
            return $this->_dtlsCipher;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDtlsCaFile($data)
    {

        if ($this->_dtlsCaFile != $data) {
            $this->_logChange('dtlsCaFile');
        }

        if (!is_null($data)) {
            $this->_dtlsCaFile = (string) $data;
        } else {
            $this->_dtlsCaFile = $data;
        }
        return $this;
    }

    /**
     * Gets column dtls_ca_file
     *
     * @return string
     */
    public function getDtlsCaFile()
    {
            return $this->_dtlsCaFile;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDtlsCaPath($data)
    {

        if ($this->_dtlsCaPath != $data) {
            $this->_logChange('dtlsCaPath');
        }

        if (!is_null($data)) {
            $this->_dtlsCaPath = (string) $data;
        } else {
            $this->_dtlsCaPath = $data;
        }
        return $this;
    }

    /**
     * Gets column dtls_ca_path
     *
     * @return string
     */
    public function getDtlsCaPath()
    {
            return $this->_dtlsCaPath;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setDtlsSetup($data)
    {

        if ($this->_dtlsSetup != $data) {
            $this->_logChange('dtlsSetup');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_dtlsSetupAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for dtlsSetup'));
            }
            $this->_dtlsSetup = (string) $data;
        } else {
            $this->_dtlsSetup = $data;
        }
        return $this;
    }

    /**
     * Gets column dtls_setup
     *
     * @return string
     */
    public function getDtlsSetup()
    {
            return $this->_dtlsSetup;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setSrtpTag32($data)
    {

        if ($this->_srtpTag32 != $data) {
            $this->_logChange('srtpTag32');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_srtpTag32AcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for srtpTag32'));
            }
            $this->_srtpTag32 = (string) $data;
        } else {
            $this->_srtpTag32 = $data;
        }
        return $this;
    }

    /**
     * Gets column srtp_tag_32
     *
     * @return string
     */
    public function getSrtpTag32()
    {
            return $this->_srtpTag32;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setMediaAddress($data)
    {

        if ($this->_mediaAddress != $data) {
            $this->_logChange('mediaAddress');
        }

        if (!is_null($data)) {
            $this->_mediaAddress = (string) $data;
        } else {
            $this->_mediaAddress = $data;
        }
        return $this;
    }

    /**
     * Gets column media_address
     *
     * @return string
     */
    public function getMediaAddress()
    {
            return $this->_mediaAddress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setRedirectMethod($data)
    {

        if ($this->_redirectMethod != $data) {
            $this->_logChange('redirectMethod');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_redirectMethodAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for redirectMethod'));
            }
            $this->_redirectMethod = (string) $data;
        } else {
            $this->_redirectMethod = $data;
        }
        return $this;
    }

    /**
     * Gets column redirect_method
     *
     * @return string
     */
    public function getRedirectMethod()
    {
            return $this->_redirectMethod;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setSetVar($data)
    {

        if ($this->_setVar != $data) {
            $this->_logChange('setVar');
        }

        if (!is_null($data)) {
            $this->_setVar = (string) $data;
        } else {
            $this->_setVar = $data;
        }
        return $this;
    }

    /**
     * Gets column set_var
     *
     * @return text
     */
    public function getSetVar()
    {
            return $this->_setVar;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setCosAudio($data)
    {

        if ($this->_cosAudio != $data) {
            $this->_logChange('cosAudio');
        }

        if (!is_null($data)) {
            $this->_cosAudio = (int) $data;
        } else {
            $this->_cosAudio = $data;
        }
        return $this;
    }

    /**
     * Gets column cos_audio
     *
     * @return int
     */
    public function getCosAudio()
    {
            return $this->_cosAudio;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setCosVideo($data)
    {

        if ($this->_cosVideo != $data) {
            $this->_logChange('cosVideo');
        }

        if (!is_null($data)) {
            $this->_cosVideo = (int) $data;
        } else {
            $this->_cosVideo = $data;
        }
        return $this;
    }

    /**
     * Gets column cos_video
     *
     * @return int
     */
    public function getCosVideo()
    {
            return $this->_cosVideo;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setMessageContext($data)
    {

        if ($this->_messageContext != $data) {
            $this->_logChange('messageContext');
        }

        if (!is_null($data)) {
            $this->_messageContext = (string) $data;
        } else {
            $this->_messageContext = $data;
        }
        return $this;
    }

    /**
     * Gets column message_context
     *
     * @return string
     */
    public function getMessageContext()
    {
            return $this->_messageContext;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setForceAvp($data)
    {

        if ($this->_forceAvp != $data) {
            $this->_logChange('forceAvp');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_forceAvpAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for forceAvp'));
            }
            $this->_forceAvp = (string) $data;
        } else {
            $this->_forceAvp = $data;
        }
        return $this;
    }

    /**
     * Gets column force_avp
     *
     * @return string
     */
    public function getForceAvp()
    {
            return $this->_forceAvp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
     */
    public function setMediaUseReceivedTransport($data)
    {

        if ($this->_mediaUseReceivedTransport != $data) {
            $this->_logChange('mediaUseReceivedTransport');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_mediaUseReceivedTransportAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for mediaUseReceivedTransport'));
            }
            $this->_mediaUseReceivedTransport = (string) $data;
        } else {
            $this->_mediaUseReceivedTransport = $data;
        }
        return $this;
    }

    /**
     * Gets column media_use_received_transport
     *
     * @return string
     */
    public function getMediaUseReceivedTransport()
    {
            return $this->_mediaUseReceivedTransport;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpoints
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
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstPsEndpoints
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstPsEndpoints')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstPsEndpoints);

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
     * @return null | \Oasis\Model\Validator\AstPsEndpoints
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstPsEndpoints')) {

                $this->setValidator(new \Oasis\Validator\AstPsEndpoints);
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
        if ($this->getSorceryId() === null) {
            $this->_logger->log('The value for SorceryId cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'sorcery_id = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getSorceryId())
        );
    }
}
