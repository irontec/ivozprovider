<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * VoicemailAbstract
 * @codeCoverageIgnore
 */
abstract class VoicemailAbstract
{
    /**
     * @var string
     */
    protected $context;

    /**
     * @var string
     */
    protected $mailbox;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $fullname;

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $pager;

    /**
     * @var string
     */
    protected $attach;

    /**
     * @var string
     */
    protected $attachfmt;

    /**
     * @var string
     */
    protected $serveremail;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $tz;

    /**
     * @column deleteast_voicemail
     * @var string
     */
    protected $deleteVoicemail;

    /**
     * @var string
     */
    protected $saycid;

    /**
     * @column sendast_voicemail
     * @var string
     */
    protected $sendVoicemail;

    /**
     * @var string
     */
    protected $review;

    /**
     * @var string
     */
    protected $tempgreetwarn;

    /**
     * @var string
     */
    protected $operator;

    /**
     * @var string
     */
    protected $envelope;

    /**
     * @var integer
     */
    protected $sayduration;

    /**
     * @var string
     */
    protected $forcename;

    /**
     * @var string
     */
    protected $forcegreetings;

    /**
     * @var string
     */
    protected $callback;

    /**
     * @var string
     */
    protected $dialout;

    /**
     * @var string
     */
    protected $exitcontext;

    /**
     * @var integer
     */
    protected $maxmsg;

    /**
     * @var string
     */
    protected $volgain;

    /**
     * @var string
     */
    protected $imapuser;

    /**
     * @var string
     */
    protected $imappassword;

    /**
     * @var string
     */
    protected $imapserver;

    /**
     * @var string
     */
    protected $imapport;

    /**
     * @var string
     */
    protected $imapflags;

    /**
     * @var \DateTime
     */
    protected $stamp;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $user;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($context, $mailbox)
    {
        $this->setContext($context);
        $this->setMailbox($mailbox);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return VoicemailDTO
     */
    public static function createDTO()
    {
        return new VoicemailDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto VoicemailDTO
         */
        Assertion::isInstanceOf($dto, VoicemailDTO::class);

        $self = new static(
            $dto->getContext(),
            $dto->getMailbox());

        return $self
            ->setPassword($dto->getPassword())
            ->setFullname($dto->getFullname())
            ->setAlias($dto->getAlias())
            ->setEmail($dto->getEmail())
            ->setPager($dto->getPager())
            ->setAttach($dto->getAttach())
            ->setAttachfmt($dto->getAttachfmt())
            ->setServeremail($dto->getServeremail())
            ->setLanguage($dto->getLanguage())
            ->setTz($dto->getTz())
            ->setDeleteVoicemail($dto->getDeleteVoicemail())
            ->setSaycid($dto->getSaycid())
            ->setSendVoicemail($dto->getSendVoicemail())
            ->setReview($dto->getReview())
            ->setTempgreetwarn($dto->getTempgreetwarn())
            ->setOperator($dto->getOperator())
            ->setEnvelope($dto->getEnvelope())
            ->setSayduration($dto->getSayduration())
            ->setForcename($dto->getForcename())
            ->setForcegreetings($dto->getForcegreetings())
            ->setCallback($dto->getCallback())
            ->setDialout($dto->getDialout())
            ->setExitcontext($dto->getExitcontext())
            ->setMaxmsg($dto->getMaxmsg())
            ->setVolgain($dto->getVolgain())
            ->setImapuser($dto->getImapuser())
            ->setImappassword($dto->getImappassword())
            ->setImapserver($dto->getImapserver())
            ->setImapport($dto->getImapport())
            ->setImapflags($dto->getImapflags())
            ->setStamp($dto->getStamp())
            ->setUser($dto->getUser())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto VoicemailDTO
         */
        Assertion::isInstanceOf($dto, VoicemailDTO::class);

        $this
            ->setContext($dto->getContext())
            ->setMailbox($dto->getMailbox())
            ->setPassword($dto->getPassword())
            ->setFullname($dto->getFullname())
            ->setAlias($dto->getAlias())
            ->setEmail($dto->getEmail())
            ->setPager($dto->getPager())
            ->setAttach($dto->getAttach())
            ->setAttachfmt($dto->getAttachfmt())
            ->setServeremail($dto->getServeremail())
            ->setLanguage($dto->getLanguage())
            ->setTz($dto->getTz())
            ->setDeleteVoicemail($dto->getDeleteVoicemail())
            ->setSaycid($dto->getSaycid())
            ->setSendVoicemail($dto->getSendVoicemail())
            ->setReview($dto->getReview())
            ->setTempgreetwarn($dto->getTempgreetwarn())
            ->setOperator($dto->getOperator())
            ->setEnvelope($dto->getEnvelope())
            ->setSayduration($dto->getSayduration())
            ->setForcename($dto->getForcename())
            ->setForcegreetings($dto->getForcegreetings())
            ->setCallback($dto->getCallback())
            ->setDialout($dto->getDialout())
            ->setExitcontext($dto->getExitcontext())
            ->setMaxmsg($dto->getMaxmsg())
            ->setVolgain($dto->getVolgain())
            ->setImapuser($dto->getImapuser())
            ->setImappassword($dto->getImappassword())
            ->setImapserver($dto->getImapserver())
            ->setImapport($dto->getImapport())
            ->setImapflags($dto->getImapflags())
            ->setStamp($dto->getStamp())
            ->setUser($dto->getUser());


        return $this;
    }

    /**
     * @return VoicemailDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setContext($this->getContext())
            ->setMailbox($this->getMailbox())
            ->setPassword($this->getPassword())
            ->setFullname($this->getFullname())
            ->setAlias($this->getAlias())
            ->setEmail($this->getEmail())
            ->setPager($this->getPager())
            ->setAttach($this->getAttach())
            ->setAttachfmt($this->getAttachfmt())
            ->setServeremail($this->getServeremail())
            ->setLanguage($this->getLanguage())
            ->setTz($this->getTz())
            ->setDeleteVoicemail($this->getDeleteVoicemail())
            ->setSaycid($this->getSaycid())
            ->setSendVoicemail($this->getSendVoicemail())
            ->setReview($this->getReview())
            ->setTempgreetwarn($this->getTempgreetwarn())
            ->setOperator($this->getOperator())
            ->setEnvelope($this->getEnvelope())
            ->setSayduration($this->getSayduration())
            ->setForcename($this->getForcename())
            ->setForcegreetings($this->getForcegreetings())
            ->setCallback($this->getCallback())
            ->setDialout($this->getDialout())
            ->setExitcontext($this->getExitcontext())
            ->setMaxmsg($this->getMaxmsg())
            ->setVolgain($this->getVolgain())
            ->setImapuser($this->getImapuser())
            ->setImappassword($this->getImappassword())
            ->setImapserver($this->getImapserver())
            ->setImapport($this->getImapport())
            ->setImapflags($this->getImapflags())
            ->setStamp($this->getStamp())
            ->setUserId($this->getUser() ? $this->getUser()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'context' => self::getContext(),
            'mailbox' => self::getMailbox(),
            'password' => self::getPassword(),
            'fullname' => self::getFullname(),
            'alias' => self::getAlias(),
            'email' => self::getEmail(),
            'pager' => self::getPager(),
            'attach' => self::getAttach(),
            'attachfmt' => self::getAttachfmt(),
            'serveremail' => self::getServeremail(),
            'language' => self::getLanguage(),
            'tz' => self::getTz(),
            'deleteast_voicemail' => self::getDeleteVoicemail(),
            'saycid' => self::getSaycid(),
            'sendast_voicemail' => self::getSendVoicemail(),
            'review' => self::getReview(),
            'tempgreetwarn' => self::getTempgreetwarn(),
            'operator' => self::getOperator(),
            'envelope' => self::getEnvelope(),
            'sayduration' => self::getSayduration(),
            'forcename' => self::getForcename(),
            'forcegreetings' => self::getForcegreetings(),
            'callback' => self::getCallback(),
            'dialout' => self::getDialout(),
            'exitcontext' => self::getExitcontext(),
            'maxmsg' => self::getMaxmsg(),
            'volgain' => self::getVolgain(),
            'imapuser' => self::getImapuser(),
            'imappassword' => self::getImappassword(),
            'imapserver' => self::getImapserver(),
            'imapport' => self::getImapport(),
            'imapflags' => self::getImapflags(),
            'stamp' => self::getStamp(),
            'userId' => self::getUser() ? self::getUser()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set context
     *
     * @param string $context
     *
     * @return self
     */
    public function setContext($context)
    {
        Assertion::notNull($context, 'context value "%s" is null, but non null value was expected.');
        Assertion::maxLength($context, 80, 'context value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set mailbox
     *
     * @param string $mailbox
     *
     * @return self
     */
    public function setMailbox($mailbox)
    {
        Assertion::notNull($mailbox, 'mailbox value "%s" is null, but non null value was expected.');
        Assertion::maxLength($mailbox, 80, 'mailbox value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->mailbox = $mailbox;

        return $this;
    }

    /**
     * Get mailbox
     *
     * @return string
     */
    public function getMailbox()
    {
        return $this->mailbox;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword($password = null)
    {
        if (!is_null($password)) {
            Assertion::maxLength($password, 80, 'password value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     *
     * @return self
     */
    public function setFullname($fullname = null)
    {
        if (!is_null($fullname)) {
            Assertion::maxLength($fullname, 80, 'fullname value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return self
     */
    public function setAlias($alias = null)
    {
        if (!is_null($alias)) {
            Assertion::maxLength($alias, 80, 'alias value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email = null)
    {
        if (!is_null($email)) {
            Assertion::maxLength($email, 80, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set pager
     *
     * @param string $pager
     *
     * @return self
     */
    public function setPager($pager = null)
    {
        if (!is_null($pager)) {
            Assertion::maxLength($pager, 80, 'pager value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->pager = $pager;

        return $this;
    }

    /**
     * Get pager
     *
     * @return string
     */
    public function getPager()
    {
        return $this->pager;
    }

    /**
     * Set attach
     *
     * @param string $attach
     *
     * @return self
     */
    public function setAttach($attach = null)
    {
        if (!is_null($attach)) {
        }

        $this->attach = $attach;

        return $this;
    }

    /**
     * Get attach
     *
     * @return string
     */
    public function getAttach()
    {
        return $this->attach;
    }

    /**
     * Set attachfmt
     *
     * @param string $attachfmt
     *
     * @return self
     */
    public function setAttachfmt($attachfmt = null)
    {
        if (!is_null($attachfmt)) {
            Assertion::maxLength($attachfmt, 10, 'attachfmt value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->attachfmt = $attachfmt;

        return $this;
    }

    /**
     * Get attachfmt
     *
     * @return string
     */
    public function getAttachfmt()
    {
        return $this->attachfmt;
    }

    /**
     * Set serveremail
     *
     * @param string $serveremail
     *
     * @return self
     */
    public function setServeremail($serveremail = null)
    {
        if (!is_null($serveremail)) {
            Assertion::maxLength($serveremail, 80, 'serveremail value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->serveremail = $serveremail;

        return $this;
    }

    /**
     * Get serveremail
     *
     * @return string
     */
    public function getServeremail()
    {
        return $this->serveremail;
    }

    /**
     * Set language
     *
     * @param string $language
     *
     * @return self
     */
    public function setLanguage($language = null)
    {
        if (!is_null($language)) {
            Assertion::maxLength($language, 20, 'language value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set tz
     *
     * @param string $tz
     *
     * @return self
     */
    public function setTz($tz = null)
    {
        if (!is_null($tz)) {
            Assertion::maxLength($tz, 30, 'tz value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tz = $tz;

        return $this;
    }

    /**
     * Get tz
     *
     * @return string
     */
    public function getTz()
    {
        return $this->tz;
    }

    /**
     * Set deleteVoicemail
     *
     * @param string $deleteVoicemail
     *
     * @return self
     */
    public function setDeleteVoicemail($deleteVoicemail = null)
    {
        if (!is_null($deleteVoicemail)) {
        }

        $this->deleteVoicemail = $deleteVoicemail;

        return $this;
    }

    /**
     * Get deleteVoicemail
     *
     * @return string
     */
    public function getDeleteVoicemail()
    {
        return $this->deleteVoicemail;
    }

    /**
     * Set saycid
     *
     * @param string $saycid
     *
     * @return self
     */
    public function setSaycid($saycid = null)
    {
        if (!is_null($saycid)) {
        }

        $this->saycid = $saycid;

        return $this;
    }

    /**
     * Get saycid
     *
     * @return string
     */
    public function getSaycid()
    {
        return $this->saycid;
    }

    /**
     * Set sendVoicemail
     *
     * @param string $sendVoicemail
     *
     * @return self
     */
    public function setSendVoicemail($sendVoicemail = null)
    {
        if (!is_null($sendVoicemail)) {
        }

        $this->sendVoicemail = $sendVoicemail;

        return $this;
    }

    /**
     * Get sendVoicemail
     *
     * @return string
     */
    public function getSendVoicemail()
    {
        return $this->sendVoicemail;
    }

    /**
     * Set review
     *
     * @param string $review
     *
     * @return self
     */
    public function setReview($review = null)
    {
        if (!is_null($review)) {
        }

        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set tempgreetwarn
     *
     * @param string $tempgreetwarn
     *
     * @return self
     */
    public function setTempgreetwarn($tempgreetwarn = null)
    {
        if (!is_null($tempgreetwarn)) {
        }

        $this->tempgreetwarn = $tempgreetwarn;

        return $this;
    }

    /**
     * Get tempgreetwarn
     *
     * @return string
     */
    public function getTempgreetwarn()
    {
        return $this->tempgreetwarn;
    }

    /**
     * Set operator
     *
     * @param string $operator
     *
     * @return self
     */
    public function setOperator($operator = null)
    {
        if (!is_null($operator)) {
        }

        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set envelope
     *
     * @param string $envelope
     *
     * @return self
     */
    public function setEnvelope($envelope = null)
    {
        if (!is_null($envelope)) {
        }

        $this->envelope = $envelope;

        return $this;
    }

    /**
     * Get envelope
     *
     * @return string
     */
    public function getEnvelope()
    {
        return $this->envelope;
    }

    /**
     * Set sayduration
     *
     * @param integer $sayduration
     *
     * @return self
     */
    public function setSayduration($sayduration = null)
    {
        if (!is_null($sayduration)) {
            if (!is_null($sayduration)) {
                Assertion::integerish($sayduration, 'sayduration value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->sayduration = $sayduration;

        return $this;
    }

    /**
     * Get sayduration
     *
     * @return integer
     */
    public function getSayduration()
    {
        return $this->sayduration;
    }

    /**
     * Set forcename
     *
     * @param string $forcename
     *
     * @return self
     */
    public function setForcename($forcename = null)
    {
        if (!is_null($forcename)) {
        }

        $this->forcename = $forcename;

        return $this;
    }

    /**
     * Get forcename
     *
     * @return string
     */
    public function getForcename()
    {
        return $this->forcename;
    }

    /**
     * Set forcegreetings
     *
     * @param string $forcegreetings
     *
     * @return self
     */
    public function setForcegreetings($forcegreetings = null)
    {
        if (!is_null($forcegreetings)) {
        }

        $this->forcegreetings = $forcegreetings;

        return $this;
    }

    /**
     * Get forcegreetings
     *
     * @return string
     */
    public function getForcegreetings()
    {
        return $this->forcegreetings;
    }

    /**
     * Set callback
     *
     * @param string $callback
     *
     * @return self
     */
    public function setCallback($callback = null)
    {
        if (!is_null($callback)) {
            Assertion::maxLength($callback, 80, 'callback value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callback = $callback;

        return $this;
    }

    /**
     * Get callback
     *
     * @return string
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Set dialout
     *
     * @param string $dialout
     *
     * @return self
     */
    public function setDialout($dialout = null)
    {
        if (!is_null($dialout)) {
            Assertion::maxLength($dialout, 80, 'dialout value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->dialout = $dialout;

        return $this;
    }

    /**
     * Get dialout
     *
     * @return string
     */
    public function getDialout()
    {
        return $this->dialout;
    }

    /**
     * Set exitcontext
     *
     * @param string $exitcontext
     *
     * @return self
     */
    public function setExitcontext($exitcontext = null)
    {
        if (!is_null($exitcontext)) {
            Assertion::maxLength($exitcontext, 80, 'exitcontext value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->exitcontext = $exitcontext;

        return $this;
    }

    /**
     * Get exitcontext
     *
     * @return string
     */
    public function getExitcontext()
    {
        return $this->exitcontext;
    }

    /**
     * Set maxmsg
     *
     * @param integer $maxmsg
     *
     * @return self
     */
    public function setMaxmsg($maxmsg = null)
    {
        if (!is_null($maxmsg)) {
            if (!is_null($maxmsg)) {
                Assertion::integerish($maxmsg, 'maxmsg value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->maxmsg = $maxmsg;

        return $this;
    }

    /**
     * Get maxmsg
     *
     * @return integer
     */
    public function getMaxmsg()
    {
        return $this->maxmsg;
    }

    /**
     * Set volgain
     *
     * @param string $volgain
     *
     * @return self
     */
    public function setVolgain($volgain = null)
    {
        if (!is_null($volgain)) {
            if (!is_null($volgain)) {
                Assertion::numeric($volgain);
            }
        }

        $this->volgain = $volgain;

        return $this;
    }

    /**
     * Get volgain
     *
     * @return string
     */
    public function getVolgain()
    {
        return $this->volgain;
    }

    /**
     * Set imapuser
     *
     * @param string $imapuser
     *
     * @return self
     */
    public function setImapuser($imapuser = null)
    {
        if (!is_null($imapuser)) {
            Assertion::maxLength($imapuser, 80, 'imapuser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->imapuser = $imapuser;

        return $this;
    }

    /**
     * Get imapuser
     *
     * @return string
     */
    public function getImapuser()
    {
        return $this->imapuser;
    }

    /**
     * Set imappassword
     *
     * @param string $imappassword
     *
     * @return self
     */
    public function setImappassword($imappassword = null)
    {
        if (!is_null($imappassword)) {
            Assertion::maxLength($imappassword, 80, 'imappassword value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->imappassword = $imappassword;

        return $this;
    }

    /**
     * Get imappassword
     *
     * @return string
     */
    public function getImappassword()
    {
        return $this->imappassword;
    }

    /**
     * Set imapserver
     *
     * @param string $imapserver
     *
     * @return self
     */
    public function setImapserver($imapserver = null)
    {
        if (!is_null($imapserver)) {
            Assertion::maxLength($imapserver, 80, 'imapserver value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->imapserver = $imapserver;

        return $this;
    }

    /**
     * Get imapserver
     *
     * @return string
     */
    public function getImapserver()
    {
        return $this->imapserver;
    }

    /**
     * Set imapport
     *
     * @param string $imapport
     *
     * @return self
     */
    public function setImapport($imapport = null)
    {
        if (!is_null($imapport)) {
            Assertion::maxLength($imapport, 8, 'imapport value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->imapport = $imapport;

        return $this;
    }

    /**
     * Get imapport
     *
     * @return string
     */
    public function getImapport()
    {
        return $this->imapport;
    }

    /**
     * Set imapflags
     *
     * @param string $imapflags
     *
     * @return self
     */
    public function setImapflags($imapflags = null)
    {
        if (!is_null($imapflags)) {
            Assertion::maxLength($imapflags, 80, 'imapflags value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->imapflags = $imapflags;

        return $this;
    }

    /**
     * Get imapflags
     *
     * @return string
     */
    public function getImapflags()
    {
        return $this->imapflags;
    }

    /**
     * Set stamp
     *
     * @param \DateTime $stamp
     *
     * @return self
     */
    public function setStamp($stamp = null)
    {
        if (!is_null($stamp)) {
        $stamp = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $stamp,
            null
        );
        }

        $this->stamp = $stamp;

        return $this;
    }

    /**
     * Get stamp
     *
     * @return \DateTime
     */
    public function getStamp()
    {
        return $this->stamp;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return self
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }



    // @codeCoverageIgnoreEnd
}

