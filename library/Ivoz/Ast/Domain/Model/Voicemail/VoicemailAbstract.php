<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * column: deleteast_voicemail
     * @var string
     */
    protected $deleteVoicemail;

    /**
     * @var string
     */
    protected $saycid;

    /**
     * column: sendast_voicemail
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
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface
     */
    protected $residentialDevice;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($context, $mailbox)
    {
        $this->setContext($context);
        $this->setMailbox($mailbox);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "Voicemail",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return VoicemailDto
     */
    public static function createDto($id = null)
    {
        return new VoicemailDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return VoicemailDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, VoicemailInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto VoicemailDto
         */
        Assertion::isInstanceOf($dto, VoicemailDto::class);

        $self = new static(
            $dto->getContext(),
            $dto->getMailbox());

        $self
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
            ->setResidentialDevice($dto->getResidentialDevice())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto VoicemailDto
         */
        Assertion::isInstanceOf($dto, VoicemailDto::class);

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
            ->setUser($dto->getUser())
            ->setResidentialDevice($dto->getResidentialDevice());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return VoicemailDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setContext(self::getContext())
            ->setMailbox(self::getMailbox())
            ->setPassword(self::getPassword())
            ->setFullname(self::getFullname())
            ->setAlias(self::getAlias())
            ->setEmail(self::getEmail())
            ->setPager(self::getPager())
            ->setAttach(self::getAttach())
            ->setAttachfmt(self::getAttachfmt())
            ->setServeremail(self::getServeremail())
            ->setLanguage(self::getLanguage())
            ->setTz(self::getTz())
            ->setDeleteVoicemail(self::getDeleteVoicemail())
            ->setSaycid(self::getSaycid())
            ->setSendVoicemail(self::getSendVoicemail())
            ->setReview(self::getReview())
            ->setTempgreetwarn(self::getTempgreetwarn())
            ->setOperator(self::getOperator())
            ->setEnvelope(self::getEnvelope())
            ->setSayduration(self::getSayduration())
            ->setForcename(self::getForcename())
            ->setForcegreetings(self::getForcegreetings())
            ->setCallback(self::getCallback())
            ->setDialout(self::getDialout())
            ->setExitcontext(self::getExitcontext())
            ->setMaxmsg(self::getMaxmsg())
            ->setVolgain(self::getVolgain())
            ->setImapuser(self::getImapuser())
            ->setImappassword(self::getImappassword())
            ->setImapserver(self::getImapserver())
            ->setImapport(self::getImapport())
            ->setImapflags(self::getImapflags())
            ->setStamp(self::getStamp())
            ->setUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getUser(), $depth))
            ->setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth));
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
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'residentialDeviceId' => self::getResidentialDevice() ? self::getResidentialDevice()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
                $volgain = (float) $volgain;
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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

    /**
     * Set residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     *
     * @return self
     */
    public function setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice = null)
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface
     */
    public function getResidentialDevice()
    {
        return $this->residentialDevice;
    }



    // @codeCoverageIgnoreEnd
}

