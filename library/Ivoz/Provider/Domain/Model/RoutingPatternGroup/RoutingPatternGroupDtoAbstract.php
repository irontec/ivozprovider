<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
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
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $description = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var RoutingPatternGroupsRelPatternDto[] | null
     */
    private $relPatterns = null;

    /**
     * @var OutgoingRoutingDto[] | null
     */
    private $outgoingRoutings = null;

    public function __construct(?int $id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
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

    public function setBrandId(?int $id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId(): ?int
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RoutingPatternGroupsRelPatternDto[] | null $relPatterns
     */
    public function setRelPatterns(?array $relPatterns): static
    {
        $this->relPatterns = $relPatterns;

        return $this;
    }

    /**
    * @return RoutingPatternGroupsRelPatternDto[] | null
    */
    public function getRelPatterns(): ?array
    {
        return $this->relPatterns;
    }

    /**
     * @param OutgoingRoutingDto[] | null $outgoingRoutings
     */
    public function setOutgoingRoutings(?array $outgoingRoutings): static
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
}
