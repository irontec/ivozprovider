<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\NotificationTemplate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* NotificationTemplateAbstract
* @codeCoverageIgnore
*/
abstract class NotificationTemplateAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     * comment: enum:voicemail|fax|limit|lowbalance|invoice|callCsv|maxDailyUsage
     */
    protected $type;

    /**
     * @var ?BrandInterface
     */
    protected $brand = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $type
    ) {
        $this->setName($name);
        $this->setType($type);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "NotificationTemplate",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): NotificationTemplateDto
    {
        return new NotificationTemplateDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|NotificationTemplateInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?NotificationTemplateDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, NotificationTemplateInterface::class);

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
     * @param NotificationTemplateDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, NotificationTemplateDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');

        $self = new static(
            $name,
            $type
        );

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param NotificationTemplateDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, NotificationTemplateDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setType($type)
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): NotificationTemplateDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setType(self::getType())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'type' => self::getType(),
            'brandId' => self::getBrand()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 55, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setType(string $type): static
    {
        Assertion::maxLength($type, 25, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $type,
            [
                NotificationTemplateInterface::TYPE_VOICEMAIL,
                NotificationTemplateInterface::TYPE_FAX,
                NotificationTemplateInterface::TYPE_LIMIT,
                NotificationTemplateInterface::TYPE_LOWBALANCE,
                NotificationTemplateInterface::TYPE_INVOICE,
                NotificationTemplateInterface::TYPE_CALLCSV,
                NotificationTemplateInterface::TYPE_MAXDAILYUSAGE,
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

    protected function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }
}
