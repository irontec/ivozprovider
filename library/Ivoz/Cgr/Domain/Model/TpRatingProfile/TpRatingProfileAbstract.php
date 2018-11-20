<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TpRatingProfileAbstract
 * @codeCoverageIgnore
 */
abstract class TpRatingProfileAbstract
{
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
     * @var string
     */
    protected $tenant;

    /**
     * @var string
     */
    protected $category = 'call';

    /**
     * @var string
     */
    protected $subject;

    /**
     * column: activation_time
     * @var \DateTime
     */
    protected $activationTime;

    /**
     * column: rating_plan_tag
     * @var string
     */
    protected $ratingPlanTag;

    /**
     * column: fallback_subjects
     * @var string
     */
    protected $fallbackSubjects;

    /**
     * column: cdr_stat_queue_ids
     * @var string
     */
    protected $cdrStatQueueIds;

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface
     */
    protected $ratingProfile;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface
     */
    protected $outgoingRoutingRelCarrier;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $tpid,
        $loadid,
        $direction,
        $category,
        $activationTime,
        $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setLoadid($loadid);
        $this->setDirection($direction);
        $this->setCategory($category);
        $this->setActivationTime($activationTime);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TpRatingProfile",
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
     * @param null $id
     * @return TpRatingProfileDto
     */
    public static function createDto($id = null)
    {
        return new TpRatingProfileDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TpRatingProfileDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpRatingProfileDto
         */
        Assertion::isInstanceOf($dto, TpRatingProfileDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getLoadid(),
            $dto->getDirection(),
            $dto->getCategory(),
            $dto->getActivationTime(),
            $dto->getCreatedAt()
        );

        $self
            ->setTenant($dto->getTenant())
            ->setSubject($dto->getSubject())
            ->setRatingPlanTag($dto->getRatingPlanTag())
            ->setFallbackSubjects($dto->getFallbackSubjects())
            ->setCdrStatQueueIds($dto->getCdrStatQueueIds())
            ->setRatingProfile($dto->getRatingProfile())
            ->setOutgoingRoutingRelCarrier($dto->getOutgoingRoutingRelCarrier())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpRatingProfileDto
         */
        Assertion::isInstanceOf($dto, TpRatingProfileDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setLoadid($dto->getLoadid())
            ->setDirection($dto->getDirection())
            ->setTenant($dto->getTenant())
            ->setCategory($dto->getCategory())
            ->setSubject($dto->getSubject())
            ->setActivationTime($dto->getActivationTime())
            ->setRatingPlanTag($dto->getRatingPlanTag())
            ->setFallbackSubjects($dto->getFallbackSubjects())
            ->setCdrStatQueueIds($dto->getCdrStatQueueIds())
            ->setCreatedAt($dto->getCreatedAt())
            ->setRatingProfile($dto->getRatingProfile())
            ->setOutgoingRoutingRelCarrier($dto->getOutgoingRoutingRelCarrier());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TpRatingProfileDto
     */
    public function toDto($depth = 0)
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
            ->setRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile::entityToDto(self::getRatingProfile(), $depth))
            ->setOutgoingRoutingRelCarrier(\Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrier::entityToDto(self::getOutgoingRoutingRelCarrier(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
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
            'ratingProfileId' => self::getRatingProfile() ? self::getRatingProfile()->getId() : null,
            'outgoingRoutingRelCarrierId' => self::getOutgoingRoutingRelCarrier() ? self::getOutgoingRoutingRelCarrier()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    public function setTpid($tpid)
    {
        Assertion::notNull($tpid, 'tpid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @deprecated
     * Set loadid
     *
     * @param string $loadid
     *
     * @return self
     */
    public function setLoadid($loadid)
    {
        Assertion::notNull($loadid, 'loadid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($loadid, 64, 'loadid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->loadid = $loadid;

        return $this;
    }

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid()
    {
        return $this->loadid;
    }

    /**
     * @deprecated
     * Set direction
     *
     * @param string $direction
     *
     * @return self
     */
    public function setDirection($direction)
    {
        Assertion::notNull($direction, 'direction value "%s" is null, but non null value was expected.');
        Assertion::maxLength($direction, 8, 'direction value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @deprecated
     * Set tenant
     *
     * @param string $tenant
     *
     * @return self
     */
    public function setTenant($tenant = null)
    {
        if (!is_null($tenant)) {
            Assertion::maxLength($tenant, 64, 'tenant value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tenant = $tenant;

        return $this;
    }

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @deprecated
     * Set category
     *
     * @param string $category
     *
     * @return self
     */
    public function setCategory($category)
    {
        Assertion::notNull($category, 'category value "%s" is null, but non null value was expected.');
        Assertion::maxLength($category, 32, 'category value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @deprecated
     * Set subject
     *
     * @param string $subject
     *
     * @return self
     */
    public function setSubject($subject = null)
    {
        if (!is_null($subject)) {
            Assertion::maxLength($subject, 64, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @deprecated
     * Set activationTime
     *
     * @param \DateTime $activationTime
     *
     * @return self
     */
    public function setActivationTime($activationTime)
    {
        Assertion::notNull($activationTime, 'activationTime value "%s" is null, but non null value was expected.');
        $activationTime = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $activationTime,
            'CURRENT_TIMESTAMP'
        );

        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * Get activationTime
     *
     * @return \DateTime
     */
    public function getActivationTime()
    {
        return $this->activationTime;
    }

    /**
     * @deprecated
     * Set ratingPlanTag
     *
     * @param string $ratingPlanTag
     *
     * @return self
     */
    public function setRatingPlanTag($ratingPlanTag = null)
    {
        if (!is_null($ratingPlanTag)) {
            Assertion::maxLength($ratingPlanTag, 64, 'ratingPlanTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ratingPlanTag = $ratingPlanTag;

        return $this;
    }

    /**
     * Get ratingPlanTag
     *
     * @return string
     */
    public function getRatingPlanTag()
    {
        return $this->ratingPlanTag;
    }

    /**
     * @deprecated
     * Set fallbackSubjects
     *
     * @param string $fallbackSubjects
     *
     * @return self
     */
    public function setFallbackSubjects($fallbackSubjects = null)
    {
        if (!is_null($fallbackSubjects)) {
            Assertion::maxLength($fallbackSubjects, 64, 'fallbackSubjects value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fallbackSubjects = $fallbackSubjects;

        return $this;
    }

    /**
     * Get fallbackSubjects
     *
     * @return string
     */
    public function getFallbackSubjects()
    {
        return $this->fallbackSubjects;
    }

    /**
     * @deprecated
     * Set cdrStatQueueIds
     *
     * @param string $cdrStatQueueIds
     *
     * @return self
     */
    public function setCdrStatQueueIds($cdrStatQueueIds = null)
    {
        if (!is_null($cdrStatQueueIds)) {
            Assertion::maxLength($cdrStatQueueIds, 64, 'cdrStatQueueIds value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->cdrStatQueueIds = $cdrStatQueueIds;

        return $this;
    }

    /**
     * Get cdrStatQueueIds
     *
     * @return string
     */
    public function getCdrStatQueueIds()
    {
        return $this->cdrStatQueueIds;
    }

    /**
     * @deprecated
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        Assertion::notNull($createdAt, 'createdAt value "%s" is null, but non null value was expected.');
        $createdAt = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     *
     * @return self
     */
    public function setRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile = null)
    {
        $this->ratingProfile = $ratingProfile;

        return $this;
    }

    /**
     * Get ratingProfile
     *
     * @return \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface
     */
    public function getRatingProfile()
    {
        return $this->ratingProfile;
    }

    /**
     * Set outgoingRoutingRelCarrier
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier
     *
     * @return self
     */
    public function setOutgoingRoutingRelCarrier(\Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier = null)
    {
        $this->outgoingRoutingRelCarrier = $outgoingRoutingRelCarrier;

        return $this;
    }

    /**
     * Get outgoingRoutingRelCarrier
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface
     */
    public function getOutgoingRoutingRelCarrier()
    {
        return $this->outgoingRoutingRelCarrier;
    }

    // @codeCoverageIgnoreEnd
}
