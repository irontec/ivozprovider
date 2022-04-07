<?php

declare(strict_types=1);

namespace Ivoz\Ast\Domain\Model\VoicemailMessage;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* VoicemailMessageAbstract
* @codeCoverageIgnore
*/
abstract class VoicemailMessageAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $dir;

    /**
     * @var int
     */
    protected $msgnum = 0;

    /**
     * @var ?string
     */
    protected $context = null;

    /**
     * @var ?string
     */
    protected $macrocontext = null;

    /**
     * @var ?string
     */
    protected $callerid = null;

    /**
     * @var int
     */
    protected $origtime = 0;

    /**
     * @var int
     */
    protected $duration = 0;

    /**
     * @var ?string
     */
    protected $recording = null;

    /**
     * @var ?string
     */
    protected $flag = null;

    /**
     * @var ?string
     */
    protected $category = null;

    /**
     * @var string
     */
    protected $mailboxuser;

    /**
     * @var string
     */
    protected $mailboxcontext;

    /**
     * @var ?string
     * column: msg_id
     */
    protected $msgId = null;

    /**
     * @var bool
     */
    protected $parsed = false;

    /**
     * Constructor
     */
    protected function __construct(
        string $dir,
        int $msgnum,
        int $origtime,
        int $duration,
        string $mailboxuser,
        string $mailboxcontext,
        bool $parsed
    ) {
        $this->setDir($dir);
        $this->setMsgnum($msgnum);
        $this->setOrigtime($origtime);
        $this->setDuration($duration);
        $this->setMailboxuser($mailboxuser);
        $this->setMailboxcontext($mailboxcontext);
        $this->setParsed($parsed);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "VoicemailMessage",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): VoicemailMessageDto
    {
        return new VoicemailMessageDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|VoicemailMessageInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?VoicemailMessageDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, VoicemailMessageInterface::class);

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
     * @param VoicemailMessageDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, VoicemailMessageDto::class);
        $dir = $dto->getDir();
        Assertion::notNull($dir, 'getDir value is null, but non null value was expected.');
        $msgnum = $dto->getMsgnum();
        Assertion::notNull($msgnum, 'getMsgnum value is null, but non null value was expected.');
        $origtime = $dto->getOrigtime();
        Assertion::notNull($origtime, 'getOrigtime value is null, but non null value was expected.');
        $duration = $dto->getDuration();
        Assertion::notNull($duration, 'getDuration value is null, but non null value was expected.');
        $mailboxuser = $dto->getMailboxuser();
        Assertion::notNull($mailboxuser, 'getMailboxuser value is null, but non null value was expected.');
        $mailboxcontext = $dto->getMailboxcontext();
        Assertion::notNull($mailboxcontext, 'getMailboxcontext value is null, but non null value was expected.');
        $parsed = $dto->getParsed();
        Assertion::notNull($parsed, 'getParsed value is null, but non null value was expected.');

        $self = new static(
            $dir,
            $msgnum,
            $origtime,
            $duration,
            $mailboxuser,
            $mailboxcontext,
            $parsed
        );

        $self
            ->setContext($dto->getContext())
            ->setMacrocontext($dto->getMacrocontext())
            ->setCallerid($dto->getCallerid())
            ->setRecording($dto->getRecording())
            ->setFlag($dto->getFlag())
            ->setCategory($dto->getCategory())
            ->setMsgId($dto->getMsgId());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param VoicemailMessageDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, VoicemailMessageDto::class);

        $dir = $dto->getDir();
        Assertion::notNull($dir, 'getDir value is null, but non null value was expected.');
        $msgnum = $dto->getMsgnum();
        Assertion::notNull($msgnum, 'getMsgnum value is null, but non null value was expected.');
        $origtime = $dto->getOrigtime();
        Assertion::notNull($origtime, 'getOrigtime value is null, but non null value was expected.');
        $duration = $dto->getDuration();
        Assertion::notNull($duration, 'getDuration value is null, but non null value was expected.');
        $mailboxuser = $dto->getMailboxuser();
        Assertion::notNull($mailboxuser, 'getMailboxuser value is null, but non null value was expected.');
        $mailboxcontext = $dto->getMailboxcontext();
        Assertion::notNull($mailboxcontext, 'getMailboxcontext value is null, but non null value was expected.');
        $parsed = $dto->getParsed();
        Assertion::notNull($parsed, 'getParsed value is null, but non null value was expected.');

        $this
            ->setDir($dir)
            ->setMsgnum($msgnum)
            ->setContext($dto->getContext())
            ->setMacrocontext($dto->getMacrocontext())
            ->setCallerid($dto->getCallerid())
            ->setOrigtime($origtime)
            ->setDuration($duration)
            ->setRecording($dto->getRecording())
            ->setFlag($dto->getFlag())
            ->setCategory($dto->getCategory())
            ->setMailboxuser($mailboxuser)
            ->setMailboxcontext($mailboxcontext)
            ->setMsgId($dto->getMsgId())
            ->setParsed($parsed);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): VoicemailMessageDto
    {
        return self::createDto()
            ->setDir(self::getDir())
            ->setMsgnum(self::getMsgnum())
            ->setContext(self::getContext())
            ->setMacrocontext(self::getMacrocontext())
            ->setCallerid(self::getCallerid())
            ->setOrigtime(self::getOrigtime())
            ->setDuration(self::getDuration())
            ->setRecording(self::getRecording())
            ->setFlag(self::getFlag())
            ->setCategory(self::getCategory())
            ->setMailboxuser(self::getMailboxuser())
            ->setMailboxcontext(self::getMailboxcontext())
            ->setMsgId(self::getMsgId())
            ->setParsed(self::getParsed());
    }

    protected function __toArray(): array
    {
        return [
            'dir' => self::getDir(),
            'msgnum' => self::getMsgnum(),
            'context' => self::getContext(),
            'macrocontext' => self::getMacrocontext(),
            'callerid' => self::getCallerid(),
            'origtime' => self::getOrigtime(),
            'duration' => self::getDuration(),
            'recording' => self::getRecording(),
            'flag' => self::getFlag(),
            'category' => self::getCategory(),
            'mailboxuser' => self::getMailboxuser(),
            'mailboxcontext' => self::getMailboxcontext(),
            'msg_id' => self::getMsgId(),
            'parsed' => self::getParsed()
        ];
    }

    protected function setDir(string $dir): static
    {
        Assertion::maxLength($dir, 255, 'dir value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->dir = $dir;

        return $this;
    }

    public function getDir(): string
    {
        return $this->dir;
    }

    protected function setMsgnum(int $msgnum): static
    {
        $this->msgnum = $msgnum;

        return $this;
    }

    public function getMsgnum(): int
    {
        return $this->msgnum;
    }

    protected function setContext(?string $context = null): static
    {
        if (!is_null($context)) {
            Assertion::maxLength($context, 80, 'context value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->context = $context;

        return $this;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    protected function setMacrocontext(?string $macrocontext = null): static
    {
        if (!is_null($macrocontext)) {
            Assertion::maxLength($macrocontext, 80, 'macrocontext value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->macrocontext = $macrocontext;

        return $this;
    }

    public function getMacrocontext(): ?string
    {
        return $this->macrocontext;
    }

    protected function setCallerid(?string $callerid = null): static
    {
        if (!is_null($callerid)) {
            Assertion::maxLength($callerid, 80, 'callerid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->callerid = $callerid;

        return $this;
    }

    public function getCallerid(): ?string
    {
        return $this->callerid;
    }

    protected function setOrigtime(int $origtime): static
    {
        $this->origtime = $origtime;

        return $this;
    }

    public function getOrigtime(): int
    {
        return $this->origtime;
    }

    protected function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    protected function setRecording(?string $recording = null): static
    {
        $this->recording = $recording;

        return $this;
    }

    public function getRecording(): ?string
    {
        return $this->recording;
    }

    protected function setFlag(?string $flag = null): static
    {
        if (!is_null($flag)) {
            Assertion::maxLength($flag, 30, 'flag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->flag = $flag;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    protected function setCategory(?string $category = null): static
    {
        if (!is_null($category)) {
            Assertion::maxLength($category, 30, 'category value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->category = $category;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    protected function setMailboxuser(string $mailboxuser): static
    {
        Assertion::maxLength($mailboxuser, 30, 'mailboxuser value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->mailboxuser = $mailboxuser;

        return $this;
    }

    public function getMailboxuser(): string
    {
        return $this->mailboxuser;
    }

    protected function setMailboxcontext(string $mailboxcontext): static
    {
        Assertion::maxLength($mailboxcontext, 30, 'mailboxcontext value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->mailboxcontext = $mailboxcontext;

        return $this;
    }

    public function getMailboxcontext(): string
    {
        return $this->mailboxcontext;
    }

    protected function setMsgId(?string $msgId = null): static
    {
        if (!is_null($msgId)) {
            Assertion::maxLength($msgId, 40, 'msgId value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->msgId = $msgId;

        return $this;
    }

    public function getMsgId(): ?string
    {
        return $this->msgId;
    }

    protected function setParsed(bool $parsed): static
    {
        $this->parsed = $parsed;

        return $this;
    }

    public function getParsed(): bool
    {
        return $this->parsed;
    }
}
