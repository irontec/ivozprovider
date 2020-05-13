<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpDestinationRateDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $destinationsTag;

    /**
     * @var string
     */
    private $ratesTag;

    /**
     * @var string
     */
    private $roundingMethod = '*up';

    /**
     * @var integer
     */
    private $roundingDecimals = 4;

    /**
     * @var float
     */
    private $maxCost = 0.0;

    /**
     * @var string
     */
    private $maxCostStrategy = '';

    /**
     * @var \DateTime | string
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto | null
     */
    private $destinationRate;


    use DtoNormalizer;

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
     * @param string $tpid
     *
     * @return static
     */
    public function setTpid($tpid = null)
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $tag
     *
     * @return static
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $destinationsTag
     *
     * @return static
     */
    public function setDestinationsTag($destinationsTag = null)
    {
        $this->destinationsTag = $destinationsTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestinationsTag()
    {
        return $this->destinationsTag;
    }

    /**
     * @param string $ratesTag
     *
     * @return static
     */
    public function setRatesTag($ratesTag = null)
    {
        $this->ratesTag = $ratesTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRatesTag()
    {
        return $this->ratesTag;
    }

    /**
     * @param string $roundingMethod
     *
     * @return static
     */
    public function setRoundingMethod($roundingMethod = null)
    {
        $this->roundingMethod = $roundingMethod;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRoundingMethod()
    {
        return $this->roundingMethod;
    }

    /**
     * @param integer $roundingDecimals
     *
     * @return static
     */
    public function setRoundingDecimals($roundingDecimals = null)
    {
        $this->roundingDecimals = $roundingDecimals;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getRoundingDecimals()
    {
        return $this->roundingDecimals;
    }

    /**
     * @param float $maxCost
     *
     * @return static
     */
    public function setMaxCost($maxCost = null)
    {
        $this->maxCost = $maxCost;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getMaxCost()
    {
        return $this->maxCost;
    }

    /**
     * @param string $maxCostStrategy
     *
     * @return static
     */
    public function setMaxCostStrategy($maxCostStrategy = null)
    {
        $this->maxCostStrategy = $maxCostStrategy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMaxCostStrategy()
    {
        return $this->maxCostStrategy;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto $destinationRate
     *
     * @return static
     */
    public function setDestinationRate(\Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto $destinationRate = null)
    {
        $this->destinationRate = $destinationRate;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto | null
     */
    public function getDestinationRate()
    {
        return $this->destinationRate;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setDestinationRateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto($id)
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
