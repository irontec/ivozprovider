<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* RatingProfileInterface
*/
interface RatingProfileInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * Return the TpRatingProfile row associated with this RatingProfile
     *
     * @return TpRatingProfileInterface|mixed
     */
    public function getCgrRatingProfile();

    public static function createDto(string|int|null $id = null): RatingProfileDto;

    /**
     * @internal use EntityTools instead
     * @param null|RatingProfileInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RatingProfileDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RatingProfileDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RatingProfileDto;

    public function getActivationTime(): \DateTime;

    public function setCompany(?CompanyInterface $company = null): static;

    public function getCompany(): ?CompanyInterface;

    public function setCarrier(?CarrierInterface $carrier = null): static;

    public function getCarrier(): ?CarrierInterface;

    public function getRatingPlanGroup(): RatingPlanGroupInterface;

    public function getRoutingTag(): ?RoutingTagInterface;

    public function addTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): RatingProfileInterface;

    public function removeTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): RatingProfileInterface;

    /**
     * @param Collection<array-key, TpRatingProfileInterface> $tpRatingProfiles
     */
    public function replaceTpRatingProfiles(Collection $tpRatingProfiles): RatingProfileInterface;

    /**
     * @return array<array-key, TpRatingProfileInterface>
     */
    public function getTpRatingProfiles(?Criteria $criteria = null): array;
}
