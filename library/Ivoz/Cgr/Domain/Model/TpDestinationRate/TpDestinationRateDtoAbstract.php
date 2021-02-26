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
     * @var string|null
     */
    private $tag;

    /**
     * @var string|null
     */
    private $destinationsTag;

    /**
     * @var string|null
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
     * @var \DateTime|string
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

    public function setTpid(?string $tpid): static
    {
        $this->tpid = $tpid;

        return $this;
    }

    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    public function setTag(?string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setDestinationsTag(?string $destinationsTag): static
    {
        $this->destinationsTag = $destinationsTag;

        return $this;
    }

    public function getDestinationsTag(): ?string
    {
        return $this->destinationsTag;
    }

    public function setRatesTag(?string $ratesTag): static
    {
        $this->ratesTag = $ratesTag;

        return $this;
    }

    public function getRatesTag(): ?string
    {
        return $this->ratesTag;
    }

    public function setRoundingMethod(?string $roundingMethod): static
    {
        $this->roundingMethod = $roundingMethod;

        return $this;
    }

    public function getRoundingMethod(): ?string
    {
        return $this->roundingMethod;
    }

    public function setRoundingDecimals(?int $roundingDecimals): static
    {
        $this->roundingDecimals = $roundingDecimals;

        return $this;
    }

    public function getRoundingDecimals(): ?int
    {
        return $this->roundingDecimals;
    }

    public function setMaxCost(?float $maxCost): static
    {
        $this->maxCost = $maxCost;

        return $this;
    }

    public function getMaxCost(): ?float
    {
        return $this->maxCost;
    }

    public function setMaxCostStrategy(?string $maxCostStrategy): static
    {
        $this->maxCostStrategy = $maxCostStrategy;

        return $this;
    }

    public function getMaxCostStrategy(): ?string
    {
        return $this->maxCostStrategy;
    }

    public function setCreatedAt(null|\DateTime|string $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTime|string|null
    {
        return $this->createdAt;
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

    public function setDestinationRate(?DestinationRateDto $destinationRate): static
    {
        $this->destinationRate = $destinationRate;

        return $this;
    }

    public function getDestinationRate(): ?DestinationRateDto
    {
        return $this->destinationRate;
    }

    public function setDestinationRateId($id): static
    {
        $value = !is_null($id)
            ? new DestinationRateDto($id)
            : null;

        return $this->setDestinationRate($value);
    }

    public function getDestinationRateId()
    {
        if ($dto = $this->getDestinationRate()) {
            return $dto->getId();
        }

        return null;
    }

}
