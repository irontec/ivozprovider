<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Service\ServiceDto;

/**
* BrandServiceDtoAbstract
* @codeCoverageIgnore
*/
abstract class BrandServiceDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $code;

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var ServiceDto | null
     */
    private $service;

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
     * @param string $code | null
     *
     * @return static
     */
    public function setCode(?string $code = null): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCode(): ?string
    {
        return $this->code;
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
     * @param ServiceDto | null
     *
     * @return static
     */
    public function setService(?ServiceDto $service = null): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return ServiceDto | null
     */
    public function getService(): ?ServiceDto
    {
        return $this->service;
    }

    /**
     * @return static
     */
    public function setServiceId($id): self
    {
        $value = !is_null($id)
            ? new ServiceDto($id)
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
