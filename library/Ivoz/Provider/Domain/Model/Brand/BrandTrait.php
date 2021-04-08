<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

/**
* @codeCoverageIgnore
*/
trait BrandTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * CompanyInterface mappedBy brand
     */
    protected $companies;

    /**
     * @var ArrayCollection
     * BrandServiceInterface mappedBy brand
     */
    protected $services;

    /**
     * @var ArrayCollection
     * WebPortalInterface mappedBy brand
     */
    protected $urls;

    /**
     * @var ArrayCollection
     * FeaturesRelBrandInterface mappedBy brand
     * orphanRemoval
     */
    protected $relFeatures;

    /**
     * @var ArrayCollection
     * ProxyTrunksRelBrandInterface mappedBy brand
     * orphanRemoval
     */
    protected $relProxyTrunks;

    /**
     * @var ArrayCollection
     * ResidentialDeviceInterface mappedBy brand
     */
    protected $residentialDevices;

    /**
     * @var ArrayCollection
     * MusicOnHoldInterface mappedBy brand
     */
    protected $musicsOnHold;

    /**
     * @var ArrayCollection
     * MatchListInterface mappedBy brand
     */
    protected $matchLists;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BrandDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getCompanies())) {
            $self->replaceCompanies(
                $fkTransformer->transformCollection(
                    $dto->getCompanies()
                )
            );
        }

        if (!is_null($dto->getServices())) {
            $self->replaceServices(
                $fkTransformer->transformCollection(
                    $dto->getServices()
                )
            );
        }

        if (!is_null($dto->getUrls())) {
            $self->replaceUrls(
                $fkTransformer->transformCollection(
                    $dto->getUrls()
                )
            );
        }

        if (!is_null($dto->getRelFeatures())) {
            $self->replaceRelFeatures(
                $fkTransformer->transformCollection(
                    $dto->getRelFeatures()
                )
            );
        }

        if (!is_null($dto->getRelProxyTrunks())) {
            $self->replaceRelProxyTrunks(
                $fkTransformer->transformCollection(
                    $dto->getRelProxyTrunks()
                )
            );
        }

        if (!is_null($dto->getResidentialDevices())) {
            $self->replaceResidentialDevices(
                $fkTransformer->transformCollection(
                    $dto->getResidentialDevices()
                )
            );
        }

        if (!is_null($dto->getMusicsOnHold())) {
            $self->replaceMusicsOnHold(
                $fkTransformer->transformCollection(
                    $dto->getMusicsOnHold()
                )
            );
        }

        if (!is_null($dto->getMatchLists())) {
            $self->replaceMatchLists(
                $fkTransformer->transformCollection(
                    $dto->getMatchLists()
                )
            );
        }

        if (!is_null($dto->getOutgoingRoutings())) {
            $self->replaceOutgoingRoutings(
                $fkTransformer->transformCollection(
                    $dto->getOutgoingRoutings()
                )
            );
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
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getCompanies())) {
            $this->replaceCompanies(
                $fkTransformer->transformCollection(
                    $dto->getCompanies()
                )
            );
        }

        if (!is_null($dto->getServices())) {
            $this->replaceServices(
                $fkTransformer->transformCollection(
                    $dto->getServices()
                )
            );
        }

        if (!is_null($dto->getUrls())) {
            $this->replaceUrls(
                $fkTransformer->transformCollection(
                    $dto->getUrls()
                )
            );
        }

        if (!is_null($dto->getRelFeatures())) {
            $this->replaceRelFeatures(
                $fkTransformer->transformCollection(
                    $dto->getRelFeatures()
                )
            );
        }

        if (!is_null($dto->getRelProxyTrunks())) {
            $this->replaceRelProxyTrunks(
                $fkTransformer->transformCollection(
                    $dto->getRelProxyTrunks()
                )
            );
        }

        if (!is_null($dto->getResidentialDevices())) {
            $this->replaceResidentialDevices(
                $fkTransformer->transformCollection(
                    $dto->getResidentialDevices()
                )
            );
        }

        if (!is_null($dto->getMusicsOnHold())) {
            $this->replaceMusicsOnHold(
                $fkTransformer->transformCollection(
                    $dto->getMusicsOnHold()
                )
            );
        }

        if (!is_null($dto->getMatchLists())) {
            $this->replaceMatchLists(
                $fkTransformer->transformCollection(
                    $dto->getMatchLists()
                )
            );
        }

        if (!is_null($dto->getOutgoingRoutings())) {
            $this->replaceOutgoingRoutings(
                $fkTransformer->transformCollection(
                    $dto->getOutgoingRoutings()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return BrandDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
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

    public function replaceCompanies(ArrayCollection $companies): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($companies as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->companies as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->companies->set($key, $updatedEntities[$identity]);
            } else {
                $this->companies->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addCompany($entity);
        }

        return $this;
    }

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

    public function replaceServices(ArrayCollection $services): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($services as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->services as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->services->set($key, $updatedEntities[$identity]);
            } else {
                $this->services->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addService($entity);
        }

        return $this;
    }

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

    public function replaceUrls(ArrayCollection $urls): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($urls as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->urls as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->urls->set($key, $updatedEntities[$identity]);
            } else {
                $this->urls->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addUrl($entity);
        }

        return $this;
    }

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

    public function replaceRelFeatures(ArrayCollection $relFeatures): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relFeatures as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relFeatures as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relFeatures->set($key, $updatedEntities[$identity]);
            } else {
                $this->relFeatures->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelFeature($entity);
        }

        return $this;
    }

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

    public function replaceRelProxyTrunks(ArrayCollection $relProxyTrunks): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relProxyTrunks as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relProxyTrunks as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relProxyTrunks->set($key, $updatedEntities[$identity]);
            } else {
                $this->relProxyTrunks->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelProxyTrunk($entity);
        }

        return $this;
    }

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

    public function replaceResidentialDevices(ArrayCollection $residentialDevices): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($residentialDevices as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->residentialDevices as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->residentialDevices->set($key, $updatedEntities[$identity]);
            } else {
                $this->residentialDevices->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addResidentialDevice($entity);
        }

        return $this;
    }

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

    public function replaceMusicsOnHold(ArrayCollection $musicsOnHold): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($musicsOnHold as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->musicsOnHold as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->musicsOnHold->set($key, $updatedEntities[$identity]);
            } else {
                $this->musicsOnHold->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addMusicsOnHold($entity);
        }

        return $this;
    }

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

    public function replaceMatchLists(ArrayCollection $matchLists): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($matchLists as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->matchLists as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->matchLists->set($key, $updatedEntities[$identity]);
            } else {
                $this->matchLists->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addMatchList($entity);
        }

        return $this;
    }

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

    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): BrandInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($outgoingRoutings as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->outgoingRoutings as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->outgoingRoutings->set($key, $updatedEntities[$identity]);
            } else {
                $this->outgoingRoutings->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addOutgoingRouting($entity);
        }

        return $this;
    }

    public function getOutgoingRoutings(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutings->matching($criteria)->toArray();
        }

        return $this->outgoingRoutings->toArray();
    }
}
