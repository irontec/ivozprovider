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

    protected $activationTime;

    /**
     * @var CompanyInterface | null
     * inversedBy ratingProfiles
     */
    protected $company;

    /**
     * @var CarrierInterface | null
     * inversedBy ratingProfiles
     */
    protected $carrier;

    /**
     * @var RatingPlanGroupInterface
     */
    protected $ratingPlanGroup;

    /**
     * @var RoutingTagInterface | null
     */
    protected $routingTag;

    /**
     * Constructor
     */
    protected function __construct(
        \DateTimeInterface|string $activationTime
    ) {
        $this->setActivationTime($activationTime);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "RatingProfile",
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
     */
    public static function createDto($id = null): RatingProfileDto
    {
        return new RatingProfileDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param RatingProfileInterface|null $entity
     * @param int $depth
     * @return RatingProfileDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var RatingProfileDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RatingProfileDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RatingProfileDto::class);

        $self = new static(
            $dto->getActivationTime()
        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRatingPlanGroup($fkTransformer->transform($dto->getRatingPlanGroup()))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RatingProfileDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RatingProfileDto::class);

        $this
            ->setActivationTime($dto->getActivationTime())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRatingPlanGroup($fkTransformer->transform($dto->getRatingPlanGroup()))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): RatingProfileDto
    {
        return self::createDto()
            ->setActivationTime(self::getActivationTime())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth))
            ->setRatingPlanGroup(RatingPlanGroup::entityToDto(self::getRatingPlanGroup(), $depth))
            ->setRoutingTag(RoutingTag::entityToDto(self::getRoutingTag(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'activationTime' => self::getActivationTime(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null,
            'ratingPlanGroupId' => self::getRatingPlanGroup()->getId(),
            'routingTagId' => self::getRoutingTag() ? self::getRoutingTag()->getId() : null
        ];
    }

    protected function setActivationTime($activationTime): static
    {

        $activationTime = DateTimeHelper::createOrFix(
            $activationTime,
            'CURRENT_TIMESTAMP'
        );

        if ($this->activationTime == $activationTime) {
            return $this;
        }

        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getActivationTime(): \DateTimeInterface
    {
        return clone $this->activationTime;
    }

    public function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        /** @var  $this */
        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    public function setCarrier(?CarrierInterface $carrier = null): static
    {
        $this->carrier = $carrier;

        /** @var  $this */
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
