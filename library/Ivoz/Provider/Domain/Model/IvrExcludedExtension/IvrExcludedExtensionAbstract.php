<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\Extension\Extension;

/**
* IvrExcludedExtensionAbstract
* @codeCoverageIgnore
*/
abstract class IvrExcludedExtensionAbstract
{
    use ChangelogTrait;

    /**
     * @var ?IvrInterface
     * inversedBy excludedExtensions
     */
    protected $ivr = null;

    /**
     * @var ExtensionInterface
     */
    protected $extension;

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
            "IvrExcludedExtension",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): IvrExcludedExtensionDto
    {
        return new IvrExcludedExtensionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|IvrExcludedExtensionInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?IvrExcludedExtensionDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, IvrExcludedExtensionInterface::class);

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
     * @param IvrExcludedExtensionDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, IvrExcludedExtensionDto::class);
        $extension = $dto->getExtension();
        Assertion::notNull($extension, 'getExtension value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setExtension($fkTransformer->transform($extension));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param IvrExcludedExtensionDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, IvrExcludedExtensionDto::class);

        $extension = $dto->getExtension();
        Assertion::notNull($extension, 'getExtension value is null, but non null value was expected.');

        $this
            ->setIvr($fkTransformer->transform($dto->getIvr()))
            ->setExtension($fkTransformer->transform($extension));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): IvrExcludedExtensionDto
    {
        return self::createDto()
            ->setIvr(Ivr::entityToDto(self::getIvr(), $depth))
            ->setExtension(Extension::entityToDto(self::getExtension(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'ivrId' => self::getIvr()?->getId(),
            'extensionId' => self::getExtension()->getId()
        ];
    }

    public function setIvr(?IvrInterface $ivr = null): static
    {
        $this->ivr = $ivr;

        return $this;
    }

    public function getIvr(): ?IvrInterface
    {
        return $this->ivr;
    }

    protected function setExtension(ExtensionInterface $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ExtensionInterface
    {
        return $this->extension;
    }
}
