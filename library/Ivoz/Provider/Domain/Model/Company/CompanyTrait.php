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
    protected $ratingProfiles;

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
    protected $relCodecs;

    /**
     * @var Collection
     */
    protected $relRoutingTags;


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
        $this->ratingProfiles = new ArrayCollection();
        $this->musicsOnHold = new ArrayCollection();
        $this->recordings = new ArrayCollection();
        $this->relFeatures = new ArrayCollection();
        $this->relCodecs = new ArrayCollection();
        $this->relRoutingTags = new ArrayCollection();
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto CompanyDto
         */
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
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto CompanyDto
         */
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
     * Add ratingProfile
     *
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface $ratingProfile
     *
     * @return CompanyTrait
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
     * @param \Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface[] $ratingProfiles
     * @return self
     */
    public function replaceRatingProfiles(Collection $ratingProfiles)
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
     *
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
     * Add relCodec
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface $relCodec
     *
     * @return CompanyTrait
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
     * @param \Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface[] $relCodecs
     * @return self
     */
    public function replaceRelCodecs(Collection $relCodecs)
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
     *
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
     * @return CompanyTrait
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
     * @param \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface[] $relRoutingTags
     * @return self
     */
    public function replaceRelRoutingTags(Collection $relRoutingTags)
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
     *
     * @return \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface[]
     */
    public function getRelRoutingTags(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relRoutingTags->matching($criteria)->toArray();
        }

        return $this->relRoutingTags->toArray();
    }
}
