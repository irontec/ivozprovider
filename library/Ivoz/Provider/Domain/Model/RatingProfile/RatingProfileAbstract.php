<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * RatingProfileAbstract
 * @codeCoverageIgnore
 */
abstract class RatingProfileAbstract
{
    /**
     * @var \DateTime
     */
    protected $activationTime;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    protected $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface
     */
    protected $ratingPlanGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface
     */
    protected $routingTag;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($activationTime)
    {
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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto RatingProfileDto
         */
        Assertion::isInstanceOf($dto, RatingProfileDto::class);

        $self = new static(
            $dto->getActivationTime()
        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRatingPlanGroup($fkTransformer->transform($dto->getRatingPlanGroup()))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto RatingProfileDto
         */
        Assertion::isInstanceOf($dto, RatingProfileDto::class);

        $this
            ->setActivationTime($dto->getActivationTime())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRatingPlanGroup($fkTransformer->transform($dto->getRatingPlanGroup()))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()));



        $this->sanitizeValues();
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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth))
            ->setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup::entityToDto(self::getRatingPlanGroup(), $depth))
            ->setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag::entityToDto(self::getRoutingTag(), $depth));
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
            'ratingPlanGroupId' => self::getRatingPlanGroup() ? self::getRatingPlanGroup()->getId() : null,
            'routingTagId' => self::getRoutingTag() ? self::getRoutingTag()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set activationTime
     *
     * @param \DateTime $activationTime
     *
     * @return self
     */
    protected function setActivationTime($activationTime)
    {
        Assertion::notNull($activationTime, 'activationTime value "%s" is null, but non null value was expected.');
        $activationTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $activationTime,
            'CURRENT_TIMESTAMP'
        );

        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * Get activationTime
     *
     * @return \DateTime
     */
    public function getActivationTime()
    {
        return clone $this->activationTime;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set ratingPlanGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup
     *
     * @return self
     */
    public function setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface $ratingPlanGroup)
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * Get ratingPlanGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface
     */
    public function getRatingPlanGroup()
    {
        return $this->ratingPlanGroup;
    }

    /**
     * Set routingTag
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag
     *
     * @return self
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag = null)
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    /**
     * Get routingTag
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface | null
     */
    public function getRoutingTag()
    {
        return $this->routingTag;
    }

    // @codeCoverageIgnoreEnd
}
