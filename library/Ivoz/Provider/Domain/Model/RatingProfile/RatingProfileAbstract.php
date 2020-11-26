<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var \DateTimeInterface
     */
    protected $activationTime = 'CURRENT_TIMESTAMP';

    /**
     * @var CompanyInterface
     * inversedBy ratingProfiles
     */
    protected $company;

    /**
     * @var CarrierInterface
     * inversedBy ratingProfiles
     */
    protected $carrier;

    /**
     * @var RatingPlanGroupInterface
     */
    protected $ratingPlanGroup;

    /**
     * @var RoutingTagInterface
     */
    protected $routingTag;

    /**
     * Constructor
     */
    protected function __construct(
        $activationTime
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
     * @param null $id
     * @return RatingProfileDto
     */
    public static function createDto($id = null)
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
        $dto = $entity->toDto($depth-1);

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
     * @return RatingProfileDto
     */
    public function toDto($depth = 0)
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

    /**
     * Set activationTime
     *
     * @param \DateTimeInterface $activationTime
     *
     * @return static
     */
    protected function setActivationTime($activationTime): RatingProfileInterface
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
     * Get activationTime
     *
     * @return \DateTimeInterface
     */
    public function getActivationTime(): \DateTimeInterface
    {
        return clone $this->activationTime;
    }

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    public function setCompany(?CompanyInterface $company = null): RatingProfileInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param CarrierInterface | null
     *
     * @return static
     */
    public function setCarrier(?CarrierInterface $carrier = null): RatingProfileInterface
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return CarrierInterface | null
     */
    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }

    /**
     * Set ratingPlanGroup
     *
     * @param RatingPlanGroupInterface
     *
     * @return static
     */
    protected function setRatingPlanGroup(RatingPlanGroupInterface $ratingPlanGroup): RatingProfileInterface
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * Get ratingPlanGroup
     *
     * @return RatingPlanGroupInterface
     */
    public function getRatingPlanGroup(): RatingPlanGroupInterface
    {
        return $this->ratingPlanGroup;
    }

    /**
     * Set routingTag
     *
     * @param RoutingTagInterface | null
     *
     * @return static
     */
    protected function setRoutingTag(?RoutingTagInterface $routingTag = null): RatingProfileInterface
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    /**
     * Get routingTag
     *
     * @return RoutingTagInterface | null
     */
    public function getRoutingTag(): ?RoutingTagInterface
    {
        return $this->routingTag;
    }

}
