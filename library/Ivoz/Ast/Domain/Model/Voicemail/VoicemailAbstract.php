<?php
declare(strict_types = 1);

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;

/**
* VoicemailAbstract
* @codeCoverageIgnore
*/
abstract class VoicemailAbstract
{
    use ChangelogTrait;

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
     * @var int | null
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
     * @var int | null
     */
    protected $maxmsg;

    /**
     * @var float | null
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
     * @var \DateTimeInterface | null
     */
    protected $stamp;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var ResidentialDeviceInterface
     */
    protected $residentialDevice;

    /**
     * Constructor
     */
    protected function __construct(
        $context,
        $mailbox
    ) {
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
     * @param VoicemailInterface|null $entity
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

        /** @var VoicemailDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param VoicemailDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param VoicemailDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()));

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
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setResidentialDevice(ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth));
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

    /**
     * Set context
     *
     * @param string $context
     *
     * @return static
     */
    protected function setContext(string $context): VoicemailInterface
    {
        Assertion::maxLength($context, 80, 'context value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext(): string
    {
        return $this->context;
    }

    /**
     * Set mailbox
     *
     * @param string $mailbox
     *
     * @return static
     */
    protected function setMailbox(string $mailbox): VoicemailInterface
    {
        Assertion::maxLength($mailbox, 80, 'mailbox value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->mailbox = $mailbox;

        return $this;
    }

    /**
     * Get mailbox
     *
     * @return string
     */
    public function getMailbox(): string
    {
        return $this->mailbox;
    }

    /**
     * Set password
     *
     * @param string $password | null
     *
     * @return static
     */
    protected function setPassword(?string $password = null): VoicemailInterface
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
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set fullname
     *
     * @param string $fullname | null
     *
     * @return static
     */
    protected function setFullname(?string $fullname = null): VoicemailInterface
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
    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    /**
     * Set alias
     *
     * @param string $alias | null
     *
     * @return static
     */
    protected function setAlias(?string $alias = null): VoicemailInterface
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
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * Set email
     *
     * @param string $email | null
     *
     * @return static
     */
    protected function setEmail(?string $email = null): VoicemailInterface
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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set pager
     *
     * @param string $pager | null
     *
     * @return static
     */
    protected function setPager(?string $pager = null): VoicemailInterface
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
    public function getPager(): ?string
    {
        return $this->pager;
    }

    /**
     * Set attach
     *
     * @param string $attach | null
     *
     * @return static
     */
    protected function setAttach(?string $attach = null): VoicemailInterface
    {
        $this->attach = $attach;

        return $this;
    }

    /**
     * Get attach
     *
     * @return string | null
     */
    public function getAttach(): ?string
    {
        return $this->attach;
    }

    /**
     * Set attachfmt
     *
     * @param string $attachfmt | null
     *
     * @return static
     */
    protected function setAttachfmt(?string $attachfmt = null): VoicemailInterface
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
    public function getAttachfmt(): ?string
    {
        return $this->attachfmt;
    }

    /**
     * Set serveremail
     *
     * @param string $serveremail | null
     *
     * @return static
     */
    protected function setServeremail(?string $serveremail = null): VoicemailInterface
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
    public function getServeremail(): ?string
    {
        return $this->serveremail;
    }

    /**
     * Set language
     *
     * @param string $language | null
     *
     * @return static
     */
    protected function setLanguage(?string $language = null): VoicemailInterface
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
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * Set tz
     *
     * @param string $tz | null
     *
     * @return static
     */
    protected function setTz(?string $tz = null): VoicemailInterface
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
    public function getTz(): ?string
    {
        return $this->tz;
    }

    /**
     * Set deleteVoicemail
     *
     * @param string $deleteVoicemail | null
     *
     * @return static
     */
    protected function setDeleteVoicemail(?string $deleteVoicemail = null): VoicemailInterface
    {
        $this->deleteVoicemail = $deleteVoicemail;

        return $this;
    }

    /**
     * Get deleteVoicemail
     *
     * @return string | null
     */
    public function getDeleteVoicemail(): ?string
    {
        return $this->deleteVoicemail;
    }

    /**
     * Set saycid
     *
     * @param string $saycid | null
     *
     * @return static
     */
    protected function setSaycid(?string $saycid = null): VoicemailInterface
    {
        $this->saycid = $saycid;

        return $this;
    }

    /**
     * Get saycid
     *
     * @return string | null
     */
    public function getSaycid(): ?string
    {
        return $this->saycid;
    }

    /**
     * Set sendVoicemail
     *
     * @param string $sendVoicemail | null
     *
     * @return static
     */
    protected function setSendVoicemail(?string $sendVoicemail = null): VoicemailInterface
    {
        $this->sendVoicemail = $sendVoicemail;

        return $this;
    }

    /**
     * Get sendVoicemail
     *
     * @return string | null
     */
    public function getSendVoicemail(): ?string
    {
        return $this->sendVoicemail;
    }

    /**
     * Set review
     *
     * @param string $review | null
     *
     * @return static
     */
    protected function setReview(?string $review = null): VoicemailInterface
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string | null
     */
    public function getReview(): ?string
    {
        return $this->review;
    }

    /**
     * Set tempgreetwarn
     *
     * @param string $tempgreetwarn | null
     *
     * @return static
     */
    protected function setTempgreetwarn(?string $tempgreetwarn = null): VoicemailInterface
    {
        $this->tempgreetwarn = $tempgreetwarn;

        return $this;
    }

    /**
     * Get tempgreetwarn
     *
     * @return string | null
     */
    public function getTempgreetwarn(): ?string
    {
        return $this->tempgreetwarn;
    }

    /**
     * Set operator
     *
     * @param string $operator | null
     *
     * @return static
     */
    protected function setOperator(?string $operator = null): VoicemailInterface
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return string | null
     */
    public function getOperator(): ?string
    {
        return $this->operator;
    }

    /**
     * Set envelope
     *
     * @param string $envelope | null
     *
     * @return static
     */
    protected function setEnvelope(?string $envelope = null): VoicemailInterface
    {
        $this->envelope = $envelope;

        return $this;
    }

    /**
     * Get envelope
     *
     * @return string | null
     */
    public function getEnvelope(): ?string
    {
        return $this->envelope;
    }

    /**
     * Set sayduration
     *
     * @param int $sayduration | null
     *
     * @return static
     */
    protected function setSayduration(?int $sayduration = null): VoicemailInterface
    {
        $this->sayduration = $sayduration;

        return $this;
    }

    /**
     * Get sayduration
     *
     * @return int | null
     */
    public function getSayduration(): ?int
    {
        return $this->sayduration;
    }

    /**
     * Set forcename
     *
     * @param string $forcename | null
     *
     * @return static
     */
    protected function setForcename(?string $forcename = null): VoicemailInterface
    {
        $this->forcename = $forcename;

        return $this;
    }

    /**
     * Get forcename
     *
     * @return string | null
     */
    public function getForcename(): ?string
    {
        return $this->forcename;
    }

    /**
     * Set forcegreetings
     *
     * @param string $forcegreetings | null
     *
     * @return static
     */
    protected function setForcegreetings(?string $forcegreetings = null): VoicemailInterface
    {
        $this->forcegreetings = $forcegreetings;

        return $this;
    }

    /**
     * Get forcegreetings
     *
     * @return string | null
     */
    public function getForcegreetings(): ?string
    {
        return $this->forcegreetings;
    }

    /**
     * Set callback
     *
     * @param string $callback | null
     *
     * @return static
     */
    protected function setCallback(?string $callback = null): VoicemailInterface
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
    public function getCallback(): ?string
    {
        return $this->callback;
    }

    /**
     * Set dialout
     *
     * @param string $dialout | null
     *
     * @return static
     */
    protected function setDialout(?string $dialout = null): VoicemailInterface
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
    public function getDialout(): ?string
    {
        return $this->dialout;
    }

    /**
     * Set exitcontext
     *
     * @param string $exitcontext | null
     *
     * @return static
     */
    protected function setExitcontext(?string $exitcontext = null): VoicemailInterface
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
    public function getExitcontext(): ?string
    {
        return $this->exitcontext;
    }

    /**
     * Set maxmsg
     *
     * @param int $maxmsg | null
     *
     * @return static
     */
    protected function setMaxmsg(?int $maxmsg = null): VoicemailInterface
    {
        $this->maxmsg = $maxmsg;

        return $this;
    }

    /**
     * Get maxmsg
     *
     * @return int | null
     */
    public function getMaxmsg(): ?int
    {
        return $this->maxmsg;
    }

    /**
     * Set volgain
     *
     * @param float $volgain | null
     *
     * @return static
     */
    protected function setVolgain(?float $volgain = null): VoicemailInterface
    {
        if (!is_null($volgain)) {
            $volgain = (float) $volgain;
        }

        $this->volgain = $volgain;

        return $this;
    }

    /**
     * Get volgain
     *
     * @return float | null
     */
    public function getVolgain(): ?float
    {
        return $this->volgain;
    }

    /**
     * Set imapuser
     *
     * @param string $imapuser | null
     *
     * @return static
     */
    protected function setImapuser(?string $imapuser = null): VoicemailInterface
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
    public function getImapuser(): ?string
    {
        return $this->imapuser;
    }

    /**
     * Set imappassword
     *
     * @param string $imappassword | null
     *
     * @return static
     */
    protected function setImappassword(?string $imappassword = null): VoicemailInterface
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
    public function getImappassword(): ?string
    {
        return $this->imappassword;
    }

    /**
     * Set imapserver
     *
     * @param string $imapserver | null
     *
     * @return static
     */
    protected function setImapserver(?string $imapserver = null): VoicemailInterface
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
    public function getImapserver(): ?string
    {
        return $this->imapserver;
    }

    /**
     * Set imapport
     *
     * @param string $imapport | null
     *
     * @return static
     */
    protected function setImapport(?string $imapport = null): VoicemailInterface
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
    public function getImapport(): ?string
    {
        return $this->imapport;
    }

    /**
     * Set imapflags
     *
     * @param string $imapflags | null
     *
     * @return static
     */
    protected function setImapflags(?string $imapflags = null): VoicemailInterface
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
    public function getImapflags(): ?string
    {
        return $this->imapflags;
    }

    /**
     * Set stamp
     *
     * @param \DateTimeInterface $stamp | null
     *
     * @return static
     */
    protected function setStamp($stamp = null): VoicemailInterface
    {
        if (!is_null($stamp)) {
            Assertion::notNull(
                $stamp,
                'stamp value "%s" is null, but non null value was expected.'
            );
            $stamp = DateTimeHelper::createOrFix(
                $stamp,
                null
            );

            if ($this->stamp == $stamp) {
                return $this;
            }
        }

        $this->stamp = $stamp;

        return $this;
    }

    /**
     * Get stamp
     *
     * @return \DateTimeInterface | null
     */
    public function getStamp(): ?\DateTimeInterface
    {
        return !is_null($this->stamp) ? clone $this->stamp : null;
    }

    /**
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setUser(?UserInterface $user = null): VoicemailInterface
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * Set residentialDevice
     *
     * @param ResidentialDeviceInterface | null
     *
     * @return static
     */
    protected function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): VoicemailInterface
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

}
