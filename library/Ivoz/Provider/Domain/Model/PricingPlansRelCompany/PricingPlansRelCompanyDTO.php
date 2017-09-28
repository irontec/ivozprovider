<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelCompany;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class PricingPlansRelCompanyDTO implements DataTransferObjectInterface
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
     * @var mixed
     */
    private $pricingPlanId;

    /**
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $brandId;

    /**
     * @var mixed
     */
    private $pricingPlan;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var mixed
     */
    private $brand;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'validFrom' => $this->getValidFrom(),
            'validTo' => $this->getValidTo(),
            'metric' => $this->getMetric(),
            'id' => $this->getId(),
            'pricingPlanId' => $this->getPricingPlanId(),
            'companyId' => $this->getCompanyId(),
            'brandId' => $this->getBrandId()
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
     * @return PricingPlansRelCompanyDTO
     */
    public function setValidFrom($validFrom)
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
     * @return PricingPlansRelCompanyDTO
     */
    public function setValidTo($validTo)
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
     * @return PricingPlansRelCompanyDTO
     */
    public function setMetric($metric)
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
     * @return PricingPlansRelCompanyDTO
     */
    public function setId($id)
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
     * @param integer $pricingPlanId
     *
     * @return PricingPlansRelCompanyDTO
     */
    public function setPricingPlanId($pricingPlanId)
    {
        $this->pricingPlanId = $pricingPlanId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPricingPlanId()
    {
        return $this->pricingPlanId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlan
     */
    public function getPricingPlan()
    {
        return $this->pricingPlan;
    }

    /**
     * @param integer $companyId
     *
     * @return PricingPlansRelCompanyDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $brandId
     *
     * @return PricingPlansRelCompanyDTO
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
}

