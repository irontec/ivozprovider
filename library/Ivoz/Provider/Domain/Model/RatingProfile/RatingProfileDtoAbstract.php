<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupDto;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileDto;

/**
* RatingProfileDtoAbstract
* @codeCoverageIgnore
*/
abstract class RatingProfileDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var \DateTimeInterface
     */
    private $activationTime = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var CarrierDto | null
     */
    private $carrier;

    /**
     * @var RatingPlanGroupDto | null
     */
    private $ratingPlanGroup;

    /**
     * @var RoutingTagDto | null
     */
    private $routingTag;

    /**
     * @var TpRatingProfileDto[] | null
     */
    private $tpRatingProfiles;

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
        $response = [
            'activationTime' => $this->getActivationTime(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier(),
            'ratingPlanGroup' => $this->getRatingPlanGroup(),
            'routingTag' => $this->getRoutingTag(),
            'tpRatingProfiles' => $this->getTpRatingProfiles()
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
     * @param \DateTimeInterface $activationTime | null
     *
     * @return static
     */
    public function setActivationTime($activationTime = null): self
    {
        $this->activationTime = $activationTime;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getActivationTime()
    {
        return $this->activationTime;
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
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CarrierDto | null
     *
     * @return static
     */
    public function setCarrier(?CarrierDto $carrier = null): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return CarrierDto | null
     */
    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    /**
     * @return static
     */
    public function setCarrierId($id): self
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return mixed | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RatingPlanGroupDto | null
     *
     * @return static
     */
    public function setRatingPlanGroup(?RatingPlanGroupDto $ratingPlanGroup = null): self
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    /**
     * @return RatingPlanGroupDto | null
     */
    public function getRatingPlanGroup(): ?RatingPlanGroupDto
    {
        return $this->ratingPlanGroup;
    }

    /**
     * @return static
     */
    public function setRatingPlanGroupId($id): self
    {
        $value = !is_null($id)
            ? new RatingPlanGroupDto($id)
            : null;

        return $this->setRatingPlanGroup($value);
    }

    /**
     * @return mixed | null
     */
    public function getRatingPlanGroupId()
    {
        if ($dto = $this->getRatingPlanGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param RoutingTagDto | null
     *
     * @return static
     */
    public function setRoutingTag(?RoutingTagDto $routingTag = null): self
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    /**
     * @return RoutingTagDto | null
     */
    public function getRoutingTag(): ?RoutingTagDto
    {
        return $this->routingTag;
    }

    /**
     * @return static
     */
    public function setRoutingTagId($id): self
    {
        $value = !is_null($id)
            ? new RoutingTagDto($id)
            : null;

        return $this->setRoutingTag($value);
    }

    /**
     * @return mixed | null
     */
    public function getRoutingTagId()
    {
        if ($dto = $this->getRoutingTag()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TpRatingProfileDto[] | null
     *
     * @return static
     */
    public function setTpRatingProfiles(?array $tpRatingProfiles = null): self
    {
        $this->tpRatingProfiles = $tpRatingProfiles;

        return $this;
    }

    /**
     * @return TpRatingProfileDto[] | null
     */
    public function getTpRatingProfiles(): ?array
    {
        return $this->tpRatingProfiles;
    }

}
