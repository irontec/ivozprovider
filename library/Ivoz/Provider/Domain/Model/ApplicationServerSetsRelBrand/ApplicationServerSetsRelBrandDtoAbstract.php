<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetDto;

/**
* ApplicationServerSetsRelBrandDtoAbstract
* @codeCoverageIgnore
*/
abstract class ApplicationServerSetsRelBrandDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var ApplicationServerSetDto | null
     */
    private $applicationServerSet = null;

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
            'id' => 'id',
            'brandId' => 'brand',
            'applicationServerSetId' => 'applicationServerSet'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'applicationServerSet' => $this->getApplicationServerSet()
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

    public function setApplicationServerSet(?ApplicationServerSetDto $applicationServerSet): static
    {
        $this->applicationServerSet = $applicationServerSet;

        return $this;
    }

    public function getApplicationServerSet(): ?ApplicationServerSetDto
    {
        return $this->applicationServerSet;
    }

    public function setApplicationServerSetId(?int $id): static
    {
        $value = !is_null($id)
            ? new ApplicationServerSetDto($id)
            : null;

        return $this->setApplicationServerSet($value);
    }

    public function getApplicationServerSetId(): ?int
    {
        if ($dto = $this->getApplicationServerSet()) {
            return $dto->getId();
        }

        return null;
    }
}
