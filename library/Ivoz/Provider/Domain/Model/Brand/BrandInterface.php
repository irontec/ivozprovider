<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
* BrandInterface
*/
interface BrandInterface extends LoggableEntityInterface, FileContainerInterface
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
    public function setDomainUsers(string $domainUsers = null): BrandInterface;

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
    public function getDomainUsers(): ?string;

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
     * Get maxCalls
     *
     * @return int
     */
    public function getMaxCalls(): int;

    /**
     * Get logo
     *
     * @return Logo
     */
    public function getLogo(): Logo;

    /**
     * Get invoice
     *
     * @return Invoice
     */
    public function getInvoice(): Invoice;

    /**
     * Get domain
     *
     * @return DomainInterface | null
     */
    public function getDomain(): ?DomainInterface;

    /**
     * Get language
     *
     * @return LanguageInterface | null
     */
    public function getLanguage(): ?LanguageInterface;

    /**
     * Get defaultTimezone
     *
     * @return TimezoneInterface
     */
    public function getDefaultTimezone(): TimezoneInterface;

    /**
     * Get currency
     *
     * @return CurrencyInterface | null
     */
    public function getCurrency(): ?CurrencyInterface;

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
     * Add company
     *
     * @param CompanyInterface $company
     *
     * @return static
     */
    public function addCompany(CompanyInterface $company): BrandInterface;

    /**
     * Remove company
     *
     * @param CompanyInterface $company
     *
     * @return static
     */
    public function removeCompany(CompanyInterface $company): BrandInterface;

    /**
     * Replace companies
     *
     * @param ArrayCollection $companies of CompanyInterface
     *
     * @return static
     */
    public function replaceCompanies(ArrayCollection $companies): BrandInterface;

    /**
     * Get companies
     * @param Criteria | null $criteria
     * @return CompanyInterface[]
     */
    public function getCompanies(?Criteria $criteria = null): array;

    /**
     * Add service
     *
     * @param BrandServiceInterface $service
     *
     * @return static
     */
    public function addService(BrandServiceInterface $service): BrandInterface;

    /**
     * Remove service
     *
     * @param BrandServiceInterface $service
     *
     * @return static
     */
    public function removeService(BrandServiceInterface $service): BrandInterface;

    /**
     * Replace services
     *
     * @param ArrayCollection $services of BrandServiceInterface
     *
     * @return static
     */
    public function replaceServices(ArrayCollection $services): BrandInterface;

    /**
     * Get services
     * @param Criteria | null $criteria
     * @return BrandServiceInterface[]
     */
    public function getServices(?Criteria $criteria = null): array;

    /**
     * Add url
     *
     * @param WebPortalInterface $url
     *
     * @return static
     */
    public function addUrl(WebPortalInterface $url): BrandInterface;

    /**
     * Remove url
     *
     * @param WebPortalInterface $url
     *
     * @return static
     */
    public function removeUrl(WebPortalInterface $url): BrandInterface;

    /**
     * Replace urls
     *
     * @param ArrayCollection $urls of WebPortalInterface
     *
     * @return static
     */
    public function replaceUrls(ArrayCollection $urls): BrandInterface;

    /**
     * Get urls
     * @param Criteria | null $criteria
     * @return WebPortalInterface[]
     */
    public function getUrls(?Criteria $criteria = null): array;

    /**
     * Add relFeature
     *
     * @param FeaturesRelBrandInterface $relFeature
     *
     * @return static
     */
    public function addRelFeature(FeaturesRelBrandInterface $relFeature): BrandInterface;

    /**
     * Remove relFeature
     *
     * @param FeaturesRelBrandInterface $relFeature
     *
     * @return static
     */
    public function removeRelFeature(FeaturesRelBrandInterface $relFeature): BrandInterface;

    /**
     * Replace relFeatures
     *
     * @param ArrayCollection $relFeatures of FeaturesRelBrandInterface
     *
     * @return static
     */
    public function replaceRelFeatures(ArrayCollection $relFeatures): BrandInterface;

    /**
     * Get relFeatures
     * @param Criteria | null $criteria
     * @return FeaturesRelBrandInterface[]
     */
    public function getRelFeatures(?Criteria $criteria = null): array;

    /**
     * Add relProxyTrunk
     *
     * @param ProxyTrunksRelBrandInterface $relProxyTrunk
     *
     * @return static
     */
    public function addRelProxyTrunk(ProxyTrunksRelBrandInterface $relProxyTrunk): BrandInterface;

    /**
     * Remove relProxyTrunk
     *
     * @param ProxyTrunksRelBrandInterface $relProxyTrunk
     *
     * @return static
     */
    public function removeRelProxyTrunk(ProxyTrunksRelBrandInterface $relProxyTrunk): BrandInterface;

    /**
     * Replace relProxyTrunks
     *
     * @param ArrayCollection $relProxyTrunks of ProxyTrunksRelBrandInterface
     *
     * @return static
     */
    public function replaceRelProxyTrunks(ArrayCollection $relProxyTrunks): BrandInterface;

    /**
     * Get relProxyTrunks
     * @param Criteria | null $criteria
     * @return ProxyTrunksRelBrandInterface[]
     */
    public function getRelProxyTrunks(?Criteria $criteria = null): array;

    /**
     * Add residentialDevice
     *
     * @param ResidentialDeviceInterface $residentialDevice
     *
     * @return static
     */
    public function addResidentialDevice(ResidentialDeviceInterface $residentialDevice): BrandInterface;

    /**
     * Remove residentialDevice
     *
     * @param ResidentialDeviceInterface $residentialDevice
     *
     * @return static
     */
    public function removeResidentialDevice(ResidentialDeviceInterface $residentialDevice): BrandInterface;

    /**
     * Replace residentialDevices
     *
     * @param ArrayCollection $residentialDevices of ResidentialDeviceInterface
     *
     * @return static
     */
    public function replaceResidentialDevices(ArrayCollection $residentialDevices): BrandInterface;

    /**
     * Get residentialDevices
     * @param Criteria | null $criteria
     * @return ResidentialDeviceInterface[]
     */
    public function getResidentialDevices(?Criteria $criteria = null): array;

    /**
     * Add musicsOnHold
     *
     * @param MusicOnHoldInterface $musicsOnHold
     *
     * @return static
     */
    public function addMusicsOnHold(MusicOnHoldInterface $musicsOnHold): BrandInterface;

    /**
     * Remove musicsOnHold
     *
     * @param MusicOnHoldInterface $musicsOnHold
     *
     * @return static
     */
    public function removeMusicsOnHold(MusicOnHoldInterface $musicsOnHold): BrandInterface;

    /**
     * Replace musicsOnHold
     *
     * @param ArrayCollection $musicsOnHold of MusicOnHoldInterface
     *
     * @return static
     */
    public function replaceMusicsOnHold(ArrayCollection $musicsOnHold): BrandInterface;

    /**
     * Get musicsOnHold
     * @param Criteria | null $criteria
     * @return MusicOnHoldInterface[]
     */
    public function getMusicsOnHold(?Criteria $criteria = null): array;

    /**
     * Add matchList
     *
     * @param MatchListInterface $matchList
     *
     * @return static
     */
    public function addMatchList(MatchListInterface $matchList): BrandInterface;

    /**
     * Remove matchList
     *
     * @param MatchListInterface $matchList
     *
     * @return static
     */
    public function removeMatchList(MatchListInterface $matchList): BrandInterface;

    /**
     * Replace matchLists
     *
     * @param ArrayCollection $matchLists of MatchListInterface
     *
     * @return static
     */
    public function replaceMatchLists(ArrayCollection $matchLists): BrandInterface;

    /**
     * Get matchLists
     * @param Criteria | null $criteria
     * @return MatchListInterface[]
     */
    public function getMatchLists(?Criteria $criteria = null): array;

    /**
     * Add outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): BrandInterface;

    /**
     * Remove outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): BrandInterface;

    /**
     * Replace outgoingRoutings
     *
     * @param ArrayCollection $outgoingRoutings of OutgoingRoutingInterface
     *
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): BrandInterface;

    /**
     * Get outgoingRoutings
     * @param Criteria | null $criteria
     * @return OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(?Criteria $criteria = null): array;

    /**
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

    /**
     * @throws \Exception
     * @return void
     */
    public function removeTmpFile(TempFile $file);

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
