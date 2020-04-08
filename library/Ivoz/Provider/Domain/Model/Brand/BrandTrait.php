<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * BrandTrait
 * @codeCoverageIgnore
 */
trait BrandTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $companies;

    /**
     * @var ArrayCollection
     */
    protected $services;

    /**
     * @var ArrayCollection
     */
    protected $urls;

    /**
     * @var ArrayCollection
     */
    protected $relFeatures;

    /**
     * @var ArrayCollection
     */
    protected $relProxyTrunks;

    /**
     * @var ArrayCollection
     */
    protected $residentialDevices;

    /**
     * @var ArrayCollection
     */
    protected $musicsOnHold;

    /**
     * @var ArrayCollection
     */
    protected $matchLists;

    /**
     * @var ArrayCollection
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
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
    /**
     * Add company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function addCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->companies->add($company);

        return $this;
    }

    /**
     * Remove company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     */
    public function removeCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->companies->removeElement($company);
    }

    /**
     * Replace companies
     *
     * @param ArrayCollection $companies of Ivoz\Provider\Domain\Model\Company\CompanyInterface
     * @return static
     */
    public function replaceCompanies(ArrayCollection $companies)
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

    /**
     * Get companies
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface[]
     */
    public function getCompanies(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->companies->matching($criteria)->toArray();
        }

        return $this->companies->toArray();
    }

    /**
     * Add service
     *
     * @param \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface $service
     *
     * @return static
     */
    public function addService(\Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface $service)
    {
        $this->services->add($service);

        return $this;
    }

    /**
     * Remove service
     *
     * @param \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface $service
     */
    public function removeService(\Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Replace services
     *
     * @param ArrayCollection $services of Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface
     * @return static
     */
    public function replaceServices(ArrayCollection $services)
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

    /**
     * Get services
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface[]
     */
    public function getServices(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->services->matching($criteria)->toArray();
        }

        return $this->services->toArray();
    }

    /**
     * Add url
     *
     * @param \Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface $url
     *
     * @return static
     */
    public function addUrl(\Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface $url)
    {
        $this->urls->add($url);

        return $this;
    }

    /**
     * Remove url
     *
     * @param \Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface $url
     */
    public function removeUrl(\Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface $url)
    {
        $this->urls->removeElement($url);
    }

    /**
     * Replace urls
     *
     * @param ArrayCollection $urls of Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface
     * @return static
     */
    public function replaceUrls(ArrayCollection $urls)
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

    /**
     * Get urls
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface[]
     */
    public function getUrls(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->urls->matching($criteria)->toArray();
        }

        return $this->urls->toArray();
    }

    /**
     * Add relFeature
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface $relFeature
     *
     * @return static
     */
    public function addRelFeature(\Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface $relFeature)
    {
        $this->relFeatures->add($relFeature);

        return $this;
    }

    /**
     * Remove relFeature
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface $relFeature
     */
    public function removeRelFeature(\Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface $relFeature)
    {
        $this->relFeatures->removeElement($relFeature);
    }

    /**
     * Replace relFeatures
     *
     * @param ArrayCollection $relFeatures of Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface
     * @return static
     */
    public function replaceRelFeatures(ArrayCollection $relFeatures)
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

    /**
     * Get relFeatures
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface[]
     */
    public function getRelFeatures(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relFeatures->matching($criteria)->toArray();
        }

        return $this->relFeatures->toArray();
    }

    /**
     * Add relProxyTrunk
     *
     * @param \Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface $relProxyTrunk
     *
     * @return static
     */
    public function addRelProxyTrunk(\Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface $relProxyTrunk)
    {
        $this->relProxyTrunks->add($relProxyTrunk);

        return $this;
    }

    /**
     * Remove relProxyTrunk
     *
     * @param \Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface $relProxyTrunk
     */
    public function removeRelProxyTrunk(\Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface $relProxyTrunk)
    {
        $this->relProxyTrunks->removeElement($relProxyTrunk);
    }

    /**
     * Replace relProxyTrunks
     *
     * @param ArrayCollection $relProxyTrunks of Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface
     * @return static
     */
    public function replaceRelProxyTrunks(ArrayCollection $relProxyTrunks)
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

    /**
     * Get relProxyTrunks
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface[]
     */
    public function getRelProxyTrunks(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relProxyTrunks->matching($criteria)->toArray();
        }

        return $this->relProxyTrunks->toArray();
    }

    /**
     * Add residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     *
     * @return static
     */
    public function addResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice)
    {
        $this->residentialDevices->add($residentialDevice);

        return $this;
    }

    /**
     * Remove residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     */
    public function removeResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice)
    {
        $this->residentialDevices->removeElement($residentialDevice);
    }

    /**
     * Replace residentialDevices
     *
     * @param ArrayCollection $residentialDevices of Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface
     * @return static
     */
    public function replaceResidentialDevices(ArrayCollection $residentialDevices)
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

    /**
     * Get residentialDevices
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface[]
     */
    public function getResidentialDevices(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->residentialDevices->matching($criteria)->toArray();
        }

        return $this->residentialDevices->toArray();
    }

    /**
     * Add musicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold
     *
     * @return static
     */
    public function addMusicsOnHold(\Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold)
    {
        $this->musicsOnHold->add($musicsOnHold);

        return $this;
    }

    /**
     * Remove musicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold
     */
    public function removeMusicsOnHold(\Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold)
    {
        $this->musicsOnHold->removeElement($musicsOnHold);
    }

    /**
     * Replace musicsOnHold
     *
     * @param ArrayCollection $musicsOnHold of Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface
     * @return static
     */
    public function replaceMusicsOnHold(ArrayCollection $musicsOnHold)
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

    /**
     * Get musicsOnHold
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface[]
     */
    public function getMusicsOnHold(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->musicsOnHold->matching($criteria)->toArray();
        }

        return $this->musicsOnHold->toArray();
    }

    /**
     * Add matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList
     *
     * @return static
     */
    public function addMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList)
    {
        $this->matchLists->add($matchList);

        return $this;
    }

    /**
     * Remove matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList
     */
    public function removeMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList)
    {
        $this->matchLists->removeElement($matchList);
    }

    /**
     * Replace matchLists
     *
     * @param ArrayCollection $matchLists of Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     * @return static
     */
    public function replaceMatchLists(ArrayCollection $matchLists)
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

    /**
     * Get matchLists
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface[]
     */
    public function getMatchLists(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->matchLists->matching($criteria)->toArray();
        }

        return $this->matchLists->toArray();
    }

    /**
     * Add outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function addOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting)
    {
        $this->outgoingRoutings->add($outgoingRouting);

        return $this;
    }

    /**
     * Remove outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     */
    public function removeOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting)
    {
        $this->outgoingRoutings->removeElement($outgoingRouting);
    }

    /**
     * Replace outgoingRoutings
     *
     * @param ArrayCollection $outgoingRoutings of Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings)
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

    /**
     * Get outgoingRoutings
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutings->matching($criteria)->toArray();
        }

        return $this->outgoingRoutings->toArray();
    }
}
