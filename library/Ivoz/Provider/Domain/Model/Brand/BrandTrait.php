<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
* @codeCoverageIgnore
*/
trait BrandTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, CompanyInterface> & Selectable<array-key, CompanyInterface>
     * CompanyInterface mappedBy brand
     */
    protected $companies;

    /**
     * @var Collection<array-key, BrandServiceInterface> & Selectable<array-key, BrandServiceInterface>
     * BrandServiceInterface mappedBy brand
     */
    protected $services;

    /**
     * @var Collection<array-key, WebPortalInterface> & Selectable<array-key, WebPortalInterface>
     * WebPortalInterface mappedBy brand
     */
    protected $urls;

    /**
     * @var Collection<array-key, FeaturesRelBrandInterface> & Selectable<array-key, FeaturesRelBrandInterface>
     * FeaturesRelBrandInterface mappedBy brand
     * orphanRemoval
     */
    protected $relFeatures;

    /**
     * @var Collection<array-key, ProxyTrunksRelBrandInterface> & Selectable<array-key, ProxyTrunksRelBrandInterface>
     * ProxyTrunksRelBrandInterface mappedBy brand
     * orphanRemoval
     */
    protected $relProxyTrunks;

    /**
     * @var Collection<array-key, ResidentialDeviceInterface> & Selectable<array-key, ResidentialDeviceInterface>
     * ResidentialDeviceInterface mappedBy brand
     */
    protected $residentialDevices;

    /**
     * @var Collection<array-key, MusicOnHoldInterface> & Selectable<array-key, MusicOnHoldInterface>
     * MusicOnHoldInterface mappedBy brand
     */
    protected $musicsOnHold;

    /**
     * @var Collection<array-key, MatchListInterface> & Selectable<array-key, MatchListInterface>
     * MatchListInterface mappedBy brand
     */
    protected $matchLists;

    /**
     * @var Collection<array-key, OutgoingRoutingInterface> & Selectable<array-key, OutgoingRoutingInterface>
     * OutgoingRoutingInterface mappedBy brand
     */
    protected $outgoingRoutings;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->companies = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->urls = new ArrayCollection();
        $this->relFeatures = new ArrayCollection();
        $this->relProxyTrunks = new ArrayCollection();
        $this->residentialDevices = new ArrayCollection();
        $this->musicsOnHold = new ArrayCollection();
        $this->matchLists = new ArrayCollection();
        $this->outgoingRoutings = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BrandDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $companies = $dto->getCompanies();
        if (!is_null($companies)) {

            /** @var Collection<array-key, CompanyInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $companies
            );
            $self->replaceCompanies($replacement);
        }

        $services = $dto->getServices();
        if (!is_null($services)) {

            /** @var Collection<array-key, BrandServiceInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $services
            );
            $self->replaceServices($replacement);
        }

        $urls = $dto->getUrls();
        if (!is_null($urls)) {

            /** @var Collection<array-key, WebPortalInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $urls
            );
            $self->replaceUrls($replacement);
        }

        $relFeatures = $dto->getRelFeatures();
        if (!is_null($relFeatures)) {

            /** @var Collection<array-key, FeaturesRelBrandInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relFeatures
            );
            $self->replaceRelFeatures($replacement);
        }

        $relProxyTrunks = $dto->getRelProxyTrunks();
        if (!is_null($relProxyTrunks)) {

            /** @var Collection<array-key, ProxyTrunksRelBrandInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relProxyTrunks
            );
            $self->replaceRelProxyTrunks($replacement);
        }

        $residentialDevices = $dto->getResidentialDevices();
        if (!is_null($residentialDevices)) {

            /** @var Collection<array-key, ResidentialDeviceInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $residentialDevices
            );
            $self->replaceResidentialDevices($replacement);
        }

        $musicsOnHold = $dto->getMusicsOnHold();
        if (!is_null($musicsOnHold)) {

            /** @var Collection<array-key, MusicOnHoldInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $musicsOnHold
            );
            $self->replaceMusicsOnHold($replacement);
        }

        $matchLists = $dto->getMatchLists();
        if (!is_null($matchLists)) {

            /** @var Collection<array-key, MatchListInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $matchLists
            );
            $self->replaceMatchLists($replacement);
        }

        $outgoingRoutings = $dto->getOutgoingRoutings();
        if (!is_null($outgoingRoutings)) {

            /** @var Collection<array-key, OutgoingRoutingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $outgoingRoutings
            );
            $self->replaceOutgoingRoutings($replacement);
        }

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param BrandDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $companies = $dto->getCompanies();
        if (!is_null($companies)) {

            /** @var Collection<array-key, CompanyInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $companies
            );
            $this->replaceCompanies($replacement);
        }

        $services = $dto->getServices();
        if (!is_null($services)) {

            /** @var Collection<array-key, BrandServiceInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $services
            );
            $this->replaceServices($replacement);
        }

        $urls = $dto->getUrls();
        if (!is_null($urls)) {

            /** @var Collection<array-key, WebPortalInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $urls
            );
            $this->replaceUrls($replacement);
        }

        $relFeatures = $dto->getRelFeatures();
        if (!is_null($relFeatures)) {

            /** @var Collection<array-key, FeaturesRelBrandInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relFeatures
            );
            $this->replaceRelFeatures($replacement);
        }

        $relProxyTrunks = $dto->getRelProxyTrunks();
        if (!is_null($relProxyTrunks)) {

            /** @var Collection<array-key, ProxyTrunksRelBrandInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relProxyTrunks
            );
            $this->replaceRelProxyTrunks($replacement);
        }

        $residentialDevices = $dto->getResidentialDevices();
        if (!is_null($residentialDevices)) {

            /** @var Collection<array-key, ResidentialDeviceInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $residentialDevices
            );
            $this->replaceResidentialDevices($replacement);
        }

        $musicsOnHold = $dto->getMusicsOnHold();
        if (!is_null($musicsOnHold)) {

            /** @var Collection<array-key, MusicOnHoldInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $musicsOnHold
            );
            $this->replaceMusicsOnHold($replacement);
        }

        $matchLists = $dto->getMatchLists();
        if (!is_null($matchLists)) {

            /** @var Collection<array-key, MatchListInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $matchLists
            );
            $this->replaceMatchLists($replacement);
        }

        $outgoingRoutings = $dto->getOutgoingRoutings();
        if (!is_null($outgoingRoutings)) {

            /** @var Collection<array-key, OutgoingRoutingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $outgoingRoutings
            );
            $this->replaceOutgoingRoutings($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): BrandDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function addCompany(CompanyInterface $company): BrandInterface
    {
        $this->companies->add($company);

        return $this;
    }

    public function removeCompany(CompanyInterface $company): BrandInterface
    {
        $this->companies->removeElement($company);

        return $this;
    }

    /**
     * @param Collection<array-key, CompanyInterface> $companies
     */
    public function replaceCompanies(Collection $companies): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($companies as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }

        foreach ($this->companies as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->companies->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->companies->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->companies->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addCompany($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, CompanyInterface>
     */
    public function getCompanies(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->companies->matching($criteria)->toArray();
        }

        return $this->companies->toArray();
    }

    public function addService(BrandServiceInterface $service): BrandInterface
    {
        $this->services->add($service);

        return $this;
    }

    public function removeService(BrandServiceInterface $service): BrandInterface
    {
        $this->services->removeElement($service);

        return $this;
    }

    /**
     * @param Collection<array-key, BrandServiceInterface> $services
     */
    public function replaceServices(Collection $services): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($services as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }

        foreach ($this->services as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->services->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->services->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->services->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addService($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, BrandServiceInterface>
     */
    public function getServices(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->services->matching($criteria)->toArray();
        }

        return $this->services->toArray();
    }

    public function addUrl(WebPortalInterface $url): BrandInterface
    {
        $this->urls->add($url);

        return $this;
    }

    public function removeUrl(WebPortalInterface $url): BrandInterface
    {
        $this->urls->removeElement($url);

        return $this;
    }

    /**
     * @param Collection<array-key, WebPortalInterface> $urls
     */
    public function replaceUrls(Collection $urls): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($urls as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }

        foreach ($this->urls as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->urls->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->urls->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->urls->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addUrl($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, WebPortalInterface>
     */
    public function getUrls(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->urls->matching($criteria)->toArray();
        }

        return $this->urls->toArray();
    }

    public function addRelFeature(FeaturesRelBrandInterface $relFeature): BrandInterface
    {
        $this->relFeatures->add($relFeature);

        return $this;
    }

    public function removeRelFeature(FeaturesRelBrandInterface $relFeature): BrandInterface
    {
        $this->relFeatures->removeElement($relFeature);

        return $this;
    }

    /**
     * @param Collection<array-key, FeaturesRelBrandInterface> $relFeatures
     */
    public function replaceRelFeatures(Collection $relFeatures): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relFeatures as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }

        foreach ($this->relFeatures as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relFeatures->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relFeatures->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relFeatures->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelFeature($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, FeaturesRelBrandInterface>
     */
    public function getRelFeatures(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relFeatures->matching($criteria)->toArray();
        }

        return $this->relFeatures->toArray();
    }

    public function addRelProxyTrunk(ProxyTrunksRelBrandInterface $relProxyTrunk): BrandInterface
    {
        $this->relProxyTrunks->add($relProxyTrunk);

        return $this;
    }

    public function removeRelProxyTrunk(ProxyTrunksRelBrandInterface $relProxyTrunk): BrandInterface
    {
        $this->relProxyTrunks->removeElement($relProxyTrunk);

        return $this;
    }

    /**
     * @param Collection<array-key, ProxyTrunksRelBrandInterface> $relProxyTrunks
     */
    public function replaceRelProxyTrunks(Collection $relProxyTrunks): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relProxyTrunks as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }

        foreach ($this->relProxyTrunks as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relProxyTrunks->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relProxyTrunks->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relProxyTrunks->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelProxyTrunk($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ProxyTrunksRelBrandInterface>
     */
    public function getRelProxyTrunks(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relProxyTrunks->matching($criteria)->toArray();
        }

        return $this->relProxyTrunks->toArray();
    }

    public function addResidentialDevice(ResidentialDeviceInterface $residentialDevice): BrandInterface
    {
        $this->residentialDevices->add($residentialDevice);

        return $this;
    }

    public function removeResidentialDevice(ResidentialDeviceInterface $residentialDevice): BrandInterface
    {
        $this->residentialDevices->removeElement($residentialDevice);

        return $this;
    }

    /**
     * @param Collection<array-key, ResidentialDeviceInterface> $residentialDevices
     */
    public function replaceResidentialDevices(Collection $residentialDevices): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($residentialDevices as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }

        foreach ($this->residentialDevices as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->residentialDevices->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->residentialDevices->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->residentialDevices->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addResidentialDevice($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ResidentialDeviceInterface>
     */
    public function getResidentialDevices(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->residentialDevices->matching($criteria)->toArray();
        }

        return $this->residentialDevices->toArray();
    }

    public function addMusicsOnHold(MusicOnHoldInterface $musicsOnHold): BrandInterface
    {
        $this->musicsOnHold->add($musicsOnHold);

        return $this;
    }

    public function removeMusicsOnHold(MusicOnHoldInterface $musicsOnHold): BrandInterface
    {
        $this->musicsOnHold->removeElement($musicsOnHold);

        return $this;
    }

    /**
     * @param Collection<array-key, MusicOnHoldInterface> $musicsOnHold
     */
    public function replaceMusicsOnHold(Collection $musicsOnHold): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($musicsOnHold as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }

        foreach ($this->musicsOnHold as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->musicsOnHold->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->musicsOnHold->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->musicsOnHold->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addMusicsOnHold($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, MusicOnHoldInterface>
     */
    public function getMusicsOnHold(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->musicsOnHold->matching($criteria)->toArray();
        }

        return $this->musicsOnHold->toArray();
    }

    public function addMatchList(MatchListInterface $matchList): BrandInterface
    {
        $this->matchLists->add($matchList);

        return $this;
    }

    public function removeMatchList(MatchListInterface $matchList): BrandInterface
    {
        $this->matchLists->removeElement($matchList);

        return $this;
    }

    /**
     * @param Collection<array-key, MatchListInterface> $matchLists
     */
    public function replaceMatchLists(Collection $matchLists): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($matchLists as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }

        foreach ($this->matchLists as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->matchLists->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->matchLists->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->matchLists->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addMatchList($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, MatchListInterface>
     */
    public function getMatchLists(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->matchLists->matching($criteria)->toArray();
        }

        return $this->matchLists->toArray();
    }

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): BrandInterface
    {
        $this->outgoingRoutings->add($outgoingRouting);

        return $this;
    }

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): BrandInterface
    {
        $this->outgoingRoutings->removeElement($outgoingRouting);

        return $this;
    }

    /**
     * @param Collection<array-key, OutgoingRoutingInterface> $outgoingRoutings
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($outgoingRoutings as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }

        foreach ($this->outgoingRoutings as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->outgoingRoutings->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->outgoingRoutings->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->outgoingRoutings->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addOutgoingRouting($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, OutgoingRoutingInterface>
     */
    public function getOutgoingRoutings(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutings->matching($criteria)->toArray();
        }

        return $this->outgoingRoutings->toArray();
    }
}
