<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetDto;
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
     * @var string|null
     */
    private $description = '';

    /**
     * @var string|null
     */
    private $name = null;

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
     * @var ProxyTrunkDto | null
     */
    private $proxyTrunk = null;

    /**
     * @var MediaRelaySetDto | null
     */
    private $mediaRelaySets = null;

    /**
     * @var MediaRelaySetDto | null
     */
    private $mediaRelaySet = null;

    /**
     * @var DdiProviderRegistrationDto[] | null
     */
    private $ddiProviderRegistrations = null;

    /**
     * @var DdiProviderAddressDto[] | null
     */
    private $ddiProviderAddresses = null;

    public function __construct(?int $id = null)
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
            'id' => 'id',
            'brandId' => 'brand',
            'transformationRuleSetId' => 'transformationRuleSet',
            'proxyTrunkId' => 'proxyTrunk',
            'mediaRelaySetsId' => 'mediaRelaySets',
            'mediaRelaySetId' => 'mediaRelaySet'
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
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'proxyTrunk' => $this->getProxyTrunk(),
            'mediaRelaySets' => $this->getMediaRelaySets(),
            'mediaRelaySet' => $this->getMediaRelaySet(),
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

    /**
     * @param int|null $id
     */
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

    public function setBrandId(?int $id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId(): ?int
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

    public function setTransformationRuleSetId(?int $id): static
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    public function getTransformationRuleSetId(): ?int
    {
        if ($dto = $this->getTransformationRuleSet()) {
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

    public function setProxyTrunkId(?int $id): static
    {
        $value = !is_null($id)
            ? new ProxyTrunkDto($id)
            : null;

        return $this->setProxyTrunk($value);
    }

    public function getProxyTrunkId(): ?int
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

    public function setMediaRelaySetsId(?int $id): static
    {
        $value = !is_null($id)
            ? new MediaRelaySetDto($id)
            : null;

        return $this->setMediaRelaySets($value);
    }

    public function getMediaRelaySetsId(): ?int
    {
        if ($dto = $this->getMediaRelaySets()) {
            return $dto->getId();
        }

        return null;
    }

    public function setMediaRelaySet(?MediaRelaySetDto $mediaRelaySet): static
    {
        $this->mediaRelaySet = $mediaRelaySet;

        return $this;
    }

    public function getMediaRelaySet(): ?MediaRelaySetDto
    {
        return $this->mediaRelaySet;
    }

    public function setMediaRelaySetId(?int $id): static
    {
        $value = !is_null($id)
            ? new MediaRelaySetDto($id)
            : null;

        return $this->setMediaRelaySet($value);
    }

    public function getMediaRelaySetId(): ?int
    {
        if ($dto = $this->getMediaRelaySet()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DdiProviderRegistrationDto[] | null $ddiProviderRegistrations
     */
    public function setDdiProviderRegistrations(?array $ddiProviderRegistrations): static
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
     * @param DdiProviderAddressDto[] | null $ddiProviderAddresses
     */
    public function setDdiProviderAddresses(?array $ddiProviderAddresses): static
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
