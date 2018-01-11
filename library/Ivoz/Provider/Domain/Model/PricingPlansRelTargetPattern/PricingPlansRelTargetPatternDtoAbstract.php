<?php

namespace Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class PricingPlansRelTargetPatternDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $connectionCharge;

    /**
     * @var integer
     */
    private $periodTime;

    /**
     * @var string
     */
    private $perPeriodCharge;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\PricingPlan\PricingPlanDto | null
     */
    private $pricingPlan;

    /**
     * @var \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto | null
     */
    private $targetPattern;

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
            'connectionCharge' => 'connectionCharge',
            'periodTime' => 'periodTime',
            'perPeriodCharge' => 'perPeriodCharge',
            'id' => 'id',
            'pricingPlan' => 'pricingPlan',
            'targetPattern' => 'targetPattern',
            'brand' => 'brand'
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'connectionCharge' => $this->getConnectionCharge(),
            'periodTime' => $this->getPeriodTime(),
            'perPeriodCharge' => $this->getPerPeriodCharge(),
            'id' => $this->getId(),
            'pricingPlan' => $this->getPricingPlan(),
            'targetPattern' => $this->getTargetPattern(),
            'brand' => $this->getBrand()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->pricingPlan = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PricingPlan\\PricingPlan', $this->getPricingPlanId());
        $this->targetPattern = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\TargetPattern\\TargetPattern', $this->getTargetPatternId());
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $connectionCharge
     *
     * @return static
     */
    public function setConnectionCharge($connectionCharge = null)
    {
        $this->connectionCharge = $connectionCharge;

        return $this;
    }

    /**
     * @return string
     */
    public function getConnectionCharge()
    {
        return $this->connectionCharge;
    }

    /**
     * @param integer $periodTime
     *
     * @return static
     */
    public function setPeriodTime($periodTime = null)
    {
        $this->periodTime = $periodTime;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPeriodTime()
    {
        return $this->periodTime;
    }

    /**
     * @param string $perPeriodCharge
     *
     * @return static
     */
    public function setPerPeriodCharge($perPeriodCharge = null)
    {
        $this->perPeriodCharge = $perPeriodCharge;

        return $this;
    }

    /**
     * @return string
     */
    public function getPerPeriodCharge()
    {
        return $this->perPeriodCharge;
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
     * @param \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto $targetPattern
     *
     * @return static
     */
    public function setTargetPattern(\Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto $targetPattern = null)
    {
        $this->targetPattern = $targetPattern;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto
     */
    public function getTargetPattern()
    {
        return $this->targetPattern;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setTargetPatternId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\TargetPattern\TargetPatternDto($id)
                : null;

            return $this->setTargetPattern($value);
        }

        /**
         * @return integer | null
         */
        public function getTargetPatternId()
        {
            if ($dto = $this->getTargetPattern()) {
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


