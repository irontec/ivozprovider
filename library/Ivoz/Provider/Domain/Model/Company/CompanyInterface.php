<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryInterface;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;

/**
* CompanyInterface
*/
interface CompanyInterface extends LoggableEntityInterface
{
    public const TYPE_VPBX = 'vpbx';

    public const TYPE_RETAIL = 'retail';

    public const TYPE_WHOLESALE = 'wholesale';

    public const TYPE_RESIDENTIAL = 'residential';

    public const DISTRIBUTEMETHOD_STATIC = 'static';

    public const DISTRIBUTEMETHOD_RR = 'rr';

    public const DISTRIBUTEMETHOD_HASH = 'hash';

    public const BILLINGMETHOD_POSTPAID = 'postpaid';

    public const BILLINGMETHOD_PREPAID = 'prepaid';

    public const BILLINGMETHOD_PSEUDOPREPAID = 'pseudoprepaid';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): static;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * {@inheritDoc}
     */
    public function setOnDemandRecordCode(?string $onDemandRecordCode = null): static;

    /**
     * @param string $exten
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getExtension($exten);

    /**
     * @param string $ddieE164
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface|null
     */
    public function getDdi($ddieE164);

    public function getFriend($exten): ?FriendInterface;

    /**
     * @param string $exten
     * @return \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface|null
     */
    public function getService($exten);

    /**
     * @param string $name
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface|mixed
     */
    public function getTerminal($name);

    public function getLanguage(): LanguageInterface;

    /**
     * @return string
     */
    public function getLanguageCode(): string;

    /**
     * @return string
     */
    public function getCurrencySymbol(): string;

    /**
     * @return string
     */
    public function getCurrencyIden(): string;

    /**
     * brief: Get musicclass for given company
     *
     * If no specific company music on hold is found, brand music will be used.
     * If no specific brand music  on hold is found, dafault music will be sued.
     *
     * @return string
     */
    public function getMusicClass();

    /**
     * @inheritdoc
     */
    public function setDomainUsers(?string $domainUsers = null): static;

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings();

    /**
     * Get the size in bytes used by the recordings on this company
     * @return int|null
     */
    public function getRecordingsDiskUsage();

    /**
     * Get the size in bytes for disk usage limit on this company
     * @return float|int
     */
    public function getRecordingsLimit();

    /**
     * Check if a Company has a given Feature by id
     *
     * @param int $featureId
     * @return bool
     */
    public function hasFeature($featureId): bool;

    public function hasFeatureByIden(string $iden): bool;

    /**
     * Get On demand recording code DTMFs
     * @return string
     */
    public function getOnDemandRecordDTMFs();

    /**
     * @return \Ivoz\Provider\Domain\Model\Feature\FeatureInterface[]
     */
    public function getFeatures();

    /**
     * @param string $name
     * @return string
     */
    public function getServiceCode($name);

    /**
     * @return string
     */
    public function getCgrSubject(): string;

    public function isVpbx(): bool;

    public function isRetail(): bool;

    public function isResidential(): bool;

    public function isWholesale(): bool;

    public static function createDto(string|int|null $id = null): CompanyDto;

    /**
     * @internal use EntityTools instead
     * @param null|CompanyInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CompanyDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CompanyDto;

    public function getType(): string;

    public function getName(): string;

    public function getDomainUsers(): ?string;

    public function getNif(): string;

    public function getDistributeMethod(): string;

    public function getMaxCalls(): int;

    public function getMaxDailyUsage(): int;

    public function getCurrentDayUsage(): ?float;

    public function getMaxDailyUsageEmail(): ?string;

    public function getPostalAddress(): string;

    public function getPostalCode(): string;

    public function getTown(): string;

    public function getProvince(): string;

    public function getCountryName(): string;

    public function getIpfilter(): ?bool;

    public function getOnDemandRecord(): ?int;

    public function getAllowRecordingRemoval(): bool;

    public function getOnDemandRecordCode(): ?string;

    public function getExternallyextraopts(): ?string;

    public function getRecordingsLimitMB(): ?int;

    public function getRecordingsLimitEmail(): ?string;

    public function getBillingMethod(): string;

    public function getBalance(): ?float;

    public function getShowInvoices(): ?bool;

    public function getMediaRelaySets(): ?MediaRelaySetInterface;

    public function getDefaultTimezone(): ?TimezoneInterface;

    public function setBrand(BrandInterface $brand): static;

    public function getBrand(): BrandInterface;

    public function getDomain(): ?DomainInterface;

    public function getApplicationServer(): ?ApplicationServerInterface;

    public function getCountry(): CountryInterface;

    public function getCurrency(): ?CurrencyInterface;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    public function getOutgoingDdi(): ?DdiInterface;

    public function getOutgoingDdiRule(): ?OutgoingDdiRuleInterface;

    public function getVoicemailNotificationTemplate(): ?NotificationTemplateInterface;

    public function getFaxNotificationTemplate(): ?NotificationTemplateInterface;

    public function getInvoiceNotificationTemplate(): ?NotificationTemplateInterface;

    public function getCallCsvNotificationTemplate(): ?NotificationTemplateInterface;

    public function getMaxDailyUsageNotificationTemplate(): ?NotificationTemplateInterface;

    public function isInitialized(): bool;

    public function addExtension(ExtensionInterface $extension): CompanyInterface;

    public function removeExtension(ExtensionInterface $extension): CompanyInterface;

    /**
     * @param Collection<array-key, ExtensionInterface> $extensions
     */
    public function replaceExtensions(Collection $extensions): CompanyInterface;

    public function getExtensions(?Criteria $criteria = null): array;

    public function addDdi(DdiInterface $ddi): CompanyInterface;

    public function removeDdi(DdiInterface $ddi): CompanyInterface;

    /**
     * @param Collection<array-key, DdiInterface> $ddis
     */
    public function replaceDdis(Collection $ddis): CompanyInterface;

    public function getDdis(?Criteria $criteria = null): array;

    public function addFriend(FriendInterface $friend): CompanyInterface;

    public function removeFriend(FriendInterface $friend): CompanyInterface;

    /**
     * @param Collection<array-key, FriendInterface> $friends
     */
    public function replaceFriends(Collection $friends): CompanyInterface;

    public function getFriends(?Criteria $criteria = null): array;

    public function addCompanyService(CompanyServiceInterface $companyService): CompanyInterface;

    public function removeCompanyService(CompanyServiceInterface $companyService): CompanyInterface;

    /**
     * @param Collection<array-key, CompanyServiceInterface> $companyServices
     */
    public function replaceCompanyServices(Collection $companyServices): CompanyInterface;

    public function getCompanyServices(?Criteria $criteria = null): array;

    public function addTerminal(TerminalInterface $terminal): CompanyInterface;

    public function removeTerminal(TerminalInterface $terminal): CompanyInterface;

    /**
     * @param Collection<array-key, TerminalInterface> $terminals
     */
    public function replaceTerminals(Collection $terminals): CompanyInterface;

    public function getTerminals(?Criteria $criteria = null): array;

    public function addRatingProfile(RatingProfileInterface $ratingProfile): CompanyInterface;

    public function removeRatingProfile(RatingProfileInterface $ratingProfile): CompanyInterface;

    /**
     * @param Collection<array-key, RatingProfileInterface> $ratingProfiles
     */
    public function replaceRatingProfiles(Collection $ratingProfiles): CompanyInterface;

    public function getRatingProfiles(?Criteria $criteria = null): array;

    public function addMusicsOnHold(MusicOnHoldInterface $musicsOnHold): CompanyInterface;

    public function removeMusicsOnHold(MusicOnHoldInterface $musicsOnHold): CompanyInterface;

    /**
     * @param Collection<array-key, MusicOnHoldInterface> $musicsOnHold
     */
    public function replaceMusicsOnHold(Collection $musicsOnHold): CompanyInterface;

    public function getMusicsOnHold(?Criteria $criteria = null): array;

    public function addVoicemail(VoicemailInterface $voicemail): CompanyInterface;

    public function removeVoicemail(VoicemailInterface $voicemail): CompanyInterface;

    /**
     * @param Collection<array-key, VoicemailInterface> $voicemails
     */
    public function replaceVoicemails(Collection $voicemails): CompanyInterface;

    public function getVoicemails(?Criteria $criteria = null): array;

    public function addRecording(RecordingInterface $recording): CompanyInterface;

    public function removeRecording(RecordingInterface $recording): CompanyInterface;

    /**
     * @param Collection<array-key, RecordingInterface> $recordings
     */
    public function replaceRecordings(Collection $recordings): CompanyInterface;

    public function getRecordings(?Criteria $criteria = null): array;

    public function addRelFeature(FeaturesRelCompanyInterface $relFeature): CompanyInterface;

    public function removeRelFeature(FeaturesRelCompanyInterface $relFeature): CompanyInterface;

    /**
     * @param Collection<array-key, FeaturesRelCompanyInterface> $relFeatures
     */
    public function replaceRelFeatures(Collection $relFeatures): CompanyInterface;

    public function getRelFeatures(?Criteria $criteria = null): array;

    public function addRelCountry(CompanyRelGeoIPCountryInterface $relCountry): CompanyInterface;

    public function removeRelCountry(CompanyRelGeoIPCountryInterface $relCountry): CompanyInterface;

    /**
     * @param Collection<array-key, CompanyRelGeoIPCountryInterface> $relCountries
     */
    public function replaceRelCountries(Collection $relCountries): CompanyInterface;

    public function getRelCountries(?Criteria $criteria = null): array;

    public function addRelCodec(CompanyRelCodecInterface $relCodec): CompanyInterface;

    public function removeRelCodec(CompanyRelCodecInterface $relCodec): CompanyInterface;

    /**
     * @param Collection<array-key, CompanyRelCodecInterface> $relCodecs
     */
    public function replaceRelCodecs(Collection $relCodecs): CompanyInterface;

    public function getRelCodecs(?Criteria $criteria = null): array;

    public function addRelRoutingTag(CompanyRelRoutingTagInterface $relRoutingTag): CompanyInterface;

    public function removeRelRoutingTag(CompanyRelRoutingTagInterface $relRoutingTag): CompanyInterface;

    /**
     * @param Collection<array-key, CompanyRelRoutingTagInterface> $relRoutingTags
     */
    public function replaceRelRoutingTags(Collection $relRoutingTags): CompanyInterface;

    public function getRelRoutingTags(?Criteria $criteria = null): array;
}
