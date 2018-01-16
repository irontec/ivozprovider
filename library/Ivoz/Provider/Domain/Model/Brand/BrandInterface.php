<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface BrandInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return array
     */
    public function getFileObjects();

    /**
     * @inheritdoc
     */
    public function setDomainUsers($domainUsers = null);

    public function getActivePricingPlans($date = null);

    public function getActivePrincingPlansIds($date = null);

    public function getLanguageCode();

    public function willUseExternallyRating(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company, $destination = null);

    /**
     * Get the size in bytes used by the recordings on this brand
     *
     */
    public function getRecordingsDiskUsage();

    /**
     * Get the size in bytes for disk usage limit on this brand
     */
    public function getRecordingsLimit();

    /**
     * @return FeatureInterface[]
     */
    public function getFeatures();

    /**
     * @param $featureId
     * @return bool
     */
    public function hasFeature($featureId);

    public function __toString();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

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
     * Set fromName
     *
     * @param string $fromName
     *
     * @return self
     */
    public function setFromName($fromName = null);

    /**
     * Get fromName
     *
     * @return string
     */
    public function getFromName();

    /**
     * Set fromAddress
     *
     * @param string $fromAddress
     *
     * @return self
     */
    public function setFromAddress($fromAddress = null);

    /**
     * Get fromAddress
     *
     * @return string
     */
    public function getFromAddress();

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
     * Set logo
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\Logo $logo
     *
     * @return self
     */
    public function setLogo(\Ivoz\Provider\Domain\Model\Brand\Logo $logo);

    /**
     * Get logo
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\Logo
     */
    public function getLogo();

    /**
     * Set invoice
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\Invoice $invoice
     *
     * @return self
     */
    public function setInvoice(\Ivoz\Provider\Domain\Model\Brand\Invoice $invoice);

    /**
     * Get invoice
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\Invoice
     */
    public function getInvoice();

    /**
     * Add company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return BrandTrait
     */
    public function addCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Remove company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     */
    public function removeCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Replace companies
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface[] $companies
     * @return self
     */
    public function replaceCompanies(Collection $companies);

    /**
     * Get companies
     *
     * @return array
     */
    public function getCompanies(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add service
     *
     * @param \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface $service
     *
     * @return BrandTrait
     */
    public function addService(\Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface $service);

    /**
     * Remove service
     *
     * @param \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface $service
     */
    public function removeService(\Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface $service);

    /**
     * Replace services
     *
     * @param \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface[] $services
     * @return self
     */
    public function replaceServices(Collection $services);

    /**
     * Get services
     *
     * @return array
     */
    public function getServices(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add url
     *
     * @param \Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface $url
     *
     * @return BrandTrait
     */
    public function addUrl(\Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface $url);

    /**
     * Remove url
     *
     * @param \Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface $url
     */
    public function removeUrl(\Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface $url);

    /**
     * Replace urls
     *
     * @param \Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface[] $urls
     * @return self
     */
    public function replaceUrls(Collection $urls);

    /**
     * Get urls
     *
     * @return array
     */
    public function getUrls(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relFeature
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface $relFeature
     *
     * @return BrandTrait
     */
    public function addRelFeature(\Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface $relFeature);

    /**
     * Remove relFeature
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface $relFeature
     */
    public function removeRelFeature(\Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface $relFeature);

    /**
     * Replace relFeatures
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface[] $relFeatures
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
     * @return BrandTrait
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

    /**
     * Add retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount
     *
     * @return BrandTrait
     */
    public function addRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount);

    /**
     * Remove retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount
     */
    public function removeRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount);

    /**
     * Replace retailAccounts
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface[] $retailAccounts
     * @return self
     */
    public function replaceRetailAccounts(Collection $retailAccounts);

    /**
     * Get retailAccounts
     *
     * @return array
     */
    public function getRetailAccounts(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add musicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold
     *
     * @return BrandTrait
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
     * Add matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList
     *
     * @return BrandTrait
     */
    public function addMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList);

    /**
     * Remove matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList
     */
    public function removeMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList);

    /**
     * Replace matchLists
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface[] $matchLists
     * @return self
     */
    public function replaceMatchLists(Collection $matchLists);

    /**
     * Get matchLists
     *
     * @return array
     */
    public function getMatchLists(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return BrandTrait
     */
    public function addOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting);

    /**
     * Remove outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     */
    public function removeOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting);

    /**
     * Replace outgoingRoutings
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[] $outgoingRoutings
     * @return self
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings);

    /**
     * Get outgoingRoutings
     *
     * @return array
     */
    public function getOutgoingRoutings(\Doctrine\Common\Collections\Criteria $criteria = null);

    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @return TempFile[]
     */
    public function getTempFiles();

    /**
     * @var string $fldName
     * @return null | TempFile
     */
    public function getTempFileByFieldName($fldName);

}

