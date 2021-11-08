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
     * @var \DateTimeInterface|string
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

    public function setActivationTime(\DateTimeInterface|string $activationTime): static
    {
        $this->activationTime = $activationTime;

        return $this;
    }

    public function getActivationTime(): \DateTimeInterface|string|null
    {
        return $this->activationTime;
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

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCarrier(?CarrierDto $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    public function setCarrierId($id): static
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRatingPlanGroup(?RatingPlanGroupDto $ratingPlanGroup): static
    {
        $this->ratingPlanGroup = $ratingPlanGroup;

        return $this;
    }

    public function getRatingPlanGroup(): ?RatingPlanGroupDto
    {
        return $this->ratingPlanGroup;
    }

    public function setRatingPlanGroupId($id): static
    {
        $value = !is_null($id)
            ? new RatingPlanGroupDto($id)
            : null;

        return $this->setRatingPlanGroup($value);
    }

    public function getRatingPlanGroupId()
    {
        if ($dto = $this->getRatingPlanGroup()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRoutingTag(?RoutingTagDto $routingTag): static
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    public function getRoutingTag(): ?RoutingTagDto
    {
        return $this->routingTag;
    }

    public function setRoutingTagId($id): static
    {
        $value = !is_null($id)
            ? new RoutingTagDto($id)
            : null;

        return $this->setRoutingTag($value);
    }

    public function getRoutingTagId()
    {
        if ($dto = $this->getRoutingTag()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTpRatingProfiles(?array $tpRatingProfiles): static
    {
        $this->tpRatingProfiles = $tpRatingProfiles;

        return $this;
    }

    public function getTpRatingProfiles(): ?array
    {
        return $this->tpRatingProfiles;
    }
}
