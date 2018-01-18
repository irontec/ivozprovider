<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TpRatingProfileDTO implements DataTransferObjectInterface
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
     * @var \DateTime
     */
    private $activationTime = 'CURRENT_TIMESTAMP';

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
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $ratingPlanId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var mixed
     */
    private $ratingPlan;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
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
            'companyId' => $this->getCompanyId(),
            'ratingPlanId' => $this->getRatingPlanId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->ratingPlan = $transformer->transform('Ivoz\\Cgr\\Domain\\Model\\RatingPlan\\RatingPlan', $this->getRatingPlanId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $tpid
     *
     * @return TpRatingProfileDTO
     */
    public function setTpid($tpid)
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $loadid
     *
     * @return TpRatingProfileDTO
     */
    public function setLoadid($loadid)
    {
        $this->loadid = $loadid;

        return $this;
    }

    /**
     * @return string
     */
    public function getLoadid()
    {
        return $this->loadid;
    }

    /**
     * @param string $direction
     *
     * @return TpRatingProfileDTO
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param string $tenant
     *
     * @return TpRatingProfileDTO
     */
    public function setTenant($tenant = null)
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return string
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @param string $category
     *
     * @return TpRatingProfileDTO
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $subject
     *
     * @return TpRatingProfileDTO
     */
    public function setSubject($subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param \DateTime $activationTime
     *
     * @return TpRatingProfileDTO
     */
    public function setActivationTime($activationTime)
    {
        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getActivationTime()
    {
        return $this->activationTime;
    }

    /**
     * @param string $ratingPlanTag
     *
     * @return TpRatingProfileDTO
     */
    public function setRatingPlanTag($ratingPlanTag = null)
    {
        $this->ratingPlanTag = $ratingPlanTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getRatingPlanTag()
    {
        return $this->ratingPlanTag;
    }

    /**
     * @param string $fallbackSubjects
     *
     * @return TpRatingProfileDTO
     */
    public function setFallbackSubjects($fallbackSubjects = null)
    {
        $this->fallbackSubjects = $fallbackSubjects;

        return $this;
    }

    /**
     * @return string
     */
    public function getFallbackSubjects()
    {
        return $this->fallbackSubjects;
    }

    /**
     * @param string $cdrStatQueueIds
     *
     * @return TpRatingProfileDTO
     */
    public function setCdrStatQueueIds($cdrStatQueueIds = null)
    {
        $this->cdrStatQueueIds = $cdrStatQueueIds;

        return $this;
    }

    /**
     * @return string
     */
    public function getCdrStatQueueIds()
    {
        return $this->cdrStatQueueIds;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return TpRatingProfileDTO
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param integer $id
     *
     * @return TpRatingProfileDTO
     */
    public function setId($id)
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
     * @param integer $companyId
     *
     * @return TpRatingProfileDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $ratingPlanId
     *
     * @return TpRatingProfileDTO
     */
    public function setRatingPlanId($ratingPlanId)
    {
        $this->ratingPlanId = $ratingPlanId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRatingPlanId()
    {
        return $this->ratingPlanId;
    }

    /**
     * @return \Ivoz\Cgr\Domain\Model\RatingPlan\RatingPlan
     */
    public function getRatingPlan()
    {
        return $this->ratingPlan;
    }
}


