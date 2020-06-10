<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
    public function setName($name);

    /**
     * {@inheritDoc}
     */
    public function setOnDemandRecordCode($onDemandRecordCode = null);

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
    public function setDomainUsers($domainUsers = null);

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
    public function hasFeature($featureId) :bool;

    public function hasFeatureByIden(string $iden) :bool;

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

    public function isVpbx() :bool;

    public function isRetail() :bool;

    public function isResidential() :bool;

    public function isWholesale() :bool;

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
     * Get maxDailyUsage
     *
     * @return integer
     */
    public function getMaxDailyUsage();

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
     * Get allowRecordingRemoval
     *
     * @return boolean
     */
    public function getAllowRecordingRemoval();

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
     * @return float | null
     */
    public function getBalance();

    /**
     * Get showInvoices
     *
     * @return boolean | null
     */
    public function getShowInvoices();

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage();

    /**
     * Get mediaRelaySets
     *
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface | null
     */
    public function getMediaRelaySets();

    /**
     * Get defaultTimezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    public function getDefaultTimezone();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain();

    /**
     * Get applicationServer
     *
     * @return \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface | null
     */
    public function getApplicationServer();

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getCountry();

    /**
     * Get currency
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface | null
     */
    public function getCurrency();

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet();

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getOutgoingDdi();

    /**
     * Get outgoingDdiRule
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface | null
     */
    public function getOutgoingDdiRule();

    /**
     * Get voicemailNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getVoicemailNotificationTemplate();

    /**
     * Get faxNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getFaxNotificationTemplate();

    /**
     * Get invoiceNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getInvoiceNotificationTemplate();

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
     * @return static
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
     * @param ArrayCollection $extensions of Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     * @return static
     */
    public function replaceExtensions(ArrayCollection $extensions);

    /**
     * Get extensions
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface[]
     */
    public function getExtensions(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     *
     * @return static
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
     * @param ArrayCollection $ddis of Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     * @return static
     */
    public function replaceDdis(ArrayCollection $ddis);

    /**
     * Get ddis
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface[]
     */
    public function getDdis(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     *
     * @return static
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
     * @param ArrayCollection $friends of Ivoz\Provider\Domain\Model\Friend\FriendInterface
     * @return static
     */
    public function replaceFriends(ArrayCollection $friends);

    /**
     * Get friends
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface[]
     */
    public function getFriends(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add companyService
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface $companyService
     *
     * @return static
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
     * @param ArrayCollection $companyServices of Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface
     * @return static
     */
    public function replaceCompanyServices(ArrayCollection $companyServices);

    /**
     * Get companyServices
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface[]
     */
    public function getCompanyServices(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     *
     * @return static
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
     * @param ArrayCollection $terminals of Ivoz\Provider\Domain\Model\Terminal\TerminalInterface
     * @return static
     */
    public function replaceTerminals(ArrayCollection $terminals);

    /**
     * Get terminals
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface[]
     */
    public function getTerminals(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     *
     * @return static
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
     * @param ArrayCollection $ratingProfiles of Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface
     * @return static
     */
    public function replaceRatingProfiles(ArrayCollection $ratingProfiles);

    /**
     * Get ratingProfiles
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface[]
     */
    public function getRatingProfiles(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add musicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold
     *
     * @return static
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
     * @param ArrayCollection $musicsOnHold of Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface
     * @return static
     */
    public function replaceMusicsOnHold(ArrayCollection $musicsOnHold);

    /**
     * Get musicsOnHold
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface[]
     */
    public function getMusicsOnHold(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add recording
     *
     * @param \Ivoz\Provider\Domain\Model\Recording\RecordingInterface $recording
     *
     * @return static
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
     * @param ArrayCollection $recordings of Ivoz\Provider\Domain\Model\Recording\RecordingInterface
     * @return static
     */
    public function replaceRecordings(ArrayCollection $recordings);

    /**
     * Get recordings
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\Recording\RecordingInterface[]
     */
    public function getRecordings(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relFeature
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface $relFeature
     *
     * @return static
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
     * @param ArrayCollection $relFeatures of Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface
     * @return static
     */
    public function replaceRelFeatures(ArrayCollection $relFeatures);

    /**
     * Get relFeatures
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface[]
     */
    public function getRelFeatures(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relCodec
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface $relCodec
     *
     * @return static
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
     * @param ArrayCollection $relCodecs of Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface
     * @return static
     */
    public function replaceRelCodecs(ArrayCollection $relCodecs);

    /**
     * Get relCodecs
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface[]
     */
    public function getRelCodecs(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relRoutingTag
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relRoutingTag
     *
     * @return static
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
     * @param ArrayCollection $relRoutingTags of Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface
     * @return static
     */
    public function replaceRelRoutingTags(ArrayCollection $relRoutingTags);

    /**
     * Get relRoutingTags
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface[]
     */
    public function getRelRoutingTags(\Doctrine\Common\Collections\Criteria $criteria = null);
}
