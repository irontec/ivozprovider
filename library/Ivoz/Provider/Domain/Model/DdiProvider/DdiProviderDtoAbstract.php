<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressDto;

/**
* DdiProviderDtoAbstract
* @codeCoverageIgnore
*/
abstract class DdiProviderDtoAbstract implements DataTransferObjectInterface
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
     * @var ProxyTrunkDto | null
     */
    private $proxyTrunk;

    /**
     * @var DdiProviderRegistrationDto[] | null
     */
    private $ddiProviderRegistrations;

    /**
     * @var DdiProviderAddressDto[] | null
     */
    private $ddiProviderAddresses;

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
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'proxyTrunk' => $this->getProxyTrunk(),
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
     * @param DdiProviderRegistrationDto[] | null
     *
     * @return static
     */
    public function setDdiProviderRegistrations(?array $ddiProviderRegistrations = null): self
    {
        $this->ddiProviderRegistrations = $ddiProviderRegistrations;

        return $this;
    }

    /**
     * @return DdiProviderRegistrationDto[] | null
     */
    public function getDdiProviderRegistrations(): ?array
    {
        return $this->ddiProviderRegistrations;
    }

    /**
     * @param DdiProviderAddressDto[] | null
     *
     * @return static
     */
    public function setDdiProviderAddresses(?array $ddiProviderAddresses = null): self
    {
        $this->ddiProviderAddresses = $ddiProviderAddresses;

        return $this;
    }

    /**
     * @return DdiProviderAddressDto[] | null
     */
    public function getDdiProviderAddresses(): ?array
    {
        return $this->ddiProviderAddresses;
    }

}
