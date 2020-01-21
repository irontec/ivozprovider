<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class DestinationDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nameEn;

    /**
     * @var string
     */
    private $nameEs;

    /**
     * @var string
     */
    private $nameCa;

    /**
     * @var string
     */
    private $nameIt;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto | null
     */
    private $tpDestination;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto[] | null
     */
    private $destinationRates = null;


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
            'prefix' => 'prefix',
            'id' => 'id',
            'name' => ['en','es','ca','it'],
            'tpDestinationId' => 'tpDestination',
            'brandId' => 'brand'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'prefix' => $this->getPrefix(),
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs(),
                'ca' => $this->getNameCa(),
                'it' => $this->getNameIt()
            ],
            'tpDestination' => $this->getTpDestination(),
            'brand' => $this->getBrand(),
            'destinationRates' => $this->getDestinationRates()
        ];
    }

    /**
     * @param string $prefix
     *
     * @return static
     */
    public function setPrefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPrefix()
    {
        return $this->prefix;
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
     * @param string $nameEn
     *
     * @return static
     */
    public function setNameEn($nameEn = null)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs
     *
     * @return static
     */
    public function setNameEs($nameEs = null)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }

    /**
     * @param string $nameCa
     *
     * @return static
     */
    public function setNameCa($nameCa = null)
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameCa()
    {
        return $this->nameCa;
    }

    /**
     * @param string $nameIt
     *
     * @return static
     */
    public function setNameIt($nameIt = null)
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameIt()
    {
        return $this->nameIt;
    }

    /**
     * @param \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto $tpDestination
     *
     * @return static
     */
    public function setTpDestination(\Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto $tpDestination = null)
    {
        $this->tpDestination = $tpDestination;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto | null
     */
    public function getTpDestination()
    {
        return $this->tpDestination;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setTpDestinationId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto($id)
            : null;

        return $this->setTpDestination($value);
    }

    /**
     * @return mixed | null
     */
    public function getTpDestinationId()
    {
        if ($dto = $this->getTpDestination()) {
            return $dto->getId();
        }

        return null;
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
     * @param array $destinationRates
     *
     * @return static
     */
    public function setDestinationRates($destinationRates = null)
    {
        $this->destinationRates = $destinationRates;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getDestinationRates()
    {
        return $this->destinationRates;
    }
}
