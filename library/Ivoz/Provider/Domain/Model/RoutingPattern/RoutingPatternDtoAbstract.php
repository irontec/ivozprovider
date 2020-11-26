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
    private $prefix;

    /**
     * @var int
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
     * @var string | null
     */
    private $descriptionEn;

    /**
     * @var string | null
     */
    private $descriptionEs;

    /**
     * @var string | null
     */
    private $descriptionCa;

    /**
     * @var string | null
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
     * @param string $descriptionEn | null
     *
     * @return static
     */
    public function setDescriptionEn(?string $descriptionEn = null): self
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    /**
     * @param string $descriptionEs | null
     *
     * @return static
     */
    public function setDescriptionEs(?string $descriptionEs = null): self
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEs(): ?string
    {
        return $this->descriptionEs;
    }

    /**
     * @param string $descriptionCa | null
     *
     * @return static
     */
    public function setDescriptionCa(?string $descriptionCa = null): self
    {
        $this->descriptionCa = $descriptionCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionCa(): ?string
    {
        return $this->descriptionCa;
    }

    /**
     * @param string $descriptionIt | null
     *
     * @return static
     */
    public function setDescriptionIt(?string $descriptionIt = null): self
    {
        $this->descriptionIt = $descriptionIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionIt(): ?string
    {
        return $this->descriptionIt;
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
     * @param OutgoingRoutingDto[] | null
     *
     * @return static
     */
    public function setOutgoingRoutings(?array $outgoingRoutings = null): self
    {
        $this->outgoingRoutings = $outgoingRoutings;

        return $this;
    }

    /**
     * @return OutgoingRoutingDto[] | null
     */
    public function getOutgoingRoutings(): ?array
    {
        return $this->outgoingRoutings;
    }

    /**
     * @param RoutingPatternGroupsRelPatternDto[] | null
     *
     * @return static
     */
    public function setRelPatternGroups(?array $relPatternGroups = null): self
    {
        $this->relPatternGroups = $relPatternGroups;

        return $this;
    }

    /**
     * @return RoutingPatternGroupsRelPatternDto[] | null
     */
    public function getRelPatternGroups(): ?array
    {
        return $this->relPatternGroups;
    }

    /**
     * @param TrunksLcrRuleDto[] | null
     *
     * @return static
     */
    public function setLcrRules(?array $lcrRules = null): self
    {
        $this->lcrRules = $lcrRules;

        return $this;
    }

    /**
     * @return TrunksLcrRuleDto[] | null
     */
    public function getLcrRules(): ?array
    {
        return $this->lcrRules;
    }

}
