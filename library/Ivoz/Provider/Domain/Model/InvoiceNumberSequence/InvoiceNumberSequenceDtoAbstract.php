<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;

/**
* InvoiceNumberSequenceDtoAbstract
* @codeCoverageIgnore
*/
abstract class InvoiceNumberSequenceDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $prefix = '';

    /**
     * @var int|null
     */
    private $sequenceLength = null;

    /**
     * @var int|null
     */
    private $increment = null;

    /**
     * @var string|null
     */
    private $latestValue = '';

    /**
     * @var int|null
     */
    private $iteration = 0;

    /**
     * @var int|null
     */
    private $version = 1;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    public function __construct($id = null)
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
            'prefix' => 'prefix',
            'sequenceLength' => 'sequenceLength',
            'increment' => 'increment',
            'latestValue' => 'latestValue',
            'iteration' => 'iteration',
            'version' => 'version',
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
            'prefix' => $this->getPrefix(),
            'sequenceLength' => $this->getSequenceLength(),
            'increment' => $this->getIncrement(),
            'latestValue' => $this->getLatestValue(),
            'iteration' => $this->getIteration(),
            'version' => $this->getVersion(),
            'id' => $this->getId(),
            'brand' => $this->getBrand()
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

    public function setPrefix(string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setSequenceLength(int $sequenceLength): static
    {
        $this->sequenceLength = $sequenceLength;

        return $this;
    }

    public function getSequenceLength(): ?int
    {
        return $this->sequenceLength;
    }

    public function setIncrement(int $increment): static
    {
        $this->increment = $increment;

        return $this;
    }

    public function getIncrement(): ?int
    {
        return $this->increment;
    }

    public function setLatestValue(?string $latestValue): static
    {
        $this->latestValue = $latestValue;

        return $this;
    }

    public function getLatestValue(): ?string
    {
        return $this->latestValue;
    }

    public function setIteration(int $iteration): static
    {
        $this->iteration = $iteration;

        return $this;
    }

    public function getIteration(): ?int
    {
        return $this->iteration;
    }

    public function setVersion(int $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

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
}
