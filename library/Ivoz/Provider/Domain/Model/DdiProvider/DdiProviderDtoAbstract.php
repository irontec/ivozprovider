<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class DdiProviderDtoAbstract implements DataTransferObjectInterface
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
     * @var \Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto | null
     */
    private $proxyTrunk;

    /**
     * @var \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto | null
     */
    private $mediaRelaySets;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto[] | null
     */
    private $ddiProviderRegistrations = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressDto[] | null
     */
    private $ddiProviderAddresses = null;


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
            'id' => 'id',
            'brandId' => 'brand',
            'transformationRuleSetId' => 'transformationRuleSet',
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
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'proxyTrunk' => $this->getProxyTrunk(),
            'mediaRelaySets' => $this->getMediaRelaySets(),
            'ddiProviderRegistrations' => $this->getDdiProviderRegistrations(),
            'ddiProviderAddresses' => $this->getDdiProviderAddresses()
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
     * @param array $ddiProviderRegistrations
     *
     * @return static
     */
    public function setDdiProviderRegistrations($ddiProviderRegistrations = null)
    {
        $this->ddiProviderRegistrations = $ddiProviderRegistrations;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getDdiProviderRegistrations()
    {
        return $this->ddiProviderRegistrations;
    }

    /**
     * @param array $ddiProviderAddresses
     *
     * @return static
     */
    public function setDdiProviderAddresses($ddiProviderAddresses = null)
    {
        $this->ddiProviderAddresses = $ddiProviderAddresses;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getDdiProviderAddresses()
    {
        return $this->ddiProviderAddresses;
    }
}
