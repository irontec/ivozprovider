<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Core\Application\DataTransferObjectInterface;
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
    private $weight = 1;

    /**
     * @var string
     */
    private $routingMode = 'static';

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var boolean
     */
    private $forceClid = '0';

    /**
     * @var string
     */
    private $clid;

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
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    private $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto | null
     */
    private $routingPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto | null
     */
    private $routingPatternGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto | null
     */
    private $routingTag;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $clidCountry;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleDto | null
     */
    private $tpLcrRule;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto[] | null
     */
    private $lcrRules = null;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetDto[] | null
     */
    private $lcrRuleTargets = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto[] | null
     */
    private $relCarriers = null;


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
            'routingMode' => 'routingMode',
            'prefix' => 'prefix',
            'forceClid' => 'forceClid',
            'clid' => 'clid',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'carrierId' => 'carrier',
            'routingPatternId' => 'routingPattern',
            'routingPatternGroupId' => 'routingPatternGroup',
            'routingTagId' => 'routingTag',
            'clidCountryId' => 'clidCountry',
            'tpLcrRuleId' => 'tpLcrRule'
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
            'routingMode' => $this->getRoutingMode(),
            'prefix' => $this->getPrefix(),
            'forceClid' => $this->getForceClid(),
            'clid' => $this->getClid(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier(),
            'routingPattern' => $this->getRoutingPattern(),
            'routingPatternGroup' => $this->getRoutingPatternGroup(),
            'routingTag' => $this->getRoutingTag(),
            'clidCountry' => $this->getClidCountry(),
            'tpLcrRule' => $this->getTpLcrRule(),
            'lcrRules' => $this->getLcrRules(),
            'lcrRuleTargets' => $this->getLcrRuleTargets(),
            'relCarriers' => $this->getRelCarriers()
        ];
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
     * @param string $routingMode
     *
     * @return static
     */
    public function setRoutingMode($routingMode = null)
    {
        $this->routingMode = $routingMode;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoutingMode()
    {
        return $this->routingMode;
    }

    /**
     * @param string $prefix
     *
     * @return static
     */
    public function setPrefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param boolean $forceClid
     *
     * @return static
     */
    public function setForceClid($forceClid = null)
    {
        $this->forceClid = $forceClid;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getForceClid()
    {
        return $this->forceClid;
    }

    /**
     * @param string $clid
     *
     * @return static
     */
    public function setClid($clid = null)
    {
        $this->clid = $clid;

        return $this;
    }

    /**
     * @return string
     */
    public function getClid()
    {
        return $this->clid;
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
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierDto
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCarrierId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Carrier\CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return integer | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
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
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto $routingTag
     *
     * @return static
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto $routingTag = null)
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto
     */
    public function getRoutingTag()
    {
        return $this->routingTag;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRoutingTagId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto($id)
            : null;

        return $this->setRoutingTag($value);
    }

    /**
     * @return integer | null
     */
    public function getRoutingTagId()
    {
        if ($dto = $this->getRoutingTag()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $clidCountry
     *
     * @return static
     */
    public function setClidCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $clidCountry = null)
    {
        $this->clidCountry = $clidCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getClidCountry()
    {
        return $this->clidCountry;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setClidCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setClidCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getClidCountryId()
    {
        if ($dto = $this->getClidCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleDto $tpLcrRule
     *
     * @return static
     */
    public function setTpLcrRule(\Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleDto $tpLcrRule = null)
    {
        $this->tpLcrRule = $tpLcrRule;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleDto
     */
    public function getTpLcrRule()
    {
        return $this->tpLcrRule;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTpLcrRuleId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleDto($id)
            : null;

        return $this->setTpLcrRule($value);
    }

    /**
     * @return integer | null
     */
    public function getTpLcrRuleId()
    {
        if ($dto = $this->getTpLcrRule()) {
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

    /**
     * @param array $lcrRuleTargets
     *
     * @return static
     */
    public function setLcrRuleTargets($lcrRuleTargets = null)
    {
        $this->lcrRuleTargets = $lcrRuleTargets;

        return $this;
    }

    /**
     * @return array
     */
    public function getLcrRuleTargets()
    {
        return $this->lcrRuleTargets;
    }

    /**
     * @param array $relCarriers
     *
     * @return static
     */
    public function setRelCarriers($relCarriers = null)
    {
        $this->relCarriers = $relCarriers;

        return $this;
    }

    /**
     * @return array
     */
    public function getRelCarriers()
    {
        return $this->relCarriers;
    }
}
