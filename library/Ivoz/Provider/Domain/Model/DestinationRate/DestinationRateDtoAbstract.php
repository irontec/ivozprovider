<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto;
use Ivoz\Provider\Domain\Model\Destination\DestinationDto;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateDto;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateDto;

/**
* DestinationRateDtoAbstract
* @codeCoverageIgnore
*/
abstract class DestinationRateDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var float
     */
    private $cost;

    /**
     * @var float
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
     * @var int
     */
    private $id;

    /**
     * @var DestinationRateGroupDto | null
     */
    private $destinationRateGroup;

    /**
     * @var DestinationDto | null
     */
    private $destination;

    /**
     * @var TpRateDto | null
     */
    private $tpRate;

    /**
     * @var TpDestinationRateDto | null
     */
    private $tpDestinationRate;

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
            'cost' => 'cost',
            'connectFee' => 'connectFee',
            'rateIncrement' => 'rateIncrement',
            'groupIntervalStart' => 'groupIntervalStart',
            'id' => 'id',
            'destinationRateGroupId' => 'destinationRateGroup',
            'destinationId' => 'destination',
            'tpRateId' => 'tpRate',
            'tpDestinationRateId' => 'tpDestinationRate'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'cost' => $this->getCost(),
            'connectFee' => $this->getConnectFee(),
            'rateIncrement' => $this->getRateIncrement(),
            'groupIntervalStart' => $this->getGroupIntervalStart(),
            'id' => $this->getId(),
            'destinationRateGroup' => $this->getDestinationRateGroup(),
            'destination' => $this->getDestination(),
            'tpRate' => $this->getTpRate(),
            'tpDestinationRate' => $this->getTpDestinationRate()
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
     * @param float $cost | null
     *
     * @return static
     */
    public function setCost(?float $cost = null): self
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getCost(): ?float
    {
        return $this->cost;
    }

    /**
     * @param float $connectFee | null
     *
     * @return static
     */
    public function setConnectFee(?float $connectFee = null): self
    {
        $this->connectFee = $connectFee;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getConnectFee(): ?float
    {
        return $this->connectFee;
    }

    /**
     * @param string $rateIncrement | null
     *
     * @return static
     */
    public function setRateIncrement(?string $rateIncrement = null): self
    {
        $this->rateIncrement = $rateIncrement;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRateIncrement(): ?string
    {
        return $this->rateIncrement;
    }

    /**
     * @param string $groupIntervalStart | null
     *
     * @return static
     */
    public function setGroupIntervalStart(?string $groupIntervalStart = null): self
    {
        $this->groupIntervalStart = $groupIntervalStart;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getGroupIntervalStart(): ?string
    {
        return $this->groupIntervalStart;
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
     * @param DestinationRateGroupDto | null
     *
     * @return static
     */
    public function setDestinationRateGroup(?DestinationRateGroupDto $destinationRateGroup = null): self
    {
        $this->destinationRateGroup = $destinationRateGroup;

        return $this;
    }

    /**
     * @return DestinationRateGroupDto | null
     */
    public function getDestinationRateGroup(): ?DestinationRateGroupDto
    {
        return $this->destinationRateGroup;
    }

    /**
     * @return static
     */
    public function setDestinationRateGroupId($id): self
    {
        $value = !is_null($id)
            ? new DestinationRateGroupDto($id)
            : null;

        return $this->setDestinationRateGroup($value);
    }

    /**
     * @return mixed | null
     */
    public function getDestinationRateGroupId()
    {
        if ($dto = $this->getDestinationRateGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DestinationDto | null
     *
     * @return static
     */
    public function setDestination(?DestinationDto $destination = null): self
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return DestinationDto | null
     */
    public function getDestination(): ?DestinationDto
    {
        return $this->destination;
    }

    /**
     * @return static
     */
    public function setDestinationId($id): self
    {
        $value = !is_null($id)
            ? new DestinationDto($id)
            : null;

        return $this->setDestination($value);
    }

    /**
     * @return mixed | null
     */
    public function getDestinationId()
    {
        if ($dto = $this->getDestination()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TpRateDto | null
     *
     * @return static
     */
    public function setTpRate(?TpRateDto $tpRate = null): self
    {
        $this->tpRate = $tpRate;

        return $this;
    }

    /**
     * @return TpRateDto | null
     */
    public function getTpRate(): ?TpRateDto
    {
        return $this->tpRate;
    }

    /**
     * @return static
     */
    public function setTpRateId($id): self
    {
        $value = !is_null($id)
            ? new TpRateDto($id)
            : null;

        return $this->setTpRate($value);
    }

    /**
     * @return mixed | null
     */
    public function getTpRateId()
    {
        if ($dto = $this->getTpRate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TpDestinationRateDto | null
     *
     * @return static
     */
    public function setTpDestinationRate(?TpDestinationRateDto $tpDestinationRate = null): self
    {
        $this->tpDestinationRate = $tpDestinationRate;

        return $this;
    }

    /**
     * @return TpDestinationRateDto | null
     */
    public function getTpDestinationRate(): ?TpDestinationRateDto
    {
        return $this->tpDestinationRate;
    }

    /**
     * @return static
     */
    public function setTpDestinationRateId($id): self
    {
        $value = !is_null($id)
            ? new TpDestinationRateDto($id)
            : null;

        return $this->setTpDestinationRate($value);
    }

    /**
     * @return mixed | null
     */
    public function getTpDestinationRateId()
    {
        if ($dto = $this->getTpDestinationRate()) {
            return $dto->getId();
        }

        return null;
    }

}
