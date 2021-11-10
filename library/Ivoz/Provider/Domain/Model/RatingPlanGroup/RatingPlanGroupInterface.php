<?php

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* RatingPlanGroupInterface
*/
interface RatingPlanGroupInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * CGRates tag for this Rating Plan
     *
     * @return string
     */
    public function getCgrTag(): string;

    /**
     * @return string
     */
    public function getCurrencyIden(): string;

    /**
     * @return string
     */
    public function getCurrencySymbol(): string;

    /**
     * @return void
     * @throws \DomainException
     */
    public function assertNoDuplicatedDestinationRateGroups();

    public static function createDto(string|int|null $id = null): RatingPlanGroupDto;

    /**
     * @internal use EntityTools instead
     * @param null|RatingPlanGroupInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RatingPlanGroupDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RatingPlanGroupDto;

    public function getName(): Name;

    public function getDescription(): Description;

    public function getBrand(): BrandInterface;

    public function getCurrency(): ?CurrencyInterface;

    public function isInitialized(): bool;

    public function addRatingPlan(RatingPlanInterface $ratingPlan): RatingPlanGroupInterface;

    public function removeRatingPlan(RatingPlanInterface $ratingPlan): RatingPlanGroupInterface;

    public function replaceRatingPlan(ArrayCollection $ratingPlan): RatingPlanGroupInterface;

    public function getRatingPlan(?Criteria $criteria = null): array;
}
