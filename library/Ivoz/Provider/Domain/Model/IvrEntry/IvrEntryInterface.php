<?php

namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* IvrEntryInterface
*/
interface IvrEntryInterface extends LoggableEntityInterface
{
    public const ROUTETYPE_NUMBER = 'number';

    public const ROUTETYPE_EXTENSION = 'extension';

    public const ROUTETYPE_VOICEMAIL = 'voicemail';

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

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    public static function createDto(string|int|null $id = null): IvrEntryDto;

    /**
     * @internal use EntityTools instead
     * @param null|IvrEntryInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?IvrEntryDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param IvrEntryDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): IvrEntryDto;

    public function getEntry(): string;

    public function getRouteType(): string;

    public function getNumberValue(): ?string;

    public function setIvr(IvrInterface $ivr): static;

    public function getIvr(): IvrInterface;

    public function getWelcomeLocution(): ?LocutionInterface;

    public function getExtension(): ?ExtensionInterface;

    public function getVoicemail(): ?VoicemailInterface;

    public function getConditionalRoute(): ?ConditionalRouteInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
