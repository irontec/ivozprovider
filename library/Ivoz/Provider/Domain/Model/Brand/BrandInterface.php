<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface BrandInterface extends FileContainerInterface, LoggableEntityInterface
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
     * @see BrandAbstract::setDomainUsers
     */
    public function setDomainUsers($domainUsers = null);

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

    /**
     * Return Brand Cgrates tenant code
     *
     * @return string
     */
    public function getCgrTenant();

    public function getServiceByIden(string $iden);

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
     * Get maxCalls
     *
     * @return integer
     */
    public function getMaxCalls();

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
    public function setDefaultTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $defaultTimezone);

    /**
     * Get defaultTimezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getDefaultTimezone();

    /**
     * Set currency
     *
     * @param \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface $currency
     *
     * @return self
     */
    public function setCurrency(\Ivoz\Provider\Domain\Model\Currency\CurrencyInterface $currency = null);

    /**
     * Get currency
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface
     */
    public function getCurrency();

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
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface[]
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
     * @return \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface[]
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
     * @return \Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface[]
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
     * @return \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface[]
     */
    public function getRelFeatures(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     *
     * @return BrandTrait
     */
    public function addResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice);

    /**
     * Remove residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     */
    public function removeResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice);

    /**
     * Replace residentialDevices
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface[] $residentialDevices
     * @return self
     */
    public function replaceResidentialDevices(Collection $residentialDevices);

    /**
     * Get residentialDevices
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface[]
     */
    public function getResidentialDevices(\Doctrine\Common\Collections\Criteria $criteria = null);

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
     * @return \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface[]
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
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface[]
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
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param $fldName
     * @param TempFile $file
     */
    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @param TempFile $file
     * @throws \Exception
     */
    public function removeTmpFile(\Ivoz\Core\Domain\Service\TempFile $file);

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
