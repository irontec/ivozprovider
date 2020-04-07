<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpRatingProfileDtoAbstract implements DataTransferObjectInterface
{
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
     * @var string
     */
    private $tenant;

    /**
     * @var string
     */
    private $category = 'call';

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $activationTime = '1970-01-01 00:00:00';

    /**
     * @var string
     */
    private $ratingPlanTag;

    /**
     * @var string
     */
    private $fallbackSubjects;

    /**
     * @var string
     */
    private $cdrStatQueueIds;

    /**
     * @var \DateTime | string
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto | null
     */
    private $ratingProfile;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto | null
     */
    private $outgoingRoutingRelCarrier;


    use DtoNormalizer;

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
     * @return string | null
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $loadid
     *
     * @return static
     */
    public function setLoadid($loadid = null)
    {
        $this->loadid = $loadid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLoadid()
    {
        return $this->loadid;
    }

    /**
     * @param string $direction
     *
     * @return static
     */
    public function setDirection($direction = null)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param string $tenant
     *
     * @return static
     */
    public function setTenant($tenant = null)
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @param string $category
     *
     * @return static
     */
    public function setCategory($category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $subject
     *
     * @return static
     */
    public function setSubject($subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $activationTime
     *
     * @return static
     */
    public function setActivationTime($activationTime = null)
    {
        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getActivationTime()
    {
        return $this->activationTime;
    }

    /**
     * @param string $ratingPlanTag
     *
     * @return static
     */
    public function setRatingPlanTag($ratingPlanTag = null)
    {
        $this->ratingPlanTag = $ratingPlanTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRatingPlanTag()
    {
        return $this->ratingPlanTag;
    }

    /**
     * @param string $fallbackSubjects
     *
     * @return static
     */
    public function setFallbackSubjects($fallbackSubjects = null)
    {
        $this->fallbackSubjects = $fallbackSubjects;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFallbackSubjects()
    {
        return $this->fallbackSubjects;
    }

    /**
     * @param string $cdrStatQueueIds
     *
     * @return static
     */
    public function setCdrStatQueueIds($cdrStatQueueIds = null)
    {
        $this->cdrStatQueueIds = $cdrStatQueueIds;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCdrStatQueueIds()
    {
        return $this->cdrStatQueueIds;
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
     * @return \DateTime | null
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
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto $ratingProfile
     *
     * @return static
     */
    public function setRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto $ratingProfile = null)
    {
        $this->ratingProfile = $ratingProfile;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto | null
     */
    public function getRatingProfile()
    {
        return $this->ratingProfile;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setRatingProfileId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto $outgoingRoutingRelCarrier
     *
     * @return static
     */
    public function setOutgoingRoutingRelCarrier(\Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto $outgoingRoutingRelCarrier = null)
    {
        $this->outgoingRoutingRelCarrier = $outgoingRoutingRelCarrier;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto | null
     */
    public function getOutgoingRoutingRelCarrier()
    {
        return $this->outgoingRoutingRelCarrier;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setOutgoingRoutingRelCarrierId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto($id)
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
