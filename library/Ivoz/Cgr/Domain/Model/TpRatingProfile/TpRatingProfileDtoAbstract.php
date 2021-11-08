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
     * @var string|null
     */
    private $tenant;

    /**
     * @var string
     */
    private $category = 'call';

    /**
     * @var string|null
     */
    private $subject;

    /**
     * @var string
     */
    private $activationTime = '1970-01-01 00:00:00';

    /**
     * @var string|null
     */
    private $ratingPlanTag;

    /**
     * @var string|null
     */
    private $fallbackSubjects;

    /**
     * @var string|null
     */
    private $cdrStatQueueIds;

    /**
     * @var \DateTimeInterface|string
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

    public function setTpid(string $tpid): static
    {
        $this->tpid = $tpid;

        return $this;
    }

    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    public function setLoadid(string $loadid): static
    {
        $this->loadid = $loadid;

        return $this;
    }

    public function getLoadid(): ?string
    {
        return $this->loadid;
    }

    public function setDirection(string $direction): static
    {
        $this->direction = $direction;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setTenant(?string $tenant): static
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setSubject(?string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setActivationTime(string $activationTime): static
    {
        $this->activationTime = $activationTime;

        return $this;
    }

    public function getActivationTime(): ?string
    {
        return $this->activationTime;
    }

    public function setRatingPlanTag(?string $ratingPlanTag): static
    {
        $this->ratingPlanTag = $ratingPlanTag;

        return $this;
    }

    public function getRatingPlanTag(): ?string
    {
        return $this->ratingPlanTag;
    }

    public function setFallbackSubjects(?string $fallbackSubjects): static
    {
        $this->fallbackSubjects = $fallbackSubjects;

        return $this;
    }

    public function getFallbackSubjects(): ?string
    {
        return $this->fallbackSubjects;
    }

    public function setCdrStatQueueIds(?string $cdrStatQueueIds): static
    {
        $this->cdrStatQueueIds = $cdrStatQueueIds;

        return $this;
    }

    public function getCdrStatQueueIds(): ?string
    {
        return $this->cdrStatQueueIds;
    }

    public function setCreatedAt(\DateTimeInterface|string $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface|string|null
    {
        return $this->createdAt;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRatingProfile(?RatingProfileDto $ratingProfile): static
    {
        $this->ratingProfile = $ratingProfile;

        return $this;
    }

    public function getRatingProfile(): ?RatingProfileDto
    {
        return $this->ratingProfile;
    }

    public function setRatingProfileId($id): static
    {
        $value = !is_null($id)
            ? new RatingProfileDto($id)
            : null;

        return $this->setRatingProfile($value);
    }

    public function getRatingProfileId()
    {
        if ($dto = $this->getRatingProfile()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutgoingRoutingRelCarrier(?OutgoingRoutingRelCarrierDto $outgoingRoutingRelCarrier): static
    {
        $this->outgoingRoutingRelCarrier = $outgoingRoutingRelCarrier;

        return $this;
    }

    public function getOutgoingRoutingRelCarrier(): ?OutgoingRoutingRelCarrierDto
    {
        return $this->outgoingRoutingRelCarrier;
    }

    public function setOutgoingRoutingRelCarrierId($id): static
    {
        $value = !is_null($id)
            ? new OutgoingRoutingRelCarrierDto($id)
            : null;

        return $this->setOutgoingRoutingRelCarrier($value);
    }

    public function getOutgoingRoutingRelCarrierId()
    {
        if ($dto = $this->getOutgoingRoutingRelCarrier()) {
            return $dto->getId();
        }

        return null;
    }
}
