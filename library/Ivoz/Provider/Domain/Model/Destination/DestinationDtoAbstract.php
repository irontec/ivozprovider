<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto;

/**
* DestinationDtoAbstract
* @codeCoverageIgnore
*/
abstract class DestinationDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $nameEn;

    /**
     * @var string|null
     */
    private $nameEs;

    /**
     * @var string|null
     */
    private $nameCa;

    /**
     * @var string|null
     */
    private $nameIt;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var TpDestinationDto | null
     */
    private $tpDestination;

    /**
     * @var DestinationRateDto[] | null
     */
    private $destinationRates;

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
            'name' => [
                'en',
                'es',
                'ca',
                'it',
            ],
            'brandId' => 'brand',
            'tpDestinationId' => 'tpDestination'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'prefix' => $this->getPrefix(),
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs(),
                'ca' => $this->getNameCa(),
                'it' => $this->getNameIt(),
            ],
            'brand' => $this->getBrand(),
            'tpDestination' => $this->getTpDestination(),
            'destinationRates' => $this->getDestinationRates()
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

    public function setPrefix(string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNameEn(?string $nameEn): static
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    public function setNameEs(?string $nameEs): static
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    public function getNameEs(): ?string
    {
        return $this->nameEs;
    }

    public function setNameCa(?string $nameCa): static
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    public function getNameCa(): ?string
    {
        return $this->nameCa;
    }

    public function setNameIt(?string $nameIt): static
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    public function getNameIt(): ?string
    {
        return $this->nameIt;
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

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTpDestination(?TpDestinationDto $tpDestination): static
    {
        $this->tpDestination = $tpDestination;

        return $this;
    }

    public function getTpDestination(): ?TpDestinationDto
    {
        return $this->tpDestination;
    }

    public function setTpDestinationId($id): static
    {
        $value = !is_null($id)
            ? new TpDestinationDto($id)
            : null;

        return $this->setTpDestination($value);
    }

    public function getTpDestinationId()
    {
        if ($dto = $this->getTpDestination()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDestinationRates(?array $destinationRates): static
    {
        $this->destinationRates = $destinationRates;

        return $this;
    }

    public function getDestinationRates(): ?array
    {
        return $this->destinationRates;
    }
}
