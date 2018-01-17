<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
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
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'code' => 'code',
            'id' => 'id',
            'brand' => 'brand',
            'service' => 'service'
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'code' => $this->getCode(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'service' => $this->getService()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->service = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Service\\Service', $this->getServiceId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

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
     * @return string
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
     * @return integer
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
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

        /**
         * @param integer $id | null
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
         * @return integer | null
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
     * @return \Ivoz\Provider\Domain\Model\Service\ServiceDto
     */
    public function getService()
    {
        return $this->service;
    }

        /**
         * @param integer $id | null
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
         * @return integer | null
         */
        public function getServiceId()
        {
            if ($dto = $this->getService()) {
                return $dto->getId();
            }

            return null;
        }
}


