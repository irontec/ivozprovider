<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto;

/**
* TpDestinationRateDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpDestinationRateDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string | null
     */
    private $tag;

    /**
     * @var string | null
     */
    private $destinationsTag;

    /**
     * @var string | null
     */
    private $ratesTag;

    /**
     * @var string
     */
    private $roundingMethod = '*up';

    /**
     * @var int
     */
    private $roundingDecimals = 4;

    /**
     * @var float
     */
    private $maxCost = 0;

    /**
     * @var string
     */
    private $maxCostStrategy = '';

    /**
     * @var \DateTimeInterface
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     */
    private $id;

    /**
     * @var DestinationRateDto | null
     */
    private $destinationRate;

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
            'tpid' => 'tpid',
            'tag' => 'tag',
            'destinationsTag' => 'destinationsTag',
            'ratesTag' => 'ratesTag',
            'roundingMethod' => 'roundingMethod',
            'roundingDecimals' => 'roundingDecimals',
            'maxCost' => 'maxCost',
            'maxCostStrategy' => 'maxCostStrategy',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'destinationRateId' => 'destinationRate'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'tpid' => $this->getTpid(),
            'tag' => $this->getTag(),
            'destinationsTag' => $this->getDestinationsTag(),
            'ratesTag' => $this->getRatesTag(),
            'roundingMethod' => $this->getRoundingMethod(),
            'roundingDecimals' => $this->getRoundingDecimals(),
            'maxCost' => $this->getMaxCost(),
            'maxCostStrategy' => $this->getMaxCostStrategy(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'destinationRate' => $this->getDestinationRate()
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
     * @param string $tpid | null
     *
     * @return static
     */
    public function setTpid(?string $tpid = null): self
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    /**
     * @param string $tag | null
     *
     * @return static
     */
    public function setTag(?string $tag = null): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param string $destinationsTag | null
     *
     * @return static
     */
    public function setDestinationsTag(?string $destinationsTag = null): self
    {
        $this->destinationsTag = $destinationsTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestinationsTag(): ?string
    {
        return $this->destinationsTag;
    }

    /**
     * @param string $ratesTag | null
     *
     * @return static
     */
    public function setRatesTag(?string $ratesTag = null): self
    {
        $this->ratesTag = $ratesTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRatesTag(): ?string
    {
        return $this->ratesTag;
    }

    /**
     * @param string $roundingMethod | null
     *
     * @return static
     */
    public function setRoundingMethod(?string $roundingMethod = null): self
    {
        $this->roundingMethod = $roundingMethod;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRoundingMethod(): ?string
    {
        return $this->roundingMethod;
    }

    /**
     * @param int $roundingDecimals | null
     *
     * @return static
     */
    public function setRoundingDecimals(?int $roundingDecimals = null): self
    {
        $this->roundingDecimals = $roundingDecimals;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getRoundingDecimals(): ?int
    {
        return $this->roundingDecimals;
    }

    /**
     * @param float $maxCost | null
     *
     * @return static
     */
    public function setMaxCost(?float $maxCost = null): self
    {
        $this->maxCost = $maxCost;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getMaxCost(): ?float
    {
        return $this->maxCost;
    }

    /**
     * @param string $maxCostStrategy | null
     *
     * @return static
     */
    public function setMaxCostStrategy(?string $maxCostStrategy = null): self
    {
        $this->maxCostStrategy = $maxCostStrategy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMaxCostStrategy(): ?string
    {
        return $this->maxCostStrategy;
    }

    /**
     * @param \DateTimeInterface $createdAt | null
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * @param DestinationRateDto | null
     *
     * @return static
     */
    public function setDestinationRate(?DestinationRateDto $destinationRate = null): self
    {
        $this->destinationRate = $destinationRate;

        return $this;
    }

    /**
     * @return DestinationRateDto | null
     */
    public function getDestinationRate(): ?DestinationRateDto
    {
        return $this->destinationRate;
    }

    /**
     * @return static
     */
    public function setDestinationRateId($id): self
    {
        $value = !is_null($id)
            ? new DestinationRateDto($id)
            : null;

        return $this->setDestinationRate($value);
    }

    /**
     * @return mixed | null
     */
    public function getDestinationRateId()
    {
        if ($dto = $this->getDestinationRate()) {
            return $dto->getId();
        }

        return null;
    }

}
