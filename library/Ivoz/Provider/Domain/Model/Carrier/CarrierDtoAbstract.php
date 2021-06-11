<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CarrierDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $description = '';

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $externallyRated = false;

    /**
     * @var float
     */
    private $balance = 0;

    /**
     * @var boolean
     */
    private $calculateCost = false;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto | null
     */
    private $transformationRuleSet;

    /**
     * @var \Ivoz\Provider\Domain\Model\Currency\CurrencyDto | null
     */
    private $currency;

    /**
     * @var \Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto | null
     */
    private $proxyTrunk;

    /**
     * @var \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto | null
     */
    private $mediaRelaySets;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto[] | null
     */
    private $outgoingRoutings = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto[] | null
     */
    private $outgoingRoutingsRelCarriers = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto[] | null
     */
    private $servers = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto[] | null
     */
    private $ratingProfiles = null;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpCdrStat\TpCdrStatDto[] | null
     */
    private $tpCdrStats = null;


    use DtoNormalizer;

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
            'proxyTrunkId' => 'proxyTrunk',
            'mediaRelaySetsId' => 'mediaRelaySets'
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

    /**
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param boolean $externallyRated
     *
     * @return static
     */
    public function setExternallyRated($externallyRated = null)
    {
        $this->externallyRated = $externallyRated;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getExternallyRated()
    {
        return $this->externallyRated;
    }

    /**
     * @param float $balance
     *
     * @return static
     */
    public function setBalance($balance = null)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param boolean $calculateCost
     *
     * @return static
     */
    public function setCalculateCost($calculateCost = null)
    {
        $this->calculateCost = $calculateCost;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getCalculateCost()
    {
        return $this->calculateCost;
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
     * @return integer | null
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
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed | null $id
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
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto $transformationRuleSet
     *
     * @return static
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto | null
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setTransformationRuleSetId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Currency\CurrencyDto $currency
     *
     * @return static
     */
    public function setCurrency(\Ivoz\Provider\Domain\Model\Currency\CurrencyDto $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyDto | null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCurrencyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Currency\CurrencyDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto $proxyTrunk
     *
     * @return static
     */
    public function setProxyTrunk(\Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto $proxyTrunk = null)
    {
        $this->proxyTrunk = $proxyTrunk;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto | null
     */
    public function getProxyTrunk()
    {
        return $this->proxyTrunk;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setProxyTrunkId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto $mediaRelaySets
     *
     * @return static
     */
    public function setMediaRelaySets(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto $mediaRelaySets = null)
    {
        $this->mediaRelaySets = $mediaRelaySets;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto | null
     */
    public function getMediaRelaySets()
    {
        return $this->mediaRelaySets;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setMediaRelaySetsId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto($id)
            : null;

        return $this->setMediaRelaySets($value);
    }

    /**
     * @return mixed | null
     */
    public function getMediaRelaySetsId()
    {
        if ($dto = $this->getMediaRelaySets()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $outgoingRoutings
     *
     * @return static
     */
    public function setOutgoingRoutings($outgoingRoutings = null)
    {
        $this->outgoingRoutings = $outgoingRoutings;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getOutgoingRoutings()
    {
        return $this->outgoingRoutings;
    }

    /**
     * @param array $outgoingRoutingsRelCarriers
     *
     * @return static
     */
    public function setOutgoingRoutingsRelCarriers($outgoingRoutingsRelCarriers = null)
    {
        $this->outgoingRoutingsRelCarriers = $outgoingRoutingsRelCarriers;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getOutgoingRoutingsRelCarriers()
    {
        return $this->outgoingRoutingsRelCarriers;
    }

    /**
     * @param array $servers
     *
     * @return static
     */
    public function setServers($servers = null)
    {
        $this->servers = $servers;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getServers()
    {
        return $this->servers;
    }

    /**
     * @param array $ratingProfiles
     *
     * @return static
     */
    public function setRatingProfiles($ratingProfiles = null)
    {
        $this->ratingProfiles = $ratingProfiles;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getRatingProfiles()
    {
        return $this->ratingProfiles;
    }

    /**
     * @param array $tpCdrStats
     *
     * @return static
     */
    public function setTpCdrStats($tpCdrStats = null)
    {
        $this->tpCdrStats = $tpCdrStats;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getTpCdrStats()
    {
        return $this->tpCdrStats;
    }
}
