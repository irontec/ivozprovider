<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;

/**
* RoutingPatternDtoAbstract
* @codeCoverageIgnore
*/
abstract class RoutingPatternDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $prefix = '';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nameEn = '';

    /**
     * @var string
     */
    private $nameEs = '';

    /**
     * @var string
     */
    private $nameCa = '';

    /**
     * @var string
     */
    private $nameIt = '';

    /**
     * @var string|null
     */
    private $descriptionEn;

    /**
     * @var string|null
     */
    private $descriptionEs;

    /**
     * @var string|null
     */
    private $descriptionCa;

    /**
     * @var string|null
     */
    private $descriptionIt;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var OutgoingRoutingDto[] | null
     */
    private $outgoingRoutings;

    /**
     * @var RoutingPatternGroupsRelPatternDto[] | null
     */
    private $relPatternGroups;

    /**
     * @var TrunksLcrRuleDto[] | null
     */
    private $lcrRules;

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
            'description' => [
                'en',
                'es',
                'ca',
                'it',
            ],
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
            'description' => [
                'en' => $this->getDescriptionEn(),
                'es' => $this->getDescriptionEs(),
                'ca' => $this->getDescriptionCa(),
                'it' => $this->getDescriptionIt(),
            ],
            'brand' => $this->getBrand(),
            'outgoingRoutings' => $this->getOutgoingRoutings(),
            'relPatternGroups' => $this->getRelPatternGroups(),
            'lcrRules' => $this->getLcrRules()
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

    public function setPrefix(?string $prefix): static
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

    public function setDescriptionEn(?string $descriptionEn): static
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEs(?string $descriptionEs): static
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    public function getDescriptionEs(): ?string
    {
        return $this->descriptionEs;
    }

    public function setDescriptionCa(?string $descriptionCa): static
    {
        $this->descriptionCa = $descriptionCa;

        return $this;
    }

    public function getDescriptionCa(): ?string
    {
        return $this->descriptionCa;
    }

    public function setDescriptionIt(?string $descriptionIt): static
    {
        $this->descriptionIt = $descriptionIt;

        return $this;
    }

    public function getDescriptionIt(): ?string
    {
        return $this->descriptionIt;
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

    public function setOutgoingRoutings(?array $outgoingRoutings): static
    {
        $this->outgoingRoutings = $outgoingRoutings;

        return $this;
    }

    public function getOutgoingRoutings(): ?array
    {
        return $this->outgoingRoutings;
    }

    public function setRelPatternGroups(?array $relPatternGroups): static
    {
        $this->relPatternGroups = $relPatternGroups;

        return $this;
    }

    public function getRelPatternGroups(): ?array
    {
        return $this->relPatternGroups;
    }

    public function setLcrRules(?array $lcrRules): static
    {
        $this->lcrRules = $lcrRules;

        return $this;
    }

    public function getLcrRules(): ?array
    {
        return $this->lcrRules;
    }
}
