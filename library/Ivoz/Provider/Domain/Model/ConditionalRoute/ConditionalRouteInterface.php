<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* ConditionalRouteInterface
*/
interface ConditionalRouteInterface extends LoggableEntityInterface
{
    public const ROUTETYPE_USER = 'user';

    public const ROUTETYPE_NUMBER = 'number';

    public const ROUTETYPE_IVR = 'ivr';

    public const ROUTETYPE_HUNTGROUP = 'huntGroup';

    public const ROUTETYPE_VOICEMAIL = 'voicemail';

    public const ROUTETYPE_FRIEND = 'friend';

    public const ROUTETYPE_QUEUE = 'queue';

    public const ROUTETYPE_CONFERENCEROOM = 'conferenceRoom';

    public const ROUTETYPE_EXTENSION = 'extension';

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

    public static function createDto(string|int|null $id = null): ConditionalRouteDto;

    /**
     * @internal use EntityTools instead
     * @param null|ConditionalRouteInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ConditionalRouteDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRouteDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ConditionalRouteDto;

    public function getName(): string;

    public function getRoutetype(): ?string;

    public function getNumbervalue(): ?string;

    public function getFriendvalue(): ?string;

    public function getCompany(): CompanyInterface;

    public function getIvr(): ?IvrInterface;

    public function getHuntGroup(): ?HuntGroupInterface;

    public function getVoicemail(): ?VoicemailInterface;

    public function getUser(): ?UserInterface;

    public function getQueue(): ?QueueInterface;

    public function getLocution(): ?LocutionInterface;

    public function getConferenceRoom(): ?ConferenceRoomInterface;

    public function getExtension(): ?ExtensionInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    public function addCondition(ConditionalRoutesConditionInterface $condition): ConditionalRouteInterface;

    public function removeCondition(ConditionalRoutesConditionInterface $condition): ConditionalRouteInterface;

    /**
     * @param Collection<array-key, ConditionalRoutesConditionInterface> $conditions
     */
    public function replaceConditions(Collection $conditions): ConditionalRouteInterface;

    public function getConditions(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
