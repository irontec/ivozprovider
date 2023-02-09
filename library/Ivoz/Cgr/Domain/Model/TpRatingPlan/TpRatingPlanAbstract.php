<?php

declare(strict_types=1);

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;

/**
* TpRatingPlanAbstract
* @codeCoverageIgnore
*/
abstract class TpRatingPlanAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var ?string
     */
    protected $tag = null;

    /**
     * @var ?string
     * column: destrates_tag
     */
    protected $destratesTag = null;

    /**
     * @var string
     * column: timing_tag
     */
    protected $timingTag = '*any';

    /**
     * @var float
     */
    protected $weight = 10;

    /**
     * @var \DateTime
     * column: created_at
     */
    protected $createdAt;

    /**
     * @var RatingPlanInterface
     * inversedBy tpRatingPlan
     */
    protected $ratingPlan;

    /**
     * Constructor
     */
    protected function __construct(
        string $tpid,
        string $timingTag,
        float $weight,
        \DateTimeInterface|string $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setTimingTag($timingTag);
        $this->setWeight($weight);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TpRatingPlan",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TpRatingPlanDto
    {
        return new TpRatingPlanDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TpRatingPlanInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpRatingPlanDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpRatingPlanInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpRatingPlanDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpRatingPlanDto::class);
        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $timingTag = $dto->getTimingTag();
        Assertion::notNull($timingTag, 'getTimingTag value is null, but non null value was expected.');
        $weight = $dto->getWeight();
        Assertion::notNull($weight, 'getWeight value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');
        $ratingPlan = $dto->getRatingPlan();
        Assertion::notNull($ratingPlan, 'getRatingPlan value is null, but non null value was expected.');

        $self = new static(
            $tpid,
            $timingTag,
            $weight,
            $createdAt
        );

        $self
            ->setTag($dto->getTag())
            ->setDestratesTag($dto->getDestratesTag())
            ->setRatingPlan($fkTransformer->transform($ratingPlan));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpRatingPlanDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpRatingPlanDto::class);

        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $timingTag = $dto->getTimingTag();
        Assertion::notNull($timingTag, 'getTimingTag value is null, but non null value was expected.');
        $weight = $dto->getWeight();
        Assertion::notNull($weight, 'getWeight value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');
        $ratingPlan = $dto->getRatingPlan();
        Assertion::notNull($ratingPlan, 'getRatingPlan value is null, but non null value was expected.');

        $this
            ->setTpid($tpid)
            ->setTag($dto->getTag())
            ->setDestratesTag($dto->getDestratesTag())
            ->setTimingTag($timingTag)
            ->setWeight($weight)
            ->setCreatedAt($createdAt)
            ->setRatingPlan($fkTransformer->transform($ratingPlan));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpRatingPlanDto
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setTag(self::getTag())
            ->setDestratesTag(self::getDestratesTag())
            ->setTimingTag(self::getTimingTag())
            ->setWeight(self::getWeight())
            ->setCreatedAt(self::getCreatedAt())
            ->setRatingPlan(RatingPlan::entityToDto(self::getRatingPlan(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'tpid' => self::getTpid(),
            'tag' => self::getTag(),
            'destrates_tag' => self::getDestratesTag(),
            'timing_tag' => self::getTimingTag(),
            'weight' => self::getWeight(),
            'created_at' => self::getCreatedAt(),
            'ratingPlanId' => self::getRatingPlan()->getId()
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

    protected function setDestratesTag(?string $destratesTag = null): static
    {
        if (!is_null($destratesTag)) {
            Assertion::maxLength($destratesTag, 64, 'destratesTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->destratesTag = $destratesTag;

        return $this;
    }

    public function getDestratesTag(): ?string
    {
        return $this->destratesTag;
    }

    protected function setTimingTag(string $timingTag): static
    {
        Assertion::maxLength($timingTag, 64, 'timingTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->timingTag = $timingTag;

        return $this;
    }

    public function getTimingTag(): string
    {
        return $this->timingTag;
    }

    protected function setWeight(float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    protected function setCreatedAt(string|\DateTimeInterface $createdAt): static
    {

        /** @var \Datetime */
        $createdAt = DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->isInitialized() && $this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return clone $this->createdAt;
    }

    public function setRatingPlan(RatingPlanInterface $ratingPlan): static
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    public function getRatingPlan(): RatingPlanInterface
    {
        return $this->ratingPlan;
    }
}
