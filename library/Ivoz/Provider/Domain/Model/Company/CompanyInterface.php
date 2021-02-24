<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CompanyInterface
*/
interface CompanyInterface extends LoggableEntityInterface
{
    const TYPE_VPBX = 'vpbx';

    const TYPE_RETAIL = 'retail';

    const TYPE_WHOLESALE = 'wholesale';

    const TYPE_RESIDENTIAL = 'residential';

    const DISTRIBUTEMETHOD_STATIC = 'static';

    const DISTRIBUTEMETHOD_RR = 'rr';

    const DISTRIBUTEMETHOD_HASH = 'hash';

    const BILLINGMETHOD_POSTPAID = 'postpaid';

    const BILLINGMETHOD_PREPAID = 'prepaid';

    const BILLINGMETHOD_PSEUDOPREPAID = 'pseudoprepaid';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setName(string $name): CompanyInterface;

    /**
     * {@inheritDoc}
     */
    public function setOnDemandRecordCode(string $onDemandRecordCode = null): CompanyInterface;

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

    public function getFriend($exten);

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

    /**
     * @return string
     */
    public function getLanguageCode();

    /**
     * @return string
     */
    public function getCurrencySymbol();

    /**
     * @return string
     */
    public function getCurrencyIden();

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
    public function setDomainUsers(string $domainUsers = null): CompanyInterface;

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
    public function getCgrSubject();

    public function isVpbx(): bool;

    public function isRetail(): bool;

    public function isResidential(): bool;

    public function isWholesale(): bool;

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get domainUsers
     *
     * @return string | null
     */
    public function getDomainUsers(): ?string;

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif(): string;

    /**
     * Get distributeMethod
     *
     * @return string
     */
    public function getDistributeMethod(): string;

    /**
     * Get maxCalls
     *
     * @return int
     */
    public function getMaxCalls(): int;

    /**
     * Get maxDailyUsage
     *
     * @return int
     */
    public function getMaxDailyUsage(): int;

    /**
     * Get currentDayUsage
     *
     * @return float | null
     */
    public function getCurrentDayUsage(): ?float;

    /**
     * Get maxDailyUsageEmail
     *
     * @return string | null
     */
    public function getMaxDailyUsageEmail(): ?string;

    /**
     * Get postalAddress
     *
     * @return string
     */
    public function getPostalAddress(): string;

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode(): string;

    /**
     * Get town
     *
     * @return string
     */
    public function getTown(): string;

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince(): string;

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName(): string;

    /**
     * Get ipfilter
     *
     * @return bool | null
     */
    public function getIpfilter(): ?bool;

    /**
     * Get onDemandRecord
     *
     * @return int | null
     */
    public function getOnDemandRecord(): ?int;

    /**
     * Get allowRecordingRemoval
     *
     * @return bool
     */
    public function getAllowRecordingRemoval(): bool;

    /**
     * Get onDemandRecordCode
     *
     * @return string | null
     */
    public function getOnDemandRecordCode(): ?string;

    /**
     * Get externallyextraopts
     *
     * @return string | null
     */
    public function getExternallyextraopts(): ?string;

    /**
     * Get recordingsLimitMB
     *
     * @return int | null
     */
    public function getRecordingsLimitMB(): ?int;

    /**
     * Get recordingsLimitEmail
     *
     * @return string | null
     */
    public function getRecordingsLimitEmail(): ?string;

    /**
     * Get billingMethod
     *
     * @return string
     */
    public function getBillingMethod(): string;

    /**
     * Get balance
     *
     * @return float | null
     */
    public function getBalance(): ?float;

    /**
     * Get showInvoices
     *
     * @return bool | null
     */
    public function getShowInvoices(): ?bool;

    /**
     * Get language
     *
     * @return LanguageInterface | null
     */
    public function getLanguage(): ?LanguageInterface;

    /**
     * Get mediaRelaySets
     *
     * @return MediaRelaySetInterface | null
     */
    public function getMediaRelaySets(): ?MediaRelaySetInterface;

    /**
     * Get defaultTimezone
     *
     * @return TimezoneInterface | null
     */
    public function getDefaultTimezone(): ?TimezoneInterface;

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    public function setBrand(BrandInterface $brand): CompanyInterface;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Get domain
     *
     * @return DomainInterface | null
     */
    public function getDomain(): ?DomainInterface;

    /**
     * Get applicationServer
     *
     * @return ApplicationServerInterface | null
     */
    public function getApplicationServer(): ?ApplicationServerInterface;

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry(): ?CountryInterface;

    /**
     * Get currency
     *
     * @return CurrencyInterface | null
     */
    public function getCurrency(): ?CurrencyInterface;

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    /**
     * Get outgoingDdi
     *
     * @return DdiInterface | null
     */
    public function getOutgoingDdi(): ?DdiInterface;

    /**
     * Get outgoingDdiRule
     *
     * @return OutgoingDdiRuleInterface | null
     */
    public function getOutgoingDdiRule(): ?OutgoingDdiRuleInterface;

    /**
     * Get voicemailNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getVoicemailNotificationTemplate(): ?NotificationTemplateInterface;

    /**
     * Get faxNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getFaxNotificationTemplate(): ?NotificationTemplateInterface;

    /**
     * Get invoiceNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getInvoiceNotificationTemplate(): ?NotificationTemplateInterface;

    /**
     * Get callCsvNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getCallCsvNotificationTemplate(): ?NotificationTemplateInterface;

    /**
     * Get maxDailyUsageNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getMaxDailyUsageNotificationTemplate(): ?NotificationTemplateInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add extension
     *
     * @param ExtensionInterface $extension
     *
     * @return static
     */
    public function addExtension(ExtensionInterface $extension): CompanyInterface;

    /**
     * Remove extension
     *
     * @param ExtensionInterface $extension
     *
     * @return static
     */
    public function removeExtension(ExtensionInterface $extension): CompanyInterface;

    /**
     * Replace extensions
     *
     * @param ArrayCollection $extensions of ExtensionInterface
     *
     * @return static
     */
    public function replaceExtensions(ArrayCollection $extensions): CompanyInterface;

    /**
     * Get extensions
     * @param Criteria | null $criteria
     * @return ExtensionInterface[]
     */
    public function getExtensions(?Criteria $criteria = null): array;

    /**
     * Add ddi
     *
     * @param DdiInterface $ddi
     *
     * @return static
     */
    public function addDdi(DdiInterface $ddi): CompanyInterface;

    /**
     * Remove ddi
     *
     * @param DdiInterface $ddi
     *
     * @return static
     */
    public function removeDdi(DdiInterface $ddi): CompanyInterface;

    /**
     * Replace ddis
     *
     * @param ArrayCollection $ddis of DdiInterface
     *
     * @return static
     */
    public function replaceDdis(ArrayCollection $ddis): CompanyInterface;

    /**
     * Get ddis
     * @param Criteria | null $criteria
     * @return DdiInterface[]
     */
    public function getDdis(?Criteria $criteria = null): array;

    /**
     * Add friend
     *
     * @param FriendInterface $friend
     *
     * @return static
     */
    public function addFriend(FriendInterface $friend): CompanyInterface;

    /**
     * Remove friend
     *
     * @param FriendInterface $friend
     *
     * @return static
     */
    public function removeFriend(FriendInterface $friend): CompanyInterface;

    /**
     * Replace friends
     *
     * @param ArrayCollection $friends of FriendInterface
     *
     * @return static
     */
    public function replaceFriends(ArrayCollection $friends): CompanyInterface;

    /**
     * Get friends
     * @param Criteria | null $criteria
     * @return FriendInterface[]
     */
    public function getFriends(?Criteria $criteria = null): array;

    /**
     * Add companyService
     *
     * @param CompanyServiceInterface $companyService
     *
     * @return static
     */
    public function addCompanyService(CompanyServiceInterface $companyService): CompanyInterface;

    /**
     * Remove companyService
     *
     * @param CompanyServiceInterface $companyService
     *
     * @return static
     */
    public function removeCompanyService(CompanyServiceInterface $companyService): CompanyInterface;

    /**
     * Replace companyServices
     *
     * @param ArrayCollection $companyServices of CompanyServiceInterface
     *
     * @return static
     */
    public function replaceCompanyServices(ArrayCollection $companyServices): CompanyInterface;

    /**
     * Get companyServices
     * @param Criteria | null $criteria
     * @return CompanyServiceInterface[]
     */
    public function getCompanyServices(?Criteria $criteria = null): array;

    /**
     * Add terminal
     *
     * @param TerminalInterface $terminal
     *
     * @return static
     */
    public function addTerminal(TerminalInterface $terminal): CompanyInterface;

    /**
     * Remove terminal
     *
     * @param TerminalInterface $terminal
     *
     * @return static
     */
    public function removeTerminal(TerminalInterface $terminal): CompanyInterface;

    /**
     * Replace terminals
     *
     * @param ArrayCollection $terminals of TerminalInterface
     *
     * @return static
     */
    public function replaceTerminals(ArrayCollection $terminals): CompanyInterface;

    /**
     * Get terminals
     * @param Criteria | null $criteria
     * @return TerminalInterface[]
     */
    public function getTerminals(?Criteria $criteria = null): array;

    /**
     * Add ratingProfile
     *
     * @param RatingProfileInterface $ratingProfile
     *
     * @return static
     */
    public function addRatingProfile(RatingProfileInterface $ratingProfile): CompanyInterface;

    /**
     * Remove ratingProfile
     *
     * @param RatingProfileInterface $ratingProfile
     *
     * @return static
     */
    public function removeRatingProfile(RatingProfileInterface $ratingProfile): CompanyInterface;

    /**
     * Replace ratingProfiles
     *
     * @param ArrayCollection $ratingProfiles of RatingProfileInterface
     *
     * @return static
     */
    public function replaceRatingProfiles(ArrayCollection $ratingProfiles): CompanyInterface;

    /**
     * Get ratingProfiles
     * @param Criteria | null $criteria
     * @return RatingProfileInterface[]
     */
    public function getRatingProfiles(?Criteria $criteria = null): array;

    /**
     * Add musicsOnHold
     *
     * @param MusicOnHoldInterface $musicsOnHold
     *
     * @return static
     */
    public function addMusicsOnHold(MusicOnHoldInterface $musicsOnHold): CompanyInterface;

    /**
     * Remove musicsOnHold
     *
     * @param MusicOnHoldInterface $musicsOnHold
     *
     * @return static
     */
    public function removeMusicsOnHold(MusicOnHoldInterface $musicsOnHold): CompanyInterface;

    /**
     * Replace musicsOnHold
     *
     * @param ArrayCollection $musicsOnHold of MusicOnHoldInterface
     *
     * @return static
     */
    public function replaceMusicsOnHold(ArrayCollection $musicsOnHold): CompanyInterface;

    /**
     * Get musicsOnHold
     * @param Criteria | null $criteria
     * @return MusicOnHoldInterface[]
     */
    public function getMusicsOnHold(?Criteria $criteria = null): array;

    /**
     * Add recording
     *
     * @param RecordingInterface $recording
     *
     * @return static
     */
    public function addRecording(RecordingInterface $recording): CompanyInterface;

    /**
     * Remove recording
     *
     * @param RecordingInterface $recording
     *
     * @return static
     */
    public function removeRecording(RecordingInterface $recording): CompanyInterface;

    /**
     * Replace recordings
     *
     * @param ArrayCollection $recordings of RecordingInterface
     *
     * @return static
     */
    public function replaceRecordings(ArrayCollection $recordings): CompanyInterface;

    /**
     * Get recordings
     * @param Criteria | null $criteria
     * @return RecordingInterface[]
     */
    public function getRecordings(?Criteria $criteria = null): array;

    /**
     * Add relFeature
     *
     * @param FeaturesRelCompanyInterface $relFeature
     *
     * @return static
     */
    public function addRelFeature(FeaturesRelCompanyInterface $relFeature): CompanyInterface;

    /**
     * Remove relFeature
     *
     * @param FeaturesRelCompanyInterface $relFeature
     *
     * @return static
     */
    public function removeRelFeature(FeaturesRelCompanyInterface $relFeature): CompanyInterface;

    /**
     * Replace relFeatures
     *
     * @param ArrayCollection $relFeatures of FeaturesRelCompanyInterface
     *
     * @return static
     */
    public function replaceRelFeatures(ArrayCollection $relFeatures): CompanyInterface;

    /**
     * Get relFeatures
     * @param Criteria | null $criteria
     * @return FeaturesRelCompanyInterface[]
     */
    public function getRelFeatures(?Criteria $criteria = null): array;

    /**
     * Add relCodec
     *
     * @param CompanyRelCodecInterface $relCodec
     *
     * @return static
     */
    public function addRelCodec(CompanyRelCodecInterface $relCodec): CompanyInterface;

    /**
     * Remove relCodec
     *
     * @param CompanyRelCodecInterface $relCodec
     *
     * @return static
     */
    public function removeRelCodec(CompanyRelCodecInterface $relCodec): CompanyInterface;

    /**
     * Replace relCodecs
     *
     * @param ArrayCollection $relCodecs of CompanyRelCodecInterface
     *
     * @return static
     */
    public function replaceRelCodecs(ArrayCollection $relCodecs): CompanyInterface;

    /**
     * Get relCodecs
     * @param Criteria | null $criteria
     * @return CompanyRelCodecInterface[]
     */
    public function getRelCodecs(?Criteria $criteria = null): array;

    /**
     * Add relRoutingTag
     *
     * @param CompanyRelRoutingTagInterface $relRoutingTag
     *
     * @return static
     */
    public function addRelRoutingTag(CompanyRelRoutingTagInterface $relRoutingTag): CompanyInterface;

    /**
     * Remove relRoutingTag
     *
     * @param CompanyRelRoutingTagInterface $relRoutingTag
     *
     * @return static
     */
    public function removeRelRoutingTag(CompanyRelRoutingTagInterface $relRoutingTag): CompanyInterface;

    /**
     * Replace relRoutingTags
     *
     * @param ArrayCollection $relRoutingTags of CompanyRelRoutingTagInterface
     *
     * @return static
     */
    public function replaceRelRoutingTags(ArrayCollection $relRoutingTags): CompanyInterface;

    /**
     * Get relRoutingTags
     * @param Criteria | null $criteria
     * @return CompanyRelRoutingTagInterface[]
     */
    public function getRelRoutingTags(?Criteria $criteria = null): array;

}
