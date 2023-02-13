<?php

declare(strict_types=1);

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrier;

/**
* TpRatingProfileAbstract
* @codeCoverageIgnore
*/
abstract class TpRatingProfileAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string
     */
    protected $loadid = 'DATABASE';

    /**
     * @var string
     */
    protected $direction = '*out';

    /**
     * @var ?string
     */
    protected $tenant = null;

    /**
     * @var string
     */
    protected $category = 'call';

    /**
     * @var ?string
     */
    protected $subject = null;

    /**
     * @var string
     * column: activation_time
     */
    protected $activationTime = '1970-01-01 00:00:00';

    /**
     * @var ?string
     * column: rating_plan_tag
     */
    protected $ratingPlanTag = null;

    /**
     * @var ?string
     * column: fallback_subjects
     */
    protected $fallbackSubjects = null;

    /**
     * @var ?string
     * column: cdr_stat_queue_ids
     */
    protected $cdrStatQueueIds = null;

    /**
     * @var \DateTime
     * column: created_at
     */
    protected $createdAt;

    /**
     * @var ?RatingProfileInterface
     * inversedBy tpRatingProfiles
     */
    protected $ratingProfile = null;

    /**
     * @var ?OutgoingRoutingRelCarrierInterface
     * inversedBy tpRatingProfiles
     */
    protected $outgoingRoutingRelCarrier = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $tpid,
        string $loadid,
        string $direction,
        string $category,
        string $activationTime,
        \DateTimeInterface|string $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setLoadid($loadid);
        $this->setDirection($direction);
        $this->setCategory($category);
        $this->setActivationTime($activationTime);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TpRatingProfile",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TpRatingProfileDto
    {
        return new TpRatingProfileDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TpRatingProfileInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpRatingProfileDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpRatingProfileInterface::class);

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
     * @param TpRatingProfileDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpRatingProfileDto::class);
        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $loadid = $dto->getLoadid();
        Assertion::notNull($loadid, 'getLoadid value is null, but non null value was expected.');
        $direction = $dto->getDirection();
        Assertion::notNull($direction, 'getDirection value is null, but non null value was expected.');
        $category = $dto->getCategory();
        Assertion::notNull($category, 'getCategory value is null, but non null value was expected.');
        $activationTime = $dto->getActivationTime();
        Assertion::notNull($activationTime, 'getActivationTime value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');

        $self = new static(
            $tpid,
            $loadid,
            $direction,
            $category,
            $activationTime,
            $createdAt
        );

        $self
            ->setTenant($dto->getTenant())
            ->setSubject($dto->getSubject())
            ->setRatingPlanTag($dto->getRatingPlanTag())
            ->setFallbackSubjects($dto->getFallbackSubjects())
            ->setCdrStatQueueIds($dto->getCdrStatQueueIds())
            ->setRatingProfile($fkTransformer->transform($dto->getRatingProfile()))
            ->setOutgoingRoutingRelCarrier($fkTransformer->transform($dto->getOutgoingRoutingRelCarrier()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpRatingProfileDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpRatingProfileDto::class);

        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $loadid = $dto->getLoadid();
        Assertion::notNull($loadid, 'getLoadid value is null, but non null value was expected.');
        $direction = $dto->getDirection();
        Assertion::notNull($direction, 'getDirection value is null, but non null value was expected.');
        $category = $dto->getCategory();
        Assertion::notNull($category, 'getCategory value is null, but non null value was expected.');
        $activationTime = $dto->getActivationTime();
        Assertion::notNull($activationTime, 'getActivationTime value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');

        $this
            ->setTpid($tpid)
            ->setLoadid($loadid)
            ->setDirection($direction)
            ->setTenant($dto->getTenant())
            ->setCategory($category)
            ->setSubject($dto->getSubject())
            ->setActivationTime($activationTime)
            ->setRatingPlanTag($dto->getRatingPlanTag())
            ->setFallbackSubjects($dto->getFallbackSubjects())
            ->setCdrStatQueueIds($dto->getCdrStatQueueIds())
            ->setCreatedAt($createdAt)
            ->setRatingProfile($fkTransformer->transform($dto->getRatingProfile()))
            ->setOutgoingRoutingRelCarrier($fkTransformer->transform($dto->getOutgoingRoutingRelCarrier()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpRatingProfileDto
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setLoadid(self::getLoadid())
            ->setDirection(self::getDirection())
            ->setTenant(self::getTenant())
            ->setCategory(self::getCategory())
            ->setSubject(self::getSubject())
            ->setActivationTime(self::getActivationTime())
            ->setRatingPlanTag(self::getRatingPlanTag())
            ->setFallbackSubjects(self::getFallbackSubjects())
            ->setCdrStatQueueIds(self::getCdrStatQueueIds())
            ->setCreatedAt(self::getCreatedAt())
            ->setRatingProfile(RatingProfile::entityToDto(self::getRatingProfile(), $depth))
            ->setOutgoingRoutingRelCarrier(OutgoingRoutingRelCarrier::entityToDto(self::getOutgoingRoutingRelCarrier(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'tpid' => self::getTpid(),
            'loadid' => self::getLoadid(),
            'direction' => self::getDirection(),
            'tenant' => self::getTenant(),
            'category' => self::getCategory(),
            'subject' => self::getSubject(),
            'activation_time' => self::getActivationTime(),
            'rating_plan_tag' => self::getRatingPlanTag(),
            'fallback_subjects' => self::getFallbackSubjects(),
            'cdr_stat_queue_ids' => self::getCdrStatQueueIds(),
            'created_at' => self::getCreatedAt(),
            'ratingProfileId' => self::getRatingProfile()?->getId(),
            'outgoingRoutingRelCarrierId' => self::getOutgoingRoutingRelCarrier()?->getId()
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

    protected function setLoadid(string $loadid): static
    {
        Assertion::maxLength($loadid, 64, 'loadid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->loadid = $loadid;

        return $this;
    }

    public function getLoadid(): string
    {
        return $this->loadid;
    }

    protected function setDirection(string $direction): static
    {
        Assertion::maxLength($direction, 8, 'direction value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->direction = $direction;

        return $this;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    protected function setTenant(?string $tenant = null): static
    {
        if (!is_null($tenant)) {
            Assertion::maxLength($tenant, 64, 'tenant value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tenant = $tenant;

        return $this;
    }

    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    protected function setCategory(string $category): static
    {
        Assertion::maxLength($category, 32, 'category value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->category = $category;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    protected function setSubject(?string $subject = null): static
    {
        if (!is_null($subject)) {
            Assertion::maxLength($subject, 64, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    protected function setActivationTime(string $activationTime): static
    {
        Assertion::maxLength($activationTime, 32, 'activationTime value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->activationTime = $activationTime;

        return $this;
    }

    public function getActivationTime(): string
    {
        return $this->activationTime;
    }

    protected function setRatingPlanTag(?string $ratingPlanTag = null): static
    {
        if (!is_null($ratingPlanTag)) {
            Assertion::maxLength($ratingPlanTag, 64, 'ratingPlanTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ratingPlanTag = $ratingPlanTag;

        return $this;
    }

    public function getRatingPlanTag(): ?string
    {
        return $this->ratingPlanTag;
    }

    protected function setFallbackSubjects(?string $fallbackSubjects = null): static
    {
        if (!is_null($fallbackSubjects)) {
            Assertion::maxLength($fallbackSubjects, 64, 'fallbackSubjects value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fallbackSubjects = $fallbackSubjects;

        return $this;
    }

    public function getFallbackSubjects(): ?string
    {
        return $this->fallbackSubjects;
    }

    protected function setCdrStatQueueIds(?string $cdrStatQueueIds = null): static
    {
        if (!is_null($cdrStatQueueIds)) {
            Assertion::maxLength($cdrStatQueueIds, 64, 'cdrStatQueueIds value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->cdrStatQueueIds = $cdrStatQueueIds;

        return $this;
    }

    public function getCdrStatQueueIds(): ?string
    {
        return $this->cdrStatQueueIds;
    }

    protected function setCreatedAt(string|\DateTimeInterface $createdAt): static
    {

        /** @var \DateTime */
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

    public function setRatingProfile(?RatingProfileInterface $ratingProfile = null): static
    {
        $this->ratingProfile = $ratingProfile;

        return $this;
    }

    public function getRatingProfile(): ?RatingProfileInterface
    {
        return $this->ratingProfile;
    }

    public function setOutgoingRoutingRelCarrier(?OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier = null): static
    {
        $this->outgoingRoutingRelCarrier = $outgoingRoutingRelCarrier;

        return $this;
    }

    public function getOutgoingRoutingRelCarrier(): ?OutgoingRoutingRelCarrierInterface
    {
        return $this->outgoingRoutingRelCarrier;
    }
}
