<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelCompany;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class PricingPlansRelCompanyDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var \DateTime
     */
    private $validFrom;

    /**
     * @var \DateTime
     */
    private $validTo;

    /**
     * @var integer
     */
    private $metric = '10';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto | null
     */
    private $pricingPlan;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'validFrom' => 'validFrom',
            'validTo' => 'validTo',
            'metric' => 'metric',
            'id' => 'id',
            'pricingPlan' => 'pricingPlan',
            'company' => 'company',
            'brand' => 'brand'
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'validFrom' => $this->getValidFrom(),
            'validTo' => $this->getValidTo(),
            'metric' => $this->getMetric(),
            'id' => $this->getId(),
            'pricingPlan' => $this->getPricingPlan(),
            'company' => $this->getCompany(),
            'brand' => $this->getBrand()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->pricingPlan = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PricingPlan\\PricingPlan', $this->getPricingPlanId());
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param \DateTime $validFrom
     *
     * @return static
     */
    public function setValidFrom($validFrom = null)
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * @param \DateTime $validTo
     *
     * @return static
     */
    public function setValidTo($validTo = null)
    {
        $this->validTo = $validTo;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * @param integer $metric
     *
     * @return static
     */
    public function setMetric($metric = null)
    {
        $this->metric = $metric;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMetric()
    {
        return $this->metric;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto $pricingPlan
     *
     * @return static
     */
    public function setPricingPlan(\Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto $pricingPlan = null)
    {
        $this->pricingPlan = $pricingPlan;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto
     */
    public function getPricingPlan()
    {
        return $this->pricingPlan;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setPricingPlanId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto($id)
                : null;

            return $this->setPricingPlan($value);
        }

        /**
         * @return integer | null
         */
        public function getPricingPlanId()
        {
            if ($dto = $this->getPricingPlan()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setCompanyId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
                : null;

            return $this->setCompany($value);
        }

        /**
         * @return integer | null
         */
        public function getCompanyId()
        {
            if ($dto = $this->getCompany()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setBrandId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
                : null;

            return $this->setBrand($value);
        }

        /**
         * @return integer | null
         */
        public function getBrandId()
        {
            if ($dto = $this->getBrand()) {
                return $dto->getId();
            }

            return null;
        }
}


