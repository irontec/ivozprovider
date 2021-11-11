<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* ExtensionInterface
*/
interface ExtensionInterface extends LoggableEntityInterface
{
    public const ROUTETYPE_USER = 'user';

    public const ROUTETYPE_NUMBER = 'number';

    public const ROUTETYPE_IVR = 'ivr';

    public const ROUTETYPE_HUNTGROUP = 'huntGroup';

    public const ROUTETYPE_CONFERENCEROOM = 'conferenceRoom';

    public const ROUTETYPE_FRIEND = 'friend';

    public const ROUTETYPE_QUEUE = 'queue';

    public const ROUTETYPE_CONDITIONAL = 'conditional';

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

    public function setUser(?UserInterface $user = null): static;

    /**
     * {@inheritDoc}
     */
    public function setNumber(string $number): static;

    /**
     * {@inheritDoc}
     */
    public function setNumberValue(?string $numberValue = null): static;

    /**
     * @return (int|string)[]
     *
     * @psalm-return array{id: int|null, number: string}
     */
    public function toArrayPortal();

    /**
     * Get User using this Extension as ScreenExtension
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface|null
     */
    public function getScreenUser();

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    public static function createDto(string|int|null $id = null): ExtensionDto;

    /**
     * @internal use EntityTools instead
     * @param null|ExtensionInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ExtensionDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ExtensionDto;

    public function getNumber(): string;

    public function getRouteType(): ?string;

    public function getNumberValue(): ?string;

    public function getFriendValue(): ?string;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function getIvr(): ?IvrInterface;

    public function getHuntGroup(): ?HuntGroupInterface;

    public function getConferenceRoom(): ?ConferenceRoomInterface;

    public function getUser(): ?UserInterface;

    public function getQueue(): ?QueueInterface;

    public function getConditionalRoute(): ?ConditionalRouteInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    public function addUser(UserInterface $user): ExtensionInterface;

    public function removeUser(UserInterface $user): ExtensionInterface;

    public function replaceUsers(ArrayCollection $users): ExtensionInterface;

    public function getUsers(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
