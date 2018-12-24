<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface CompanyInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setName($name);

    /**
     * {@inheritDoc}
     */
    public function setOnDemandRecordCode($onDemandRecordCode = null);

    /**
     * @param string $exten
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getExtension($exten);

    /**
     * @param $ddieE164
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface|null
     */
    public function getDdi($ddieE164);

    public function getFriend($exten);

    public function getService($exten);

    public function getTerminal($name);

    public function getLanguageCode();

    /**
     * brief: Get musicclass for given company
     *
     * If no specific company music on hold is found, brand music will be used.
     * If no specific brand music  on hold is found, dafault music will be sued.
     *
     */
    public function getMusicClass();

    /**
     * @inheritdoc
     */
    public function setDomainUsers($domainUsers = null);

    public function getOutgoingRoutings();

    /**
     * Get the size in bytes used by the recordings on this company
     */
    public function getRecordingsDiskUsage();

    /**
     * Get the size in bytes for disk usage limit on this company
     */
    public function getRecordingsLimit();

    /**
     * Check if a Company has a given Feature by id
     *
     * @param $featureId
     * @return bool
     */
    public function hasFeature($featureId);

    /**
     * Get On demand recording code DTMFs
     */
    public function getOnDemandRecordDTMFs();

    /**
     * @return FeatureInterface[]
     */
    public function getFeatures();

    /**
     * @param string $name
     * @return string
     */
    public function getServiceCode($name);

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getDefaultTimezone();

    /**
     * @return string
     */
    public function getCgrSubject();

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get domainUsers
     *
     * @return string | null
     */
    public function getDomainUsers();

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif();

    /**
     * Get distributeMethod
     *
     * @return string
     */
    public function getDistributeMethod();

    /**
     * Get maxCalls
     *
     * @return integer
     */
    public function getMaxCalls();

    /**
     * Get postalAddress
     *
     * @return string
     */
    public function getPostalAddress();

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode();

    /**
     * Get town
     *
     * @return string
     */
    public function getTown();

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince();

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName();

    /**
     * Get ipfilter
     *
     * @return boolean | null
     */
    public function getIpfilter();

    /**
     * Get onDemandRecord
     *
     * @return integer | null
     */
    public function getOnDemandRecord();

    /**
     * Get onDemandRecordCode
     *
     * @return string | null
     */
    public function getOnDemandRecordCode();

    /**
     * Get externallyextraopts
     *
     * @return string | null
     */
    public function getExternallyextraopts();

    /**
     * Get recordingsLimitMB
     *
     * @return integer | null
     */
    public function getRecordingsLimitMB();

    /**
     * Get recordingsLimitEmail
     *
     * @return string | null
     */
    public function getRecordingsLimitEmail();

    /**
     * Get billingMethod
     *
     * @return string
     */
    public function getBillingMethod();

    /**
     * Get balance
     *
     * @return string | null
     */
    public function getBalance();

    /**
     * Get showInvoices
     *
     * @return boolean | null
     */
    public function getShowInvoices();

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     *
     * @return self
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null);

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage();

    /**
     * Set mediaRelaySets
     *
     * @param \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySets
     *
     * @return self
     */
    public function setMediaRelaySets(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySets = null);

    /**
     * Get mediaRelaySets
     *
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface
     */
    public function getMediaRelaySets();

    /**
     * Set defaultTimezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone
     *
     * @return self
     */
    public function setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone = null);

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain
     *
     * @return self
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null);

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain();

    /**
     * Set applicationServer
     *
     * @param \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer
     *
     * @return self
     */
    public function setApplicationServer(\Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer = null);

    /**
     * Get applicationServer
     *
     * @return \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface
     */
    public function getApplicationServer();

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return self
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null);

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry();

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet
     *
     * @return self
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null);

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    public function getTransformationRuleSet();

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi
     *
     * @return self
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null);

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi();

    /**
     * Set outgoingDdiRule
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule
     *
     * @return self
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule = null);

    /**
     * Get outgoingDdiRule
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface | null
     */
    public function getOutgoingDdiRule();

    /**
     * Set voicemailNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $voicemailNotificationTemplate
     *
     * @return self
     */
    public function setVoicemailNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $voicemailNotificationTemplate = null);

    /**
     * Get voicemailNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getVoicemailNotificationTemplate();

    /**
     * Set faxNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $faxNotificationTemplate
     *
     * @return self
     */
    public function setFaxNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $faxNotificationTemplate = null);

    /**
     * Get faxNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getFaxNotificationTemplate();

    /**
     * Set invoiceNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $invoiceNotificationTemplate
     *
     * @return self
     */
    public function setInvoiceNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $invoiceNotificationTemplate = null);

    /**
     * Get invoiceNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getInvoiceNotificationTemplate();

    /**
     * Set callCsvNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $callCsvNotificationTemplate
     *
     * @return self
     */
    public function setCallCsvNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $callCsvNotificationTemplate = null);

    /**
     * Get callCsvNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getCallCsvNotificationTemplate();

    /**
     * Add extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension
     *
     * @return CompanyTrait
     */
    public function addExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension);

    /**
     * Remove extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension
     */
    public function removeExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension);

    /**
     * Replace extensions
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface[] $extensions
     * @return self
     */
    public function replaceExtensions(Collection $extensions);

    /**
     * Get extensions
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface[]
     */
    public function getExtensions(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     *
     * @return CompanyTrait
     */
    public function addDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi);

    /**
     * Remove ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     */
    public function removeDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi);

    /**
     * Replace ddis
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface[] $ddis
     * @return self
     */
    public function replaceDdis(Collection $ddis);

    /**
     * Get ddis
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface[]
     */
    public function getDdis(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     *
     * @return CompanyTrait
     */
    public function addFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend);

    /**
     * Remove friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     */
    public function removeFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend);

    /**
     * Replace friends
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface[] $friends
     * @return self
     */
    public function replaceFriends(Collection $friends);

    /**
     * Get friends
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface[]
     */
    public function getFriends(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add companyService
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface $companyService
     *
     * @return CompanyTrait
     */
    public function addCompanyService(\Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface $companyService);

    /**
     * Remove companyService
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface $companyService
     */
    public function removeCompanyService(\Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface $companyService);

    /**
     * Replace companyServices
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface[] $companyServices
     * @return self
     */
    public function replaceCompanyServices(Collection $companyServices);

    /**
     * Get companyServices
     *
     * @return \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface[]
     */
    public function getCompanyServices(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     *
     * @return CompanyTrait
     */
    public function addTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal);

    /**
     * Remove terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     */
    public function removeTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal);

    /**
     * Replace terminals
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface[] $terminals
     * @return self
     */
    public function replaceTerminals(Collection $terminals);

    /**
     * Get terminals
     *
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface[]
     */
    public function getTerminals(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     *
     * @return CompanyTrait
     */
    public function addRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile);

    /**
     * Remove ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     */
    public function removeRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile);

    /**
     * Replace ratingProfiles
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface[] $ratingProfiles
     * @return self
     */
    public function replaceRatingProfiles(Collection $ratingProfiles);

    /**
     * Get ratingProfiles
     *
     * @return \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface[]
     */
    public function getRatingProfiles(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add musicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold
     *
     * @return CompanyTrait
     */
    public function addMusicsOnHold(\Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold);

    /**
     * Remove musicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold
     */
    public function removeMusicsOnHold(\Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold);

    /**
     * Replace musicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface[] $musicsOnHold
     * @return self
     */
    public function replaceMusicsOnHold(Collection $musicsOnHold);

    /**
     * Get musicsOnHold
     *
     * @return \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface[]
     */
    public function getMusicsOnHold(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add recording
     *
     * @param \Ivoz\Provider\Domain\Model\Recording\RecordingInterface $recording
     *
     * @return CompanyTrait
     */
    public function addRecording(\Ivoz\Provider\Domain\Model\Recording\RecordingInterface $recording);

    /**
     * Remove recording
     *
     * @param \Ivoz\Provider\Domain\Model\Recording\RecordingInterface $recording
     */
    public function removeRecording(\Ivoz\Provider\Domain\Model\Recording\RecordingInterface $recording);

    /**
     * Replace recordings
     *
     * @param \Ivoz\Provider\Domain\Model\Recording\RecordingInterface[] $recordings
     * @return self
     */
    public function replaceRecordings(Collection $recordings);

    /**
     * Get recordings
     *
     * @return \Ivoz\Provider\Domain\Model\Recording\RecordingInterface[]
     */
    public function getRecordings(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relFeature
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface $relFeature
     *
     * @return CompanyTrait
     */
    public function addRelFeature(\Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface $relFeature);

    /**
     * Remove relFeature
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface $relFeature
     */
    public function removeRelFeature(\Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface $relFeature);

    /**
     * Replace relFeatures
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface[] $relFeatures
     * @return self
     */
    public function replaceRelFeatures(Collection $relFeatures);

    /**
     * Get relFeatures
     *
     * @return \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface[]
     */
    public function getRelFeatures(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relCodec
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface $relCodec
     *
     * @return CompanyTrait
     */
    public function addRelCodec(\Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface $relCodec);

    /**
     * Remove relCodec
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface $relCodec
     */
    public function removeRelCodec(\Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface $relCodec);

    /**
     * Replace relCodecs
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface[] $relCodecs
     * @return self
     */
    public function replaceRelCodecs(Collection $relCodecs);

    /**
     * Get relCodecs
     *
     * @return \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface[]
     */
    public function getRelCodecs(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relRoutingTag
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relRoutingTag
     *
     * @return CompanyTrait
     */
    public function addRelRoutingTag(\Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relRoutingTag);

    /**
     * Remove relRoutingTag
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relRoutingTag
     */
    public function removeRelRoutingTag(\Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relRoutingTag);

    /**
     * Replace relRoutingTags
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface[] $relRoutingTags
     * @return self
     */
    public function replaceRelRoutingTags(Collection $relRoutingTags);

    /**
     * Get relRoutingTags
     *
     * @return \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface[]
     */
    public function getRelRoutingTags(\Doctrine\Common\Collections\Criteria $criteria = null);
}
