<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto;

/**
* TpRatingProfileDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpRatingProfileDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $loadid = 'DATABASE';

    /**
     * @var string
     */
    private $direction = '*out';

    /**
     * @var string | null
     */
    private $tenant;

    /**
     * @var string
     */
    private $category = 'call';

    /**
     * @var string | null
     */
    private $subject;

    /**
     * @var string
     */
    private $activationTime = '1970-01-01 00:00:00';

    /**
     * @var string | null
     */
    private $ratingPlanTag;

    /**
     * @var string | null
     */
    private $fallbackSubjects;

    /**
     * @var string | null
     */
    private $cdrStatQueueIds;

    /**
     * @var \DateTimeInterface
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     */
    private $id;

    /**
     * @var RatingProfileDto | null
     */
    private $ratingProfile;

    /**
     * @var OutgoingRoutingRelCarrierDto | null
     */
    private $outgoingRoutingRelCarrier;

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
            'loadid' => 'loadid',
            'direction' => 'direction',
            'tenant' => 'tenant',
            'category' => 'category',
            'subject' => 'subject',
            'activationTime' => 'activationTime',
            'ratingPlanTag' => 'ratingPlanTag',
            'fallbackSubjects' => 'fallbackSubjects',
            'cdrStatQueueIds' => 'cdrStatQueueIds',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'ratingProfileId' => 'ratingProfile',
            'outgoingRoutingRelCarrierId' => 'outgoingRoutingRelCarrier'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'tpid' => $this->getTpid(),
            'loadid' => $this->getLoadid(),
            'direction' => $this->getDirection(),
            'tenant' => $this->getTenant(),
            'category' => $this->getCategory(),
            'subject' => $this->getSubject(),
            'activationTime' => $this->getActivationTime(),
            'ratingPlanTag' => $this->getRatingPlanTag(),
            'fallbackSubjects' => $this->getFallbackSubjects(),
            'cdrStatQueueIds' => $this->getCdrStatQueueIds(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'ratingProfile' => $this->getRatingProfile(),
            'outgoingRoutingRelCarrier' => $this->getOutgoingRoutingRelCarrier()
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
     * @param string $loadid | null
     *
     * @return static
     */
    public function setLoadid(?string $loadid = null): self
    {
        $this->loadid = $loadid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLoadid(): ?string
    {
        return $this->loadid;
    }

    /**
     * @param string $direction | null
     *
     * @return static
     */
    public function setDirection(?string $direction = null): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirection(): ?string
    {
        return $this->direction;
    }

    /**
     * @param string $tenant | null
     *
     * @return static
     */
    public function setTenant(?string $tenant = null): self
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    /**
     * @param string $category | null
     *
     * @return static
     */
    public function setCategory(?string $category = null): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string $subject | null
     *
     * @return static
     */
    public function setSubject(?string $subject = null): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string $activationTime | null
     *
     * @return static
     */
    public function setActivationTime(?string $activationTime = null): self
    {
        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getActivationTime(): ?string
    {
        return $this->activationTime;
    }

    /**
     * @param string $ratingPlanTag | null
     *
     * @return static
     */
    public function setRatingPlanTag(?string $ratingPlanTag = null): self
    {
        $this->ratingPlanTag = $ratingPlanTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRatingPlanTag(): ?string
    {
        return $this->ratingPlanTag;
    }

    /**
     * @param string $fallbackSubjects | null
     *
     * @return static
     */
    public function setFallbackSubjects(?string $fallbackSubjects = null): self
    {
        $this->fallbackSubjects = $fallbackSubjects;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFallbackSubjects(): ?string
    {
        return $this->fallbackSubjects;
    }

    /**
     * @param string $cdrStatQueueIds | null
     *
     * @return static
     */
    public function setCdrStatQueueIds(?string $cdrStatQueueIds = null): self
    {
        $this->cdrStatQueueIds = $cdrStatQueueIds;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCdrStatQueueIds(): ?string
    {
        return $this->cdrStatQueueIds;
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
     * @param RatingProfileDto | null
     *
     * @return static
     */
    public function setRatingProfile(?RatingProfileDto $ratingProfile = null): self
    {
        $this->ratingProfile = $ratingProfile;

        return $this;
    }

    /**
     * @return RatingProfileDto | null
     */
    public function getRatingProfile(): ?RatingProfileDto
    {
        return $this->ratingProfile;
    }

    /**
     * @return static
     */
    public function setRatingProfileId($id): self
    {
        $value = !is_null($id)
            ? new RatingProfileDto($id)
            : null;

        return $this->setRatingProfile($value);
    }

    /**
     * @return mixed | null
     */
    public function getRatingProfileId()
    {
        if ($dto = $this->getRatingProfile()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param OutgoingRoutingRelCarrierDto | null
     *
     * @return static
     */
    public function setOutgoingRoutingRelCarrier(?OutgoingRoutingRelCarrierDto $outgoingRoutingRelCarrier = null): self
    {
        $this->outgoingRoutingRelCarrier = $outgoingRoutingRelCarrier;

        return $this;
    }

    /**
     * @return OutgoingRoutingRelCarrierDto | null
     */
    public function getOutgoingRoutingRelCarrier(): ?OutgoingRoutingRelCarrierDto
    {
        return $this->outgoingRoutingRelCarrier;
    }

    /**
     * @return static
     */
    public function setOutgoingRoutingRelCarrierId($id): self
    {
        $value = !is_null($id)
            ? new OutgoingRoutingRelCarrierDto($id)
            : null;

        return $this->setOutgoingRoutingRelCarrier($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingRoutingRelCarrierId()
    {
        if ($dto = $this->getOutgoingRoutingRelCarrier()) {
            return $dto->getId();
        }

        return null;
    }

}
