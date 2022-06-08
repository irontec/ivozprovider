<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag;

/**
* RatingProfileAbstract
* @codeCoverageIgnore
*/
abstract class RatingProfileAbstract
{
    use ChangelogTrait;

    /**
     * @var \DateTime
     */
    protected $activationTime;

    /**
     * @var ?CompanyInterface
     * inversedBy ratingProfiles
     */
    protected $company = null;

    /**
     * @var ?CarrierInterface
     * inversedBy ratingProfiles
     */
    protected $carrier = null;

    /**
     * @var RatingPlanGroupInterface
     */
    protected $ratingPlanGroup;

    /**
     * @var ?RoutingTagInterface
     */
    protected $routingTag = null;

    /**
     * Constructor
     */
    protected function __construct(
        \DateTimeInterface|string $activationTime
    ) {
        $this->setActivationTime($activationTime);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "RatingProfile",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): RatingProfileDto
    {
        return new RatingProfileDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|RatingProfileInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RatingProfileDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, RatingProfileInterface::class);

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
     * @param RatingProfileDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, RatingProfileDto::class);
        $activationTime = $dto->getActivationTime();
        Assertion::notNull($activationTime, 'getActivationTime value is null, but non null value was expected.');
        $ratingPlanGroup = $dto->getRatingPlanGroup();
        Assertion::notNull($ratingPlanGroup, 'getRatingPlanGroup value is null, but non null value was expected.');

        $self = new static(
            $activationTime
        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRatingPlanGroup($fkTransformer->transform($ratingPlanGroup))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RatingProfileDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, RatingProfileDto::class);

        $activationTime = $dto->getActivationTime();
        Assertion::notNull($activationTime, 'getActivationTime value is null, but non null value was expected.');
        $ratingPlanGroup = $dto->getRatingPlanGroup();
        Assertion::notNull($ratingPlanGroup, 'getRatingPlanGroup value is null, but non null value was expected.');

        $this
            ->setActivationTime($activationTime)
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRatingPlanGroup($fkTransformer->transform($ratingPlanGroup))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RatingProfileDto
    {
        return self::createDto()
            ->setActivationTime(self::getActivationTime())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth))
            ->setRatingPlanGroup(RatingPlanGroup::entityToDto(self::getRatingPlanGroup(), $depth))
            ->setRoutingTag(RoutingTag::entityToDto(self::getRoutingTag(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'activationTime' => self::getActivationTime(),
            'companyId' => self::getCompany()?->getId(),
            'carrierId' => self::getCarrier()?->getId(),
            'ratingPlanGroupId' => self::getRatingPlanGroup()->getId(),
            'routingTagId' => self::getRoutingTag()?->getId()
        ];
    }

    protected function setActivationTime(string|\DateTimeInterface $activationTime): static
    {

        /** @var \Datetime */
        $activationTime = DateTimeHelper::createOrFix(
            $activationTime,
            'CURRENT_TIMESTAMP'
        );

        if ($this->isInitialized() && $this->activationTime == $activationTime) {
            return $this;
        }

        $this->activationTime = $activationTime;

        return $this;
    }

    public function getActivationTime(): \DateTime
    {
        return clone $this->activationTime;
    }

    public function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    public function setCarrier(?CarrierInterface $carrier = null): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }

    protected function setRatingPlanGroup(RatingPlanGroupInterface $ratingPlanGroup): static
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    public function getRatingPlanGroup(): RatingPlanGroupInterface
    {
        return $this->ratingPlanGroup;
    }

    protected function setRoutingTag(?RoutingTagInterface $routingTag = null): static
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    public function getRoutingTag(): ?RoutingTagInterface
    {
        return $this->routingTag;
    }
}
