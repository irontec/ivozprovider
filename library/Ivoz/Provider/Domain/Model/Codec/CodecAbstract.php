<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Codec;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* CodecAbstract
* @codeCoverageIgnore
*/
abstract class CodecAbstract
{
    use ChangelogTrait;

    /**
     * comment: enum:audio|video
     */
    protected $type = 'audio';

    protected $iden;

    protected $name;

    /**
     * Constructor
     */
    protected function __construct(
        string $type,
        string $iden,
        string $name
    ) {
        $this->setType($type);
        $this->setIden($iden);
        $this->setName($name);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Codec",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CodecDto
    {
        return new CodecDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CodecInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CodecDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CodecInterface::class);

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
     * @param CodecDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CodecDto::class);

        $self = new static(
            $dto->getType(),
            $dto->getIden(),
            $dto->getName()
        );

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CodecDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CodecDto::class);

        $this
            ->setType($dto->getType())
            ->setIden($dto->getIden())
            ->setName($dto->getName());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CodecDto
    {
        return self::createDto()
            ->setType(self::getType())
            ->setIden(self::getIden())
            ->setName(self::getName());
    }

    protected function __toArray(): array
    {
        return [
            'type' => self::getType(),
            'iden' => self::getIden(),
            'name' => self::getName()
        ];
    }

    protected function setType(string $type): static
    {
        Assertion::maxLength($type, 10, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $type,
            [
                CodecInterface::TYPE_AUDIO,
                CodecInterface::TYPE_VIDEO,
            ],
            'typevalue "%s" is not an element of the valid values: %s'
        );

        $this->type = $type;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    protected function setIden(string $iden): static
    {
        Assertion::maxLength($iden, 25, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->iden = $iden;

        return $this;
    }

    public function getIden(): string
    {
        return $this->iden;
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
