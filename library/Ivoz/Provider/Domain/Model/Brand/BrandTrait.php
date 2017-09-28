<?php

namespace Ivoz\Provider\Domain\Model\Brand;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var Collection
     */
    protected $companies;

    /**
     * @var Collection
     */
    protected $operators;

    /**
     * @var Collection
     */
    protected $services;

    /**
     * @var Collection
     */
    protected $urls;

    /**
     * @var Collection
     */
    protected $relFeatures;

    /**
     * @var Collection
     */
    protected $domains;

    /**
     * @var Collection
     */
    protected $retailAccounts;

    /**
     * @var Collection
     */
    protected $genericMusicsOnHold;

    /**
     * @var Collection
     */
    protected $genericCallAclPatterns;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->companies = new ArrayCollection();
        $this->operators = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->urls = new ArrayCollection();
        $this->relFeatures = new ArrayCollection();
        $this->domains = new ArrayCollection();
        $this->retailAccounts = new ArrayCollection();
        $this->genericMusicsOnHold = new ArrayCollection();
        $this->genericCallAclPatterns = new ArrayCollection();
    }

    /**
     * @return BrandDTO
     */
    public static function createDTO()
    {
        return new BrandDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BrandDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getCompanies()) {
            $self->replaceCompanies($dto->getCompanies());
        }

        if ($dto->getOperators()) {
            $self->replaceOperators($dto->getOperators());
        }

        if ($dto->getServices()) {
            $self->replaceServices($dto->getServices());
        }

        if ($dto->getUrls()) {
            $self->replaceUrls($dto->getUrls());
        }

        if ($dto->getRelFeatures()) {
            $self->replaceRelFeatures($dto->getRelFeatures());
        }

        if ($dto->getDomains()) {
            $self->replaceDomains($dto->getDomains());
        }

        if ($dto->getRetailAccounts()) {
            $self->replaceRetailAccounts($dto->getRetailAccounts());
        }

        if ($dto->getGenericMusicsOnHold()) {
            $self->replaceGenericMusicsOnHold($dto->getGenericMusicsOnHold());
        }

        if ($dto->getGenericCallAclPatterns()) {
            $self->replaceGenericCallAclPatterns($dto->getGenericCallAclPatterns());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
        }
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BrandDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getCompanies()) {
            $this->replaceCompanies($dto->getCompanies());
        }
        if ($dto->getOperators()) {
            $this->replaceOperators($dto->getOperators());
        }
        if ($dto->getServices()) {
            $this->replaceServices($dto->getServices());
        }
        if ($dto->getUrls()) {
            $this->replaceUrls($dto->getUrls());
        }
        if ($dto->getRelFeatures()) {
            $this->replaceRelFeatures($dto->getRelFeatures());
        }
        if ($dto->getDomains()) {
            $this->replaceDomains($dto->getDomains());
        }
        if ($dto->getRetailAccounts()) {
            $this->replaceRetailAccounts($dto->getRetailAccounts());
        }
        if ($dto->getGenericMusicsOnHold()) {
            $this->replaceGenericMusicsOnHold($dto->getGenericMusicsOnHold());
        }
        if ($dto->getGenericCallAclPatterns()) {
            $this->replaceGenericCallAclPatterns($dto->getGenericCallAclPatterns());
        }
        return $this;
    }

    /**
     * @return BrandDTO
     */
    public function toDTO()
    {
        $dto = parent::toDTO();
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return parent::__toArray() + [
            'id' => $this->getId()
        ];
    }


    /**
     * Add company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return BrandTrait
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
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface[] $companies
     * @return self
     */
    public function replaceCompanies(Collection $companies)
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
     *
     * @return array
     */
    public function getCompanies(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->companies->matching($criteria)->toArray();
        }

        return $this->companies->toArray();
    }

    /**
     * Add operator
     *
     * @param \Ivoz\Provider\Domain\Model\BrandOperator\BrandOperatorInterface $operator
     *
     * @return BrandTrait
     */
    public function addOperator(\Ivoz\Provider\Domain\Model\BrandOperator\BrandOperatorInterface $operator)
    {
        $this->operators->add($operator);

        return $this;
    }

    /**
     * Remove operator
     *
     * @param \Ivoz\Provider\Domain\Model\BrandOperator\BrandOperatorInterface $operator
     */
    public function removeOperator(\Ivoz\Provider\Domain\Model\BrandOperator\BrandOperatorInterface $operator)
    {
        $this->operators->removeElement($operator);
    }

    /**
     * Replace operators
     *
     * @param \Ivoz\Provider\Domain\Model\BrandOperator\BrandOperatorInterface[] $operators
     * @return self
     */
    public function replaceOperators(Collection $operators)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($operators as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->operators as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->operators->set($key, $updatedEntities[$identity]);
            } else {
                $this->operators->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addOperator($entity);
        }

        return $this;
    }

    /**
     * Get operators
     *
     * @return array
     */
    public function getOperators(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->operators->matching($criteria)->toArray();
        }

        return $this->operators->toArray();
    }

    /**
     * Add service
     *
     * @param \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface $service
     *
     * @return BrandTrait
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
     * @param \Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface[] $services
     * @return self
     */
    public function replaceServices(Collection $services)
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
     *
     * @return array
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
     * @param \Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface $url
     *
     * @return BrandTrait
     */
    public function addUrl(\Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface $url)
    {
        $this->urls->add($url);

        return $this;
    }

    /**
     * Remove url
     *
     * @param \Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface $url
     */
    public function removeUrl(\Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface $url)
    {
        $this->urls->removeElement($url);
    }

    /**
     * Replace urls
     *
     * @param \Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface[] $urls
     * @return self
     */
    public function replaceUrls(Collection $urls)
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
     *
     * @return array
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
     * @return BrandTrait
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
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface[] $relFeatures
     * @return self
     */
    public function replaceRelFeatures(Collection $relFeatures)
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
     *
     * @return array
     */
    public function getRelFeatures(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relFeatures->matching($criteria)->toArray();
        }

        return $this->relFeatures->toArray();
    }

    /**
     * Add domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain
     *
     * @return BrandTrait
     */
    public function addDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain)
    {
        $this->domains->add($domain);

        return $this;
    }

    /**
     * Remove domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain
     */
    public function removeDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain)
    {
        $this->domains->removeElement($domain);
    }

    /**
     * Replace domains
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface[] $domains
     * @return self
     */
    public function replaceDomains(Collection $domains)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($domains as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->domains as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->domains->set($key, $updatedEntities[$identity]);
            } else {
                $this->domains->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addDomain($entity);
        }

        return $this;
    }

    /**
     * Get domains
     *
     * @return array
     */
    public function getDomains(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->domains->matching($criteria)->toArray();
        }

        return $this->domains->toArray();
    }

    /**
     * Add retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount
     *
     * @return BrandTrait
     */
    public function addRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount)
    {
        $this->retailAccounts->add($retailAccount);

        return $this;
    }

    /**
     * Remove retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount
     */
    public function removeRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount)
    {
        $this->retailAccounts->removeElement($retailAccount);
    }

    /**
     * Replace retailAccounts
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface[] $retailAccounts
     * @return self
     */
    public function replaceRetailAccounts(Collection $retailAccounts)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($retailAccounts as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->retailAccounts as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->retailAccounts->set($key, $updatedEntities[$identity]);
            } else {
                $this->retailAccounts->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRetailAccount($entity);
        }

        return $this;
    }

    /**
     * Get retailAccounts
     *
     * @return array
     */
    public function getRetailAccounts(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->retailAccounts->matching($criteria)->toArray();
        }

        return $this->retailAccounts->toArray();
    }

    /**
     * Add genericMusicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface $genericMusicsOnHold
     *
     * @return BrandTrait
     */
    public function addGenericMusicsOnHold(\Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface $genericMusicsOnHold)
    {
        $this->genericMusicsOnHold->add($genericMusicsOnHold);

        return $this;
    }

    /**
     * Remove genericMusicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface $genericMusicsOnHold
     */
    public function removeGenericMusicsOnHold(\Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface $genericMusicsOnHold)
    {
        $this->genericMusicsOnHold->removeElement($genericMusicsOnHold);
    }

    /**
     * Replace genericMusicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\GenericMusicOnHold\GenericMusicOnHoldInterface[] $genericMusicsOnHold
     * @return self
     */
    public function replaceGenericMusicsOnHold(Collection $genericMusicsOnHold)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($genericMusicsOnHold as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->genericMusicsOnHold as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->genericMusicsOnHold->set($key, $updatedEntities[$identity]);
            } else {
                $this->genericMusicsOnHold->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addGenericMusicsOnHold($entity);
        }

        return $this;
    }

    /**
     * Get genericMusicsOnHold
     *
     * @return array
     */
    public function getGenericMusicsOnHold(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->genericMusicsOnHold->matching($criteria)->toArray();
        }

        return $this->genericMusicsOnHold->toArray();
    }

    /**
     * Add genericCallAclPattern
     *
     * @param \Ivoz\Provider\Domain\Model\GenericCallAclPattern\GenericCallAclPatternInterface $genericCallAclPattern
     *
     * @return BrandTrait
     */
    public function addGenericCallAclPattern(\Ivoz\Provider\Domain\Model\GenericCallAclPattern\GenericCallAclPatternInterface $genericCallAclPattern)
    {
        $this->genericCallAclPatterns->add($genericCallAclPattern);

        return $this;
    }

    /**
     * Remove genericCallAclPattern
     *
     * @param \Ivoz\Provider\Domain\Model\GenericCallAclPattern\GenericCallAclPatternInterface $genericCallAclPattern
     */
    public function removeGenericCallAclPattern(\Ivoz\Provider\Domain\Model\GenericCallAclPattern\GenericCallAclPatternInterface $genericCallAclPattern)
    {
        $this->genericCallAclPatterns->removeElement($genericCallAclPattern);
    }

    /**
     * Replace genericCallAclPatterns
     *
     * @param \Ivoz\Provider\Domain\Model\GenericCallAclPattern\GenericCallAclPatternInterface[] $genericCallAclPatterns
     * @return self
     */
    public function replaceGenericCallAclPatterns(Collection $genericCallAclPatterns)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($genericCallAclPatterns as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setBrand($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->genericCallAclPatterns as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->genericCallAclPatterns->set($key, $updatedEntities[$identity]);
            } else {
                $this->genericCallAclPatterns->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addGenericCallAclPattern($entity);
        }

        return $this;
    }

    /**
     * Get genericCallAclPatterns
     *
     * @return array
     */
    public function getGenericCallAclPatterns(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->genericCallAclPatterns->matching($criteria)->toArray();
        }

        return $this->genericCallAclPatterns->toArray();
    }


}

