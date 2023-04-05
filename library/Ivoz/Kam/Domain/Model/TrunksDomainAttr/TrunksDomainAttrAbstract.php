<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;

/**
* TrunksDomainAttrAbstract
* @codeCoverageIgnore
*/
abstract class TrunksDomainAttrAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $did;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var \DateTime
     * column: last_modified
     */
    protected $lastModified;

    /**
     * Constructor
     */
    protected function __construct(
        string $did,
        string $name,
        int $type,
        string $value,
        \DateTimeInterface|string $lastModified
    ) {
        $this->setDid($did);
        $this->setName($name);
        $this->setType($type);
        $this->setValue($value);
        $this->setLastModified($lastModified);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TrunksDomainAttr",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TrunksDomainAttrDto
    {
        return new TrunksDomainAttrDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TrunksDomainAttrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksDomainAttrDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrunksDomainAttrInterface::class);

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
     * @param TrunksDomainAttrDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TrunksDomainAttrDto::class);
        $did = $dto->getDid();
        Assertion::notNull($did, 'getDid value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $value = $dto->getValue();
        Assertion::notNull($value, 'getValue value is null, but non null value was expected.');
        $lastModified = $dto->getLastModified();
        Assertion::notNull($lastModified, 'getLastModified value is null, but non null value was expected.');

        $self = new static(
            $did,
            $name,
            $type,
            $value,
            $lastModified
        );

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksDomainAttrDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TrunksDomainAttrDto::class);

        $did = $dto->getDid();
        Assertion::notNull($did, 'getDid value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $value = $dto->getValue();
        Assertion::notNull($value, 'getValue value is null, but non null value was expected.');
        $lastModified = $dto->getLastModified();
        Assertion::notNull($lastModified, 'getLastModified value is null, but non null value was expected.');

        $this
            ->setDid($did)
            ->setName($name)
            ->setType($type)
            ->setValue($value)
            ->setLastModified($lastModified);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksDomainAttrDto
    {
        return self::createDto()
            ->setDid(self::getDid())
            ->setName(self::getName())
            ->setType(self::getType())
            ->setValue(self::getValue())
            ->setLastModified(self::getLastModified());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'did' => self::getDid(),
            'name' => self::getName(),
            'type' => self::getType(),
            'value' => self::getValue(),
            'last_modified' => self::getLastModified()
        ];
    }

    protected function setDid(string $did): static
    {
        Assertion::maxLength($did, 190, 'did value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->did = $did;

        return $this;
    }

    public function getDid(): string
    {
        return $this->did;
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 32, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setType(int $type): static
    {
        Assertion::greaterOrEqualThan($type, 0, 'type provided "%s" is not greater or equal than "%s".');

        $this->type = $type;

        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    protected function setValue(string $value): static
    {
        Assertion::maxLength($value, 255, 'value value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->value = $value;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    protected function setLastModified(string|\DateTimeInterface $lastModified): static
    {

        /** @var \DateTime */
        $lastModified = DateTimeHelper::createOrFix(
            $lastModified,
            '1900-01-01 00:00:01'
        );

        if ($this->isInitialized() && $this->lastModified == $lastModified) {
            return $this;
        }

        $this->lastModified = $lastModified;

        return $this;
    }

    public function getLastModified(): \DateTime
    {
        return clone $this->lastModified;
    }
}
