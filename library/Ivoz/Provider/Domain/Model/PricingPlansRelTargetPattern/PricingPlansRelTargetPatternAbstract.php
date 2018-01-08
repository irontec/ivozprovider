<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

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


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

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
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @return PricingPlansRelTargetPatternDTO
     */
    public static function createDTO()
    {
        return new PricingPlansRelTargetPatternDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PricingPlansRelTargetPatternDTO
         */
        Assertion::isInstanceOf($dto, PricingPlansRelTargetPatternDTO::class);

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
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PricingPlansRelTargetPatternDTO
         */
        Assertion::isInstanceOf($dto, PricingPlansRelTargetPatternDTO::class);

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
     * @return PricingPlansRelTargetPatternDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setConnectionCharge($this->getConnectionCharge())
            ->setPeriodTime($this->getPeriodTime())
            ->setPerPeriodCharge($this->getPerPeriodCharge())
            ->setPricingPlanId($this->getPricingPlan() ? $this->getPricingPlan()->getId() : null)
            ->setTargetPatternId($this->getTargetPattern() ? $this->getTargetPattern()->getId() : null)
            ->setBrandId($this->getBrand() ? $this->getBrand()->getId() : null);
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

