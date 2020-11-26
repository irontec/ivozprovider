<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto;

/**
* ProxyTrunksRelBrandDtoAbstract
* @codeCoverageIgnore
*/
abstract class ProxyTrunksRelBrandDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var ProxyTrunkDto | null
     */
    private $proxyTrunk;

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
            'id' => 'id',
            'brandId' => 'brand',
            'proxyTrunkId' => 'proxyTrunk'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'proxyTrunk' => $this->getProxyTrunk()
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

}
