<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\Currency\CurrencyDto;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto;
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
     * @var string
     */
    private $description = '';

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool | null
     */
    private $externallyRated = false;

    /**
     * @var float | null
     */
    private $balance = 0;

    /**
     * @var bool | null
     */
    private $calculateCost = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var TransformationRuleSetDto | null
     */
    private $transformationRuleSet;

    /**
     * @var CurrencyDto | null
     */
    private $currency;

    /**
     * @var ProxyTrunkDto | null
     */
    private $proxyTrunk;

    /**
     * @var OutgoingRoutingDto[] | null
     */
    private $outgoingRoutings;

    /**
     * @var OutgoingRoutingRelCarrierDto[] | null
     */
    private $outgoingRoutingsRelCarriers;

    /**
     * @var CarrierServerDto[] | null
     */
    private $servers;

    /**
     * @var RatingProfileDto[] | null
     */
    private $ratingProfiles;

    /**
     * @var TpCdrStatDto[] | null
     */
    private $tpCdrStats;

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
            'description' => 'description',
            'name' => 'name',
            'externallyRated' => 'externallyRated',
            'balance' => 'balance',
            'calculateCost' => 'calculateCost',
            'id' => 'id',
            'brandId' => 'brand',
            'transformationRuleSetId' => 'transformationRuleSet',
            'currencyId' => 'currency',
            'proxyTrunkId' => 'proxyTrunk'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'description' => $this->getDescription(),
            'name' => $this->getName(),
            'externallyRated' => $this->getExternallyRated(),
            'balance' => $this->getBalance(),
            'calculateCost' => $this->getCalculateCost(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'currency' => $this->getCurrency(),
            'proxyTrunk' => $this->getProxyTrunk(),
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

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param bool $externallyRated | null
     *
     * @return static
     */
    public function setExternallyRated(?bool $externallyRated = null): self
    {
        $this->externallyRated = $externallyRated;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getExternallyRated(): ?bool
    {
        return $this->externallyRated;
    }

    /**
     * @param float $balance | null
     *
     * @return static
     */
    public function setBalance(?float $balance = null): self
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * @param bool $calculateCost | null
     *
     * @return static
     */
    public function setCalculateCost(?bool $calculateCost = null): self
    {
        $this->calculateCost = $calculateCost;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getCalculateCost(): ?bool
    {
        return $this->calculateCost;
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
     * @param TransformationRuleSetDto | null
     *
     * @return static
     */
    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet = null): self
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * @return TransformationRuleSetDto | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    /**
     * @return static
     */
    public function setTransformationRuleSetId($id): self
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    /**
     * @return mixed | null
     */
    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CurrencyDto | null
     *
     * @return static
     */
    public function setCurrency(?CurrencyDto $currency = null): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return CurrencyDto | null
     */
    public function getCurrency(): ?CurrencyDto
    {
        return $this->currency;
    }

    /**
     * @return static
     */
    public function setCurrencyId($id): self
    {
        $value = !is_null($id)
            ? new CurrencyDto($id)
            : null;

        return $this->setCurrency($value);
    }

    /**
     * @return mixed | null
     */
    public function getCurrencyId()
    {
        if ($dto = $this->getCurrency()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ProxyTrunkDto | null
     *
     * @return static
     */
    public function setProxyTrunk(?ProxyTrunkDto $proxyTrunk = null): self
    {
        $this->proxyTrunk = $proxyTrunk;

        return $this;
    }

    /**
     * @return ProxyTrunkDto | null
     */
    public function getProxyTrunk(): ?ProxyTrunkDto
    {
        return $this->proxyTrunk;
    }

    /**
     * @return static
     */
    public function setProxyTrunkId($id): self
    {
        $value = !is_null($id)
            ? new ProxyTrunkDto($id)
            : null;

        return $this->setProxyTrunk($value);
    }

    /**
     * @return mixed | null
     */
    public function getProxyTrunkId()
    {
        if ($dto = $this->getProxyTrunk()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param OutgoingRoutingDto[] | null
     *
     * @return static
     */
    public function setOutgoingRoutings(?array $outgoingRoutings = null): self
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

    /**
     * @param OutgoingRoutingRelCarrierDto[] | null
     *
     * @return static
     */
    public function setOutgoingRoutingsRelCarriers(?array $outgoingRoutingsRelCarriers = null): self
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

    /**
     * @param CarrierServerDto[] | null
     *
     * @return static
     */
    public function setServers(?array $servers = null): self
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

    /**
     * @param RatingProfileDto[] | null
     *
     * @return static
     */
    public function setRatingProfiles(?array $ratingProfiles = null): self
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

    /**
     * @param TpCdrStatDto[] | null
     *
     * @return static
     */
    public function setTpCdrStats(?array $tpCdrStats = null): self
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
