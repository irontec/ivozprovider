<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class OutgoingRoutingDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $type = 'group';

    /**
     * @var integer
     */
    private $priority;

    /**
     * @var integer
     */
    private $weight = '1';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto | null
     */
    private $peeringContract;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto | null
     */
    private $routingPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto | null
     */
    private $routingPatternGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleDto[] | null
     */
    private $lcrRules = null;


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
            'type' => 'type',
            'priority' => 'priority',
            'weight' => 'weight',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'peeringContractId' => 'peeringContract',
            'routingPatternId' => 'routingPattern',
            'routingPatternGroupId' => 'routingPatternGroup'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'type' => $this->getType(),
            'priority' => $this->getPriority(),
            'weight' => $this->getWeight(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'peeringContract' => $this->getPeeringContract(),
            'routingPattern' => $this->getRoutingPattern(),
            'routingPatternGroup' => $this->getRoutingPatternGroup(),
            'lcrRules' => $this->getLcrRules()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->peeringContract = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PeeringContract\\PeeringContract', $this->getPeeringContractId());
        $this->routingPattern = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\RoutingPattern\\RoutingPattern', $this->getRoutingPatternId());
        $this->routingPatternGroup = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\RoutingPatternGroup\\RoutingPatternGroup', $this->getRoutingPatternGroupId());
        if (!is_null($this->lcrRules)) {
            $items = $this->getLcrRules();
            $this->lcrRules = [];
            foreach ($items as $item) {
                $this->lcrRules[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\LcrRule\\LcrRule',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->lcrRules = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\LcrRule\\LcrRule',
            $this->lcrRules
        );
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param integer $priority
     *
     * @return static
     */
    public function setPriority($priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param integer $weight
     *
     * @return static
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
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
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto $peeringContract
     *
     * @return static
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto $peeringContract = null)
    {
        $this->peeringContract = $peeringContract;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setPeeringContractId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto($id)
                : null;

            return $this->setPeeringContract($value);
        }

        /**
         * @return integer | null
         */
        public function getPeeringContractId()
        {
            if ($dto = $this->getPeeringContract()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto $routingPattern
     *
     * @return static
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto $routingPattern = null)
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto
     */
    public function getRoutingPattern()
    {
        return $this->routingPattern;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setRoutingPatternId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto($id)
                : null;

            return $this->setRoutingPattern($value);
        }

        /**
         * @return integer | null
         */
        public function getRoutingPatternId()
        {
            if ($dto = $this->getRoutingPattern()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto $routingPatternGroup
     *
     * @return static
     */
    public function setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto $routingPatternGroup = null)
    {
        $this->routingPatternGroup = $routingPatternGroup;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto
     */
    public function getRoutingPatternGroup()
    {
        return $this->routingPatternGroup;
    }

        /**
         * @param integer $id | null
         *
         * @return static
         */
        public function setRoutingPatternGroupId($id)
        {
            $value = !is_null($id)
                ? new \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto($id)
                : null;

            return $this->setRoutingPatternGroup($value);
        }

        /**
         * @return integer | null
         */
        public function getRoutingPatternGroupId()
        {
            if ($dto = $this->getRoutingPatternGroup()) {
                return $dto->getId();
            }

            return null;
        }

    /**
     * @param array $lcrRules
     *
     * @return static
     */
    public function setLcrRules($lcrRules = null)
    {
        $this->lcrRules = $lcrRules;

        return $this;
    }

    /**
     * @return array
     */
    public function getLcrRules()
    {
        return $this->lcrRules;
    }
}


