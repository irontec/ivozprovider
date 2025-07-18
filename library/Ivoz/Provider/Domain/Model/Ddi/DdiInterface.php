<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* DdiInterface
*/
interface DdiInterface extends LoggableEntityInterface
{
    public const RECORDCALLS_NONE = 'none';

    public const RECORDCALLS_ALL = 'all';

    public const RECORDCALLS_INBOUND = 'inbound';

    public const RECORDCALLS_OUTBOUND = 'outbound';

    public const ROUTETYPE_USER = 'user';

    public const ROUTETYPE_IVR = 'ivr';

    public const ROUTETYPE_HUNTGROUP = 'huntGroup';

    public const ROUTETYPE_FAX = 'fax';

    public const ROUTETYPE_CONFERENCEROOM = 'conferenceRoom';

    public const ROUTETYPE_FRIEND = 'friend';

    public const ROUTETYPE_QUEUE = 'queue';

    public const ROUTETYPE_CONDITIONAL = 'conditional';

    public const ROUTETYPE_RESIDENTIAL = 'residential';

    public const ROUTETYPE_RETAIL = 'retail';

    public const ROUTETYPE_LOCUTION = 'locution';

    public const TYPE_INOUT = 'inout';

    public const TYPE_OUT = 'out';

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
     * {@inheritDoc}
     */
    public function setDdi(string $ddi): static;

    public function getDomain(): ?DomainInterface;

    public function getLanguageCode(): string;

    public function setRouteType(?string $routeType = null): static;

    public function setUser(?UserInterface $user = null): static;

    /**
     * @return string
     */
    public function getDdie164(): string;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): DdiDto;

    /**
     * @internal use EntityTools instead
     * @param null|DdiInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DdiDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DdiDto;

    public function getDdi(): string;

    public function getDescription(): ?string;

    public function getRecordCalls(): string;

    public function getDisplayName(): ?string;

    public function getRouteType(): ?string;

    public function getFriendValue(): ?string;

    public function getType(): string;

    public function getUseDdiProviderRoutingTag(): bool;

    public function setCompany(?CompanyInterface $company = null): static;

    public function getCompany(): ?CompanyInterface;

    public function getBrand(): BrandInterface;

    public function getConferenceRoom(): ?ConferenceRoomInterface;

    public function getLanguage(): ?LanguageInterface;

    public function getQueue(): ?QueueInterface;

    public function getExternalCallFilter(): ?ExternalCallFilterInterface;

    public function getUser(): ?UserInterface;

    public function getIvr(): ?IvrInterface;

    public function getHuntGroup(): ?HuntGroupInterface;

    public function getFax(): ?FaxInterface;

    public function getDdiProvider(): ?DdiProviderInterface;

    public function getCountry(): ?CountryInterface;

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function getConditionalRoute(): ?ConditionalRouteInterface;

    public function setRetailAccount(?RetailAccountInterface $retailAccount = null): static;

    public function getRetailAccount(): ?RetailAccountInterface;

    public function getRoutingTag(): ?RoutingTagInterface;

    public function getLocution(): ?LocutionInterface;

    public function addRecording(RecordingInterface $recording): DdiInterface;

    public function removeRecording(RecordingInterface $recording): DdiInterface;

    /**
     * @param Collection<array-key, RecordingInterface> $recordings
     */
    public function replaceRecordings(Collection $recordings): DdiInterface;

    /**
     * @return array<array-key, RecordingInterface>
     */
    public function getRecordings(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
