<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use DateTimeInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* ScheduleInterface
*/
interface ScheduleInterface extends LoggableEntityInterface
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
     * Check if current time is inside Schedule
     *
     * @param \DateTime $time Current time in Client's Timezone
     * @return bool
     */
    public function isOnSchedule(DateTimeInterface $time);

    public static function createDto(string|int|null $id = null): ScheduleDto;

    /**
     * @internal use EntityTools instead
     * @param null|ScheduleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ScheduleDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ScheduleDto;

    public function getName(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getTimeIn(): \DateTimeInterface;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getTimeout(): \DateTimeInterface;

    public function getMonday(): ?bool;

    public function getTuesday(): ?bool;

    public function getWednesday(): ?bool;

    public function getThursday(): ?bool;

    public function getFriday(): ?bool;

    public function getSaturday(): ?bool;

    public function getSunday(): ?bool;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;
}
