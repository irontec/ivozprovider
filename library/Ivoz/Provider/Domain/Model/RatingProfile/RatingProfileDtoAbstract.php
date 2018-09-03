<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
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
     * @var \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto | null
     */
    private $ratingPlan;

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
            'ratingPlanId' => 'ratingPlan',
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
            'ratingPlan' => $this->getRatingPlan(),
            'routingTag' => $this->getRoutingTag(),
            'tpRatingProfiles' => $this->getTpRatingProfiles()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->carrier = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Carrier\\Carrier', $this->getCarrierId());
        $this->ratingPlan = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\RatingPlan\\RatingPlan', $this->getRatingPlanId());
        $this->routingTag = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\RoutingTag\\RoutingTag', $this->getRoutingTagId());
        if (!is_null($this->tpRatingProfiles)) {
            $items = $this->getTpRatingProfiles();
            $this->tpRatingProfiles = [];
            foreach ($items as $item) {
                $this->tpRatingProfiles[] = $transformer->transform(
                    'Ivoz\\Cgr\\Domain\\Model\\TpRatingProfile\\TpRatingProfile',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->tpRatingProfiles = $transformer->transform(
            'Ivoz\\Cgr\\Domain\\Model\\TpRatingProfile\\TpRatingProfile',
            $this->tpRatingProfiles
        );
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
     * @param \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto $ratingPlan
     *
     * @return static
     */
    public function setRatingPlan(\Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto $ratingPlan = null)
    {
        $this->ratingPlan = $ratingPlan;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto
     */
    public function getRatingPlan()
    {
        return $this->ratingPlan;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setRatingPlanId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanDto($id)
            : null;

        return $this->setRatingPlan($value);
    }

    /**
     * @return integer | null
     */
    public function getRatingPlanId()
    {
        if ($dto = $this->getRatingPlan()) {
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


