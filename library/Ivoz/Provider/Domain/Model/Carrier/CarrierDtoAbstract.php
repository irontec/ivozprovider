<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\Currency\CurrencyDto;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto;
use Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatDto;

/**
* CarrierDtoAbstract
* @codeCoverageIgnore
*/
abstract class CarrierDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $description = '';

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var float|null
     */
    private $balance = 0;

    /**
     * @var bool|null
     */
    private $calculateCost = false;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var TransformationRuleSetDto | null
     */
    private $transformationRuleSet = null;

    /**
     * @var CurrencyDto | null
     */
    private $currency = null;

    /**
     * @var ProxyTrunkDto | null
     */
    private $proxyTrunk = null;

    /**
     * @var MediaRelaySetDto | null
     */
    private $mediaRelaySets = null;

    /**
     * @var OutgoingRoutingDto[] | null
     */
    private $outgoingRoutings = null;

    /**
     * @var OutgoingRoutingRelCarrierDto[] | null
     */
    private $outgoingRoutingsRelCarriers = null;

    /**
     * @var CarrierServerDto[] | null
     */
    private $servers = null;

    /**
     * @var RatingProfileDto[] | null
     */
    private $ratingProfiles = null;

    /**
     * @var TpCdrStatDto[] | null
     */
    private $tpCdrStats = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'description' => 'description',
            'name' => 'name',
            'balance' => 'balance',
            'calculateCost' => 'calculateCost',
            'id' => 'id',
            'brandId' => 'brand',
            'transformationRuleSetId' => 'transformationRuleSet',
            'currencyId' => 'currency',
            'proxyTrunkId' => 'proxyTrunk',
            'mediaRelaySetsId' => 'mediaRelaySets'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'description' => $this->getDescription(),
            'name' => $this->getName(),
            'balance' => $this->getBalance(),
            'calculateCost' => $this->getCalculateCost(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'currency' => $this->getCurrency(),
            'proxyTrunk' => $this->getProxyTrunk(),
            'mediaRelaySets' => $this->getMediaRelaySets(),
            'outgoingRoutings' => $this->getOutgoingRoutings(),
            'outgoingRoutingsRelCarriers' => $this->getOutgoingRoutingsRelCarriers(),
            'servers' => $this->getServers(),
            'ratingProfiles' => $this->getRatingProfiles(),
            'tpCdrStats' => $this->getTpCdrStats()
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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setBalance(?float $balance): static
    {
        $this->balance = $balance;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setCalculateCost(?bool $calculateCost): static
    {
        $this->calculateCost = $calculateCost;

        return $this;
    }

    public function getCalculateCost(): ?bool
    {
        return $this->calculateCost;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
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

    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet): static
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    public function setTransformationRuleSetId($id): static
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCurrency(?CurrencyDto $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrency(): ?CurrencyDto
    {
        return $this->currency;
    }

    public function setCurrencyId($id): static
    {
        $value = !is_null($id)
            ? new CurrencyDto($id)
            : null;

        return $this->setCurrency($value);
    }

    public function getCurrencyId()
    {
        if ($dto = $this->getCurrency()) {
            return $dto->getId();
        }

        return null;
    }

    public function setProxyTrunk(?ProxyTrunkDto $proxyTrunk): static
    {
        $this->proxyTrunk = $proxyTrunk;

        return $this;
    }

    public function getProxyTrunk(): ?ProxyTrunkDto
    {
        return $this->proxyTrunk;
    }

    public function setProxyTrunkId($id): static
    {
        $value = !is_null($id)
            ? new ProxyTrunkDto($id)
            : null;

        return $this->setProxyTrunk($value);
    }

    public function getProxyTrunkId()
    {
        if ($dto = $this->getProxyTrunk()) {
            return $dto->getId();
        }

        return null;
    }

    public function setMediaRelaySets(?MediaRelaySetDto $mediaRelaySets): static
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    public function getMediaRelaySets(): ?MediaRelaySetDto
    {
        return $this->mediaRelaySets;
    }

    public function setMediaRelaySetsId($id): static
    {
        $value = !is_null($id)
            ? new MediaRelaySetDto($id)
            : null;

        return $this->setMediaRelaySets($value);
    }

    public function getMediaRelaySetsId()
    {
        if ($dto = $this->getMediaRelaySets()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutgoingRoutings(?array $outgoingRoutings): static
    {
        $this->outgoingRoutings = $outgoingRoutings;

        return $this;
    }

    /**
    * @return OutgoingRoutingDto[] | null
    */
    public function getOutgoingRoutings(): ?array
    {
        return $this->outgoingRoutings;
    }

    public function setOutgoingRoutingsRelCarriers(?array $outgoingRoutingsRelCarriers): static
    {
        $this->outgoingRoutingsRelCarriers = $outgoingRoutingsRelCarriers;

        return $this;
    }

    /**
    * @return OutgoingRoutingRelCarrierDto[] | null
    */
    public function getOutgoingRoutingsRelCarriers(): ?array
    {
        return $this->outgoingRoutingsRelCarriers;
    }

    public function setServers(?array $servers): static
    {
        $this->servers = $servers;

        return $this;
    }

    /**
    * @return CarrierServerDto[] | null
    */
    public function getServers(): ?array
    {
        return $this->servers;
    }

    public function setRatingProfiles(?array $ratingProfiles): static
    {
        $this->ratingProfiles = $ratingProfiles;

        return $this;
    }

    /**
    * @return RatingProfileDto[] | null
    */
    public function getRatingProfiles(): ?array
    {
        return $this->ratingProfiles;
    }

    public function setTpCdrStats(?array $tpCdrStats): static
    {
        $this->tpCdrStats = $tpCdrStats;

        return $this;
    }

    /**
    * @return TpCdrStatDto[] | null
    */
    public function getTpCdrStats(): ?array
    {
        return $this->tpCdrStats;
    }
}
