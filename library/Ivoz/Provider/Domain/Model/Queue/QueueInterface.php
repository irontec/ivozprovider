<?php

namespace Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* QueueInterface
*/
interface QueueInterface extends LoggableEntityInterface
{
    public const TIMEOUTTARGETTYPE_NUMBER = 'number';

    public const TIMEOUTTARGETTYPE_EXTENSION = 'extension';

    public const TIMEOUTTARGETTYPE_VOICEMAIL = 'voicemail';

    public const FULLTARGETTYPE_NUMBER = 'number';

    public const FULLTARGETTYPE_EXTENSION = 'extension';

    public const FULLTARGETTYPE_VOICEMAIL = 'voicemail';

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
    public function setName(?string $name = null): static;

    public function getAstQueueName(): string;

    /**
     * @return string
     */
    public function getTimeoutRouteType(): ?string;

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getTimeoutNumberValueE164();

    /**
     * @return string
     */
    public function getFullRouteType(): ?string;

    /**
     * Get the full numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getFullNumberValueE164();

    public function setMaxWaitTime(?int $maxWaitTime = null): static;

    public function setMaxlen(?int $maxlen = null): static;

    public static function createDto(string|int|null $id = null): QueueDto;

    /**
     * @internal use EntityTools instead
     * @param null|QueueInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?QueueDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param QueueDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): QueueDto;

    public function getName(): ?string;

    public function getMaxWaitTime(): ?int;

    public function getTimeoutTargetType(): ?string;

    public function getTimeoutNumberValue(): ?string;

    public function getMaxlen(): ?int;

    public function getFullTargetType(): ?string;

    public function getFullNumberValue(): ?string;

    public function getPeriodicAnnounceFrequency(): ?int;

    public function getMemberCallRest(): ?int;

    public function getMemberCallTimeout(): ?int;

    public function getStrategy(): ?string;

    public function getWeight(): ?int;

    public function getPreventMissedCalls(): int;

    public function getCompany(): CompanyInterface;

    public function getPeriodicAnnounceLocution(): ?LocutionInterface;

    public function getTimeoutLocution(): ?LocutionInterface;

    public function getTimeoutExtension(): ?ExtensionInterface;

    public function getTimeoutVoicemail(): ?VoicemailInterface;

    public function getFullLocution(): ?LocutionInterface;

    public function getFullExtension(): ?ExtensionInterface;

    public function getFullVoicemail(): ?VoicemailInterface;

    public function getTimeoutNumberCountry(): ?CountryInterface;

    public function getFullNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
