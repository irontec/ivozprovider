<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
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
     * @var string
     */
    private $maxCost = '0.000';

    /**
     * @var string
     */
    private $maxCostStrategy = '';

    /**
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $destinationPrefix;

    /**
     * @var string
     */
    private $destinationPrefixName;

    /**
     * @var string
     */
    private $rateCost;

    /**
     * @var string
     */
    private $rateConnectFee;

    /**
     * @var string
     */
    private $rateRateIncrement;

    /**
     * @var string
     */
    private $rateGroupIntervalStart = '0s';

    /**
     * @var \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto | null
     */
    private $destinationRate;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto | null
     */
    private $tpDestination;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpRate\TpRateDto | null
     */
    private $tpRate;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
            'destination' => ['prefix','prefixName'],
            'rate' => ['cost','connectFee','rateIncrement','groupIntervalStart'],
            'destinationRateId' => 'destinationRate',
            'tpDestinationId' => 'tpDestination',
            'tpRateId' => 'tpRate'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
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
            'destination' => [
                'prefix' => $this->getDestinationPrefix(),
                'prefixName' => $this->getDestinationPrefixName()
            ],
            'rate' => [
                'cost' => $this->getRateCost(),
                'connectFee' => $this->getRateConnectFee(),
                'rateIncrement' => $this->getRateRateIncrement(),
                'groupIntervalStart' => $this->getRateGroupIntervalStart()
            ],
            'destinationRate' => $this->getDestinationRate(),
            'tpDestination' => $this->getTpDestination(),
            'tpRate' => $this->getTpRate()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->destinationRate = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\DestinationRate\\DestinationRate', $this->getDestinationRateId());
        $this->tpDestination = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\TpDestination\\TpDestination', $this->getTpDestinationId());
        $this->tpRate = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\TpRate\\TpRate', $this->getTpRateId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

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
     * @return string
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
     * @return string
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
     * @return string
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
     * @return string
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
     * @return string
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
     * @return integer
     */
    public function getRoundingDecimals()
    {
        return $this->roundingDecimals;
    }

    /**
     * @param string $maxCost
     *
     * @return static
     */
    public function setMaxCost($maxCost = null)
    {
        $this->maxCost = $maxCost;

        return $this;
    }

    /**
     * @return string
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
     * @return string
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
     * @return \DateTime
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $destinationPrefix
     *
     * @return static
     */
    public function setDestinationPrefix($destinationPrefix = null)
    {
        $this->destinationPrefix = $destinationPrefix;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationPrefix()
    {
        return $this->destinationPrefix;
    }

    /**
     * @param string $destinationPrefixName
     *
     * @return static
     */
    public function setDestinationPrefixName($destinationPrefixName = null)
    {
        $this->destinationPrefixName = $destinationPrefixName;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationPrefixName()
    {
        return $this->destinationPrefixName;
    }

    /**
     * @param string $rateCost
     *
     * @return static
     */
    public function setRateCost($rateCost = null)
    {
        $this->rateCost = $rateCost;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateCost()
    {
        return $this->rateCost;
    }

    /**
     * @param string $rateConnectFee
     *
     * @return static
     */
    public function setRateConnectFee($rateConnectFee = null)
    {
        $this->rateConnectFee = $rateConnectFee;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateConnectFee()
    {
        return $this->rateConnectFee;
    }

    /**
     * @param string $rateRateIncrement
     *
     * @return static
     */
    public function setRateRateIncrement($rateRateIncrement = null)
    {
        $this->rateRateIncrement = $rateRateIncrement;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateRateIncrement()
    {
        return $this->rateRateIncrement;
    }

    /**
     * @param string $rateGroupIntervalStart
     *
     * @return static
     */
    public function setRateGroupIntervalStart($rateGroupIntervalStart = null)
    {
        $this->rateGroupIntervalStart = $rateGroupIntervalStart;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateGroupIntervalStart()
    {
        return $this->rateGroupIntervalStart;
    }

    /**
     * @param \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto $destinationRate
     *
     * @return static
     */
    public function setDestinationRate(\Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto $destinationRate = null)
    {
        $this->destinationRate = $destinationRate;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto
     */
    public function getDestinationRate()
    {
        return $this->destinationRate;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDestinationRateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto($id)
            : null;

        return $this->setDestinationRate($value);
    }

    /**
     * @return integer | null
     */
    public function getDestinationRateId()
    {
        if ($dto = $this->getDestinationRate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto $tpDestination
     *
     * @return static
     */
    public function setTpDestination(\Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto $tpDestination = null)
    {
        $this->tpDestination = $tpDestination;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto
     */
    public function getTpDestination()
    {
        return $this->tpDestination;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTpDestinationId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto($id)
            : null;

        return $this->setTpDestination($value);
    }

    /**
     * @return integer | null
     */
    public function getTpDestinationId()
    {
        if ($dto = $this->getTpDestination()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Cgr\Domain\Model\TpRate\TpRateDto $tpRate
     *
     * @return static
     */
    public function setTpRate(\Ivoz\Cgr\Domain\Model\TpRate\TpRateDto $tpRate = null)
    {
        $this->tpRate = $tpRate;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\TpRate\TpRateDto
     */
    public function getTpRate()
    {
        return $this->tpRate;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTpRateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Cgr\Domain\Model\TpRate\TpRateDto($id)
            : null;

        return $this->setTpRate($value);
    }

    /**
     * @return integer | null
     */
    public function getTpRateId()
    {
        if ($dto = $this->getTpRate()) {
            return $dto->getId();
        }

        return null;
    }
}


