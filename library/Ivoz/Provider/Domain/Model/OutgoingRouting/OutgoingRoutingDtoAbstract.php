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
     * @var string|null
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
     * @var string|null
     */
    private $routingMode = 'static';

    /**
     * @var string|null
     */
    private $prefix;

    /**
     * @var bool
     */
    private $stopper = false;

    /**
     * @var bool|null
     */
    private $forceClid = false;

    /**
     * @var string|null
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

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setPriority(?int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setWeight(?int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setRoutingMode(?string $routingMode): static
    {
        $this->routingMode = $routingMode;

        return $this;
    }

    public function getRoutingMode(): ?string
    {
        return $this->routingMode;
    }

    public function setPrefix(?string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setStopper(?bool $stopper): static
    {
        $this->stopper = $stopper;

        return $this;
    }

    public function getStopper(): ?bool
    {
        return $this->stopper;
    }

    public function setForceClid(?bool $forceClid): static
    {
        $this->forceClid = $forceClid;

        return $this;
    }

    public function getForceClid(): ?bool
    {
        return $this->forceClid;
    }

    public function setClid(?string $clid): static
    {
        $this->clid = $clid;

        return $this;
    }

    public function getClid(): ?string
    {
        return $this->clid;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCarrier(?CarrierDto $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    public function setCarrierId($id): static
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRoutingPattern(?RoutingPatternDto $routingPattern): static
    {
        $this->routingPattern = $routingPattern;

        return $this;
    }

    public function getRoutingPattern(): ?RoutingPatternDto
    {
        return $this->routingPattern;
    }

    public function setRoutingPatternId($id): static
    {
        $value = !is_null($id)
            ? new RoutingPatternDto($id)
            : null;

        return $this->setRoutingPattern($value);
    }

    public function getRoutingPatternId()
    {
        if ($dto = $this->getRoutingPattern()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRoutingPatternGroup(?RoutingPatternGroupDto $routingPatternGroup): static
    {
        $this->routingPatternGroup = $routingPatternGroup;

        return $this;
    }

    public function getRoutingPatternGroup(): ?RoutingPatternGroupDto
    {
        return $this->routingPatternGroup;
    }

    public function setRoutingPatternGroupId($id): static
    {
        $value = !is_null($id)
            ? new RoutingPatternGroupDto($id)
            : null;

        return $this->setRoutingPatternGroup($value);
    }

    public function getRoutingPatternGroupId()
    {
        if ($dto = $this->getRoutingPatternGroup()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRoutingTag(?RoutingTagDto $routingTag): static
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    public function getRoutingTag(): ?RoutingTagDto
    {
        return $this->routingTag;
    }

    public function setRoutingTagId($id): static
    {
        $value = !is_null($id)
            ? new RoutingTagDto($id)
            : null;

        return $this->setRoutingTag($value);
    }

    public function getRoutingTagId()
    {
        if ($dto = $this->getRoutingTag()) {
            return $dto->getId();
        }

        return null;
    }

    public function setClidCountry(?CountryDto $clidCountry): static
    {
        $this->clidCountry = $clidCountry;

        return $this;
    }

    public function getClidCountry(): ?CountryDto
    {
        return $this->clidCountry;
    }

    public function setClidCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setClidCountry($value);
    }

    public function getClidCountryId()
    {
        if ($dto = $this->getClidCountry()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTpLcrRule(?TpLcrRuleDto $tpLcrRule): static
    {
        $this->tpLcrRule = $tpLcrRule;

        return $this;
    }

    public function getTpLcrRule(): ?TpLcrRuleDto
    {
        return $this->tpLcrRule;
    }

    public function setTpLcrRuleId($id): static
    {
        $value = !is_null($id)
            ? new TpLcrRuleDto($id)
            : null;

        return $this->setTpLcrRule($value);
    }

    public function getTpLcrRuleId()
    {
        if ($dto = $this->getTpLcrRule()) {
            return $dto->getId();
        }

        return null;
    }

    public function setLcrRules(?array $lcrRules): static
    {
        $this->lcrRules = $lcrRules;

        return $this;
    }

    public function getLcrRules(): ?array
    {
        return $this->lcrRules;
    }

    public function setLcrRuleTargets(?array $lcrRuleTargets): static
    {
        $this->lcrRuleTargets = $lcrRuleTargets;

        return $this;
    }

    public function getLcrRuleTargets(): ?array
    {
        return $this->lcrRuleTargets;
    }

    public function setRelCarriers(?array $relCarriers): static
    {
        $this->relCarriers = $relCarriers;

        return $this;
    }

    public function getRelCarriers(): ?array
    {
        return $this->relCarriers;
    }

}
