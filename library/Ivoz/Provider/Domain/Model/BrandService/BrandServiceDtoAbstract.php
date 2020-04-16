<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class BrandServiceDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Service\ServiceDto | null
     */
    private $service;


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
            'code' => 'code',
            'id' => 'id',
            'brandId' => 'brand',
            'serviceId' => 'service'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'code' => $this->getCode(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'service' => $this->getService()
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
     * @param string $code
     *
     * @return static
     */
    public function setCode($code = null)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCode()
    {
        return $this->code;
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
     * @param \Ivoz\Provider\Domain\Model\Service\ServiceDto $service
     *
     * @return static
     */
    public function setService(\Ivoz\Provider\Domain\Model\Service\ServiceDto $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Service\ServiceDto | null
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setServiceId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Service\ServiceDto($id)
            : null;

        return $this->setService($value);
    }

    /**
     * @return mixed | null
     */
    public function getServiceId()
    {
        if ($dto = $this->getService()) {
            return $dto->getId();
        }

        return null;
    }
}
