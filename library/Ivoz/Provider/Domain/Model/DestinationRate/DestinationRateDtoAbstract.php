<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class DestinationRateDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $cost;

    /**
     * @var string
     */
    private $connectFee;

    /**
     * @var string
     */
    private $rateIncrement;

    /**
     * @var string
     */
    private $groupIntervalStart = '0s';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpRate\TpRateDto | null
     */
    private $tpRate;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateDto | null
     */
    private $tpDestinationRate;

    /**
     * @var \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto | null
     */
    private $destinationRateGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\Destination\DestinationDto | null
     */
    private $destination;


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
            'cost' => 'cost',
            'connectFee' => 'connectFee',
            'rateIncrement' => 'rateIncrement',
            'groupIntervalStart' => 'groupIntervalStart',
            'id' => 'id',
            'tpRateId' => 'tpRate',
            'tpDestinationRateId' => 'tpDestinationRate',
            'destinationRateGroupId' => 'destinationRateGroup',
            'destinationId' => 'destination'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'cost' => $this->getCost(),
            'connectFee' => $this->getConnectFee(),
            'rateIncrement' => $this->getRateIncrement(),
            'groupIntervalStart' => $this->getGroupIntervalStart(),
            'id' => $this->getId(),
            'tpRate' => $this->getTpRate(),
            'tpDestinationRate' => $this->getTpDestinationRate(),
            'destinationRateGroup' => $this->getDestinationRateGroup(),
            'destination' => $this->getDestination()
        ];
    }

    /**
     * @param string $cost
     *
     * @return static
     */
    public function setCost($cost = null)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param string $connectFee
     *
     * @return static
     */
    public function setConnectFee($connectFee = null)
    {
        $this->connectFee = $connectFee;

        return $this;
    }

    /**
     * @return string
     */
    public function getConnectFee()
    {
        return $this->connectFee;
    }

    /**
     * @param string $rateIncrement
     *
     * @return static
     */
    public function setRateIncrement($rateIncrement = null)
    {
        $this->rateIncrement = $rateIncrement;

        return $this;
    }

    /**
     * @return string
     */
    public function getRateIncrement()
    {
        return $this->rateIncrement;
    }

    /**
     * @param string $groupIntervalStart
     *
     * @return static
     */
    public function setGroupIntervalStart($groupIntervalStart = null)
    {
        $this->groupIntervalStart = $groupIntervalStart;

        return $this;
    }

    /**
     * @return string
     */
    public function getGroupIntervalStart()
    {
        return $this->groupIntervalStart;
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

    /**
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateDto $tpDestinationRate
     *
     * @return static
     */
    public function setTpDestinationRate(\Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateDto $tpDestinationRate = null)
    {
        $this->tpDestinationRate = $tpDestinationRate;

        return $this;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateDto
     */
    public function getTpDestinationRate()
    {
        return $this->tpDestinationRate;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTpDestinationRateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateDto($id)
            : null;

        return $this->setTpDestinationRate($value);
    }

    /**
     * @return integer | null
     */
    public function getTpDestinationRateId()
    {
        if ($dto = $this->getTpDestinationRate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto $destinationRateGroup
     *
     * @return static
     */
    public function setDestinationRateGroup(\Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto $destinationRateGroup = null)
    {
        $this->destinationRateGroup = $destinationRateGroup;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto
     */
    public function getDestinationRateGroup()
    {
        return $this->destinationRateGroup;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDestinationRateGroupId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto($id)
            : null;

        return $this->setDestinationRateGroup($value);
    }

    /**
     * @return integer | null
     */
    public function getDestinationRateGroupId()
    {
        if ($dto = $this->getDestinationRateGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Destination\DestinationDto $destination
     *
     * @return static
     */
    public function setDestination(\Ivoz\Provider\Domain\Model\Destination\DestinationDto $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationDto
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDestinationId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Destination\DestinationDto($id)
            : null;

        return $this->setDestination($value);
    }

    /**
     * @return integer | null
     */
    public function getDestinationId()
    {
        if ($dto = $this->getDestination()) {
            return $dto->getId();
        }

        return null;
    }
}
