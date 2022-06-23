<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Doctrine\Common\Collections\Collection;
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

/**
* BrandInterface
*/
interface BrandInterface extends LoggableEntityInterface, FileContainerInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int;

    /**
     * @inheritdoc
     * @see BrandAbstract::setDomainUsers
     */
    public function setDomainUsers(?string $domainUsers = null): static;

    public function getLanguageCode(): string;

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
     *
     * @return int
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
    public function getCgrTenant(): string;

    /**
     * @param string $exten
     * @return \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface|null
     */
    public function getService($exten);

    public static function createDto(string|int|null $id = null): BrandDto;

    /**
     * @internal use EntityTools instead
     * @param null|BrandInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?BrandDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BrandDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): BrandDto;

    public function getName(): string;

    public function getDomainUsers(): ?string;

    public function getRecordingsLimitMB(): ?int;

    public function getRecordingsLimitEmail(): ?string;

    public function getMaxCalls(): int;

    public function getLogo(): Logo;

    public function getInvoice(): Invoice;

    public function getDomain(): ?DomainInterface;

    public function getLanguage(): LanguageInterface;

    public function getDefaultTimezone(): TimezoneInterface;

    public function getCurrency(): CurrencyInterface;

    public function getVoicemailNotificationTemplate(): ?NotificationTemplateInterface;

    public function getFaxNotificationTemplate(): ?NotificationTemplateInterface;

    public function getInvoiceNotificationTemplate(): ?NotificationTemplateInterface;

    public function getCallCsvNotificationTemplate(): ?NotificationTemplateInterface;

    public function getMaxDailyUsageNotificationTemplate(): ?NotificationTemplateInterface;

    public function isInitialized(): bool;

    public function addCompany(CompanyInterface $company): BrandInterface;

    public function removeCompany(CompanyInterface $company): BrandInterface;

    /**
     * @param Collection<array-key, CompanyInterface> $companies
     */
    public function replaceCompanies(Collection $companies): BrandInterface;

    /**
     * @return array<array-key, CompanyInterface>
     */
    public function getCompanies(?Criteria $criteria = null): array;

    public function addService(BrandServiceInterface $service): BrandInterface;

    public function removeService(BrandServiceInterface $service): BrandInterface;

    /**
     * @param Collection<array-key, BrandServiceInterface> $services
     */
    public function replaceServices(Collection $services): BrandInterface;

    /**
     * @return array<array-key, BrandServiceInterface>
     */
    public function getServices(?Criteria $criteria = null): array;

    public function addUrl(WebPortalInterface $url): BrandInterface;

    public function removeUrl(WebPortalInterface $url): BrandInterface;

    /**
     * @param Collection<array-key, WebPortalInterface> $urls
     */
    public function replaceUrls(Collection $urls): BrandInterface;

    /**
     * @return array<array-key, WebPortalInterface>
     */
    public function getUrls(?Criteria $criteria = null): array;

    public function addRelFeature(FeaturesRelBrandInterface $relFeature): BrandInterface;

    public function removeRelFeature(FeaturesRelBrandInterface $relFeature): BrandInterface;

    /**
     * @param Collection<array-key, FeaturesRelBrandInterface> $relFeatures
     */
    public function replaceRelFeatures(Collection $relFeatures): BrandInterface;

    /**
     * @return array<array-key, FeaturesRelBrandInterface>
     */
    public function getRelFeatures(?Criteria $criteria = null): array;

    public function addRelProxyTrunk(ProxyTrunksRelBrandInterface $relProxyTrunk): BrandInterface;

    public function removeRelProxyTrunk(ProxyTrunksRelBrandInterface $relProxyTrunk): BrandInterface;

    /**
     * @param Collection<array-key, ProxyTrunksRelBrandInterface> $relProxyTrunks
     */
    public function replaceRelProxyTrunks(Collection $relProxyTrunks): BrandInterface;

    /**
     * @return array<array-key, ProxyTrunksRelBrandInterface>
     */
    public function getRelProxyTrunks(?Criteria $criteria = null): array;

    public function addResidentialDevice(ResidentialDeviceInterface $residentialDevice): BrandInterface;

    public function removeResidentialDevice(ResidentialDeviceInterface $residentialDevice): BrandInterface;

    /**
     * @param Collection<array-key, ResidentialDeviceInterface> $residentialDevices
     */
    public function replaceResidentialDevices(Collection $residentialDevices): BrandInterface;

    /**
     * @return array<array-key, ResidentialDeviceInterface>
     */
    public function getResidentialDevices(?Criteria $criteria = null): array;

    public function addMusicsOnHold(MusicOnHoldInterface $musicsOnHold): BrandInterface;

    public function removeMusicsOnHold(MusicOnHoldInterface $musicsOnHold): BrandInterface;

    /**
     * @param Collection<array-key, MusicOnHoldInterface> $musicsOnHold
     */
    public function replaceMusicsOnHold(Collection $musicsOnHold): BrandInterface;

    /**
     * @return array<array-key, MusicOnHoldInterface>
     */
    public function getMusicsOnHold(?Criteria $criteria = null): array;

    public function addMatchList(MatchListInterface $matchList): BrandInterface;

    public function removeMatchList(MatchListInterface $matchList): BrandInterface;

    /**
     * @param Collection<array-key, MatchListInterface> $matchLists
     */
    public function replaceMatchLists(Collection $matchLists): BrandInterface;

    /**
     * @return array<array-key, MatchListInterface>
     */
    public function getMatchLists(?Criteria $criteria = null): array;

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): BrandInterface;

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): BrandInterface;

    /**
     * @param Collection<array-key, OutgoingRoutingInterface> $outgoingRoutings
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings): BrandInterface;

    /**
     * @return array<array-key, OutgoingRoutingInterface>
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
