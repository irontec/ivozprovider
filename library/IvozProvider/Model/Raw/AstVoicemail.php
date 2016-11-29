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
class AstVoicemail extends ModelAbstract
{

    protected $_attachAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_deleteastVoicemailAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_saycidAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_sendastVoicemailAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_reviewAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_tempgreetwarnAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_operatorAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_envelopeAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_forcenameAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_forcegreetingsAcceptedValues = array(
        'yes',
        'no',
    );

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_uniqueid;

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
    protected $_mailbox;

    /**
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
    protected $_fullname;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_alias;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_email;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pager;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_attach;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_attachfmt;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_serveremail;

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
    protected $_tz;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_deleteastVoicemail;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_saycid;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_sendastVoicemail;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_review;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_tempgreetwarn;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_operator;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_envelope;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_sayduration;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_forcename;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_forcegreetings;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callback;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_dialout;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_exitcontext;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxmsg;

    /**
     * Database var type decimal
     *
     * @var float
     */
    protected $_volgain;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_imapuser;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_imappassword;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_imapserver;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_imapport;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_imapflags;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_stamp;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_userId;


    /**
     * Parent relation ast_voicemail_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_User;


    protected $_columnsList = array(
        'uniqueid'=>'uniqueid',
        'context'=>'context',
        'mailbox'=>'mailbox',
        'password'=>'password',
        'fullname'=>'fullname',
        'alias'=>'alias',
        'email'=>'email',
        'pager'=>'pager',
        'attach'=>'attach',
        'attachfmt'=>'attachfmt',
        'serveremail'=>'serveremail',
        'language'=>'language',
        'tz'=>'tz',
        'deleteast_voicemail'=>'deleteastVoicemail',
        'saycid'=>'saycid',
        'sendast_voicemail'=>'sendastVoicemail',
        'review'=>'review',
        'tempgreetwarn'=>'tempgreetwarn',
        'operator'=>'operator',
        'envelope'=>'envelope',
        'sayduration'=>'sayduration',
        'forcename'=>'forcename',
        'forcegreetings'=>'forcegreetings',
        'callback'=>'callback',
        'dialout'=>'dialout',
        'exitcontext'=>'exitcontext',
        'maxmsg'=>'maxmsg',
        'volgain'=>'volgain',
        'imapuser'=>'imapuser',
        'imappassword'=>'imappassword',
        'imapserver'=>'imapserver',
        'imapport'=>'imapport',
        'imapflags'=>'imapflags',
        'stamp'=>'stamp',
        'userId'=>'userId',
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
            'AstVoicemailIbfk1'=> array(
                    'property' => 'User',
                    'table_name' => 'Users',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'password' => '1234',
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
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setUniqueid($data)
    {

        if ($this->_uniqueid != $data) {
            $this->_logChange('uniqueid', $this->_uniqueid, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_uniqueid = $data;

        } else if (!is_null($data)) {
            $this->_uniqueid = (int) $data;

        } else {
            $this->_uniqueid = $data;
        }
        return $this;
    }

    /**
     * Gets column uniqueid
     *
     * @return int
     */
    public function getUniqueid()
    {
        return $this->_uniqueid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setContext($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_context != $data) {
            $this->_logChange('context', $this->_context, $data);
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
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setMailbox($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_mailbox != $data) {
            $this->_logChange('mailbox', $this->_mailbox, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mailbox = $data;

        } else if (!is_null($data)) {
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
     * @return \IvozProvider\Model\Raw\AstVoicemail
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setFullname($data)
    {

        if ($this->_fullname != $data) {
            $this->_logChange('fullname', $this->_fullname, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fullname = $data;

        } else if (!is_null($data)) {
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
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setAlias($data)
    {

        if ($this->_alias != $data) {
            $this->_logChange('alias', $this->_alias, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_alias = $data;

        } else if (!is_null($data)) {
            $this->_alias = (string) $data;

        } else {
            $this->_alias = $data;
        }
        return $this;
    }

    /**
     * Gets column alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->_alias;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setEmail($data)
    {

        if ($this->_email != $data) {
            $this->_logChange('email', $this->_email, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_email = $data;

        } else if (!is_null($data)) {
            $this->_email = (string) $data;

        } else {
            $this->_email = $data;
        }
        return $this;
    }

    /**
     * Gets column email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setPager($data)
    {

        if ($this->_pager != $data) {
            $this->_logChange('pager', $this->_pager, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pager = $data;

        } else if (!is_null($data)) {
            $this->_pager = (string) $data;

        } else {
            $this->_pager = $data;
        }
        return $this;
    }

    /**
     * Gets column pager
     *
     * @return string
     */
    public function getPager()
    {
        return $this->_pager;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setAttach($data)
    {

        if ($this->_attach != $data) {
            $this->_logChange('attach', $this->_attach, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_attach = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_attachAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for attach'));
            }
            $this->_attach = (string) $data;

        } else {
            $this->_attach = $data;
        }
        return $this;
    }

    /**
     * Gets column attach
     *
     * @return string
     */
    public function getAttach()
    {
        return $this->_attach;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setAttachfmt($data)
    {

        if ($this->_attachfmt != $data) {
            $this->_logChange('attachfmt', $this->_attachfmt, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_attachfmt = $data;

        } else if (!is_null($data)) {
            $this->_attachfmt = (string) $data;

        } else {
            $this->_attachfmt = $data;
        }
        return $this;
    }

    /**
     * Gets column attachfmt
     *
     * @return string
     */
    public function getAttachfmt()
    {
        return $this->_attachfmt;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setServeremail($data)
    {

        if ($this->_serveremail != $data) {
            $this->_logChange('serveremail', $this->_serveremail, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_serveremail = $data;

        } else if (!is_null($data)) {
            $this->_serveremail = (string) $data;

        } else {
            $this->_serveremail = $data;
        }
        return $this;
    }

    /**
     * Gets column serveremail
     *
     * @return string
     */
    public function getServeremail()
    {
        return $this->_serveremail;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setLanguage($data)
    {

        if ($this->_language != $data) {
            $this->_logChange('language', $this->_language, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_language = $data;

        } else if (!is_null($data)) {
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
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setTz($data)
    {

        if ($this->_tz != $data) {
            $this->_logChange('tz', $this->_tz, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tz = $data;

        } else if (!is_null($data)) {
            $this->_tz = (string) $data;

        } else {
            $this->_tz = $data;
        }
        return $this;
    }

    /**
     * Gets column tz
     *
     * @return string
     */
    public function getTz()
    {
        return $this->_tz;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setDeleteastVoicemail($data)
    {

        if ($this->_deleteastVoicemail != $data) {
            $this->_logChange('deleteastVoicemail', $this->_deleteastVoicemail, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_deleteastVoicemail = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_deleteastVoicemailAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for deleteastVoicemail'));
            }
            $this->_deleteastVoicemail = (string) $data;

        } else {
            $this->_deleteastVoicemail = $data;
        }
        return $this;
    }

    /**
     * Gets column deleteast_voicemail
     *
     * @return string
     */
    public function getDeleteastVoicemail()
    {
        return $this->_deleteastVoicemail;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setSaycid($data)
    {

        if ($this->_saycid != $data) {
            $this->_logChange('saycid', $this->_saycid, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_saycid = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_saycidAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for saycid'));
            }
            $this->_saycid = (string) $data;

        } else {
            $this->_saycid = $data;
        }
        return $this;
    }

    /**
     * Gets column saycid
     *
     * @return string
     */
    public function getSaycid()
    {
        return $this->_saycid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setSendastVoicemail($data)
    {

        if ($this->_sendastVoicemail != $data) {
            $this->_logChange('sendastVoicemail', $this->_sendastVoicemail, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sendastVoicemail = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_sendastVoicemailAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for sendastVoicemail'));
            }
            $this->_sendastVoicemail = (string) $data;

        } else {
            $this->_sendastVoicemail = $data;
        }
        return $this;
    }

    /**
     * Gets column sendast_voicemail
     *
     * @return string
     */
    public function getSendastVoicemail()
    {
        return $this->_sendastVoicemail;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setReview($data)
    {

        if ($this->_review != $data) {
            $this->_logChange('review', $this->_review, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_review = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_reviewAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for review'));
            }
            $this->_review = (string) $data;

        } else {
            $this->_review = $data;
        }
        return $this;
    }

    /**
     * Gets column review
     *
     * @return string
     */
    public function getReview()
    {
        return $this->_review;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setTempgreetwarn($data)
    {

        if ($this->_tempgreetwarn != $data) {
            $this->_logChange('tempgreetwarn', $this->_tempgreetwarn, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tempgreetwarn = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_tempgreetwarnAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for tempgreetwarn'));
            }
            $this->_tempgreetwarn = (string) $data;

        } else {
            $this->_tempgreetwarn = $data;
        }
        return $this;
    }

    /**
     * Gets column tempgreetwarn
     *
     * @return string
     */
    public function getTempgreetwarn()
    {
        return $this->_tempgreetwarn;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setOperator($data)
    {

        if ($this->_operator != $data) {
            $this->_logChange('operator', $this->_operator, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_operator = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_operatorAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for operator'));
            }
            $this->_operator = (string) $data;

        } else {
            $this->_operator = $data;
        }
        return $this;
    }

    /**
     * Gets column operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->_operator;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setEnvelope($data)
    {

        if ($this->_envelope != $data) {
            $this->_logChange('envelope', $this->_envelope, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_envelope = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_envelopeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for envelope'));
            }
            $this->_envelope = (string) $data;

        } else {
            $this->_envelope = $data;
        }
        return $this;
    }

    /**
     * Gets column envelope
     *
     * @return string
     */
    public function getEnvelope()
    {
        return $this->_envelope;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setSayduration($data)
    {

        if ($this->_sayduration != $data) {
            $this->_logChange('sayduration', $this->_sayduration, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sayduration = $data;

        } else if (!is_null($data)) {
            $this->_sayduration = (int) $data;

        } else {
            $this->_sayduration = $data;
        }
        return $this;
    }

    /**
     * Gets column sayduration
     *
     * @return int
     */
    public function getSayduration()
    {
        return $this->_sayduration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setForcename($data)
    {

        if ($this->_forcename != $data) {
            $this->_logChange('forcename', $this->_forcename, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_forcename = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_forcenameAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for forcename'));
            }
            $this->_forcename = (string) $data;

        } else {
            $this->_forcename = $data;
        }
        return $this;
    }

    /**
     * Gets column forcename
     *
     * @return string
     */
    public function getForcename()
    {
        return $this->_forcename;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setForcegreetings($data)
    {

        if ($this->_forcegreetings != $data) {
            $this->_logChange('forcegreetings', $this->_forcegreetings, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_forcegreetings = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_forcegreetingsAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for forcegreetings'));
            }
            $this->_forcegreetings = (string) $data;

        } else {
            $this->_forcegreetings = $data;
        }
        return $this;
    }

    /**
     * Gets column forcegreetings
     *
     * @return string
     */
    public function getForcegreetings()
    {
        return $this->_forcegreetings;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setCallback($data)
    {

        if ($this->_callback != $data) {
            $this->_logChange('callback', $this->_callback, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callback = $data;

        } else if (!is_null($data)) {
            $this->_callback = (string) $data;

        } else {
            $this->_callback = $data;
        }
        return $this;
    }

    /**
     * Gets column callback
     *
     * @return string
     */
    public function getCallback()
    {
        return $this->_callback;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setDialout($data)
    {

        if ($this->_dialout != $data) {
            $this->_logChange('dialout', $this->_dialout, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_dialout = $data;

        } else if (!is_null($data)) {
            $this->_dialout = (string) $data;

        } else {
            $this->_dialout = $data;
        }
        return $this;
    }

    /**
     * Gets column dialout
     *
     * @return string
     */
    public function getDialout()
    {
        return $this->_dialout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setExitcontext($data)
    {

        if ($this->_exitcontext != $data) {
            $this->_logChange('exitcontext', $this->_exitcontext, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_exitcontext = $data;

        } else if (!is_null($data)) {
            $this->_exitcontext = (string) $data;

        } else {
            $this->_exitcontext = $data;
        }
        return $this;
    }

    /**
     * Gets column exitcontext
     *
     * @return string
     */
    public function getExitcontext()
    {
        return $this->_exitcontext;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setMaxmsg($data)
    {

        if ($this->_maxmsg != $data) {
            $this->_logChange('maxmsg', $this->_maxmsg, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_maxmsg = $data;

        } else if (!is_null($data)) {
            $this->_maxmsg = (int) $data;

        } else {
            $this->_maxmsg = $data;
        }
        return $this;
    }

    /**
     * Gets column maxmsg
     *
     * @return int
     */
    public function getMaxmsg()
    {
        return $this->_maxmsg;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setVolgain($data)
    {

        if ($this->_volgain != $data) {
            $this->_logChange('volgain', $this->_volgain, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_volgain = $data;

        } else if (!is_null($data)) {
            $this->_volgain = (float) $data;

        } else {
            $this->_volgain = $data;
        }
        return $this;
    }

    /**
     * Gets column volgain
     *
     * @return float
     */
    public function getVolgain()
    {
        return $this->_volgain;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setImapuser($data)
    {

        if ($this->_imapuser != $data) {
            $this->_logChange('imapuser', $this->_imapuser, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_imapuser = $data;

        } else if (!is_null($data)) {
            $this->_imapuser = (string) $data;

        } else {
            $this->_imapuser = $data;
        }
        return $this;
    }

    /**
     * Gets column imapuser
     *
     * @return string
     */
    public function getImapuser()
    {
        return $this->_imapuser;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setImappassword($data)
    {

        if ($this->_imappassword != $data) {
            $this->_logChange('imappassword', $this->_imappassword, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_imappassword = $data;

        } else if (!is_null($data)) {
            $this->_imappassword = (string) $data;

        } else {
            $this->_imappassword = $data;
        }
        return $this;
    }

    /**
     * Gets column imappassword
     *
     * @return string
     */
    public function getImappassword()
    {
        return $this->_imappassword;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setImapserver($data)
    {

        if ($this->_imapserver != $data) {
            $this->_logChange('imapserver', $this->_imapserver, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_imapserver = $data;

        } else if (!is_null($data)) {
            $this->_imapserver = (string) $data;

        } else {
            $this->_imapserver = $data;
        }
        return $this;
    }

    /**
     * Gets column imapserver
     *
     * @return string
     */
    public function getImapserver()
    {
        return $this->_imapserver;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setImapport($data)
    {

        if ($this->_imapport != $data) {
            $this->_logChange('imapport', $this->_imapport, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_imapport = $data;

        } else if (!is_null($data)) {
            $this->_imapport = (string) $data;

        } else {
            $this->_imapport = $data;
        }
        return $this;
    }

    /**
     * Gets column imapport
     *
     * @return string
     */
    public function getImapport()
    {
        return $this->_imapport;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setImapflags($data)
    {

        if ($this->_imapflags != $data) {
            $this->_logChange('imapflags', $this->_imapflags, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_imapflags = $data;

        } else if (!is_null($data)) {
            $this->_imapflags = (string) $data;

        } else {
            $this->_imapflags = $data;
        }
        return $this;
    }

    /**
     * Gets column imapflags
     *
     * @return string
     */
    public function getImapflags()
    {
        return $this->_imapflags;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setStamp($data)
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

        if ($this->_stamp != $data) {
            $this->_logChange('stamp', $this->_stamp, $data);
        }

        $this->_stamp = $data;
        return $this;
    }

    /**
     * Gets column stamp
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getStamp($returnZendDate = false)
    {
        if (is_null($this->_stamp)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_stamp->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_stamp->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setUserId($data)
    {

        if ($this->_userId != $data) {
            $this->_logChange('userId', $this->_userId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_userId = $data;

        } else if (!is_null($data)) {
            $this->_userId = (int) $data;

        } else {
            $this->_userId = $data;
        }
        return $this;
    }

    /**
     * Gets column userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * Sets parent relation User
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\AstVoicemail
     */
    public function setUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_User = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setUserId($primaryKey);
        }

        $this->_setLoaded('AstVoicemailIbfk1');
        return $this;
    }

    /**
     * Gets parent User
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstVoicemailIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_User = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_User;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\AstVoicemail
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\AstVoicemail')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\AstVoicemail);

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
     * @return null | \IvozProvider\Model\Validator\AstVoicemail
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\AstVoicemail')) {

                $this->setValidator(new \IvozProvider\Validator\AstVoicemail);
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
     * @see \Mapper\Sql\AstVoicemail::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getUniqueid() === null) {
            $this->_logger->log('The value for Uniqueid cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'uniqueid = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getUniqueid())
        );
    }

    public function mustUpdateEtag()
    {
        return true;
    }

}