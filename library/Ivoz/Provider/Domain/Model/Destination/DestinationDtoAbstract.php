<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto;

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
     * @var string | null
     */
    private $nameEn;

    /**
     * @var string | null
     */
    private $nameEs;

    /**
     * @var string | null
     */
    private $nameCa;

    /**
     * @var string | null
     */
    private $nameIt;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var DestinationRateDto[] | null
     */
    private $destinationRates;

    /**
     * @var TpDestinationDto | null
     */
    private $tpDestination;

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
            'tpDestinationId' => 'tpDestination',
            'brandId' => 'brand'
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
            'tpDestination' => $this->getTpDestination(),
            'brand' => $this->getBrand(),
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

    /**
     * @param string $prefix | null
     *
     * @return static
     */
    public function setPrefix(?string $prefix = null): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
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
     * @param string $nameEn | null
     *
     * @return static
     */
    public function setNameEn(?string $nameEn = null): self
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs | null
     *
     * @return static
     */
    public function setNameEs(?string $nameEs = null): self
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEs(): ?string
    {
        return $this->nameEs;
    }

    /**
     * @param string $nameCa | null
     *
     * @return static
     */
    public function setNameCa(?string $nameCa = null): self
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameCa(): ?string
    {
        return $this->nameCa;
    }

    /**
     * @param string $nameIt | null
     *
     * @return static
     */
    public function setNameIt(?string $nameIt = null): self
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameIt(): ?string
    {
        return $this->nameIt;
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
     * @param DestinationRateDto[] | null
     *
     * @return static
     */
    public function setDestinationRates(?array $destinationRates = null): self
    {
        $this->destinationRates = $destinationRates;

        return $this;
    }

    /**
     * @return DestinationRateDto[] | null
     */
    public function getDestinationRates(): ?array
    {
        return $this->destinationRates;
    }

    /**
     * @param TpDestinationDto | null
     *
     * @return static
     */
    public function setTpDestination(?TpDestinationDto $tpDestination = null): self
    {
        $this->tpDestination = $tpDestination;

        return $this;
    }

    /**
     * @return TpDestinationDto | null
     */
    public function getTpDestination(): ?TpDestinationDto
    {
        return $this->tpDestination;
    }

    /**
     * @return static
     */
    public function setTpDestinationId($id): self
    {
        $value = !is_null($id)
            ? new TpDestinationDto($id)
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
}
