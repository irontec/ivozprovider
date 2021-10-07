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
     * comment: enum:voicemail|fax|limit|lowbalance|invoice|callCsv|maxDailyUsage
     * @var string
     */
    protected $type;

    /**
     * @var BrandInterface | null
     */
    protected $brand;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $type
    ) {
        $this->setName($name);
        $this->setType($type);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "NotificationTemplate",
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
     * @param mixed $id
     * @return NotificationTemplateDto
     */
    public static function createDto($id = null)
    {
        return new NotificationTemplateDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param NotificationTemplateInterface|null $entity
     * @param int $depth
     * @return NotificationTemplateDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var NotificationTemplateDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param NotificationTemplateDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, NotificationTemplateDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getType()
        );

        $self
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param NotificationTemplateDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, NotificationTemplateDto::class);

        $this
            ->setName($dto->getName())
            ->setType($dto->getType())
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return NotificationTemplateDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setType(self::getType())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'type' => self::getType(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
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
