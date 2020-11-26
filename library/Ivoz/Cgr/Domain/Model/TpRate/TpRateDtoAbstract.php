<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto;

/**
* TpRateDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpRateDtoAbstract implements DataTransferObjectInterface
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
     * @var float
     */
    private $connectFee;

    /**
     * @var float
     */
    private $rateCost;

    /**
     * @var string
     */
    private $rateUnit = '60s';

    /**
     * @var string
     */
    private $rateIncrement;

    /**
     * @var string
     */
    private $groupIntervalStart = '0s';

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
            'connectFee' => 'connectFee',
            'rateCost' => 'rateCost',
            'rateUnit' => 'rateUnit',
            'rateIncrement' => 'rateIncrement',
            'groupIntervalStart' => 'groupIntervalStart',
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
            'connectFee' => $this->getConnectFee(),
            'rateCost' => $this->getRateCost(),
            'rateUnit' => $this->getRateUnit(),
            'rateIncrement' => $this->getRateIncrement(),
            'groupIntervalStart' => $this->getGroupIntervalStart(),
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
     * @param float $rateCost | null
     *
     * @return static
     */
    public function setRateCost(?float $rateCost = null): self
    {
        $this->rateCost = $rateCost;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getRateCost(): ?float
    {
        return $this->rateCost;
    }

    /**
     * @param string $rateUnit | null
     *
     * @return static
     */
    public function setRateUnit(?string $rateUnit = null): self
    {
        $this->rateUnit = $rateUnit;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRateUnit(): ?string
    {
        return $this->rateUnit;
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
