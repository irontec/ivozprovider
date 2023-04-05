<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;

/**
* TpRatingProfileInterface
*/
interface TpRatingProfileInterface extends LoggableEntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    public static function createDto(string|int|null $id = null): TpRatingProfileDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpRatingProfileInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpRatingProfileDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpRatingProfileDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpRatingProfileDto;

    public function getTpid(): string;

    public function getLoadid(): string;

    public function getDirection(): string;

    public function getTenant(): ?string;

    public function getCategory(): string;

    public function getSubject(): ?string;

    public function getActivationTime(): string;

    public function getRatingPlanTag(): ?string;

    public function getFallbackSubjects(): ?string;

    public function getCdrStatQueueIds(): ?string;

    public function getCreatedAt(): \DateTime;

    public function setRatingProfile(?RatingProfileInterface $ratingProfile = null): static;

    public function getRatingProfile(): ?RatingProfileInterface;

    public function setOutgoingRoutingRelCarrier(?OutgoingRoutingRelCarrierInterface $outgoingRoutingRelCarrier = null): static;

    public function getOutgoingRoutingRelCarrier(): ?OutgoingRoutingRelCarrierInterface;
}
