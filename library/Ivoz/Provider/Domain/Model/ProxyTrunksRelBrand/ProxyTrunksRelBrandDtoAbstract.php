<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ProxyTrunksRelBrandDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkDto | null
     */
    private $proxyTrunk;


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
        return [
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'proxyTrunk' => $this->getProxyTrunk()
        ];
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
}
