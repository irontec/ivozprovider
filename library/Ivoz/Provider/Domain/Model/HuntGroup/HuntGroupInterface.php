<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMemberInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* HuntGroupInterface
*/
interface HuntGroupInterface extends LoggableEntityInterface
{
    public const STRATEGY_RINGALL = 'ringAll';

    public const STRATEGY_LINEAR = 'linear';

    public const STRATEGY_ROUNDROBIN = 'roundRobin';

    public const STRATEGY_RANDOM = 'random';

    public const NOANSWERTARGETTYPE_NUMBER = 'number';

    public const NOANSWERTARGETTYPE_EXTENSION = 'extension';

    public const NOANSWERTARGETTYPE_VOICEMAIL = 'voicemail';

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
     * @return string
     */
    public function getNoAnswerRouteType(): ?string;

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNoAnswerNumberValueE164();

    public static function createDto(string|int|null $id = null): HuntGroupDto;

    /**
     * @internal use EntityTools instead
     * @param null|HuntGroupInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?HuntGroupDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param HuntGroupDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): HuntGroupDto;

    public function getName(): string;

    public function getDescription(): string;

    public function getStrategy(): string;

    public function getRingAllTimeout(): ?int;

    public function getNoAnswerTargetType(): ?string;

    public function getNoAnswerNumberValue(): ?string;

    public function getPreventMissedCalls(): int;

    public function getAllowCallForwards(): int;

    public function getCompany(): CompanyInterface;

    public function getNoAnswerLocution(): ?LocutionInterface;

    public function getNoAnswerExtension(): ?ExtensionInterface;

    public function getNoAnswerVoicemail(): ?VoicemailInterface;

    public function getNoAnswerNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    public function addHuntGroupMember(HuntGroupMemberInterface $huntGroupMember): HuntGroupInterface;

    public function removeHuntGroupMember(HuntGroupMemberInterface $huntGroupMember): HuntGroupInterface;

    /**
     * @param Collection<array-key, HuntGroupMemberInterface> $huntGroupMembers
     */
    public function replaceHuntGroupMembers(Collection $huntGroupMembers): HuntGroupInterface;

    /**
     * @return array<array-key, HuntGroupMemberInterface>
     */
    public function getHuntGroupMembers(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
