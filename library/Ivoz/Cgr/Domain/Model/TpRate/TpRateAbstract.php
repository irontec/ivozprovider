<?php
declare(strict_types = 1);

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate;

/**
* TpRateAbstract
* @codeCoverageIgnore
*/
abstract class TpRateAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string | null
     */
    protected $tag;

    /**
     * column: connect_fee
     * @var float
     */
    protected $connectFee;

    /**
     * column: rate
     * @var float
     */
    protected $rateCost;

    /**
     * column: rate_unit
     * @var string
     */
    protected $rateUnit = '60s';

    /**
     * column: rate_increment
     * @var string
     */
    protected $rateIncrement;

    /**
     * column: group_interval_start
     * @var string
     */
    protected $groupIntervalStart = '0s';

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var DestinationRate
     * inversedBy tpRate
     */
    protected $destinationRate;

    /**
     * Constructor
     */
    protected function __construct(
        $tpid,
        $connectFee,
        $rateCost,
        $rateUnit,
        $rateIncrement,
        $groupIntervalStart,
        $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setConnectFee($connectFee);
        $this->setRateCost($rateCost);
        $this->setRateUnit($rateUnit);
        $this->setRateIncrement($rateIncrement);
        $this->setGroupIntervalStart($groupIntervalStart);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TpRate",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param mixed $id
     * @return TpRateDto
     */
    public static function createDto($id = null)
    {
        return new TpRateDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TpRateInterface|null $entity
     * @param int $depth
     * @return TpRateDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpRateInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var TpRateDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpRateDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpRateDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getConnectFee(),
            $dto->getRateCost(),
            $dto->getRateUnit(),
            $dto->getRateIncrement(),
            $dto->getGroupIntervalStart(),
            $dto->getCreatedAt()
        );

        $self
            ->setTag($dto->getTag())
            ->setDestinationRate($fkTransformer->transform($dto->getDestinationRate()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpRateDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpRateDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setConnectFee($dto->getConnectFee())
            ->setRateCost($dto->getRateCost())
            ->setRateUnit($dto->getRateUnit())
            ->setRateIncrement($dto->getRateIncrement())
            ->setGroupIntervalStart($dto->getGroupIntervalStart())
            ->setCreatedAt($dto->getCreatedAt())
            ->setDestinationRate($fkTransformer->transform($dto->getDestinationRate()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TpRateDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setTag(self::getTag())
            ->setConnectFee(self::getConnectFee())
            ->setRateCost(self::getRateCost())
            ->setRateUnit(self::getRateUnit())
            ->setRateIncrement(self::getRateIncrement())
            ->setGroupIntervalStart(self::getGroupIntervalStart())
            ->setCreatedAt(self::getCreatedAt())
            ->setDestinationRate(DestinationRate::entityToDto(self::getDestinationRate(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tpid' => self::getTpid(),
            'tag' => self::getTag(),
            'connect_fee' => self::getConnectFee(),
            'rate' => self::getRateCost(),
            'rate_unit' => self::getRateUnit(),
            'rate_increment' => self::getRateIncrement(),
            'group_interval_start' => self::getGroupIntervalStart(),
            'created_at' => self::getCreatedAt(),
            'destinationRateId' => self::getDestinationRate()->getId()
        ];
    }

    protected function setTpid(string $tpid): static
    {
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    public function getTpid(): string
    {
        return $this->tpid;
    }

    protected function setTag(?string $tag = null): static
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tag = $tag;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    protected function setConnectFee(float $connectFee): static
    {
        $this->connectFee = $connectFee;

        return $this;
    }

    public function getConnectFee(): float
    {
        return $this->connectFee;
    }

    protected function setRateCost(float $rateCost): static
    {
        $this->rateCost = $rateCost;

        return $this;
    }

    public function getRateCost(): float
    {
        return $this->rateCost;
    }

    protected function setRateUnit(string $rateUnit): static
    {
        Assertion::maxLength($rateUnit, 16, 'rateUnit value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rateUnit = $rateUnit;

        return $this;
    }

    public function getRateUnit(): string
    {
        return $this->rateUnit;
    }

    protected function setRateIncrement(string $rateIncrement): static
    {
        Assertion::maxLength($rateIncrement, 16, 'rateIncrement value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->rateIncrement = $rateIncrement;

        return $this;
    }

    public function getRateIncrement(): string
    {
        return $this->rateIncrement;
    }

    protected function setGroupIntervalStart(string $groupIntervalStart): static
    {
        Assertion::maxLength($groupIntervalStart, 16, 'groupIntervalStart value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->groupIntervalStart = $groupIntervalStart;

        return $this;
    }

    public function getGroupIntervalStart(): string
    {
        return $this->groupIntervalStart;
    }

    protected function setCreatedAt($createdAt): static
    {

        $createdAt = DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return clone $this->createdAt;
    }

    public function setDestinationRate(DestinationRate $destinationRate): static
    {
        $this->destinationRate = $destinationRate;

        /** @var  $this */
        return $this;
    }

    public function getDestinationRate(): DestinationRate
    {
        return $this->destinationRate;
    }

}
