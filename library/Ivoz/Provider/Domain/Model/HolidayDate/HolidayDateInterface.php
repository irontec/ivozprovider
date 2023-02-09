<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* HolidayDateInterface
*/
interface HolidayDateInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): HolidayDateDto;

    /**
     * @internal use EntityTools instead
     * @param null|HolidayDateInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?HolidayDateDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param HolidayDateDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): HolidayDateDto;

    public function getName(): string;

    public function getEventDate(): \DateTimeInterface;

    public function getWholeDayEvent(): bool;

    public function getTimeIn(): ?\DateTimeInterface;

    public function getTimeOut(): ?\DateTimeInterface;

    public function getRouteType(): ?string;

    public function getNumberValue(): ?string;

    public function setCalendar(CalendarInterface $calendar): static;

    public function getCalendar(): CalendarInterface;

    public function getLocution(): ?LocutionInterface;

    public function getExtension(): ?ExtensionInterface;

    public function getVoicemail(): ?VoicemailInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
