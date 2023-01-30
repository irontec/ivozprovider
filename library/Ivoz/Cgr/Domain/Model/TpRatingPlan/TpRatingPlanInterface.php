<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingPlan;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;

/**
* TpRatingPlanInterface
*/
interface TpRatingPlanInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): TpRatingPlanDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpRatingPlanInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpRatingPlanDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpRatingPlanDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpRatingPlanDto;

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getDestratesTag(): ?string;

    public function getTimingTag(): string;

    public function getWeight(): float;

    public function getCreatedAt(): \DateTime;

    public function setRatingPlan(RatingPlanInterface $ratingPlan): static;

    public function getRatingPlan(): RatingPlanInterface;
}
