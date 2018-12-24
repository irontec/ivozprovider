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
     * @var string | null
     */
    protected $password;

    /**
     * @var string | null
     */
    protected $fullname;

    /**
     * @var string | null
     */
    protected $alias;

    /**
     * @var string | null
     */
    protected $email;

    /**
     * @var string | null
     */
    protected $pager;

    /**
     * @var string | null
     */
    protected $attach;

    /**
     * @var string | null
     */
    protected $attachfmt;

    /**
     * @var string | null
     */
    protected $serveremail;

    /**
     * @var string | null
     */
    protected $language;

    /**
     * @var string | null
     */
    protected $tz;

    /**
     * column: deleteast_voicemail
     * @var string | null
     */
    protected $deleteVoicemail;

    /**
     * @var string | null
     */
    protected $saycid = 'yes';

    /**
     * column: sendast_voicemail
     * @var string | null
     */
    protected $sendVoicemail;

    /**
     * @var string | null
     */
    protected $review;

    /**
     * @var string | null
     */
    protected $tempgreetwarn;

    /**
     * @var string | null
     */
    protected $operator;

    /**
     * @var string | null
     */
    protected $envelope;

    /**
     * @var integer | null
     */
    protected $sayduration;

    /**
     * @var string | null
     */
    protected $forcename;

    /**
     * @var string | null
     */
    protected $forcegreetings;

    /**
     * @var string | null
     */
    protected $callback;

    /**
     * @var string | null
     */
    protected $dialout;

    /**
     * @var string | null
     */
    protected $exitcontext;

    /**
     * @var integer | null
     */
    protected $maxmsg;

    /**
     * @var string | null
     */
    protected $volgain;

    /**
     * @var string | null
     */
    protected $imapuser;

    /**
     * @var string | null
     */
    protected $imappassword;

    /**
     * @var string | null
     */
    protected $imapserver;

    /**
     * @var string | null
     */
    protected $imapport;

    /**
     * @var string | null
     */
    protected $imapflags;

    /**
     * @var \DateTime | null
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
        return sprintf(
            "%s#%s",
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
     * @internal use EntityTools instead
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
     * @internal use EntityTools instead
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
            $dto->getMailbox()
        );

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
     * @internal use EntityTools instead
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
     * @internal use EntityTools instead
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
     * Set context
     *
     * @param string $context
     *
     * @return self
     */
    protected function setContext($context)
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
    protected function setMailbox($mailbox)
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
    protected function setPassword($password = null)
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
     * @return string | null
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
    protected function setFullname($fullname = null)
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
     * @return string | null
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
    protected function setAlias($alias = null)
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
     * @return string | null
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
    protected function setEmail($email = null)
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
     * @return string | null
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
    protected function setPager($pager = null)
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
     * @return string | null
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
    protected function setAttach($attach = null)
    {
        if (!is_null($attach)) {
        }

        $this->attach = $attach;

        return $this;
    }

    /**
     * Get attach
     *
     * @return string | null
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
    protected function setAttachfmt($attachfmt = null)
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
     * @return string | null
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
    protected function setServeremail($serveremail = null)
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
     * @return string | null
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
    protected function setLanguage($language = null)
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
     * @return string | null
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
    protected function setTz($tz = null)
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
     * @return string | null
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
    protected function setDeleteVoicemail($deleteVoicemail = null)
    {
        if (!is_null($deleteVoicemail)) {
        }

        $this->deleteVoicemail = $deleteVoicemail;

        return $this;
    }

    /**
     * Get deleteVoicemail
     *
     * @return string | null
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
    protected function setSaycid($saycid = null)
    {
        if (!is_null($saycid)) {
        }

        $this->saycid = $saycid;

        return $this;
    }

    /**
     * Get saycid
     *
     * @return string | null
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
    protected function setSendVoicemail($sendVoicemail = null)
    {
        if (!is_null($sendVoicemail)) {
        }

        $this->sendVoicemail = $sendVoicemail;

        return $this;
    }

    /**
     * Get sendVoicemail
     *
     * @return string | null
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
    protected function setReview($review = null)
    {
        if (!is_null($review)) {
        }

        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string | null
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
    protected function setTempgreetwarn($tempgreetwarn = null)
    {
        if (!is_null($tempgreetwarn)) {
        }

        $this->tempgreetwarn = $tempgreetwarn;

        return $this;
    }

    /**
     * Get tempgreetwarn
     *
     * @return string | null
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
    protected function setOperator($operator = null)
    {
        if (!is_null($operator)) {
        }

        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return string | null
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
    protected function setEnvelope($envelope = null)
    {
        if (!is_null($envelope)) {
        }

        $this->envelope = $envelope;

        return $this;
    }

    /**
     * Get envelope
     *
     * @return string | null
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
    protected function setSayduration($sayduration = null)
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
     * @return integer | null
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
    protected function setForcename($forcename = null)
    {
        if (!is_null($forcename)) {
        }

        $this->forcename = $forcename;

        return $this;
    }

    /**
     * Get forcename
     *
     * @return string | null
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
    protected function setForcegreetings($forcegreetings = null)
    {
        if (!is_null($forcegreetings)) {
        }

        $this->forcegreetings = $forcegreetings;

        return $this;
    }

    /**
     * Get forcegreetings
     *
     * @return string | null
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
    protected function setCallback($callback = null)
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
     * @return string | null
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
    protected function setDialout($dialout = null)
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
     * @return string | null
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
    protected function setExitcontext($exitcontext = null)
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
     * @return string | null
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
    protected function setMaxmsg($maxmsg = null)
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
     * @return integer | null
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
    protected function setVolgain($volgain = null)
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
     * @return string | null
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
    protected function setImapuser($imapuser = null)
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
     * @return string | null
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
    protected function setImappassword($imappassword = null)
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
     * @return string | null
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
    protected function setImapserver($imapserver = null)
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
     * @return string | null
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
    protected function setImapport($imapport = null)
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
     * @return string | null
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
    protected function setImapflags($imapflags = null)
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
     * @return string | null
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
    protected function setStamp($stamp = null)
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
     * @return \DateTime | null
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
