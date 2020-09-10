<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
    public function getFileObjects(int $filter = null);

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
     * @return \Ivoz\Provider\Domain\Model\Feature\FeatureInterface[]
     */
    public function getFeatures();

    /**
     * @param int $featureId
     * @return bool
     */
    public function hasFeature($featureId);

    public function hasFeatureByIden(string $iden): bool;

    /**
     * Return Brand Cgrates tenant code
     *
     * @return string
     */
    public function getCgrTenant();

    /**
     * @param string $exten
     * @return \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface|null
     */
    public function getService($exten);

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
    public function getMaxCalls(): int;

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain();

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage();

    /**
     * Get defaultTimezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getDefaultTimezone();

    /**
     * Get currency
     *
     * @return \Ivoz\Provider\Domain\Model\Currency\CurrencyInterface | null
     */
    public function getCurrency();

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
     * Get maxDailyUsageNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getMaxDailyUsageNotificationTemplate();

    /**
     * Get logo
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\Logo
     */
    public function getLogo();

    /**
     * Get invoice
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\Invoice
     */
    public function getInvoice();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
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
     * @param ArrayCollection $companies of Ivoz\Provider\Domain\Model\Company\CompanyInterface
     * @return static
     */
    public function replaceCompanies(ArrayCollection $companies);

    /**
     * Get companies
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface[]
     */
    public function getCompanies(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add service
     *
     * @param \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface $service
     *
     * @return static
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
     * @param ArrayCollection $services of Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface
     * @return static
     */
    public function replaceServices(ArrayCollection $services);

    /**
     * Get services
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface[]
     */
    public function getServices(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add url
     *
     * @param \Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface $url
     *
     * @return static
     */
    public function addUrl(\Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface $url);

    /**
     * Remove url
     *
     * @param \Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface $url
     */
    public function removeUrl(\Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface $url);

    /**
     * Replace urls
     *
     * @param ArrayCollection $urls of Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface
     * @return static
     */
    public function replaceUrls(ArrayCollection $urls);

    /**
     * Get urls
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface[]
     */
    public function getUrls(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relFeature
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface $relFeature
     *
     * @return static
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
     * @param ArrayCollection $relFeatures of Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface
     * @return static
     */
    public function replaceRelFeatures(ArrayCollection $relFeatures);

    /**
     * Get relFeatures
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface[]
     */
    public function getRelFeatures(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relProxyTrunk
     *
     * @param \Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface $relProxyTrunk
     *
     * @return static
     */
    public function addRelProxyTrunk(\Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface $relProxyTrunk);

    /**
     * Remove relProxyTrunk
     *
     * @param \Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface $relProxyTrunk
     */
    public function removeRelProxyTrunk(\Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface $relProxyTrunk);

    /**
     * Replace relProxyTrunks
     *
     * @param ArrayCollection $relProxyTrunks of Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface
     * @return static
     */
    public function replaceRelProxyTrunks(ArrayCollection $relProxyTrunks);

    /**
     * Get relProxyTrunks
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface[]
     */
    public function getRelProxyTrunks(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     *
     * @return static
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
     * @param ArrayCollection $residentialDevices of Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface
     * @return static
     */
    public function replaceResidentialDevices(ArrayCollection $residentialDevices);

    /**
     * Get residentialDevices
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface[]
     */
    public function getResidentialDevices(\Doctrine\Common\Collections\Criteria $criteria = null);

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
     * Add matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList
     *
     * @return static
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
     * @param ArrayCollection $matchLists of Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     * @return static
     */
    public function replaceMatchLists(ArrayCollection $matchLists);

    /**
     * Get matchLists
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface[]
     */
    public function getMatchLists(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
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
     * @param ArrayCollection $outgoingRoutings of Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings);

    /**
     * Get outgoingRoutings
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @throws \Exception
     *
     * @return void
     */
    public function removeTmpFile(\Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @return \Ivoz\Core\Domain\Service\TempFile[]
     */
    public function getTempFiles();

    /**
     * @var string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);
}
