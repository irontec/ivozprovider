<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtensionInterface;

/**
* IvrInterface
*/
interface IvrInterface extends LoggableEntityInterface
{
    public const NOINPUTROUTETYPE_NUMBER = 'number';

    public const NOINPUTROUTETYPE_EXTENSION = 'extension';

    public const NOINPUTROUTETYPE_VOICEMAIL = 'voicemail';

    public const ERRORROUTETYPE_NUMBER = 'number';

    public const ERRORROUTETYPE_EXTENSION = 'extension';

    public const ERRORROUTETYPE_VOICEMAIL = 'voicemail';

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
     * @return (\Ivoz\Provider\Domain\Model\Locution\LocutionInterface|null)[] with key=>value
     *
     * @psalm-return array{welcome: \Ivoz\Provider\Domain\Model\Locution\LocutionInterface|null, noanswer: \Ivoz\Provider\Domain\Model\Locution\LocutionInterface|null, error: \Ivoz\Provider\Domain\Model\Locution\LocutionInterface|null, success: \Ivoz\Provider\Domain\Model\Locution\LocutionInterface|null}
     */
    public function getAllLocutions(): array;

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNoInputNumberValueE164();

    /**
     * Get the error numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getErrorNumberValueE164();

    /**
     * @return null|string
     */
    public function getNoInputTarget(): ?string;

    /**
     * @return null|string
     */
    public function getErrorTarget(): ?string;

    public static function createDto(string|int|null $id = null): IvrDto;

    /**
     * @internal use EntityTools instead
     * @param null|IvrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?IvrDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param IvrDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): IvrDto;

    public function getName(): string;

    public function getTimeout(): int;

    public function getMaxDigits(): int;

    public function getAllowExtensions(): bool;

    public function getNoInputRouteType(): ?string;

    public function getNoInputNumberValue(): ?string;

    public function getErrorRouteType(): ?string;

    public function getErrorNumberValue(): ?string;

    public function getCompany(): CompanyInterface;

    public function getWelcomeLocution(): ?LocutionInterface;

    public function getNoInputLocution(): ?LocutionInterface;

    public function getErrorLocution(): ?LocutionInterface;

    public function getSuccessLocution(): ?LocutionInterface;

    public function getNoInputExtension(): ?ExtensionInterface;

    public function getErrorExtension(): ?ExtensionInterface;

    public function getNoInputVoicemail(): ?VoicemailInterface;

    public function getErrorVoicemail(): ?VoicemailInterface;

    public function getNoInputNumberCountry(): ?CountryInterface;

    public function getErrorNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    public function addEntry(IvrEntryInterface $entry): IvrInterface;

    public function removeEntry(IvrEntryInterface $entry): IvrInterface;

    /**
     * @param Collection<array-key, IvrEntryInterface> $entries
     */
    public function replaceEntries(Collection $entries): IvrInterface;

    public function getEntries(?Criteria $criteria = null): array;

    public function addExcludedExtension(IvrExcludedExtensionInterface $excludedExtension): IvrInterface;

    public function removeExcludedExtension(IvrExcludedExtensionInterface $excludedExtension): IvrInterface;

    /**
     * @param Collection<array-key, IvrExcludedExtensionInterface> $excludedExtensions
     */
    public function replaceExcludedExtensions(Collection $excludedExtensions): IvrInterface;

    public function getExcludedExtensions(?Criteria $criteria = null): array;
}
