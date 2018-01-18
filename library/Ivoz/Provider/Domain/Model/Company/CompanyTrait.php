<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * CompanyTrait
 * @codeCoverageIgnore
 */
trait CompanyTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $extensions;

    /**
     * @var Collection
     */
    protected $ddis;

    /**
     * @var Collection
     */
    protected $friends;

    /**
     * @var Collection
     */
    protected $companyServices;

    /**
     * @var Collection
     */
    protected $terminals;

    /**
     * @var Collection
     */
    protected $ratinProfiles;

    /**
     * @var Collection
     */
    protected $musicsOnHold;

    /**
     * @var Collection
     */
    protected $recordings;

    /**
     * @var Collection
     */
    protected $relFeatures;

    /**
     * @var Collection
     */
    protected $domains;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->extensions = new ArrayCollection();
        $this->ddis = new ArrayCollection();
        $this->friends = new ArrayCollection();
        $this->companyServices = new ArrayCollection();
        $this->terminals = new ArrayCollection();
        $this->ratinProfiles = new ArrayCollection();
        $this->musicsOnHold = new ArrayCollection();
        $this->recordings = new ArrayCollection();
        $this->relFeatures = new ArrayCollection();
        $this->domains = new ArrayCollection();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CompanyDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getExtensions()) {
            $self->replaceExtensions($dto->getExtensions());
        }

        if ($dto->getDdis()) {
            $self->replaceDdis($dto->getDdis());
        }

        if ($dto->getFriends()) {
            $self->replaceFriends($dto->getFriends());
        }

        if ($dto->getCompanyServices()) {
            $self->replaceCompanyServices($dto->getCompanyServices());
        }

        if ($dto->getTerminals()) {
            $self->replaceTerminals($dto->getTerminals());
        }

        if ($dto->getRatinProfiles()) {
            $self->replaceRatinProfiles($dto->getRatinProfiles());
        }

        if ($dto->getMusicsOnHold()) {
            $self->replaceMusicsOnHold($dto->getMusicsOnHold());
        }

        if ($dto->getRecordings()) {
            $self->replaceRecordings($dto->getRecordings());
        }

        if ($dto->getRelFeatures()) {
            $self->replaceRelFeatures($dto->getRelFeatures());
        }

        if ($dto->getDomains()) {
            $self->replaceDomains($dto->getDomains());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CompanyDto
         */
        parent::updateFromDto($dto);
        if ($dto->getExtensions()) {
            $this->replaceExtensions($dto->getExtensions());
        }
        if ($dto->getDdis()) {
            $this->replaceDdis($dto->getDdis());
        }
        if ($dto->getFriends()) {
            $this->replaceFriends($dto->getFriends());
        }
        if ($dto->getCompanyServices()) {
            $this->replaceCompanyServices($dto->getCompanyServices());
        }
        if ($dto->getTerminals()) {
            $this->replaceTerminals($dto->getTerminals());
        }
        if ($dto->getRatinProfiles()) {
            $this->replaceRatinProfiles($dto->getRatinProfiles());
        }
        if ($dto->getMusicsOnHold()) {
            $this->replaceMusicsOnHold($dto->getMusicsOnHold());
        }
        if ($dto->getRecordings()) {
            $this->replaceRecordings($dto->getRecordings());
        }
        if ($dto->getRelFeatures()) {
            $this->replaceRelFeatures($dto->getRelFeatures());
        }
        if ($dto->getDomains()) {
            $this->replaceDomains($dto->getDomains());
        }
        return $this;
    }

    /**
     * @param int $depth
     * @return CompanyDto
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
     * Add extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension
     *
     * @return CompanyTrait
     */
    public function addExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension)
    {
        $this->extensions->add($extension);

        return $this;
    }

    /**
     * Remove extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension
     */
    public function removeExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension)
    {
        $this->extensions->removeElement($extension);
    }

    /**
     * Replace extensions
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface[] $extensions
     * @return self
     */
    public function replaceExtensions(Collection $extensions)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($extensions as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->extensions as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->extensions->set($key, $updatedEntities[$identity]);
            } else {
                $this->extensions->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addExtension($entity);
        }

        return $this;
    }

    /**
     * Get extensions
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface[]
     */
    public function getExtensions(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->extensions->matching($criteria)->toArray();
        }

        return $this->extensions->toArray();
    }

    /**
     * Add ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     *
     * @return CompanyTrait
     */
    public function addDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi)
    {
        $this->ddis->add($ddi);

        return $this;
    }

    /**
     * Remove ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi
     */
    public function removeDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi)
    {
        $this->ddis->removeElement($ddi);
    }

    /**
     * Replace ddis
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface[] $ddis
     * @return self
     */
    public function replaceDdis(Collection $ddis)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ddis as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->ddis as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->ddis->set($key, $updatedEntities[$identity]);
            } else {
                $this->ddis->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addDdi($entity);
        }

        return $this;
    }

    /**
     * Get ddis
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface[]
     */
    public function getDdis(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->ddis->matching($criteria)->toArray();
        }

        return $this->ddis->toArray();
    }

    /**
     * Add friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     *
     * @return CompanyTrait
     */
    public function addFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend)
    {
        $this->friends->add($friend);

        return $this;
    }

    /**
     * Remove friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     */
    public function removeFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend)
    {
        $this->friends->removeElement($friend);
    }

    /**
     * Replace friends
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface[] $friends
     * @return self
     */
    public function replaceFriends(Collection $friends)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($friends as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->friends as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->friends->set($key, $updatedEntities[$identity]);
            } else {
                $this->friends->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addFriend($entity);
        }

        return $this;
    }

    /**
     * Get friends
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface[]
     */
    public function getFriends(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->friends->matching($criteria)->toArray();
        }

        return $this->friends->toArray();
    }

    /**
     * Add companyService
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface $companyService
     *
     * @return CompanyTrait
     */
    public function addCompanyService(\Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface $companyService)
    {
        $this->companyServices->add($companyService);

        return $this;
    }

    /**
     * Remove companyService
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface $companyService
     */
    public function removeCompanyService(\Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface $companyService)
    {
        $this->companyServices->removeElement($companyService);
    }

    /**
     * Replace companyServices
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface[] $companyServices
     * @return self
     */
    public function replaceCompanyServices(Collection $companyServices)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($companyServices as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->companyServices as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->companyServices->set($key, $updatedEntities[$identity]);
            } else {
                $this->companyServices->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addCompanyService($entity);
        }

        return $this;
    }

    /**
     * Get companyServices
     *
     * @return \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface[]
     */
    public function getCompanyServices(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->companyServices->matching($criteria)->toArray();
        }

        return $this->companyServices->toArray();
    }

    /**
     * Add terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     *
     * @return CompanyTrait
     */
    public function addTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal)
    {
        $this->terminals->add($terminal);

        return $this;
    }

    /**
     * Remove terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     */
    public function removeTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal)
    {
        $this->terminals->removeElement($terminal);
    }

    /**
     * Replace terminals
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface[] $terminals
     * @return self
     */
    public function replaceTerminals(Collection $terminals)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($terminals as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->terminals as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->terminals->set($key, $updatedEntities[$identity]);
            } else {
                $this->terminals->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addTerminal($entity);
        }

        return $this;
    }

    /**
     * Get terminals
     *
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface[]
     */
    public function getTerminals(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->terminals->matching($criteria)->toArray();
        }

        return $this->terminals->toArray();
    }

    /**
     * Add ratinProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $ratinProfile
     *
     * @return CompanyTrait
     */
    public function addRatinProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $ratinProfile)
    {
        $this->ratinProfiles->add($ratinProfile);

        return $this;
    }

    /**
     * Remove ratinProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $ratinProfile
     */
    public function removeRatinProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $ratinProfile)
    {
        $this->ratinProfiles->removeElement($ratinProfile);
    }

    /**
     * Replace ratinProfiles
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface[] $ratinProfiles
     * @return self
     */
    public function replaceRatinProfiles(Collection $ratinProfiles)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ratinProfiles as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->ratinProfiles as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->ratinProfiles->set($key, $updatedEntities[$identity]);
            } else {
                $this->ratinProfiles->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRatinProfile($entity);
        }

        return $this;
    }

    /**
     * Get ratinProfiles
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface[]
     */
    public function getRatinProfiles(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->ratinProfiles->matching($criteria)->toArray();
        }

        return $this->ratinProfiles->toArray();
    }

    /**
     * Add musicsOnHold
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface $musicsOnHold
     *
     * @return CompanyTrait
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
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface[] $musicsOnHold
     * @return self
     */
    public function replaceMusicsOnHold(Collection $musicsOnHold)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($musicsOnHold as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
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
     *
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
     * Add recording
     *
     * @param \Ivoz\Provider\Domain\Model\Recording\RecordingInterface $recording
     *
     * @return CompanyTrait
     */
    public function addRecording(\Ivoz\Provider\Domain\Model\Recording\RecordingInterface $recording)
    {
        $this->recordings->add($recording);

        return $this;
    }

    /**
     * Remove recording
     *
     * @param \Ivoz\Provider\Domain\Model\Recording\RecordingInterface $recording
     */
    public function removeRecording(\Ivoz\Provider\Domain\Model\Recording\RecordingInterface $recording)
    {
        $this->recordings->removeElement($recording);
    }

    /**
     * Replace recordings
     *
     * @param \Ivoz\Provider\Domain\Model\Recording\RecordingInterface[] $recordings
     * @return self
     */
    public function replaceRecordings(Collection $recordings)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($recordings as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->recordings as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->recordings->set($key, $updatedEntities[$identity]);
            } else {
                $this->recordings->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRecording($entity);
        }

        return $this;
    }

    /**
     * Get recordings
     *
     * @return \Ivoz\Provider\Domain\Model\Recording\RecordingInterface[]
     */
    public function getRecordings(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->recordings->matching($criteria)->toArray();
        }

        return $this->recordings->toArray();
    }

    /**
     * Add relFeature
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface $relFeature
     *
     * @return CompanyTrait
     */
    public function addRelFeature(\Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface $relFeature)
    {
        $this->relFeatures->add($relFeature);

        return $this;
    }

    /**
     * Remove relFeature
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface $relFeature
     */
    public function removeRelFeature(\Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface $relFeature)
    {
        $this->relFeatures->removeElement($relFeature);
    }

    /**
     * Replace relFeatures
     *
     * @param \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface[] $relFeatures
     * @return self
     */
    public function replaceRelFeatures(Collection $relFeatures)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relFeatures as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
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
     * @return \Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface[]
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
     * @return CompanyTrait
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
            $entity->setCompany($this);
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
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface[]
     */
    public function getDomains(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->domains->matching($criteria)->toArray();
        }

        return $this->domains->toArray();
    }


}

