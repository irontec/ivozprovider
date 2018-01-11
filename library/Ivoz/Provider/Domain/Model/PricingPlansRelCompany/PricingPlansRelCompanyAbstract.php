<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelCompany;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * PricingPlansRelCompanyAbstract
 * @codeCoverageIgnore
 */
abstract class PricingPlansRelCompanyAbstract
{
    /**
     * @var \DateTime
     */
    protected $validFrom;

    /**
     * @var \DateTime
     */
    protected $validTo;

    /**
     * @var integer
     */
    protected $metric = '10';

    /**
     * @var \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanInterface
     */
    protected $pricingPlan;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($validFrom, $validTo, $metric)
    {
        $this->setValidFrom($validFrom);
        $this->setValidTo($validTo);
        $this->setMetric($metric);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "PricingPlansRelCompany",
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
     * @return PricingPlansRelCompanyDto
     */
    public static function createDto($id = null)
    {
        return new PricingPlansRelCompanyDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return PricingPlansRelCompanyDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, PricingPlansRelCompanyInterface::class);

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
         * @var $dto PricingPlansRelCompanyDto
         */
        Assertion::isInstanceOf($dto, PricingPlansRelCompanyDto::class);

        $self = new static(
            $dto->getValidFrom(),
            $dto->getValidTo(),
            $dto->getMetric());

        $self
            ->setPricingPlan($dto->getPricingPlan())
            ->setCompany($dto->getCompany())
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
         * @var $dto PricingPlansRelCompanyDto
         */
        Assertion::isInstanceOf($dto, PricingPlansRelCompanyDto::class);

        $this
            ->setValidFrom($dto->getValidFrom())
            ->setValidTo($dto->getValidTo())
            ->setMetric($dto->getMetric())
            ->setPricingPlan($dto->getPricingPlan())
            ->setCompany($dto->getCompany())
            ->setBrand($dto->getBrand());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return PricingPlansRelCompanyDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setValidFrom($this->getValidFrom())
            ->setValidTo($this->getValidTo())
            ->setMetric($this->getMetric())
            ->setPricingPlan(\Ivoz\Provider\Domain\Model\PricingPlan\PricingPlan::entityToDto($this->getPricingPlan(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto($this->getCompany(), $depth))
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto($this->getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'validFrom' => self::getValidFrom(),
            'validTo' => self::getValidTo(),
            'metric' => self::getMetric(),
            'pricingPlanId' => self::getPricingPlan() ? self::getPricingPlan()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set validFrom
     *
     * @param \DateTime $validFrom
     *
     * @return self
     */
    public function setValidFrom($validFrom)
    {
        Assertion::notNull($validFrom, 'validFrom value "%s" is null, but non null value was expected.');
        $validFrom = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $validFrom,
            null
        );

        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * Get validFrom
     *
     * @return \DateTime
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * Set validTo
     *
     * @param \DateTime $validTo
     *
     * @return self
     */
    public function setValidTo($validTo)
    {
        Assertion::notNull($validTo, 'validTo value "%s" is null, but non null value was expected.');
        $validTo = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $validTo,
            null
        );

        $this->validTo = $validTo;

        return $this;
    }

    /**
     * Get validTo
     *
     * @return \DateTime
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * Set metric
     *
     * @param integer $metric
     *
     * @return self
     */
    public function setMetric($metric)
    {
        Assertion::notNull($metric, 'metric value "%s" is null, but non null value was expected.');
        Assertion::integerish($metric, 'metric value "%s" is not an integer or a number castable to integer.');

        $this->metric = $metric;

        return $this;
    }

    /**
     * Get metric
     *
     * @return integer
     */
    public function getMetric()
    {
        return $this->metric;
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
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
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

