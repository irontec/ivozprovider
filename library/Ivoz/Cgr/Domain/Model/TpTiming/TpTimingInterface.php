<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlanInterface;

/**
* TpTimingInterface
*/
interface TpTimingInterface extends EntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): TpTimingDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpTimingInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpTimingDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpTimingDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpTimingDto;

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getYears(): string;

    public function getMonths(): string;

    public function getMonthDays(): string;

    public function getWeekDays(): string;

    public function getTime(): string;

    public function getCreatedAt(): \DateTime;

    public function setRatingPlan(RatingPlanInterface $ratingPlan): static;

    public function getRatingPlan(): RatingPlanInterface;

    public function isInitialized(): bool;
}
