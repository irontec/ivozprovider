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

    public function getCompanyActivePricingPlan($date = null);

    public function getLanguageCode();

    /**
     * @brief Get musicclass for given company
     *
     * If no specific company music on hold is found, brand music will be used.
     * If no specific brand music  on hold is found, dafault music will be sued.
     *
     */
    public function getMusicClass();

    /**
     * Ensures valid domain value
     * @param string $data
     * @return \Ivoz\Provider\Model\Raw\Companies
     * @throws \Exception
     */
    public function setDomainUsers($domainUsers = null);

    /**
     *
     * @param string $number
     * @return bool tarificable
     */
    public function isDstTarificable($number);

    public function getOutgoingRoutings();

    /**
     * Get the size in bytes used by the recordings on this company
     */
    public function getRecordingsDiskUsage();

    /**
     * Get the size in bytes for disk usage limit on this company
     */
    public function getRecordingsLimit();

    public function hasFeature($featureId);

    /**
     * Get On demand recording code DTMFs
     */
    public function getOnDemandRecordDTMFs();

    public function getFeatures();

    public function __toString();

    /**
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type);

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
     * @return string
     */
    public function getDomainUsers();

    /**
     * Set nif
     *
     * @param string $nif
     *
     * @return self
     */
    public function setNif($nif);

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif();

    /**
     * Set distributeMethod
     *
     * @param string $distributeMethod
     *
     * @return self
     */
    public function setDistributeMethod($distributeMethod);

    /**
     * Get distributeMethod
     *
     * @return string
     */
    public function getDistributeMethod();

    /**
     * Set externalMaxCalls
     *
     * @param integer $externalMaxCalls
     *
     * @return self
     */
    public function setExternalMaxCalls($externalMaxCalls);

    /**
     * Get externalMaxCalls
     *
     * @return integer
     */
    public function getExternalMaxCalls();

    /**
     * Set postalAddress
     *
     * @param string $postalAddress
     *
     * @return self
     */
    public function setPostalAddress($postalAddress);

    /**
     * Get postalAddress
     *
     * @return string
     */
    public function getPostalAddress();

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return self
     */
    public function setPostalCode($postalCode);

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode();

    /**
     * Set town
     *
     * @param string $town
     *
     * @return self
     */
    public function setTown($town);

    /**
     * Get town
     *
     * @return string
     */
    public function getTown();

    /**
     * Set province
     *
     * @param string $province
     *
     * @return self
     */
    public function setProvince($province);

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince();

    /**
     * Set countryName
     *
     * @param string $countryName
     *
     * @return self
     */
    public function setCountryName($countryName);

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName();

    /**
     * Set ipfilter
     *
     * @param boolean $ipfilter
     *
     * @return self
     */
    public function setIpfilter($ipfilter = null);

    /**
     * Get ipfilter
     *
     * @return boolean
     */
    public function getIpfilter();

    /**
     * Set onDemandRecord
     *
     * @param integer $onDemandRecord
     *
     * @return self
     */
    public function setOnDemandRecord($onDemandRecord = null);

    /**
     * Get onDemandRecord
     *
     * @return integer
     */
    public function getOnDemandRecord();

    /**
     * Get onDemandRecordCode
     *
     * @return string
     */
    public function getOnDemandRecordCode();

    /**
     * Set externallyextraopts
     *
     * @param string $externallyextraopts
     *
     * @return self
     */
    public function setExternallyextraopts($externallyextraopts = null);

    /**
     * Get externallyextraopts
     *
     * @return string
     */
    public function getExternallyextraopts();

    /**
     * Set recordingsLimitMB
     *
     * @param integer $recordingsLimitMB
     *
     * @return self
     */
    public function setRecordingsLimitMB($recordingsLimitMB = null);

    /**
     * Get recordingsLimitMB
     *
     * @return integer
     */
    public function getRecordingsLimitMB();

    /**
     * Set recordingsLimitEmail
     *
     * @param string $recordingsLimitEmail
     *
     * @return self
     */
    public function setRecordingsLimitEmail($recordingsLimitEmail = null);

    /**
     * Get recordingsLimitEmail
     *
     * @return string
     */
    public function getRecordingsLimitEmail();

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
     * Get defaultTimezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getDefaultTimezone();

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
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface
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
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    public function getOutgoingDdiRule();

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
     * @return array
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
     * @return array
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
     * @return array
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
     * @return array
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
     * @return array
     */
    public function getTerminals(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relPricingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\PricingPlansRelCompany\PricingPlansRelCompanyInterface $relPricingPlan
     *
     * @return CompanyTrait
     */
    public function addRelPricingPlan(\Ivoz\Provider\Domain\Model\PricingPlansRelCompany\PricingPlansRelCompanyInterface $relPricingPlan);

    /**
     * Remove relPricingPlan
     *
     * @param \Ivoz\Provider\Domain\Model\PricingPlansRelCompany\PricingPlansRelCompanyInterface $relPricingPlan
     */
    public function removeRelPricingPlan(\Ivoz\Provider\Domain\Model\PricingPlansRelCompany\PricingPlansRelCompanyInterface $relPricingPlan);

    /**
     * Replace relPricingPlans
     *
     * @param \Ivoz\Provider\Domain\Model\PricingPlansRelCompany\PricingPlansRelCompanyInterface[] $relPricingPlans
     * @return self
     */
    public function replaceRelPricingPlans(Collection $relPricingPlans);

    /**
     * Get relPricingPlans
     *
     * @return array
     */
    public function getRelPricingPlans(\Doctrine\Common\Collections\Criteria $criteria = null);

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
     * @return array
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
     * @return array
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
     * @return array
     */
    public function getRelFeatures(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain
     *
     * @return CompanyTrait
     */
    public function addDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain);

    /**
     * Remove domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain
     */
    public function removeDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain);

    /**
     * Replace domains
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface[] $domains
     * @return self
     */
    public function replaceDomains(Collection $domains);

    /**
     * Get domains
     *
     * @return array
     */
    public function getDomains(\Doctrine\Common\Collections\Criteria $criteria = null);

}

