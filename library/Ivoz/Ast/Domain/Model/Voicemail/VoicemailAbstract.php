<?php

declare(strict_types=1);

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;

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
     * @var ?string
     */
    protected $password = null;

    /**
     * @var ?string
     */
    protected $fullname = null;

    /**
     * @var ?string
     */
    protected $alias = null;

    /**
     * @var ?string
     */
    protected $email = null;

    /**
     * @var ?string
     */
    protected $pager = null;

    /**
     * @var ?string
     */
    protected $attach = null;

    /**
     * @var ?string
     */
    protected $attachfmt = null;

    /**
     * @var ?string
     */
    protected $serveremail = null;

    /**
     * @var ?string
     */
    protected $language = null;

    /**
     * @var ?string
     */
    protected $tz = null;

    /**
     * @var ?string
     * column: deleteast_voicemail
     */
    protected $deleteVoicemail = null;

    /**
     * @var ?string
     */
    protected $saycid = 'yes';

    /**
     * @var ?string
     * column: sendast_voicemail
     */
    protected $sendVoicemail = null;

    /**
     * @var ?string
     */
    protected $review = null;

    /**
     * @var ?string
     */
    protected $tempgreetwarn = null;

    /**
     * @var ?string
     */
    protected $operator = null;

    /**
     * @var ?string
     */
    protected $envelope = null;

    /**
     * @var ?int
     */
    protected $sayduration = null;

    /**
     * @var ?string
     */
    protected $forcename = null;

    /**
     * @var ?string
     */
    protected $forcegreetings = null;

    /**
     * @var ?string
     */
    protected $callback = null;

    /**
     * @var ?string
     */
    protected $dialout = null;

    /**
     * @var ?string
     */
    protected $exitcontext = null;

    /**
     * @var ?int
     */
    protected $maxmsg = null;

    /**
     * @var ?float
     */
    protected $volgain = null;

    /**
     * @var ?string
     */
    protected $imapuser = null;

    /**
     * @var ?string
     */
    protected $imappassword = null;

    /**
     * @var ?string
     */
    protected $imapserver = null;

    /**
     * @var ?string
     */
    protected $imapport = null;

    /**
     * @var ?string
     */
    protected $imapflags = null;

    /**
     * @var ?\DateTime
     */
    protected $stamp = null;

    /**
     * @var ?\Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface
     * inversedBy astVoicemail
     */
    protected $voicemail = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $context,
        string $mailbox
    ) {
        $this->setContext($context);
        $this->setMailbox($mailbox);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Voicemail",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): VoicemailDto
    {
        return new VoicemailDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|VoicemailInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?VoicemailDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param VoicemailDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, VoicemailDto::class);
        $context = $dto->getContext();
        Assertion::notNull($context, 'getContext value is null, but non null value was expected.');
        $mailbox = $dto->getMailbox();
        Assertion::notNull($mailbox, 'getMailbox value is null, but non null value was expected.');

        $self = new static(
            $context,
            $mailbox
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
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param VoicemailDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, VoicemailDto::class);

        $context = $dto->getContext();
        Assertion::notNull($context, 'getContext value is null, but non null value was expected.');
        $mailbox = $dto->getMailbox();
        Assertion::notNull($mailbox, 'getMailbox value is null, but non null value was expected.');

        $this
            ->setContext($context)
            ->setMailbox($mailbox)
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
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): VoicemailDto
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
            ->setVoicemail(Voicemail::entityToDto(self::getVoicemail(), $depth));
    }

    protected function __toArray(): array
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
            'voicemailId' => self::getVoicemail()?->getId()
        ];
    }

    protected function setContext(string $context): static
    {
        Assertion::maxLength($context, 80, 'context value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->context = $context;

        return $this;
    }

    public function getContext(): string
    {
        return $this->context;
    }

    protected function setMailbox(string $mailbox): static
    {
        Assertion::maxLength($mailbox, 80, 'mailbox value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->mailbox = $mailbox;

        return $this;
    }

    public function getMailbox(): string
    {
        return $this->mailbox;
    }

    protected function setPassword(?string $password = null): static
    {
        if (!is_null($password)) {
            Assertion::maxLength($password, 80, 'password value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->password = $password;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    protected function setFullname(?string $fullname = null): static
    {
        if (!is_null($fullname)) {
            Assertion::maxLength($fullname, 80, 'fullname value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fullname = $fullname;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    protected function setAlias(?string $alias = null): static
    {
        if (!is_null($alias)) {
            Assertion::maxLength($alias, 80, 'alias value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->alias = $alias;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    protected function setEmail(?string $email = null): static
    {
        if (!is_null($email)) {
            Assertion::maxLength($email, 80, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    protected function setPager(?string $pager = null): static
    {
        if (!is_null($pager)) {
            Assertion::maxLength($pager, 80, 'pager value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->pager = $pager;

        return $this;
    }

    public function getPager(): ?string
    {
        return $this->pager;
    }

    protected function setAttach(?string $attach = null): static
    {
        $this->attach = $attach;

        return $this;
    }

    public function getAttach(): ?string
    {
        return $this->attach;
    }

    protected function setAttachfmt(?string $attachfmt = null): static
    {
        if (!is_null($attachfmt)) {
            Assertion::maxLength($attachfmt, 10, 'attachfmt value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->attachfmt = $attachfmt;

        return $this;
    }

    public function getAttachfmt(): ?string
    {
        return $this->attachfmt;
    }

    protected function setServeremail(?string $serveremail = null): static
    {
        if (!is_null($serveremail)) {
            Assertion::maxLength($serveremail, 80, 'serveremail value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->serveremail = $serveremail;

        return $this;
    }

    public function getServeremail(): ?string
    {
        return $this->serveremail;
    }

    protected function setLanguage(?string $language = null): static
    {
        if (!is_null($language)) {
            Assertion::maxLength($language, 20, 'language value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    protected function setTz(?string $tz = null): static
    {
        if (!is_null($tz)) {
            Assertion::maxLength($tz, 30, 'tz value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tz = $tz;

        return $this;
    }

    public function getTz(): ?string
    {
        return $this->tz;
    }

    protected function setDeleteVoicemail(?string $deleteVoicemail = null): static
    {
        $this->deleteVoicemail = $deleteVoicemail;

        return $this;
    }

    public function getDeleteVoicemail(): ?string
    {
        return $this->deleteVoicemail;
    }

    protected function setSaycid(?string $saycid = null): static
    {
        $this->saycid = $saycid;

        return $this;
    }

    public function getSaycid(): ?string
    {
        return $this->saycid;
    }

    protected function setSendVoicemail(?string $sendVoicemail = null): static
    {
        $this->sendVoicemail = $sendVoicemail;

        return $this;
    }

    public function getSendVoicemail(): ?string
    {
        return $this->sendVoicemail;
    }

    protected function setReview(?string $review = null): static
    {
        $this->review = $review;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    protected function setTempgreetwarn(?string $tempgreetwarn = null): static
    {
        $this->tempgreetwarn = $tempgreetwarn;

        return $this;
    }

    public function getTempgreetwarn(): ?string
    {
        return $this->tempgreetwarn;
    }

    protected function setOperator(?string $operator = null): static
    {
        $this->operator = $operator;

        return $this;
    }

    public function getOperator(): ?string
    {
        return $this->operator;
    }

    protected function setEnvelope(?string $envelope = null): static
    {
        $this->envelope = $envelope;

        return $this;
    }

    public function getEnvelope(): ?string
    {
        return $this->envelope;
    }

    protected function setSayduration(?int $sayduration = null): static
    {
        $this->sayduration = $sayduration;

        return $this;
    }

    public function getSayduration(): ?int
    {
        return $this->sayduration;
    }

    protected function setForcename(?string $forcename = null): static
    {
        $this->forcename = $forcename;

        return $this;
    }

    public function getForcename(): ?string
    {
        return $this->forcename;
    }

    protected function setForcegreetings(?string $forcegreetings = null): static
    {
        $this->forcegreetings = $forcegreetings;

        return $this;
    }

    public function getForcegreetings(): ?string
    {
        return $this->forcegreetings;
    }

    protected function setCallback(?string $callback = null): static
    {
        if (!is_null($callback)) {
            Assertion::maxLength($callback, 80, 'callback value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callback = $callback;

        return $this;
    }

    public function getCallback(): ?string
    {
        return $this->callback;
    }

    protected function setDialout(?string $dialout = null): static
    {
        if (!is_null($dialout)) {
            Assertion::maxLength($dialout, 80, 'dialout value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->dialout = $dialout;

        return $this;
    }

    public function getDialout(): ?string
    {
        return $this->dialout;
    }

    protected function setExitcontext(?string $exitcontext = null): static
    {
        if (!is_null($exitcontext)) {
            Assertion::maxLength($exitcontext, 80, 'exitcontext value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->exitcontext = $exitcontext;

        return $this;
    }

    public function getExitcontext(): ?string
    {
        return $this->exitcontext;
    }

    protected function setMaxmsg(?int $maxmsg = null): static
    {
        $this->maxmsg = $maxmsg;

        return $this;
    }

    public function getMaxmsg(): ?int
    {
        return $this->maxmsg;
    }

    protected function setVolgain(?float $volgain = null): static
    {
        if (!is_null($volgain)) {
            $volgain = (float) $volgain;
        }

        $this->volgain = $volgain;

        return $this;
    }

    public function getVolgain(): ?float
    {
        return $this->volgain;
    }

    protected function setImapuser(?string $imapuser = null): static
    {
        if (!is_null($imapuser)) {
            Assertion::maxLength($imapuser, 80, 'imapuser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->imapuser = $imapuser;

        return $this;
    }

    public function getImapuser(): ?string
    {
        return $this->imapuser;
    }

    protected function setImappassword(?string $imappassword = null): static
    {
        if (!is_null($imappassword)) {
            Assertion::maxLength($imappassword, 80, 'imappassword value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->imappassword = $imappassword;

        return $this;
    }

    public function getImappassword(): ?string
    {
        return $this->imappassword;
    }

    protected function setImapserver(?string $imapserver = null): static
    {
        if (!is_null($imapserver)) {
            Assertion::maxLength($imapserver, 80, 'imapserver value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->imapserver = $imapserver;

        return $this;
    }

    public function getImapserver(): ?string
    {
        return $this->imapserver;
    }

    protected function setImapport(?string $imapport = null): static
    {
        if (!is_null($imapport)) {
            Assertion::maxLength($imapport, 8, 'imapport value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->imapport = $imapport;

        return $this;
    }

    public function getImapport(): ?string
    {
        return $this->imapport;
    }

    protected function setImapflags(?string $imapflags = null): static
    {
        if (!is_null($imapflags)) {
            Assertion::maxLength($imapflags, 80, 'imapflags value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->imapflags = $imapflags;

        return $this;
    }

    public function getImapflags(): ?string
    {
        return $this->imapflags;
    }

    protected function setStamp(string|\DateTimeInterface|null $stamp = null): static
    {
        if (!is_null($stamp)) {

            /** @var ?\Datetime */
            $stamp = DateTimeHelper::createOrFix(
                $stamp,
                null
            );

            if ($this->isInitialized() && $this->stamp == $stamp) {
                return $this;
            }
        }

        $this->stamp = $stamp;

        return $this;
    }

    public function getStamp(): ?\DateTime
    {
        return !is_null($this->stamp) ? clone $this->stamp : null;
    }

    public function setVoicemail(?\Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface $voicemail = null): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?\Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface
    {
        return $this->voicemail;
    }
}
