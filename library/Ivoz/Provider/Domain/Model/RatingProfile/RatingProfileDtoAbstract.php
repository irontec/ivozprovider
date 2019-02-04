<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class RatingProfileDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var \DateTime
     */
    private $activationTime = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    private $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto | null
     */
    private $ratingPlanGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto | null
     */
    private $routingTag;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileDto[] | null
     */
    private $tpRatingProfiles = null;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'activationTime' => 'activationTime',
            'id' => 'id',
            'companyId' => 'company',
            'carrierId' => 'carrier',
            'ratingPlanGroupId' => 'ratingPlanGroup',
            'routingTagId' => 'routingTag'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'activationTime' => $this->getActivationTime(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier(),
            'ratingPlanGroup' => $this->getRatingPlanGroup(),
            'routingTag' => $this->getRoutingTag(),
            'tpRatingProfiles' => $this->getTpRatingProfiles()
        ];
    }

    /**
     * @param \DateTime $activationTime
     *
     * @return static
     */
    public function setActivationTime($activationTime = null)
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierDto
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCarrierId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Carrier\CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return integer | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto $ratingPlanGroup
     *
     * @return static
     */
    public function setRatingPlanGroup(\Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto $ratingPlanGroup = null)
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto
     */
    public function getRatingPlanGroup()
    {
        return $this->ratingPlanGroup;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRatingPlanGroupId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto($id)
            : null;

        return $this->setRatingPlanGroup($value);
    }

    /**
     * @return integer | null
     */
    public function getRatingPlanGroupId()
    {
        if ($dto = $this->getRatingPlanGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto $routingTag
     *
     * @return static
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto $routingTag = null)
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto
     */
    public function getRoutingTag()
    {
        return $this->routingTag;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRoutingTagId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto($id)
            : null;

        return $this->setRoutingTag($value);
    }

    /**
     * @return integer | null
     */
    public function getRoutingTagId()
    {
        if ($dto = $this->getRoutingTag()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $tpRatingProfiles
     *
     * @return static
     */
    public function setTpRatingProfiles($tpRatingProfiles = null)
    {
        $this->tpRatingProfiles = $tpRatingProfiles;

        return $this;
    }

    /**
     * @return array
     */
    public function getTpRatingProfiles()
    {
        return $this->tpRatingProfiles;
    }
}
