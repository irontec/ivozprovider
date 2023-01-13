<?php

namespace Ivoz\Provider\Domain\Model\Company;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var ArrayCollection
     */
    protected $extensions;

    /**
     * @var ArrayCollection
     */
    protected $ddis;

    /**
     * @var ArrayCollection
     */
    protected $friends;

    /**
     * @var ArrayCollection
     */
    protected $contacts;

    /**
     * @var ArrayCollection
     */
    protected $companyServices;

    /**
     * @var ArrayCollection
     */
    protected $terminals;

    /**
     * @var ArrayCollection
     */
    protected $ratingProfiles;

    /**
     * @var ArrayCollection
     */
    protected $musicsOnHold;

    /**
     * @var ArrayCollection
     */
    protected $recordings;

    /**
     * @var ArrayCollection
     */
    protected $relFeatures;

    /**
     * @var ArrayCollection
     */
    protected $relCodecs;

    /**
     * @var ArrayCollection
     */
    protected $relRoutingTags;

    /**
     * @var ArrayCollection
     */
    protected $relCountries;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->extensions = new ArrayCollection();
        $this->ddis = new ArrayCollection();
        $this->friends = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->companyServices = new ArrayCollection();
        $this->terminals = new ArrayCollection();
        $this->ratingProfiles = new ArrayCollection();
        $this->musicsOnHold = new ArrayCollection();
        $this->recordings = new ArrayCollection();
        $this->relFeatures = new ArrayCollection();
        $this->relCodecs = new ArrayCollection();
        $this->relRoutingTags = new ArrayCollection();
        $this->relCountries = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getExtensions())) {
            $self->replaceExtensions(
                $fkTransformer->transformCollection(
                    $dto->getExtensions()
                )
            );
        }

        if (!is_null($dto->getDdis())) {
            $self->replaceDdis(
                $fkTransformer->transformCollection(
                    $dto->getDdis()
                )
            );
        }

        if (!is_null($dto->getFriends())) {
            $self->replaceFriends(
                $fkTransformer->transformCollection(
                    $dto->getFriends()
                )
            );
        }

        if (!is_null($dto->getContacts())) {
            $self->replaceContacts(
                $fkTransformer->transformCollection(
                    $dto->getContacts()
                )
            );
        }

        if (!is_null($dto->getCompanyServices())) {
            $self->replaceCompanyServices(
                $fkTransformer->transformCollection(
                    $dto->getCompanyServices()
                )
            );
        }

        if (!is_null($dto->getTerminals())) {
            $self->replaceTerminals(
                $fkTransformer->transformCollection(
                    $dto->getTerminals()
                )
            );
        }

        if (!is_null($dto->getRatingProfiles())) {
            $self->replaceRatingProfiles(
                $fkTransformer->transformCollection(
                    $dto->getRatingProfiles()
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

        if (!is_null($dto->getRecordings())) {
            $self->replaceRecordings(
                $fkTransformer->transformCollection(
                    $dto->getRecordings()
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

        if (!is_null($dto->getRelCodecs())) {
            $self->replaceRelCodecs(
                $fkTransformer->transformCollection(
                    $dto->getRelCodecs()
                )
            );
        }

        if (!is_null($dto->getRelRoutingTags())) {
            $self->replaceRelRoutingTags(
                $fkTransformer->transformCollection(
                    $dto->getRelRoutingTags()
                )
            );
        }

        if (!is_null($dto->getRelCountries())) {
            $self->replaceRelCountries(
                $fkTransformer->transformCollection(
                    $dto->getRelCountries()
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
     * @param CompanyDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getExtensions())) {
            $this->replaceExtensions(
                $fkTransformer->transformCollection(
                    $dto->getExtensions()
                )
            );
        }
        if (!is_null($dto->getDdis())) {
            $this->replaceDdis(
                $fkTransformer->transformCollection(
                    $dto->getDdis()
                )
            );
        }
        if (!is_null($dto->getFriends())) {
            $this->replaceFriends(
                $fkTransformer->transformCollection(
                    $dto->getFriends()
                )
            );
        }
        if (!is_null($dto->getContacts())) {
            $this->replaceContacts(
                $fkTransformer->transformCollection(
                    $dto->getContacts()
                )
            );
        }
        if (!is_null($dto->getCompanyServices())) {
            $this->replaceCompanyServices(
                $fkTransformer->transformCollection(
                    $dto->getCompanyServices()
                )
            );
        }
        if (!is_null($dto->getTerminals())) {
            $this->replaceTerminals(
                $fkTransformer->transformCollection(
                    $dto->getTerminals()
                )
            );
        }
        if (!is_null($dto->getRatingProfiles())) {
            $this->replaceRatingProfiles(
                $fkTransformer->transformCollection(
                    $dto->getRatingProfiles()
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
        if (!is_null($dto->getRecordings())) {
            $this->replaceRecordings(
                $fkTransformer->transformCollection(
                    $dto->getRecordings()
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
        if (!is_null($dto->getRelCodecs())) {
            $this->replaceRelCodecs(
                $fkTransformer->transformCollection(
                    $dto->getRelCodecs()
                )
            );
        }
        if (!is_null($dto->getRelRoutingTags())) {
            $this->replaceRelRoutingTags(
                $fkTransformer->transformCollection(
                    $dto->getRelRoutingTags()
                )
            );
        }
        if (!is_null($dto->getRelCountries())) {
            $this->replaceRelCountries(
                $fkTransformer->transformCollection(
                    $dto->getRelCountries()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
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
     * @return static
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
     * @param ArrayCollection $extensions of Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     * @return static
     */
    public function replaceExtensions(ArrayCollection $extensions)
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
     * @param Criteria | null $criteria
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
     * @return static
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
     * @param ArrayCollection $ddis of Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     * @return static
     */
    public function replaceDdis(ArrayCollection $ddis)
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
     * @param Criteria | null $criteria
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
     * @return static
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
     * @param ArrayCollection $friends of Ivoz\Provider\Domain\Model\Friend\FriendInterface
     * @return static
     */
    public function replaceFriends(ArrayCollection $friends)
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
     * @param Criteria | null $criteria
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
     * Add contact
     *
     * @param \Ivoz\Provider\Domain\Model\Contact\ContactInterface $contact
     *
     * @return static
     */
    public function addContact(\Ivoz\Provider\Domain\Model\Contact\ContactInterface $contact)
    {
        $this->contacts->add($contact);

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \Ivoz\Provider\Domain\Model\Contact\ContactInterface $contact
     */
    public function removeContact(\Ivoz\Provider\Domain\Model\Contact\ContactInterface $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Replace contacts
     *
     * @param ArrayCollection $contacts of Ivoz\Provider\Domain\Model\Contact\ContactInterface
     * @return static
     */
    public function replaceContacts(ArrayCollection $contacts)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($contacts as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->contacts as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->contacts->set($key, $updatedEntities[$identity]);
            } else {
                $this->contacts->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addContact($entity);
        }

        return $this;
    }

    /**
     * Get contacts
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\Contact\ContactInterface[]
     */
    public function getContacts(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->contacts->matching($criteria)->toArray();
        }

        return $this->contacts->toArray();
    }

    /**
     * Add companyService
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface $companyService
     *
     * @return static
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
     * @param ArrayCollection $companyServices of Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface
     * @return static
     */
    public function replaceCompanyServices(ArrayCollection $companyServices)
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
     * @param Criteria | null $criteria
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
     * @return static
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
     * @param ArrayCollection $terminals of Ivoz\Provider\Domain\Model\Terminal\TerminalInterface
     * @return static
     */
    public function replaceTerminals(ArrayCollection $terminals)
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
     * @param Criteria | null $criteria
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
     * Add ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     *
     * @return static
     */
    public function addRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile)
    {
        $this->ratingProfiles->add($ratingProfile);

        return $this;
    }

    /**
     * Remove ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     */
    public function removeRatingProfile(\Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile)
    {
        $this->ratingProfiles->removeElement($ratingProfile);
    }

    /**
     * Replace ratingProfiles
     *
     * @param ArrayCollection $ratingProfiles of Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface
     * @return static
     */
    public function replaceRatingProfiles(ArrayCollection $ratingProfiles)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ratingProfiles as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->ratingProfiles as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->ratingProfiles->set($key, $updatedEntities[$identity]);
            } else {
                $this->ratingProfiles->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRatingProfile($entity);
        }

        return $this;
    }

    /**
     * Get ratingProfiles
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface[]
     */
    public function getRatingProfiles(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->ratingProfiles->matching($criteria)->toArray();
        }

        return $this->ratingProfiles->toArray();
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
     * Add recording
     *
     * @param \Ivoz\Provider\Domain\Model\Recording\RecordingInterface $recording
     *
     * @return static
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
     * @param ArrayCollection $recordings of Ivoz\Provider\Domain\Model\Recording\RecordingInterface
     * @return static
     */
    public function replaceRecordings(ArrayCollection $recordings)
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
     * @param Criteria | null $criteria
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
     * @return static
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
     * @param ArrayCollection $relFeatures of Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface
     * @return static
     */
    public function replaceRelFeatures(ArrayCollection $relFeatures)
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
     * @param Criteria | null $criteria
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
     * Add relCodec
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface $relCodec
     *
     * @return static
     */
    public function addRelCodec(\Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface $relCodec)
    {
        $this->relCodecs->add($relCodec);

        return $this;
    }

    /**
     * Remove relCodec
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface $relCodec
     */
    public function removeRelCodec(\Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface $relCodec)
    {
        $this->relCodecs->removeElement($relCodec);
    }

    /**
     * Replace relCodecs
     *
     * @param ArrayCollection $relCodecs of Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface
     * @return static
     */
    public function replaceRelCodecs(ArrayCollection $relCodecs)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relCodecs as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relCodecs as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relCodecs->set($key, $updatedEntities[$identity]);
            } else {
                $this->relCodecs->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelCodec($entity);
        }

        return $this;
    }

    /**
     * Get relCodecs
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface[]
     */
    public function getRelCodecs(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relCodecs->matching($criteria)->toArray();
        }

        return $this->relCodecs->toArray();
    }

    /**
     * Add relRoutingTag
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relRoutingTag
     *
     * @return static
     */
    public function addRelRoutingTag(\Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relRoutingTag)
    {
        $this->relRoutingTags->add($relRoutingTag);

        return $this;
    }

    /**
     * Remove relRoutingTag
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relRoutingTag
     */
    public function removeRelRoutingTag(\Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relRoutingTag)
    {
        $this->relRoutingTags->removeElement($relRoutingTag);
    }

    /**
     * Replace relRoutingTags
     *
     * @param ArrayCollection $relRoutingTags of Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface
     * @return static
     */
    public function replaceRelRoutingTags(ArrayCollection $relRoutingTags)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relRoutingTags as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relRoutingTags as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relRoutingTags->set($key, $updatedEntities[$identity]);
            } else {
                $this->relRoutingTags->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelRoutingTag($entity);
        }

        return $this;
    }

    /**
     * Get relRoutingTags
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface[]
     */
    public function getRelRoutingTags(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relRoutingTags->matching($criteria)->toArray();
        }

        return $this->relRoutingTags->toArray();
    }

    /**
     * Add relCountry
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryInterface $relCountry
     *
     * @return static
     */
    public function addRelCountry(\Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryInterface $relCountry)
    {
        $this->relCountries->add($relCountry);

        return $this;
    }

    /**
     * Remove relCountry
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryInterface $relCountry
     */
    public function removeRelCountry(\Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryInterface $relCountry)
    {
        $this->relCountries->removeElement($relCountry);
    }

    /**
     * Replace relCountries
     *
     * @param ArrayCollection $relCountries of Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryInterface
     * @return static
     */
    public function replaceRelCountries(ArrayCollection $relCountries)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relCountries as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCompany($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relCountries as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relCountries->set($key, $updatedEntities[$identity]);
            } else {
                $this->relCountries->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelCountry($entity);
        }

        return $this;
    }

    /**
     * Get relCountries
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryInterface[]
     */
    public function getRelCountries(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relCountries->matching($criteria)->toArray();
        }

        return $this->relCountries->toArray();
    }
}
