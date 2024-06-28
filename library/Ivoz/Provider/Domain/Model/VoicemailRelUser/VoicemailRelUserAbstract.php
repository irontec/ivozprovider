<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\VoicemailRelUser;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;

/**
* VoicemailRelUserAbstract
* @codeCoverageIgnore
*/
abstract class VoicemailRelUserAbstract
{
    use ChangelogTrait;

    /**
     * @var UserInterface
     * inversedBy voicemailRelUsers
     */
    protected $user;

    /**
     * @var ?VoicemailInterface
     * inversedBy voicemailRelUsers
     */
    protected $voicemail = null;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "VoicemailRelUser",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): VoicemailRelUserDto
    {
        return new VoicemailRelUserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|VoicemailRelUserInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?VoicemailRelUserDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, VoicemailRelUserInterface::class);

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
     * @param VoicemailRelUserDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, VoicemailRelUserDto::class);
        $user = $dto->getUser();
        Assertion::notNull($user, 'getUser value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setUser($fkTransformer->transform($user))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param VoicemailRelUserDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, VoicemailRelUserDto::class);

        $user = $dto->getUser();
        Assertion::notNull($user, 'getUser value is null, but non null value was expected.');

        $this
            ->setUser($fkTransformer->transform($user))
            ->setVoicemail($fkTransformer->transform($dto->getVoicemail()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): VoicemailRelUserDto
    {
        return self::createDto()
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setVoicemail(Voicemail::entityToDto(self::getVoicemail(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'userId' => self::getUser()->getId(),
            'voicemailId' => self::getVoicemail()?->getId()
        ];
    }

    public function setUser(UserInterface $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setVoicemail(?VoicemailInterface $voicemail = null): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailInterface
    {
        return $this->voicemail;
    }
}
