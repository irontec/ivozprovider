<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * PricingPlansRelTargetPatternAbstract
 * @codeCoverageIgnore
 */
abstract class PricingPlansRelTargetPatternAbstract
{
    /**
     * @var string
     */
    protected $connectionCharge;

    /**
     * @var integer
     */
    protected $periodTime;

    /**
     * @var string
     */
    protected $perPeriodCharge;

    /**
     * @var \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface
     */
    protected $pricingPlan;

    /**
     * @var \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface
     */
    protected $targetPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $connectionCharge,
        $periodTime,
        $perPeriodCharge
    ) {
        $this->setConnectionCharge($connectionCharge);
        $this->setPeriodTime($periodTime);
        $this->setPerPeriodCharge($perPeriodCharge);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "PricingPlansRelTargetPattern",
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
     * @return PricingPlansRelTargetPatternDto
     */
    public static function createDto($id = null)
    {
        return new PricingPlansRelTargetPatternDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return PricingPlansRelTargetPatternDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, PricingPlansRelTargetPatternInterface::class);

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
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PricingPlansRelTargetPatternDto
         */
        Assertion::isInstanceOf($dto, PricingPlansRelTargetPatternDto::class);

        $self = new static(
            $dto->getConnectionCharge(),
            $dto->getPeriodTime(),
            $dto->getPerPeriodCharge());

        $self
            ->setPricingPlan($dto->getPricingPlan())
            ->setTargetPattern($dto->getTargetPattern())
            ->setBrand($dto->getBrand())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PricingPlansRelTargetPatternDto
         */
        Assertion::isInstanceOf($dto, PricingPlansRelTargetPatternDto::class);

        $this
            ->setConnectionCharge($dto->getConnectionCharge())
            ->setPeriodTime($dto->getPeriodTime())
            ->setPerPeriodCharge($dto->getPerPeriodCharge())
            ->setPricingPlan($dto->getPricingPlan())
            ->setTargetPattern($dto->getTargetPattern())
            ->setBrand($dto->getBrand());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return PricingPlansRelTargetPatternDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setConnectionCharge($this->getConnectionCharge())
            ->setPeriodTime($this->getPeriodTime())
            ->setPerPeriodCharge($this->getPerPeriodCharge())
            ->setPricingPlan(\Ivoz\Provider\Domain\Model\PricingPlan\PricingPlan::entityToDto($this->getPricingPlan(), $depth))
            ->setTargetPattern(\Ivoz\Provider\Domain\Model\TargetPattern\TargetPattern::entityToDto($this->getTargetPattern(), $depth))
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto($this->getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'connectionCharge' => self::getConnectionCharge(),
            'periodTime' => self::getPeriodTime(),
            'perPeriodCharge' => self::getPerPeriodCharge(),
            'pricingPlanId' => self::getPricingPlan() ? self::getPricingPlan()->getId() : null,
            'targetPatternId' => self::getTargetPattern() ? self::getTargetPattern()->getId() : null,
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set connectionCharge
     *
     * @param string $connectionCharge
     *
     * @return self
     */
    public function setConnectionCharge($connectionCharge)
    {
        Assertion::notNull($connectionCharge, 'connectionCharge value "%s" is null, but non null value was expected.');
        Assertion::numeric($connectionCharge);

        $this->connectionCharge = $connectionCharge;

        return $this;
    }

    /**
     * Get connectionCharge
     *
     * @return string
     */
    public function getConnectionCharge()
    {
        return $this->connectionCharge;
    }

    /**
     * Set periodTime
     *
     * @param integer $periodTime
     *
     * @return self
     */
    public function setPeriodTime($periodTime)
    {
        Assertion::notNull($periodTime, 'periodTime value "%s" is null, but non null value was expected.');
        Assertion::integerish($periodTime, 'periodTime value "%s" is not an integer or a number castable to integer.');

        $this->periodTime = $periodTime;

        return $this;
    }

    /**
     * Get periodTime
     *
     * @return integer
     */
    public function getPeriodTime()
    {
        return $this->periodTime;
    }

    /**
     * Set perPeriodCharge
     *
     * @param string $perPeriodCharge
     *
     * @return self
     */
    public function setPerPeriodCharge($perPeriodCharge)
    {
        Assertion::notNull($perPeriodCharge, 'perPeriodCharge value "%s" is null, but non null value was expected.');
        Assertion::numeric($perPeriodCharge);

        $this->perPeriodCharge = $perPeriodCharge;

        return $this;
    }

    /**
     * Get perPeriodCharge
     *
     * @return string
     */
    public function getPerPeriodCharge()
    {
        return $this->perPeriodCharge;
    }

    /**
     * Set pricingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface $pricingPlan
     *
     * @return self
     */
    public function setPricingPlan(\Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface $pricingPlan)
    {
        $this->pricingPlan = $pricingPlan;

        return $this;
    }

    /**
     * Get pricingPlan
     *
     * @return \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface
     */
    public function getPricingPlan()
    {
        return $this->pricingPlan;
    }

    /**
     * Set targetPattern
     *
     * @param \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface $targetPattern
     *
     * @return self
     */
    public function setTargetPattern(\Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface $targetPattern)
    {
        $this->targetPattern = $targetPattern;

        return $this;
    }

    /**
     * Get targetPattern
     *
     * @return \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternInterface
     */
    public function getTargetPattern()
    {
        return $this->targetPattern;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }



    // @codeCoverageIgnoreEnd
}

