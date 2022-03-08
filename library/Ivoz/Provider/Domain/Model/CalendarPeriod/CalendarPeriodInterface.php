<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* CalendarPeriodInterface
*/
interface CalendarPeriodInterface extends LoggableEntityInterface
{
    public const ROUTETYPE_NUMBER = 'number';

    public const ROUTETYPE_EXTENSION = 'extension';

    public const ROUTETYPE_VOICEMAIL = 'voicemail';

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
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    public function isOutOfSchedule(): bool;

    public static function createDto(string|int|null $id = null): CalendarPeriodDto;

    /**
     * @internal use EntityTools instead
     * @param null|CalendarPeriodInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CalendarPeriodDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CalendarPeriodDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CalendarPeriodDto;

    public function getStartDate(): \DateTimeInterface;

    public function getEndDate(): \DateTimeInterface;

    public function getRouteType(): ?string;

    public function getNumberValue(): ?string;

    public function setCalendar(CalendarInterface $calendar): static;

    public function getCalendar(): CalendarInterface;

    public function getLocution(): ?LocutionInterface;

    public function getExtension(): ?ExtensionInterface;

    public function getVoicemail(): ?VoicemailInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    public function addRelSchedule(CalendarPeriodsRelScheduleInterface $relSchedule): CalendarPeriodInterface;

    public function removeRelSchedule(CalendarPeriodsRelScheduleInterface $relSchedule): CalendarPeriodInterface;

    /**
     * @param Collection<array-key, CalendarPeriodsRelScheduleInterface> $relSchedules
     */
    public function replaceRelSchedules(Collection $relSchedules): CalendarPeriodInterface;

    public function getRelSchedules(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
