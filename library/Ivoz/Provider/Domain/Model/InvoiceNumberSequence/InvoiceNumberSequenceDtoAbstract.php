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
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $prefix = '';

    /**
     * @var int
     */
    private $sequenceLength;

    /**
     * @var int
     */
    private $increment;

    /**
     * @var string | null
     */
    private $latestValue = '';

    /**
     * @var int
     */
    private $iteration = 0;

    /**
     * @var int
     */
    private $version = 1;

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
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
     * @param int $sequenceLength | null
     *
     * @return static
     */
    public function setSequenceLength(?int $sequenceLength = null): self
    {
        $this->sequenceLength = $sequenceLength;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getSequenceLength(): ?int
    {
        return $this->sequenceLength;
    }

    /**
     * @param int $increment | null
     *
     * @return static
     */
    public function setIncrement(?int $increment = null): self
    {
        $this->increment = $increment;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getIncrement(): ?int
    {
        return $this->increment;
    }

    /**
     * @param string $latestValue | null
     *
     * @return static
     */
    public function setLatestValue(?string $latestValue = null): self
    {
        $this->latestValue = $latestValue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLatestValue(): ?string
    {
        return $this->latestValue;
    }

    /**
     * @param int $iteration | null
     *
     * @return static
     */
    public function setIteration(?int $iteration = null): self
    {
        $this->iteration = $iteration;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getIteration(): ?int
    {
        return $this->iteration;
    }

    /**
     * @param int $version | null
     *
     * @return static
     */
    public function setVersion(?int $version = null): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getVersion(): ?int
    {
        return $this->version;
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

}
