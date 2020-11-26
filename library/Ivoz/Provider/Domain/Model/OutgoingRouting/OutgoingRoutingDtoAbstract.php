<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDto;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetDto;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto;

/**
* OutgoingRoutingDtoAbstract
* @codeCoverageIgnore
*/
abstract class OutgoingRoutingDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string | null
     */
    private $type = 'group';

    /**
     * @var int
     */
    private $priority;

    /**
     * @var int
     */
    private $weight = 1;

    /**
     * @var string | null
     */
    private $routingMode = 'static';

    /**
     * @var string | null
     */
    private $prefix;

    /**
     * @var bool
     */
    private $stopper = false;

    /**
     * @var bool | null
     */
    private $forceClid = false;

    /**
     * @var string | null
     */
    private $clid;

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var CarrierDto | null
     */
    private $carrier;

    /**
     * @var RoutingPatternDto | null
     */
    private $routingPattern;

    /**
     * @var RoutingPatternGroupDto | null
     */
    private $routingPatternGroup;

    /**
     * @var RoutingTagDto | null
     */
    private $routingTag;

    /**
     * @var CountryDto | null
     */
    private $clidCountry;

    /**
     * @var TpLcrRuleDto | null
     */
    private $tpLcrRule;

    /**
     * @var TrunksLcrRuleDto[] | null
     */
    private $lcrRules;

    /**
     * @var TrunksLcrRuleTargetDto[] | null
     */
    private $lcrRuleTargets;

    /**
     * @var OutgoingRoutingRelCarrierDto[] | null
     */
    private $relCarriers;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
            'stopper' => 'stopper',
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
        $response = [
            'type' => $this->getType(),
            'priority' => $this->getPriority(),
            'weight' => $this->getWeight(),
            'routingMode' => $this->getRoutingMode(),
            'prefix' => $this->getPrefix(),
            'stopper' => $this->getStopper(),
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

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $type | null
     *
     * @return static
     */
    public function setType(?string $type = null): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param int $priority | null
     *
     * @return static
     */
    public function setPriority(?int $priority = null): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param int $weight | null
     *
     * @return static
     */
    public function setWeight(?int $weight = null): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param string $routingMode | null
     *
     * @return static
     */
    public function setRoutingMode(?string $routingMode = null): self
    {
        $this->routingMode = $routingMode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRoutingMode(): ?string
    {
        return $this->routingMode;
    }

    /**
     * @param string $prefix | null
     *
     * @return static
     */
    public function setPrefix(?string $prefix = null): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param bool $stopper | null
     *
     * @return static
     */
    public function setStopper(?bool $stopper = null): self
    {
        $this->stopper = $stopper;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getStopper(): ?bool
    {
        return $this->stopper;
    }

    /**
     * @param bool $forceClid | null
     *
     * @return static
     */
    public function setForceClid(?bool $forceClid = null): self
    {
        $this->forceClid = $forceClid;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getForceClid(): ?bool
    {
        return $this->forceClid;
    }

    /**
     * @param string $clid | null
     *
     * @return static
     */
    public function setClid(?string $clid = null): self
    {
        $this->clid = $clid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getClid(): ?string
    {
        return $this->clid;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CarrierDto | null
     *
     * @return static
     */
    public function setCarrier(?CarrierDto $carrier = null): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return CarrierDto | null
     */
    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    /**
     * @return static
     */
    public function setCarrierId($id): self
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return mixed | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RoutingPatternDto | null
     *
     * @return static
     */
    public function setRoutingPattern(?RoutingPatternDto $routingPattern = null): self
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    /**
     * @return RoutingPatternDto | null
     */
    public function getRoutingPattern(): ?RoutingPatternDto
    {
        return $this->routingPattern;
    }

    /**
     * @return static
     */
    public function setRoutingPatternId($id): self
    {
        $value = !is_null($id)
            ? new RoutingPatternDto($id)
            : null;

        return $this->setRoutingPattern($value);
    }

    /**
     * @return mixed | null
     */
    public function getRoutingPatternId()
    {
        if ($dto = $this->getRoutingPattern()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RoutingPatternGroupDto | null
     *
     * @return static
     */
    public function setRoutingPatternGroup(?RoutingPatternGroupDto $routingPatternGroup = null): self
    {
        $this->routingPatternGroup = $routingPatternGroup;

        return $this;
    }

    /**
     * @return RoutingPatternGroupDto | null
     */
    public function getRoutingPatternGroup(): ?RoutingPatternGroupDto
    {
        return $this->routingPatternGroup;
    }

    /**
     * @return static
     */
    public function setRoutingPatternGroupId($id): self
    {
        $value = !is_null($id)
            ? new RoutingPatternGroupDto($id)
            : null;

        return $this->setRoutingPatternGroup($value);
    }

    /**
     * @return mixed | null
     */
    public function getRoutingPatternGroupId()
    {
        if ($dto = $this->getRoutingPatternGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RoutingTagDto | null
     *
     * @return static
     */
    public function setRoutingTag(?RoutingTagDto $routingTag = null): self
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    /**
     * @return RoutingTagDto | null
     */
    public function getRoutingTag(): ?RoutingTagDto
    {
        return $this->routingTag;
    }

    /**
     * @return static
     */
    public function setRoutingTagId($id): self
    {
        $value = !is_null($id)
            ? new RoutingTagDto($id)
            : null;

        return $this->setRoutingTag($value);
    }

    /**
     * @return mixed | null
     */
    public function getRoutingTagId()
    {
        if ($dto = $this->getRoutingTag()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setClidCountry(?CountryDto $clidCountry = null): self
    {
        $this->clidCountry = $clidCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getClidCountry(): ?CountryDto
    {
        return $this->clidCountry;
    }

    /**
     * @return static
     */
    public function setClidCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setClidCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getClidCountryId()
    {
        if ($dto = $this->getClidCountry()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TpLcrRuleDto | null
     *
     * @return static
     */
    public function setTpLcrRule(?TpLcrRuleDto $tpLcrRule = null): self
    {
        $this->tpLcrRule = $tpLcrRule;

        return $this;
    }

    /**
     * @return TpLcrRuleDto | null
     */
    public function getTpLcrRule(): ?TpLcrRuleDto
    {
        return $this->tpLcrRule;
    }

    /**
     * @return static
     */
    public function setTpLcrRuleId($id): self
    {
        $value = !is_null($id)
            ? new TpLcrRuleDto($id)
            : null;

        return $this->setTpLcrRule($value);
    }

    /**
     * @return mixed | null
     */
    public function getTpLcrRuleId()
    {
        if ($dto = $this->getTpLcrRule()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TrunksLcrRuleDto[] | null
     *
     * @return static
     */
    public function setLcrRules(?array $lcrRules = null): self
    {
        $this->lcrRules = $lcrRules;

        return $this;
    }

    /**
     * @return TrunksLcrRuleDto[] | null
     */
    public function getLcrRules(): ?array
    {
        return $this->lcrRules;
    }

    /**
     * @param TrunksLcrRuleTargetDto[] | null
     *
     * @return static
     */
    public function setLcrRuleTargets(?array $lcrRuleTargets = null): self
    {
        $this->lcrRuleTargets = $lcrRuleTargets;

        return $this;
    }

    /**
     * @return TrunksLcrRuleTargetDto[] | null
     */
    public function getLcrRuleTargets(): ?array
    {
        return $this->lcrRuleTargets;
    }

    /**
     * @param OutgoingRoutingRelCarrierDto[] | null
     *
     * @return static
     */
    public function setRelCarriers(?array $relCarriers = null): self
    {
        $this->relCarriers = $relCarriers;

        return $this;
    }

    /**
     * @return OutgoingRoutingRelCarrierDto[] | null
     */
    public function getRelCarriers(): ?array
    {
        return $this->relCarriers;
    }

}
