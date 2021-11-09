<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;

/**
* RoutingPatternGroupDtoAbstract
* @codeCoverageIgnore
*/
abstract class RoutingPatternGroupDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var RoutingPatternGroupsRelPatternDto[] | null
     */
    private $relPatterns;

    /**
     * @var OutgoingRoutingDto[] | null
     */
    private $outgoingRoutings;

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
            'name' => 'name',
            'description' => 'description',
            'id' => 'id',
            'brandId' => 'brand'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'relPatterns' => $this->getRelPatterns(),
            'outgoingRoutings' => $this->getOutgoingRoutings()
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
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

    public function setRelPatterns(?array $relPatterns): static
    {
        $this->relPatterns = $relPatterns;

        return $this;
    }

    public function getRelPatterns(): ?array
    {
        return $this->relPatterns;
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
}
